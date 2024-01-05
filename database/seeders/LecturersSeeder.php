<?php

namespace Database\Seeders;

use App\Models\Lecturers;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LecturersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Lecturers::create([
            "name" => "Kelvin S.Kom, M.Kom",
            "lecturers_id" => "45150600",
            "field" => "Teknik Informatika",
            "gender" => "Male"
        ]);

        Lecturers::create([
            "name" => "Jhonson S.Kom, M.Kom",
            "lecturers_id" => "45150700",
            "field" => "Teknik Informatika",
            "gender" => "Male"
        ]);

        Lecturers::create([
            "name" => "Angeline S.Kom, M.Kom",
            "lecturers_id" => "45150800",
            "field" => "Teknik Informatika",
            "gender" => "Female"
        ]);

        Lecturers::create([
            "name" => "Christy S.Kom, M.Kom",
            "lecturers_id" => "45150900",
            "field" => "Teknik Informatika",
            "gender" => "Female"
        ]);

        Lecturers::create([
            "name" => "Irwan S.Kom, M.Kom",
            "lecturers_id" => "45150950",
            "field" => "Teknik Informatika",
            "gender" => "Male"
        ]);
    }
}
