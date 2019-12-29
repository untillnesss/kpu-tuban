<?php

use Illuminate\Database\Seeder;
use App\User;
// use DB;
// use Hash;

class table_user_seed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name'=>'Admin',
            'email'=>'admin@admin.com',
            'password'=>Hash::make('adminadmin')
        ]);
    }
}
