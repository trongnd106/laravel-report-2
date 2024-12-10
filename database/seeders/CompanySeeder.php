<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('companies')->insert([
            [
                'name' => 'Kaopiz Software',
                'size' => 180,
                'description' => 'Software development',
                'code' => 'KSW',
                'created_at' => new \DateTime('2014-09-29'),
                'updated_at'=> new \DateTime('2018-01-01'),
            ],
            [
                'name' => 'Kaopiz Solution',
                'size' => 50,
                'description' => 'AI solution & production',
                'code' => 'KSL',
                'created_at' => new \DateTime('2017-05-10'),
                'updated_at'=> new \DateTime(now()->format('Y-m-d H:i:s')),
            ],
            [
                'name' => 'Codestar',
                'size' => 80,
                'description' => 'Teaching & courses',
                'code' => 'KCS',
                'created_at' => new \DateTime('2019-02-12'),
                'updated_at'=> new \DateTime(now()->format('Y-m-d H:i:s')),
            ]
        ]);
    }
}
