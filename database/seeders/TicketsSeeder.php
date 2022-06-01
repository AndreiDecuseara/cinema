<?php

namespace Database\Seeders;

use App\Models\Ticket;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;
use Carbon\Carbon;

/**
 *
 *
 * @package Database\Seeders
 */
class TicketsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $this->getRecords()->each(function ($item) {
            Ticket::create(array_merge([
            ], $item));
        });
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    private function getRecords(): Collection
    {
        return collect([
            ['ticket_number' => '323',
             'ticket_price' => 19,
             'ticket_date_time' => Carbon::create('2022', '01', '01'),
             'seat_id' => 1,
             'movie_id' => 1
            ],
            ['ticket_number' => '326',
            'ticket_price' => 19,
            'ticket_date_time' => Carbon::create('2022', '01', '01'),
            'seat_id' => 2,
            'movie_id' => 1
           ],
           ['ticket_number' => '123',
           'ticket_price' => 22,
           'ticket_date_time' => Carbon::create('2022', '03', '01'),
           'seat_id' => 3,
           'movie_id' => 2
           ],
          ['ticket_number' => '128',
          'ticket_price' => 22,
          'ticket_date_time' => Carbon::create('2022', '01', '12'),
          'seat_id' => 2,
          'movie_id' => 2
          ],
         ['ticket_number' => '547',
         'ticket_price' => 56,
         'ticket_date_time' => Carbon::create('2022', '07', '01'),
         'seat_id' => 2,
         'movie_id' => 3
        ],
        ['ticket_number' => '329',
        'ticket_price' => 89,
        'ticket_date_time' => Carbon::create('2022', '06', '12'),
        'seat_id' => 4,
        'movie_id' => 3
       ],
        ]);
    }
}
