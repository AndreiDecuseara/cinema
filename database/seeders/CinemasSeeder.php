<?php

namespace Database\Seeders;

use App\Models\Cinema;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;

/**
 *
 *
 * @package Database\Seeders
 */
class CinemasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $this->getRecords()->each(function ($item) {
            Cinema::create(array_merge([
            ], $item));
        });
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    private function getRecords(): Collection
    {
        return collect([
            ['name' => 'Hollywood Multiplex',
             'country_id' => 1],
             ['name' => 'Cinema City Cotroceni',
             'country_id' => 1],
             ['name' => 'Baneasa Drive-In Cinema',
             'country_id' => 1],
             ['name' => 'Uranus 144 aka E-Uranus',
             'country_id' => 2],
             ['name' => 'Studio',
             'country_id' => 3],
             ['name' => ' Samsung IMAX',
             'country_id' => 2],
        ]);
    }
}
