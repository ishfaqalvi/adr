<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class PackagingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('packagings')->insert([
            [
                'user_id' => 1,
                'name_en' => 'Drum',
                'name_it' => 'Fusto',
                'default' => 1
            ],
            [
                'user_id' => 1,
                'name_en' => 'Box',
                'name_it' => 'Cassa/Scatola',
                'default' => 1
            ],
            [
                'user_id' => 1,
                'name_en' => 'Jerrican',
                'name_it' => 'Tanica',
                'default' => 1
            ],
            [
                'user_id' => 1,
                'name_en' => 'Bag',
                'name_it' => 'Sacco',
                'default' => 1
            ],
            [
                'user_id' => 1,
                'name_en' => 'IBC',
                'name_it' => 'IBC Cisternetta',
                'default' => 1
            ],
            [
                'user_id' => 1,
                'name_en' => 'BigBag',
                'name_it' => 'IBC BigBag',
                'default' => 1
            ]
        ]);
    }
}
