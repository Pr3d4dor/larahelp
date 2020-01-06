<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => 'admin',
        ]);

        $user->save();
    }
}
