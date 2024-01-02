<?php

namespace Database\Seeders;

use App\Models\Students;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Students::create([
            "name" => "Deni",
            "students_id" => "201110326",
            "major" => "Teknik Informatika",
            "gender" => "Male"
        ]);

        Students::create([
            "name" => "Cindy",
            "students_id" => "201110330",
            "major" => "Teknik Informatika",
            "gender" => "Female"
        ]);

        Students::create([
            "name" => "Billy",
            "students_id" => "201110337",
            "major" => "Teknik Informatika",
            "gender" => "Male"
        ]);
    }
}
