<?php

use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    factory(User::class)->create([
      'name' => 'Enrique Rodriguez',
      'email' => 'enriq_1997@hotmail.com',
      'email_verified_at' => now(),
      'password' => bcrypt('123456'),
    ]);
  }
}
