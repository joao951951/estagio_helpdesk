<?php

namespace Database\Seeders;

use App\Models\Typeuser;
use Illuminate\Database\Seeder;

class TypeuserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Typeuser::create([
            'desc_type' => 'Usuario Interno',
        ]);
        Typeuser::create([
            'desc_type' => 'Usuario externo',
        ]);
    }
}
