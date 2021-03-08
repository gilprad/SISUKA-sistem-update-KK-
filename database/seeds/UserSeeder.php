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
      User::create([
          'name' => 'Admin',
          'email' => 'admin@gmail.test',
          'image' => '',
          'password' => bcrypt('123')
      ])->assignRole('admin');

      User::create([
          'name' => 'Verifikator',
          'email' => 'verifikator@gmail.test',
          'image' => '',
          'password' => bcrypt('123')
      ])->assignRole('verifikator');

      factory(User::class, 10)->create()->each(function ($u){
          $u->assignRole('user');
      });

      User::create([
          'name' => 'User',
          'email' => 'user@gmail.test',
          'image' => '',
          'password' => bcrypt('123')
      ])->assignRole(['user']);

    }
}
