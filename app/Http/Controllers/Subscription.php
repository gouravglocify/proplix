<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Razorpay\Api\Api;
use App\UserSubscription;
use App\UserCalculation;
use App\Notifications\SubscriptionNotification;
use App\Notifications\SubscriptionCancelNotification;
use App\Notifications\SubscriptionRenewNotification;
use App\Coupon;
use App\User;
use App\Traits\PaytmChecksum;
use Illuminate\Support\Carbon;
class Subscription extends Controller
{
	use PaytmChecksum;

    public function packages(Request $request){
			$userDetails = Auth::user();
			$getUserSubscription = UserSubscription::where([
	                                    ['user_id','=',$userDetails->id],
	                                    ['status','=','active'],
	                               ])->orderBy('id','DESC')->first();
	        $getCaluationshit = UserCalculation::where('user_id',$userDetails->id)->get();
			return view('subscriptions.packages',compact('userDetails','getUserSubscription','getCaluationshit'));
    }

	public function buyProplix(Request $request,$type){
		if($type!='year' && $type!='month' ){
			return redirect(url('dashboard'));
		}
    	$userDetails = Auth::user();
		$getUserSubscription = UserSubscription::where([
                                    ['user_id','=',$userDetails->id],
                                    ['status','=','active'],
                               ])->orderBy('id','DESC')->first();
        if(!is_null($getUserSubscription)){
        	return redirect(url('dashboard'));
        }
        $getCaluationshit = UserCalculation::where('user_id',$userDetails->id)->get();
				$finalAmount = isset($type) & ($type == "month")  ? "100" : "599" ;
				$getCouponDetails = null;

				if(!empty($request->all())){
					if($type=='month'){
						$getCouponDetails = Coupon::where([
											['name','=',$request->input('promocode')],
											['end_date','>=',date('Y-m-d')],
											['status','=','1'],
											['coupon_applicable_on','=','1'],
										])->first();

						if(!is_null($getCouponDetails)){
							$usedTimes  = UserSubscription::where('coupon_id',$getCouponDetails->id)->get();
							if(count($usedTimes)>$getCouponDetails->number_of_use){
								return back()->with('error','Coupon limit exceeded.');
							}

							if($getCouponDetails->discount_type=='1'){
								$finalAmount = $finalAmount - $getCouponDetails->discount_value ;
							}
							else{
								$finalAmount = $finalAmount - (($finalAmount * $getCouponDetails->discount_value)/100);
							}

							$duration = $getCouponDetails->duration;
							if($getCouponDetails->duration=='1'){
								$duration = $duration + 1;
							}
						}
					}
				}
		return view('subscriptions.buyProplix',compact('userDetails','getUserSubscription','getCaluationshit','finalAmount' , 'type') );
    }







    public function transaction(Request $request,$paymentId,$subscriptionId,$signature,$type){
    	$details  = array();
    	$userDetails = Auth::user();
    	$getSubscriptionDetails = UserSubscription::where('user_id',$userDetails->id)->orderBy('id','DESC')->first();

    	if(!is_null($getSubscriptionDetails) && $getSubscriptionDetails->status=='active'){
    		return redirect(url('dashboard'));
    	}
    	$api = new Api(config('razorpay.razorpay_key_id'), config('razorpay.razorpay_secret_key'));
    	$subscription = $api->subscription->fetch($subscriptionId);
		$expectedSignature = hash_hmac('sha256', $paymentId . '|' . $subscriptionId, config('razorpay.razorpay_secret_key'));
		if ($expectedSignature === $signature){

			$getSubscriptionDetails = UserSubscription::where([
																'user_id'=>$userDetails->id,
																'subscription_id'=>$subscription->id,
																'plan_id'=>$subscription->plan_id,
															])->first();
			if(is_null($getSubscriptionDetails)){
				$plan_type='1';
				if(strtolower($type)=='year'){
					$plan_type='2';
				}
				if(isset($subscription['notes']['coupon_id'])){
					$finalAmount = 100;
					$getCouponDetails = Coupon::where('id',$subscription['notes']['coupon_id'])->first();
					if(!is_null($getCouponDetails)){
						if($getCouponDetails->discount_type=='1'){
							$discountAmount = $getCouponDetails->discount_value;
							$finalAmount = $finalAmount - $discountAmount ;
						}
						else{
							$discountAmount = (($finalAmount * $getCouponDetails->discount_value)/100);
							$finalAmount = $finalAmount - $discountAmount;
						}
						$details = [
							'plan_type'=>$plan_type,
							'user_id'=>$userDetails->id,
							'subscription_id'=>$subscription->id,
							'plan_id'=>$subscription->plan_id,
							'status'=>$subscription->status,
							'short_url'=>$subscription->short_url,
							'customer_id'=>$subscription->customer_id,
			    			'payment_id'=>$paymentId,
			    			'signature'=>$signature,
			    			'status'=>$subscription->status,
			    			'charge_at'=>date('Y-m-d h:i:s',$subscription->charge_at),
							'start_at'=>date('Y-m-d h:i:s',$subscription->start_at),
							'end_at'=>date('Y-m-d h:i:s',$subscription->end_at),
							'coupon_id'=>$getCouponDetails->id,
							'discount_amount'=>$discountAmount,
							'discount_price'=>$finalAmount,
							'total_count'=>$subscription->total_count,
							'remaining_count'=>$subscription->remaining_count,
						];
					}
				}
				else{


					$details = [
						'plan_type'=>$plan_type,
						'user_id'=>$userDetails->id,
						'subscription_id'=>$subscription->id,
						'plan_id'=>$subscription->plan_id,
						'status'=>$subscription->status,
						'short_url'=>$subscription->short_url,
						'customer_id'=>$subscription->customer_id,
		    			'payment_id'=>$paymentId,
		    			'signature'=>$signature,
		    			'status'=>$subscription->status,
		    			'charge_at'=>date('Y-m-d h:i:s',$subscription->charge_at),
						'start_at'=>date('Y-m-d h:i:s',$subscription->start_at),
						'end_at'=>date('Y-m-d h:i:s',$subscription->end_at),
						'total_count'=>$subscription->total_count,
						'remaining_count'=>$subscription->remaining_count,
					];
				}

				UserSubscription::create($details);
			}


			return redirect(url('packages'))->with('success','You subscription is processed. Please wait for two minutes. A confirmation email is sent to your email address '.strtolower($userDetails->email).'.');


		}
		else{
			return redirect(url('dashboard'));
		}
    }


    public function cancelSubscription(Request $request,$id){
    	$userDetails = Auth::user();
    	$api = new Api(config('razorpay.razorpay_key_id'), config('razorpay.razorpay_secret_key'));
    	$getSubscriptionDetails = UserSubscription::where([
											['id','=',base64_decode($id)],
											['user_id','=',$userDetails->id]
										])->first();

		if(is_null($getSubscriptionDetails)){
			return redirect(url('packages'))->with('error','Unauthorized Access');
		}

    	$options = ['cancel_at_cycle_end' => 0];
    	$subscription = $api->subscription->fetch($getSubscriptionDetails->subscription_id)->cancel($options);
    	UserSubscription::where('id',$getSubscriptionDetails->id)->update(['current_end'=>date('Y-m-d h:i:s',$subscription->current_end)]);
        $when = now()->addSeconds(10);
    	$userDetails->notify((new SubscriptionCancelNotification($subscription))->delay($when));
    	return redirect(url('packages'))->with('success','You subscription cancel request submitted successfully. You subscription cancel date is '.date('F d, Y h:i A',$subscription->current_end) .'.');
    }

    public function upgradeSubscription(Request $request,$id){
    	$userDetails = Auth::user();
    	$getUserSubscription = UserSubscription::where([
    						['id','=',base64_decode($id)],
    						['user_id','=',$userDetails->id],
    					])->first();
    	if(is_null($getUserSubscription)){
    		return redirect(url('packages'))->with('error','No active subscription found !');
    	}
    	$api = new Api(config('razorpay.razorpay_key_id'), config('razorpay.razorpay_secret_key'));
    	$subscription = $api->subscription->fetch($getUserSubscription->subscription_id);

    	$data = [
		          "plan_id"=>env('YEARLY_PLAN_ID'),
		          "quantity"=>1,
		          "remaining_count"=>6,
		          "customer_notify"=>1,
		          "schedule_change_at"=>"cycle_end"
		        ];
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://api.razorpay.com/v1/subscriptions/".$subscription->id,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "PATCH",
          CURLOPT_POSTFIELDS => json_encode($data),
          CURLOPT_HTTPHEADER => array(
            "authorization: Basic ".base64_encode(config('razorpay.razorpay_key_id').':'.config('razorpay.razorpay_secret_key')),
            "Content-Type: application/json",

          ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
          echo "cURL Error #:" . $err;
        } else {
          $subscription = json_decode($response);
        }


        $details = [
            'user_id'=>$getUserSubscription->user_id,
            'subscription_id'=>$subscription->id,
            'plan_id'=>$subscription->plan_id,
            'status'=>$subscription->status,
            'short_url'=>$subscription->short_url,
            'customer_id'=>$subscription->customer_id,
            'payment_id'=>$getUserSubscription->payment_id,
            'signature'=>$getUserSubscription->signature,
            'status'=>$subscription->status,
            'charge_at'=>date('Y-m-d h:i:s',$subscription->charge_at),
            'start_at'=>date('Y-m-d h:i:s',$subscription->start_at),
            'end_at'=>date('Y-m-d h:i:s',$subscription->end_at),
            'total_count'=>$subscription->total_count,
            'remaining_count'=>$subscription->remaining_count,
        ];

        UserSubscription::create($details);


        $msg = 'You subscription upgrade request is receieved. Plan will activate on '.date('F d, Y',$subscription->charge_at).'.';


        $time = 10;
        $when = now()->addSeconds($time);
        $userDetails->notify((new SubscriptionRenewNotification($subscription,$msg))->delay($when));

        return redirect(url('packages'))->with('success',$msg);



    }

    public function test(){

		$api = new Api(config('razorpay.razorpay_key_id'), config('razorpay.razorpay_secret_key'));

		$json=file_get_contents('php://input');
		$webhookBody = json_decode($json);

		$webhookSecret='proplix';
		$webhookSignature = hash_hmac('sha256', $webhookBody, $webhookSecret);


		$data = $api->utility->verifyWebhookSignature($webhookBody, $webhookSignature, $webhookSecret);
		$userDetails = User::where('email','saurabhkumar.glocify@gmail.com')->first();
		$userDetails->notify((new SubscriptionRenewNotification($subscription,$msg)));
    	// $api = new Api(config('razorpay.razorpay_key_id'), config('razorpay.razorpay_secret_key'));
    	// $options = ['cancel_at_cycle_end' => 0];
    	// $subscription = $api->subscription->fetch('sub_FJP99pv6r6YthP')->cancel($options);
    }

    public function paytm(){
    	$order = 'ORDER_'.rand(1,99);
		$paytmParams = array();

		$paytmParams["body"] = array(
		    "requestType"               => "NATIVE_SUBSCRIPTION",
		    "mid"                       => config('paytm.merchant_id'),
		    "websiteName"               => config('paytm.webiste'),
		    "orderId"                   => $order,
		    "callbackUrl"               => url('paytmSuccess'),
		    "subscriptionAmountType"    => "FIX",
		    "subscriptionFrequency"     => "2",
		    "subscriptionFrequencyUnit" => "MONTH",
		    "subscriptionExpiryDate"    => date('Y-m-d',strtotime("+30 days")),
		    "subscriptionEnableRetry"   => "1",
		    "txnAmount"                 => array(
		        "value"                 => "1.00",
		        "currency"              => "INR",
		    ),
		    "userInfo"                  => array(
		        "custId"                => "CUST_001",
		    ),
		);

		/*
		* Generate checksum by parameters we have in body
		* Find your Merchant Key in your Paytm Dashboard at https://dashboard.paytm.com/next/apikeys
		*/
		$checksum = PaytmChecksum::generateSignature(json_encode($paytmParams["body"], JSON_UNESCAPED_SLASHES), config('paytm.merchant_key'));

		$paytmParams["head"] = array(
		    "signature"	              => $checksum
		);

		$post_data = json_encode($paytmParams, JSON_UNESCAPED_SLASHES);


		/* for Staging */
		$url = "https://securegw-stage.paytm.in/subscription/create?mid=".config('paytm.merchant_id')."&orderId=".$order;


		/* for Production */
		// $url = "https://securegw.paytm.in/subscription/create?mid=YOUR_MID_HERE&orderId=ORDERID_98765";

		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
		$response = curl_exec($ch);
		json_decode($response,TRUE);
    }

    public function paytmSuccess(Request $request){
    	dd($request->all());
    }
}
