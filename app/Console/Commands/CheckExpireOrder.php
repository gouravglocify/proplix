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
      $order = Order::whereDate('expired_at', '=', \Carbon\Carbon::now()->toDateString())->first();
      if(!empty($order))
      {
      $user = DB::table('orders')
             ->join('users' , 'orders.user_id' , '=' , 'users.id')
             ->select('orders.type' , 'users.email')
             ->get();

      dd($user);

      if(!empty($order) && !empty($user))
      {
        foreach ($user as $a)
        Mail::raw("Your plan is Expired soon , Visit on our Site , Update it!", function($message) use ($a)
        {
        $message->from('test@gmail.com');
        $message->to($a->email)->subject('Plan Expired Soon!');
        });
      }

    }
}
