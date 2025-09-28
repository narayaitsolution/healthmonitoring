<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BloodPressureCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'category',
        'systolic_min',
        'systolic_max',
        'diastolic_min',
        'diastolic_max'
    ];

    /**
     * Get all blood pressure categories ordered by systolic_min
     */
    public static function getAllCategories()
    {
        return self::orderBy('systolic_min')->get();
    }

    /**
     * Find category based on systolic and diastolic values
     */
    public static function findCategory($systolic, $diastolic)
    {
        return self::where('systolic_min', '<=', $systolic)
            ->where('systolic_max', '>=', $systolic)
            ->where('diastolic_min', '<=', $diastolic)
            ->where('diastolic_max', '>=', $diastolic)
            ->first();
    }
}