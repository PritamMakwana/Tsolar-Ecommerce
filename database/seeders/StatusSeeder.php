<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Status;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Status::create([
            'status' => 'Order Received',
        ]);

        Status::create([
            'status' => 'Order Dispached',
        ]);

        Status::create([
            'status' => 'Order Shipped',
        ]);

        Status::create([
            'status' => 'Order Delivered',
        ]);

    }
}