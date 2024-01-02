<?php

namespace Database\Seeders;

use App\Models\Subjects;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubjectsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Subjects::create([
            "name" => "Logika Pemrograman Dasar",
            "subjects_id" => "IF1001",
            "credits" => 4,
            "lecturers_id" => 2
        ]);

        Subjects::create([
            "name" => "Pemrograman Web",
            "subjects_id" => "IF1002",
            "credits" => 4,
            "lecturers_id" => 1
        ]);

        Subjects::create([
            "name" => "Struktur Data",
            "subjects_id" => "IF1003",
            "credits" => 2,
            "lecturers_id" => 3
        ]);
    }
}
