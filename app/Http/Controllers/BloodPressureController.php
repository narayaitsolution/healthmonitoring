<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\BloodPressureRecord;
use App\Models\BloodPressureCategory;

class BloodPressureController extends Controller
{
    /**
     * Show form to create new blood pressure record
     */
    public function create()
    {
        return view('pasien.blood-pressure.create');
    }

    /**
     * Store new blood pressure record
     */
    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date|before_or_equal:today',
            'time' => 'required',
            'systolic' => 'required|integer|min:60|max:300',
            'diastolic' => 'required|integer|min:40|max:200',
            'weight' => 'nullable|numeric|min:20|max:300'
        ]);

        $user = Auth::user();
        
        BloodPressureRecord::create([
            'user_id' => $user->id,
            'date' => $request->date,
            'time' => $request->time,
            'systolic' => $request->systolic,
            'diastolic' => $request->diastolic,
            'weight' => $request->weight
        ]);

        return redirect()->route('pasien.dashboard')->with('success', 'Data tekanan darah berhasil disimpan!');
    }

    /**
     * Show form to edit blood pressure record
     */
    public function edit($id)
    {
        $user = Auth::user();
        $record = BloodPressureRecord::where('user_id', $user->id)->findOrFail($id);
        
        return view('pasien.blood-pressure.edit', compact('record'));
    }

    /**
     * Update blood pressure record
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'date' => 'required|date|before_or_equal:today',
            'time' => 'required',
            'systolic' => 'required|integer|min:60|max:300',
            'diastolic' => 'required|integer|min:40|max:200',
            'weight' => 'nullable|numeric|min:20|max:300'
        ]);

        $user = Auth::user();
        $record = BloodPressureRecord::where('user_id', $user->id)->findOrFail($id);
        
        $record->update([
            'date' => $request->date,
            'time' => $request->time,
            'systolic' => $request->systolic,
            'diastolic' => $request->diastolic,
            'weight' => $request->weight
        ]);

        return redirect()->route('pasien.dashboard')->with('success', 'Data tekanan darah berhasil diupdate!');
    }

    /**
     * Delete blood pressure record
     */
    public function destroy($id)
    {
        $user = Auth::user();
        $record = BloodPressureRecord::where('user_id', $user->id)->findOrFail($id);
        
        $record->delete();

        return redirect()->route('pasien.dashboard')->with('success', 'Data tekanan darah berhasil dihapus!');
    }
}