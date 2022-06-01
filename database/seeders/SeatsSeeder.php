<?php

namespace Database\Seeders;

use App\Models\Seat;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;

/**
 *
 *
 * @package Database\Seeders
 */
class SeatsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $this->getRecords()->each(function ($item) {
            Seat::create(array_merge([
            ], $item));
        });
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    private function getRecords(): Collection
    {
        return collect([
            ['seat_nr' => 1,
             'row_nr' => 1,
             'hall_id' => 1],
             ['seat_nr' => 2,
             'row_nr' => 1,
             'hall_id' => 1],
             ['seat_nr' => 3,
             'row_nr' => 1,
             'hall_id' => 1],
             ['seat_nr' => 4,
             'row_nr' => 1,
             'hall_id' => 1],
             ['seat_nr' => 5,
             'row_nr' => 1,
             'hall_id' => 1],
             ['seat_nr' => 1,
             'row_nr' => 2,
             'hall_id' => 1],
             ['seat_nr' => 2,
             'row_nr' => 2,
             'hall_id' => 4],
             ['seat_nr' => 3,
             'row_nr' => 2,
             'hall_id' => 4],
             ['seat_nr' => 4,
             'row_nr' => 2,
             'hall_id' => 3],
             ['seat_nr' => 5,
             'row_nr' => 2,
             'hall_id' => 3],
             ['seat_nr' => 1,
             'row_nr' => 3,
             'hall_id' => 3],
             ['seat_nr' => 1,
             'row_nr' => 1,
             'hall_id' => 2],
             ['seat_nr' => 2,
             'row_nr' => 1,
             'hall_id' => 2],
             ['seat_nr' => 3,
             'row_nr' => 1,
             'hall_id' => 2],
             ['seat_nr' => 4,
             'row_nr' => 1,
             'hall_id' => 2],
             ['seat_nr' => 5,
             'row_nr' => 1,
             'hall_id' => 2],
        ]);
    }
}
