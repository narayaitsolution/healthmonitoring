<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'email_verified_at',
        'password',
        'role',
        'gender',
        'birth_date',
        'height',
        'avatar'
    ];
    

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'birth_date' => 'date',
    ];

    /**
     * Get the blood pressure records for the user.
    */
    public function bloodPressureRecords()
    {
        return $this->hasMany(BloodPressureRecord::class);
    }

    /**
     * Get the patients assigned to this nakes.
     */
    public function assignedPatients()
    {
        return $this->belongsToMany(User::class, 'patient_nakes_assignments', 'nakes_id', 'patient_id')
                    ->withTimestamps();
    }

    /**
     * Get the nakes assigned to this patient.
     */
    public function assignedNakes()
    {
        return $this->belongsToMany(User::class, 'patient_nakes_assignments', 'patient_id', 'nakes_id')
                    ->withTimestamps();
    }

    /**
     * Calculate age from birth date
     */
    public function getAgeAttribute()
    {
        if (!$this->birth_date) {
            return null;
        }
        
        return $this->birth_date->diffInYears(now());
    }

    /**
     * Get age in years, months, and days
     */
    public function getDetailedAgeAttribute()
    {
        if (!$this->birth_date) {
            return null;
        }
        
        $age = $this->birth_date->diff(now());
        return [
            'years' => $age->y,
            'months' => $age->m,
            'days' => $age->d
        ];
    }

    /**
     * Check if user is admin
     */
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    /**
     * Check if user is nakes
     */
    public function isNakes()
    {
        return $this->role === 'nakes';
    }

    /**
     * Check if user is pasien
     */
    public function isPasien()
    {
        return $this->role === 'pasien';
    }

    /**
     * Scope untuk filter berdasarkan role
     */
    public function scopeByRole($query, $role)
    {
        return $query->where('role', $role);
    }
}
