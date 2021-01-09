<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("TRUNCATE TABLE users");
        DB::table("users")->insert([
           'name' => 'Saitcan TAKILAN',
           'username' => 'admin',
           'email' => 'admin@saitcantakilan.com',
           'email_verified_at' => now(),
           'password' => bcrypt(123123),
           'remember_token' => Str::random(10)
        ]);
        User::factory(3)->create();
    }
}
