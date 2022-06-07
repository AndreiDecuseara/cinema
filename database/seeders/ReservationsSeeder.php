<?php

namespace Database\Seeders;

use App\Models\Reservation;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;

/**
 *
 *
 * @package Database\Seeders
 */
class ReservationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $this->getRecords()->each(function ($item) {
            Reservation::create(array_merge([
            ], $item));
        });
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    private function getRecords(): Collection
    {
        return collect([
            ['customer_id' => 1,
            'ticket_id' => 1,
            ],
            ['customer_id' => 2,
            'ticket_id' => 3,
            ],
            ['customer_id' => 3,
            'ticket_id' => 2,
            ],
            ['customer_id' => 4,
            'ticket_id' => 4,
            ],
        ]);
    }
}
