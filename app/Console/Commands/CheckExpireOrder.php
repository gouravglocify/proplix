<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Mail;
use App\User;
use App\Order;
use DB;

class CheckExpireOrder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:CheckExpireOrder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Notificaton for Expired Date for Subscription';

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
      $expired = \Carbon\Carbon::now()->toDateString();
      $orders = DB::table('orders')
               ->join('users' , 'users.id' , '=' , 'orders.user_id')
              ->whereDate('orders.expired_at', '=', $expired)->pluck('users.email' , 'users.name');
      if(count($orders) > 0)
      {
        foreach ($orders as $value)
        Mail::raw("Your plan is Expired soon , Visit on our Site , Update it! ", function($message) use ( $value)
        {
        $message->from('test@gmail.com');
        $message->to( $value )->subject('Plan Expired Soon!');
        });
      }

    }
}
