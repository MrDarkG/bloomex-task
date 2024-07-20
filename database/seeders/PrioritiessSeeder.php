<?php

namespace Database\Seeders;

use App\Models\Priority;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PrioritiessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $priorities = [
            ['name' => 'Low', 'is_default' => true],
            ['name' => 'Medium', 'is_default' => false],
            ['name' => 'High', 'is_default' => false],
        ];

        foreach ($priorities as $priority) {
            Priority::create($priority);
        }
    }
}
