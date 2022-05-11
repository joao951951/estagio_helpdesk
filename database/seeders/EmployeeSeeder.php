<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'paulomoraes',
            'email' => 'paulo.moraes@email.com',
            'password' => bcrypt('teste'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        Employee::create([
            'user_id' => $user->id,
            'name' => 'Paulo Jorge Moraes',
            'cpf' => '118.998.771-69',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
