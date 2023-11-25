<?php
namespace Database\Seeders;

use App\Models\Bus;
use Illuminate\Database\Seeder;

class BusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $buses = [];

        foreach (range(1, 15) as $id) {
            $buses[] = [
                'id'               => $id,
                'name'             => 'Bus ' . $id,
                'places_available' => mt_rand(15, 40),
            ];
        }

        Bus::insert($buses);
    }
}
