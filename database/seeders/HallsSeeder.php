<?php

namespace Database\Seeders;

use App\Models\Hall;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;

/**
 *
 *
 * @package Database\Seeders
 */
class HallsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $this->getRecords()->each(function ($item) {
            Hall::create(array_merge([
            ], $item));
        });
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    private function getRecords(): Collection
    {
        return collect([
            ['name' => 'Multiplex',
             'cinema_id' => 1],
             ['name' => 'Union',
             'cinema_id' => 2],
             ['name' => 'Central',
             'cinema_id' => 3],
             ['name' => 'Contact',
             'cinema_id' => 3],
             ['name' => 'Master Hall',
             'cinema_id' => 4],
             ['name' => 'Small Hall',
             'cinema_id' => 4],
             ['name' => 'Medium Hall',
             'cinema_id' => 4],
             ['name' => 'Big Hall',
             'cinema_id' => 2],
             ['name' => 'Never Hall',
             'cinema_id' => 1],
        ]);
    }
}
