<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BloodPressureRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'patient_id',
        'date',
        'time',
        'systolic',
        'diastolic',
        'weight'
    ];

    protected $casts = [
        'date' => 'date',
        'time' => 'datetime:H:i',
        'weight' => 'decimal:2'
    ];

    /**
     * Get the user that owns the blood pressure record.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the patient for this record (when recorded by nakes).
     */
    public function patient()
    {
        return $this->belongsTo(User::class, 'patient_id');
    }

    /**
     * Get blood pressure category
     */
    public function getBloodPressureCategoryAttribute()
    {
        $category = BloodPressureCategory::where('systolic_min', '<=', $this->systolic)
            ->where('systolic_max', '>=', $this->systolic)
            ->where('diastolic_min', '<=', $this->diastolic)
            ->where('diastolic_max', '>=', $this->diastolic)
            ->first();
            
        return $category ? $category->category : 'Unknown';
    }

    /**
     * Calculate BMI if weight is provided
     */
    public function getBmiAttribute()
    {
        if (!$this->weight || !$this->user->height) {
            return null;
        }
        
        $heightInMeters = $this->user->height / 100;
        return round($this->weight / ($heightInMeters * $heightInMeters), 2);
    }
}