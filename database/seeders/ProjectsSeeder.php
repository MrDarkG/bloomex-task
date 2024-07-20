<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $projects = [
            ['name' => 'Project 1'],
            ['name' => 'Project 2'],
            ['name' => 'Project 3'],
        ];

        foreach ($projects as $project) {
            Project::create($project);
        }
    }
}
