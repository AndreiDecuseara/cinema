<?php

namespace Database\Seeders;

use App\Models\Movie;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;

/**
 *
 *
 * @package Database\Seeders
 */
class MoviesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $this->getRecords()->each(function ($item) {
            Movie::create(array_merge([
            ], $item));
        });
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    private function getRecords(): Collection
    {
        return collect([
            ['title' => 'Rapunzel',
             'rating_audience' => 'impress',
             'rating_score' => 9,
             'duration' => 130,
             'release_year' => 2019,
             'cinema_id' => 1],
             ['title' => 'Spiderman',
             'rating_audience' => 'failed',
             'rating_score' => 3,
             'release_year' => 2016,
             'duration' => 190,
             'cinema_id' => 2],
             ['title' => 'The Godfather',
             'rating_audience' => '-',
             'rating_score' => 6,
             'duration' => 150,
             'release_year' => 1972,
             'cinema_id' => 3],
             ['title' => 'The Lord',
             'rating_audience' => '-',
             'rating_score' => 7,
             'duration' => 220,
             'release_year' => 2020,
             'cinema_id' => 4],
             ['title' => 'Forrest Gump',
             'rating_audience' => 'good',
             'rating_score' => 8,
             'duration' => 210,
             'release_year' => 2022,
             'cinema_id' => 5],
             ['title' => 'Inception',
             'rating_audience' => 'fantastic',
             'rating_score' => 10,
             'duration' => 240,
             'release_year' => 2010,
             'cinema_id' => 6],
             ['title' => 'The Matrix ',
             'rating_audience' => '-',
             'rating_score' => 6,
             'duration' => 200,
             'release_year' => 1999,
             'cinema_id' => 4],
        ]);
    }
}
