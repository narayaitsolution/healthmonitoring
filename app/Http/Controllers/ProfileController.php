<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Show profile setup form
     */
    public function showSetup()
    {
        return view('profile.setup');
    }

    /**
     * Store profile setup data
     */
    public function storeSetup(Request $request)
    {
        $request->validate([
            'gender' => 'required|in:laki-laki,perempuan',
            'birth_date' => 'required|date|before:today',
            'height' => 'required|integer|min:100|max:250'
        ]);

        $user = Auth::user();
        $user->update([
            'gender' => $request->gender,
            'birth_date' => $request->birth_date,
            'height' => $request->height
        ]);

        // Redirect berdasarkan role
        return $this->redirectBasedOnRole($user->role);
    }

    /**
     * Redirect based on user role
     */
    private function redirectBasedOnRole($role)
    {
        switch ($role) {
            case 'pasien':
                return redirect()->route('pasien.dashboard');
            case 'nakes':
                return redirect()->route('nakes.dashboard');
            case 'admin':
                return redirect()->route('admin.dashboard');
            default:
                return redirect()->route('pasien.dashboard');
        }
    }
}