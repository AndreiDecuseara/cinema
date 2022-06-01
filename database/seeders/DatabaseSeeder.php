<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

/**
 * Class DatabaseSeeder
 *
 * @package Database\Seeders
 */
class DatabaseSeeder extends Seeder
{
    /** @var array|string[] */
    private array $seeders = [
        CinemasSeeder::class,
        MoviesSeeder::class,
        TicketsSeeder::class,
        HallsSeeder::class,
    ];

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call($this->seeders);
    }
}
