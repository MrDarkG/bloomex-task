<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = [
            ['name' => 'Open'],
            ['name' => 'In Progress'],
            ['name' => 'Resolved'],
            ['name' => 'Closed'],
        ];

        foreach ($statuses as $status) {
            Status::create($status);
        }
    }
}
