<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$data = ['name'=>'Thanh',
    	'email'=> 'thanhmedianet@gmail.com',
    	'password'=>\Hash::make('12341234'),
    	'created_at'=>'2020-11-10',
    	
    ];
         DB::table('users')->insert($data);
    }
}
