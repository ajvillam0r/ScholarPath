<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Scholarship;

class ScholarshipSeeder extends Seeder
{
    public function run()
    {
        Scholarship::create(['name' => 'National Merit Scholarship', 'type' => 'merit', 'grade_level' => 'undergraduate']);
        Scholarship::create(['name' => 'Need-Based Assistance', 'type' => 'need', 'grade_level' => 'high_school']);
    }
}
