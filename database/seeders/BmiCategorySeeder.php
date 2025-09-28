<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\BmiCategory;

class BmiCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'category' => 'Underweight',
                'min_value' => 0.00,
                'max_value' => 18.49
            ],
            [
                'category' => 'Normal',
                'min_value' => 18.50,
                'max_value' => 24.99
            ],
            [
                'category' => 'Overweight',
                'min_value' => 25.00,
                'max_value' => 29.99
            ],
            [
                'category' => 'Obesitas I',
                'min_value' => 30.00,
                'max_value' => 34.99
            ],
            [
                'category' => 'Obesitas II',
                'min_value' => 35.00,
                'max_value' => 39.99
            ],
            [
                'category' => 'Obesitas III',
                'min_value' => 40.00,
                'max_value' => 999.99
            ]
        ];

        foreach ($categories as $category) {
            BmiCategory::create($category);
        }
    }
}