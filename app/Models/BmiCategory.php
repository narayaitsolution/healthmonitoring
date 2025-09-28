<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BmiCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'category',
        'min_value',
        'max_value'
    ];

    protected $casts = [
        'min_value' => 'decimal:2',
        'max_value' => 'decimal:2'
    ];

    /**
     * Get all BMI categories ordered by min_value
     */
    public static function getAllCategories()
    {
        return self::orderBy('min_value')->get();
    }

    /**
     * Find BMI category based on BMI value
     */
    public static function findCategory($bmi)
    {
        return self::where('min_value', '<=', $bmi)
            ->where('max_value', '>=', $bmi)
            ->first();
    }
}