<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::where('email', 'user@gmail.com')->first();
        if(is_null($user)){
            $user = new User;
            $user->name = 'Md. User';
            $user->email = 'user@gmail.com';
            $user->user_type = 'user';
            $user->role = 1;
            $user->password = Hash::make('user@gmail.com');
            $user->save();
        }
    }
}
