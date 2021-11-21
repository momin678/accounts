<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Hash;
class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::where('email', 'superadmin@gmail.com')->first();
        if(is_null($user)){
            $user = new User;
            $user->name = 'Md. SuperAdmin';
            $user->email = 'superadmin@gmail.com';
            $user->user_type = 'admin';
            $user->role = 1;
            $user->password = Hash::make('superadmin@gmail.com');
            $user->save();
        }
    }
}
