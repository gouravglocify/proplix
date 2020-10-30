<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Report;
use PDF;
use Excel;
use App\Exports\UsersReportExport;
use App\UserSubscription;
use App\Coupon;
use Razorpay\Api\Api;
use App\Notifications\SubscriptionCancelAlert;
class AdminController extends Controller
{
    public function adminDashboard(Request $request){
    	$userDetails = Auth::user();
    	$users = User::where('user_type','1')->get();
    	return view('admin.dashboard',compact('userDetails','users'));
    }

    public function reports(Request $request){
    	$userDetails = Auth::user();
    	$reports = Report::get();
    	return view('admin.reports',compact('userDetails','reports'));
    }

    public function viewReportAdmin(Request $request,$id){
		$userDetails = Auth::user();
		$getReportDetails = Report::where([
								['id','=',base64_decode($id)]
							])->first();
		if(is_null($getReportDetails)){
			return redirect(url('reports'));
		}
		return view('admin.viewReport',compact('userDetails','getReportDetails'));
	}
    public function downloadReportsAdmin(Request $request, $type, $id){
        if($type!='pdf' && $type!='excel'){
            return redirect(url('allReports'));
        }
        $reports = array();
        $userDetails = Auth::user();
        $report = Report::where([
                                ['id','=',base64_decode($id)]
                            ])->first();
        if(is_null($report)){
            return redirect(url('allReports'));
        }
        $reports[] = $report;
        if($type=='pdf'){
            $pdf = PDF::loadView('exports.reportsExcel', compact('reports'))->setPaper('a4', 'landscape');
             return $pdf->download(base64_encode($report->user_id).'_'.$report->title . '.pdf');
        }
        //EXCEL
        ob_end_clean(); // this
        ob_start(); // and this
        return Excel::download(new UsersReportExport($reports), base64_encode($report->id).'_'.$report->title.'.xlsx');
    }


    public function downloadMultipleReportsAdmin(Request $request){
        $reports = array();
        $userDetails = Auth::user();
        if(is_null($request->input('ids'))){
            return redirect(url('reports'));
        }

        foreach(explode(",",$request->input('ids')) as $ids){
            $report = Report::where([
                                ['id','=',base64_decode($ids)]
                            ])->first();
            if(!is_null($report)){
                    $reports[] = $report;
                }
        }

        //PDF   
        if($request->input('type')=='pdf'){
            $pdf = PDF::loadView('exports.reportsExcel', compact('reports'))->setPaper('a4', 'landscape');
            return $pdf->download(date('Y-m-d h:i:s').'_reports.pdf');
        }      
        //EXCEL
        ob_end_clean(); // this
        ob_start(); // and this
        return Excel::download(new UsersReportExport($reports), date('Y-m-d h:i:s').'_reports.xlsx');
    }

    public function users(Request $request){
        $userDetails = Auth::user();
        $users = User::where('user_type','1')->get();
        return view('admin.users',compact('userDetails','users'));
    }

    public function usersMembership(Request $request){
        $userDetails = Auth::user();
        $userSubscriptions = UserSubscription::orderBy('id','DESC')->get();
        return view('admin.userMemberships',compact('userDetails','userSubscriptions'));
    }

    public function adminProfile(Request $request){
        $userDetails = Auth::user();
        if(!empty($request->all())){
            $request->validate([
                'name' => ['required', 'string', 'max:25'],
                'phone' => ['required', 'string','max:10',],
            ]);

            if(!is_null($request->input('password'))){
                User::where('id',$userDetails->id)->update([
                                                        'name'=>$request->input('name'),
                                                        'phone'=>$request->input('phone'),
                                                        'password'=>bcrypt($request->input('password')),
                                                    ]);
            }   
            else{
                User::where('id',$userDetails->id)->update([
                                                        'name'=>$request->input('name'),
                                                        'phone'=>$request->input('phone'),
                                                    ]);
            }
            return back()->with('success','Profile updated successfully.');
            
        }
        return view('admin.profile',compact('userDetails'));
    }

    public function coupons(Request $request){
        $userDetails = Auth::user();
        $coupons = Coupon::orderBy('id','DESC')->get();
        return view('admin.coupons',compact('userDetails','coupons'));
    }

    public function addCoupon(Request $request){
        $userDetails = Auth::user();
        if(!empty($request->all())){
            $request->validate([
                'name'=>['required','max:20','unique:coupons'],
                'coupon_applicable_on'=>['required'],
                'description'=>['required'],
                'discount_type'=>['required'],
                'discount_value'=>['required'],
                'duration'=>['required'],
                'number_of_use'=>['required'],
                'end_date'=>['required'],
            ]);

            if($request->input('start_date')>=$request->input('end_date')){
                return back()->with('error','Start date cannot be greater than end date.');
            }

            $coupon  = Coupon::create([
                        'coupon_applicable_on'=>$request->input('coupon_applicable_on'),
                        'name'=>$request->input('name'),
                        'description'=>$request->input('description'),
                        'discount_type'=>$request->input('discount_type'),
                        'discount_value'=>$request->input('discount_value'),
                        'duration'=>$request->input('duration'),
                        'number_of_use'=>$request->input('number_of_use'),
                        'end_date'=>date('Y-m-d',strtotime($request->input('end_date'))),
                        'status'=>'1',
                        ]);

            return redirect(url('coupons'))->with('success','Coupon added !');

        }
        return view('admin.addCoupon',compact('userDetails'));
    }

    public function deleteCoupon(Request $request,$id){
        $userDetails = Auth::user();
        $getCouponDetails = Coupon::where('id',base64_decode($id))->first();
        if(is_null($getCouponDetails)){
            return back()->with('error','No coupon code found !');
        }
        Coupon::where('id',$getCouponDetails->id)->update(['status'=>'2']);
        return redirect(url('coupons'))->with('success','Coupon deleted !');

    }
        

    public function editCoupon(Request $request,$id){
        $userDetails = Auth::user();
        $getCouponDetails = Coupon::where('id',base64_decode($id))->first();
        if(is_null($getCouponDetails)){
            return back()->with('error','No coupon code found !');
        }
        
        if(!empty($request->all())){
            if(strtoupper($getCouponDetails->name)==strtoupper($request->input('name'))){
                $request->validate([
                    'coupon_applicable_on'=>['required'],
                    'name'=>['required','max:20'],
                    'description'=>['required'],
                    'discount_type'=>['required'],
                    'discount_value'=>['required'],
                    'duration'=>['required'],
                    'number_of_use'=>['required'],
                    'end_date'=>['required'],
                ]);
            }   
            else{
                $request->validate([
                    'coupon_applicable_on'=>['required'],
                    'name'=>['required','max:20','unique:coupons'],
                    'description'=>['required'],
                    'discount_type'=>['required'],
                    'discount_value'=>['required'],
                    'duration'=>['required'],
                    'number_of_use'=>['required'],
                    'end_date'=>['required'],
                ]);
            }

            if($request->input('start_date')>=$request->input('end_date')){
                return back()->with('error','Start date cannot be greater than end date.');
            }

            $coupon  = Coupon::where('id',$getCouponDetails->id)->update([
                        'coupon_applicable_on'=>$request->input('coupon_applicable_on'),
                        'name'=>$request->input('name'),
                        'description'=>$request->input('description'),
                        'discount_type'=>$request->input('discount_type'),
                        'discount_value'=>$request->input('discount_value'),
                        'duration'=>$request->input('duration'),
                        'number_of_use'=>$request->input('number_of_use'),
                        'end_date'=>date('Y-m-d',strtotime($request->input('end_date'))),
                        ]);

            return redirect(url('coupons'))->with('success','Coupon updated !');

        }

        return view('admin.editCoupon',compact('userDetails','getCouponDetails'));

    }

    public function changeUserLoginStatus(Request $request,$id){
        $getUserDetails = User::where('id',$id)->first();
        if(is_null($getUserDetails)){
            return redirect(url('users'))->with('error','No user found.');
        }
        if($getUserDetails->user_type=='2'){
            return redirect(url('users'))->with('error','You cannot edit this user.');
        }

        $login_status = '2';
        

        $update = User::where('id',$getUserDetails->id)->update(['login_status'=>$login_status]);
        if($update==true){
            return redirect(url('users'))->with('success','User login status changed successfully.');
        }
        else{
            return redirect(url('users'))->with('error','Something went wrong.');
        }

    }

    public function cancelUserSubscription($userId, $subscriptionId){
        $getSubscriptionDetails = UserSubscription::where([
                                    'user_id'=>$userId,
                                    'subscription_id'=>$subscriptionId,
                                  ])->first();
        if(is_null($getSubscriptionDetails)){
            return redirect(url('usersMembership'))->with('error','Something went wrong.');
        }



        $api = new Api(config('razorpay.razorpay_key_id'), config('razorpay.razorpay_secret_key'));
        $options = ['cancel_at_cycle_end' => 0];
        $subscription = $api->subscription->fetch($getSubscriptionDetails->subscription_id)->cancel($options);
        $updateDetails = [
                            'status'=>$subscription->status,
                            'current_end'=>date('Y-m-d h:i:s',$subscription->current_end),
                         ];
        $update = UserSubscription::where('id',$getSubscriptionDetails->id)->update($updateDetails);
        $userDetails = User::where('id',$userId)->first();
        if($update==true){            
            $userDetails->notify((new SubscriptionCancelAlert($subscription)));
            return redirect(url('usersMembership'))->with('success','User subscription cancelled on '.date('F d,Y h:i A',$subscription->ended_at).'. This will affect by '.date('F d,Y h:i A',$subscription->current_end).'.');
        }
        else{
            return redirect(url('usersMembership'))->with('error','Something went wrong.');
        }
    }

    
}
