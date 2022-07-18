<?php

namespace Database\Seeders;

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
        $user = new User();
        $user->fName = 'Mohammad Arman';
        $user->lName = 'Ali';
        $user->email = 'arman@gmail.com';
        $user->phone = '01307035688';
        $user->gender = 'Male';
        $user->dob = '20/09/2001';
        $user->role_id = 1;
        $user->role = 'admin';
        $user->password = Hash::make('123456');
        $user->save();
    }
}
