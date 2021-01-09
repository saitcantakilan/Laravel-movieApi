<?php

namespace Database\Seeders;

use App\Models\Director;
use App\Models\Movie;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DirectorMoviesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('movies')->delete();
        DB::table('directors')->delete();
        Director::factory(20)->has(Movie::factory(3))->create();
    }
}
