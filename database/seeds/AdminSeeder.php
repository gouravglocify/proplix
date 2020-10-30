<?php

use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Krishan Kumar',
            'user_type'=>'2',
            'email' => 'proplixofficial@gmail.com',
            'email_verified_at'=>date('Y-m-d h:i:s'),
            'password' => Hash::make("QrU>Fpck'xNwG_2z[t#JH:c"),
        ]);
    }
}
