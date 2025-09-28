<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientNakesAssignment extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'nakes_id',
        'assigned_at'
    ];

    protected $casts = [
        'assigned_at' => 'datetime'
    ];

    /**
     * Get the patient
     */
    public function patient()
    {
        return $this->belongsTo(User::class, 'patient_id');
    }

    /**
     * Get the nakes
     */
    public function nakes()
    {
        return $this->belongsTo(User::class, 'nakes_id');
    }
}