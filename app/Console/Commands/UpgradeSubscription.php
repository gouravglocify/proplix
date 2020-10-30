<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Razorpay\Api\Api;
use App\UserSubscription;
use App\User;
use App\Notifications\SubscriptionRenewNotification;
class UpgradeSubscription extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:upgradeSubscription';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Upgrade user subscription !';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $api = new Api(config('razorpay.razorpay_key_id'), config('razorpay.razorpay_secret_key'));
        $getUserSubscriptions = UserSubscription::where([
                                    ['charge_at','<=',date("Y-m-d h:i:s")],
                                    ['status','!=','active'],
                                    ['current_end','=',NULL],
                                ])->get();
        if(count($getUserSubscriptions)>0){
            $time = 5;
            foreach($getUserSubscriptions as $getUserSubscription){
                 $subscription = $api->subscription->fetch($getUserSubscription->subscription_id);
                 if($subscription->remaining_count==0){
                  $planId = env('MONTHLY_PLAN_ID');
                  if($getUserSubscription->plan_type=='2'){
                    $planId = env('YEARLY_PLAN_ID');
                  }
                    $data = [
                      "plan_id"=>$planId,
                      "quantity"=>1,
                      "remaining_count"=>6,
                      "customer_notify"=>1,
                      "schedule_change_at"=>"now"
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

                 }
                 else{
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
                 }

                UserSubscription::create($details);

                if($subscription->status=='active'){
                    $msg = 'Your subscription is renewed on '.date('F d,Y h:i A').'.';
                }
                else{
                    $msg = 'Your subscription is cannot renewed on '.date('F d,Y h:i A').' because of insufficient fund in your account. Kindly add funds to your account. So, you can enjoy the benifits of proplix.';
                }
                $userDetails = User::where('id',$getUserSubscription->user_id)->first();    
                $time = $time+10;
                $when = now()->addSeconds($time);
                $userDetails->notify((new SubscriptionRenewNotification($subscription,$msg))->delay($when));
            }       
           
        }



        
    }
}
