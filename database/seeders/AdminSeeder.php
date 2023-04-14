<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //create admin with user table data
        $user = User::create([
            'email' => 'admin@gmail.com',
            'password' => Hash::make('asd'),
            'user_type' => 1,
            'avatar' =>'default.png',
            'status' => 1,
            'is_approved' => 1,
            'is_admin' => 1,
        ]);
        //create admin with admin table data
        Admin::create([
            'user_id' => $user->id,
            'firstName' => 'John',
            'lastName' => 'Doe',
            'address' => '123, ABC Street, XYZ City, 123456',
        ]);

    }
}
