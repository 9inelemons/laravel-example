<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        User::create([
            'name' => 'Admin User',
            'email' => 'adminadmin@admin.com',
            'inn' => '123123123123',
            'phone' => '+79000000000',
            'organization' => 'AdminAdmin',
            'description' => 'Admin user organization',
            'password' => Hash::make('adminadmin'),
            'uuid' => Str::uuid(),
        ]);

        User::create([
            'name' => 'User User',
            'email' => 'useruser@user.com',
            'inn' => '321321321321',
            'phone' => '+79000000001',
            'organization' => 'UserUser',
            'description' => 'User user organization',
            'password' => Hash::make('useruser'),
            'uuid' => Str::uuid(),
        ]);
    }
}
