<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use App\Models\Chemical;

class ChemicalExcelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = File::get(database_path('Chemicals.json'));
        $file = json_decode($json, true);
        foreach ($file as $chemical) {
            Chemical::create($chemical);
        }
    }
}
