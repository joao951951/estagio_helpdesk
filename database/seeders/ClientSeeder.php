<?php

namespace Database\Seeders;

use App\Models\Client;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Client::create([
            'name' => 'Patrícia e Vitor Pizzaria ME',
            'email' => 'estoque@patriciaevitorpizzariame.com.br',
            'cnpj' => '53.835.420/0001-54',
            'contract' => 'contrato1',
            'address' => 'Via de Pedestre Senatus',
            'city' => 'São Paulo',
            'phone' => '(11) 3929-6219',
            'insc' => '489.357.830.449',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
