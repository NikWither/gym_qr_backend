<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SimulatorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('simulators')->insert([
            [
                'title' => 'trenager-1',
                'slug' => 'trenager-1',
                'description' => 'Тренажер номер 1',
                'img_path' => '',
                'view_counter' => 23,
            ],
            [
                'title' => 'trenager-2',
                'slug' => 'trenager-2',
                'description' => 'Тренажер номер 2',
                'img_path' => '',
                'view_counter' => 204,
            ],
            [
                'title' => 'trenager-3',
                'slug' => 'trenager-3',
                'description' => 'Тренажер номер 3',
                'img_path' => '',
                'view_counter' => 123,
            ],
            [
                'title' => 'trenager-4',
                'slug' => 'trenager-4',
                'description' => 'Тренажер номер 4',
                'img_path' => '',
                'view_counter' => 32,
            ],
            [
                'title' => 'trenager-5',
                'slug' => 'trenager-5',
                'description' => 'Тренажер номер 5',
                'img_path' => '',
                'view_counter' => 84,
            ],
            [
                'title' => 'trenager-6',
                'slug' => 'trenager-6',
                'description' => 'Тренажер номер 6',
                'img_path' => '',
                'view_counter' => 777,
            ],
            [
                'title' => 'trenager-7',
                'slug' => 'trenager-7',
                'description' => 'Тренажер номер 7',
                'img_path' => '',
                'view_counter' => 14,
            ]
        ]);
    }
}
