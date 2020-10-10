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
        $admin = User::factory()->create([
    		'name' => 'Enrique Rodriguez',
    		'email' => 'enriq_1997@hotmail.com',
    		'email_verified_at' => now(),
    		'password' => bcrypt('123456'),
        ]);

        $admin->assign('admin');
    	
        User::factory()
            ->times(50)
            ->create();
    }
}
