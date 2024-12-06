<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("departments")->insert([
            [
                "name" => "SBU1",
                "description" => "Strategic Business Unit 1",
                "code" => "SBU1"
            ],
            [
                "name" => "SBU2",
                "description" => "Strategic Business Unit 2",
                "code" => "SBU2"
            ],
            [
                "name" => "PQA",
                "description" => "PQA",
                "code" => "PQA"
            ],
            [
                "name" => "HR",
                "description" => "Human resources",
                "code" => "HR"
            ]
        ]);
    }
}
