<?php

namespace Database\Seeders;

use App\Models\data_master;
use Illuminate\Database\Seeder;

class DataMasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        data_master::create([
            'total_order' => 0,
            'stok_awn' => 0,
            'stok_nambo' => 0,
            'stok' => 0
        ]);
    }
}
