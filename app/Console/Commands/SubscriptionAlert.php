<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;
use App\UserSubscription;
use Razorpay\Api\Api;
use App\Notifications\SubscriptionNotification;
class SubscriptionAlert extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:subscriptionAlert';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Subscription Alert !';

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
        $time = 0;
        $api = new Api(config('razorpay.razorpay_key_id'), config('razorpay.razorpay_secret_key'));
        $getNotActivatedSubscription = UserSubscription::where([
                                                                ['status','!=','active'],
                                                                ['current_end','=',NULL],
                                                             ])->get();

        if(count($getNotActivatedSubscription)>0){
            foreach($getNotActivatedSubscription as $getSubscriptionDetails){

                $userDetails = User::where('id',$getSubscriptionDetails->user_id)->first();
              
                $msg = 'Monthly Plan';
                if($getSubscriptionDetails->plan_type=='2'){
                    $msg = 'Yearly Plan';
                }
                $subscription = $api->subscription->fetch($getSubscriptionDetails->subscription_id);
                $time = $time+10;
                $when = now()->addSeconds($time);
                $userDetails->notify((new SubscriptionNotification($subscription,$msg))->delay($when));
                $details = [
                    'status'=>$subscription->status,
                    'short_url'=>$subscription->short_url,
                    'customer_id'=>$subscription->customer_id,
                    'status'=>$subscription->status,
                    'charge_at'=>date('Y-m-d h:i:s',$subscription->charge_at),
                    'start_at'=>date('Y-m-d h:i:s',$subscription->start_at),
                    'end_at'=>date('Y-m-d h:i:s',$subscription->end_at),
                    ];
                UserSubscription::where('id',$getSubscriptionDetails->id)->update($details);      
                
                
            }
        }
    }
}
