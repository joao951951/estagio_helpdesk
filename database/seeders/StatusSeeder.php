<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Status;


class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Status::create([
            'desc_status' => 'Aberto',
        ]);
        Status::create([
            'desc_status' => 'Em andamento',
        ]);
        Status::create([
            'desc_status' => 'Visita Tecnica',
        ]);
        Status::create([
            'desc_status' => 'Fechado',
        ]);
    }
}
