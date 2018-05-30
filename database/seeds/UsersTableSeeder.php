<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\User::create([
            "name" => "Simon Gheux",
            "email" => "simongheux@gmail.com",
            "role_id" => 1,
            "password" => bcrypt('admin1234'),
        ]);

        App\User::create([
            "name" => "simon test",
            "email" => "simongheux@test.com",
            "role_id" => 2,
            "password" => bcrypt('secret'),
        ]);

        factory(App\User::class, 50)->create()->each(function($user) {
            for($i=0; $i < rand(1,3); $i++){
                $user->posts()->save(factory(App\Post::class)->make());

            }
        });

    }
}
