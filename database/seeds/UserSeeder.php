<?php

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::where('email', 'anup9449@gmail.com')->first();
        if(is_null($user)){
            $user = new User();
            $user->first_name = "Anup";
            $user->last_name = "Chakraborty";
            $user->email = "anup9449@gmail.com";
            $user->username = "anup-chakraborty";
            $user->password =Hash::make("12345678");
            $user->phone = "01676188050";
            $user->street_address = "South Satpai";
            $user->shipping_address = "South Satpai";
            $user->division_id = 2;
            $user->district_id = 3;
            $user->save();
        }
    }
}
