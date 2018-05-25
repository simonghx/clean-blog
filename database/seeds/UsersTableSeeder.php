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
            "password" => bcrypt('admin1234'),
        ]);

        factory(App\User::class, 50)->create()->each(function($user) {
            for($i=0; $i < rand(1,3); $i++){
                $user->posts()->save(factory(App\Post::class)->make());

            }
        });

    }
}
