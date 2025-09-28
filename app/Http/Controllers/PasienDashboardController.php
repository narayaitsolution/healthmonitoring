<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\BloodPressureRecord;
use App\Models\BloodPressureCategory;
use App\Models\BmiCategory;

class PasienDashboardController extends Controller
{
    /**
     * Show pasien dashboard
     */
    public function index()
    {
        $user = Auth::user();
        
        // Ambil data tekanan darah user
        $bloodPressureRecords = BloodPressureRecord::where('user_id', $user->id)
            ->orderBy('date', 'desc')
            ->orderBy('time', 'desc')
            ->get();
        
        // Ambil data terbaru untuk summary
        $latestRecord = $bloodPressureRecords->first();
        
        // Ambil semua kategori untuk referensi
        $bloodPressureCategories = BloodPressureCategory::getAllCategories();
        $bmiCategories = BmiCategory::getAllCategories();
        
        // Siapkan data untuk chart
        $chartData = $this->prepareChartData($bloodPressureRecords);
        
        // Hitung persentase dan kategori tekanan darah
        $bloodPressureData = $this->calculateBloodPressurePercentage($latestRecord);
        
        return view('pasien.dashboard', compact(
            'user',
            'bloodPressureRecords',
            'latestRecord',
            'bloodPressureCategories',
            'bmiCategories',
            'chartData',
            'bloodPressureData'
        ));
    }
    
    /**
     * Prepare data for Chart.js
     */
    private function prepareChartData($records)
    {
        $labels = [];
        $systolicData = [];
        $diastolicData = [];
        
        foreach ($records->reverse() as $record) {
            $labels[] = $record->date->format('d/m');
            $systolicData[] = $record->systolic;
            $diastolicData[] = $record->diastolic;
        }
        
        return [
            'labels' => $labels,
            'systolic' => $systolicData,
            'diastolic' => $diastolicData
        ];
    }

    /**
     * Calculate blood pressure percentage and category
     */
    private function calculateBloodPressurePercentage($latestRecord)
    {
        if (!$latestRecord) {
            return [
                'percentage' => 0,
                'category' => 'No Data',
                'category_class' => 'normal'
            ];
        }

        // Ambil systolic_max dari kategori Normal
        $normalCategory = BloodPressureCategory::where('category', 'Normal')->first();
        $systolicMaxNormal = $normalCategory ? $normalCategory->systolic_max : 129; // fallback ke 129

        // Hitung persentase: (systolic_user / systolic_max_normal) * 100
        $percentage = ($latestRecord->systolic / $systolicMaxNormal) * 100;

        // Tentukan kategori berdasarkan systolic user
        $category = BloodPressureCategory::where('systolic_min', '<=', $latestRecord->systolic)
            ->where('systolic_max', '>=', $latestRecord->systolic)
            ->first();

        $categoryName = $category ? $category->category : 'Unknown';
        
        // Convert category name to CSS class format
        $categoryClass = strtolower($categoryName);
        $categoryClass = str_replace([' ', '-'], '_', $categoryClass);
        $categoryClass = preg_replace('/[^a-z0-9_]/', '', $categoryClass);

        return [
            'percentage' => round($percentage, 1),
            'category' => $categoryName,
            'category_class' => $categoryClass
        ];
    }

    /**
 * Show pasien dashboard
 */
public function indexMobile()
{
    $user = Auth::user();
    
    // Ambil data tekanan darah user
    $bloodPressureRecords = BloodPressureRecord::where('user_id', $user->id)
        ->orderBy('date', 'desc')
        ->orderBy('time', 'desc')
        ->get();
    
    // Ambil data terbaru untuk summary
    $latestRecord = $bloodPressureRecords->first();
    
    // Ambil semua kategori untuk referensi
    $bloodPressureCategories = BloodPressureCategory::getAllCategories();
    $bmiCategories = BmiCategory::getAllCategories();
    
    // Siapkan data untuk chart
    $chartData = $this->prepareChartData($bloodPressureRecords);
    
    // Hitung persentase dan kategori tekanan darah
    $bloodPressureData = $this->calculateBloodPressurePercentage($latestRecord);
    
    return view('pasien.dashboard', compact(
        'user',
        'bloodPressureRecords',
        'latestRecord',
        'bloodPressureCategories',
        'bmiCategories',
        'chartData',
        'bloodPressureData'
    ));
}
}