<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;

/**
 *
 *
 * @package Database\Seeders
 */
class CustomersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $this->getRecords()->each(function ($item) {
            Customer::create(array_merge([
            ], $item));
        });
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    private function getRecords(): Collection
    {
        return collect([
            ['first_name' => 'Andrei',
            'middle_name' => 'Cristi',
            'last_name' => 'Decuseara',
            'cnp' => '1980811224323',
            'email' => 'andrei@gmail.com',
            'country_id' => 1,],
            ['first_name' => 'Ion',
            'middle_name' => 'Cristi',
            'last_name' => 'Ionsecu',
            'cnp' => '1980811224311',
            'email' => 'ion@gmail.com',
            'country_id' => 1,],
            ['first_name' => 'Mihaela',
            'middle_name' => 'Cristina',
            'last_name' => 'Dorobanti',
            'cnp' => '2980812228311',
            'email' => 'mihaela@gmail.com',
            'country_id' => 1,],
            ['first_name' => 'Nae',
            'middle_name' => '-',
            'last_name' => 'Nedelcu',
            'cnp' => '19808122324561',
            'email' => 'nae@gmail.com',
            'country_id' => 1,],
        ]);
    }
}
