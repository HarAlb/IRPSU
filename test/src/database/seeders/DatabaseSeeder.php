<?php

namespace Database\Seeders;

use App\Models\Drug;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(1)->create();

        \App\Models\Substance::factory(10)->create();

        \App\Models\Drug::factory(10)->create()->each(function (Drug $drug) {
            $drug->substances()->attach([1, 2]);
        });

        \App\Models\Drug::factory(10)->create()->each(function (Drug $drug) {
            $drug->substances()->attach([1, 2, 3]);
        });

        \App\Models\Drug::factory(2)->create()->each(function (Drug $drug) {
            $drug->substances()->attach([1, 2, 3, 4]);
        });

        \App\Models\Drug::factory(2)->create()->each(function (Drug $drug) {
            $drug->substances()->attach([2, 3, 4, 5, 6]);
        });

        \App\Models\Drug::factory(2)->create()->each(function (Drug $drug) {
            $drug->substances()->attach([3, 4, 5, 6, 7]);
        });

        \App\Models\Drug::factory(2)->create()->each(function (Drug $drug) {
            $drug->substances()->attach([1, 2, 3, 4]);
        });

        \App\Models\Drug::factory(2)->create()->each(function (Drug $drug) {
            $drug->substances()->attach([2, 3, 4, 5, 6]);
        });
    }
}
