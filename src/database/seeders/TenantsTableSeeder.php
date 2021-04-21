<?php

namespace Database\Seeders;

use App\Models\Plan;
use App\Models\Tenant;
use Illuminate\Database\Seeder;

class TenantsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $plan = Plan::first();

        $plan->tenants()->create([
            'cnpj' => '16.490.342/0001-77',
            'name' => 'ExodoDigitalMKT',
            'url' => 'exododigitalmkt',
            'email' => 'exododigitalmkt@gmail.com'
        ]);
    }
}
