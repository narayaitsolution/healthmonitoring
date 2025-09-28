<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\BloodPressureCategory;

class BloodPressureCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'category' => 'Hipotensi',
                'systolic_min' => 0,
                'systolic_max' => 119,
                'diastolic_min' => 0,
                'diastolic_max' => 79
            ],
            [
                'category' => 'Normal',
                'systolic_min' => 120,
                'systolic_max' => 129,
                'diastolic_min' => 80,
                'diastolic_max' => 84
            ],
            [
                'category' => 'Pre-hipertensi',
                'systolic_min' => 130,
                'systolic_max' => 139,
                'diastolic_min' => 85,
                'diastolic_max' => 89
            ],
            [
                'category' => 'Hipertensi Stage 1',
                'systolic_min' => 140,
                'systolic_max' => 159,
                'diastolic_min' => 90,
                'diastolic_max' => 99
            ],
            [
                'category' => 'Hipertensi Stage 2',
                'systolic_min' => 160,
                'systolic_max' => 179,
                'diastolic_min' => 100,
                'diastolic_max' => 109
            ],
            [
                'category' => 'Hipertensi Krisis',
                'systolic_min' => 180,
                'systolic_max' => 999,
                'diastolic_min' => 110,
                'diastolic_max' => 999
            ]
        ];

        foreach ($categories as $category) {
            BloodPressureCategory::create($category);
        }
    }
}