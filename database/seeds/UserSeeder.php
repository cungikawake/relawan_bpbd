<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = new User;
        $data->name = 'administrator';
        $data->email = 'admin@admin.com';
        $data->password = Hash::make('12345678');
        $data->role = 1;
        $data->status_verified = 1;
        $data->save();
    }
}
