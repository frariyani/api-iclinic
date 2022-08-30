<?php

use Illuminate\Database\Seeder;
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
        User::create([
            'username' => 'test1',
            'password' => bcrypt('pass123'),
            'fullname' => 'Test',
            'roleID' => '1'
        ]);
    }
}
