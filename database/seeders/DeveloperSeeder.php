<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DeveloperSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('developers')->insert([
              [
                'name' => 'DEV1',
                'units' => 1,
              ],
              [
                'name' => 'DEV2',
                'units' => 2,
              ],
              [
                'name' => 'DEV3',
                'units' => 3,
              ],
              [
                'name' => 'DEV4',
                'units' => 4,
              ],
              [
                'name' => 'DEV5',
                'units' => 5,
              ]
          ]);
    }
}
