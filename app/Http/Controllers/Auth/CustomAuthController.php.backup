<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class CustomAuthController extends Controller
{
    /**
     * Show login form
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }
    
    /**
     * Redirect to Google OAuth
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Handle Google OAuth callback
     */
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            
            // Debug: Cek data yang diterima dari Google
            \Log::info('Google User Data:', [
                'id' => $googleUser->getId(),
                'name' => $googleUser->getName(),
                'email' => $googleUser->getEmail(),
                'avatar' => $googleUser->getAvatar()
            ]);
            
            // Cari user berdasarkan email
            $user = User::where('email', $googleUser->getEmail())->first();
            
            if (!$user) {
                // Buat user baru dengan data dari Google
                $user = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'email_verified_at' => now(),
                    'role' => 'pasien', // Default role
                    'avatar' => $googleUser->getAvatar(), // Simpan foto profil Google
                    'password' => bcrypt('google_oauth_user') // Password default untuk OAuth user
                ]);
                
                \Log::info('User baru dibuat:', [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'role' => $user->role
                ]);
            } else {
                // Update avatar jika ada perubahan
                if ($googleUser->getAvatar() && $user->avatar !== $googleUser->getAvatar()) {
                    $user->update(['avatar' => $googleUser->getAvatar()]);
                }
                
                \Log::info('User existing ditemukan:', [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'role' => $user->role
                ]);
            }
            
            // Login user
            Auth::login($user);
            
            // Redirect berdasarkan status profile
            if (!$user->gender || !$user->birth_date || !$user->height) {
                \Log::info('Profile belum lengkap, redirect ke profile setup');
                return redirect()->route('profile.setup');
            }
            
            // Redirect berdasarkan role
            \Log::info('Profile lengkap, redirect ke dashboard');
            return $this->redirectBasedOnRole($user->role);
            
        } catch (\Laravel\Socialite\Two\InvalidStateException $e) {
            \Log::error('Google OAuth InvalidStateException: ' . $e->getMessage());
            return redirect()->route('login')->with('error', 'Session expired. Please try logging in again.');
        } catch (\Laravel\Socialite\Two\ProviderException $e) {
            \Log::error('Google OAuth ProviderException: ' . $e->getMessage());
            return redirect()->route('login')->with('error', 'Google authentication failed. Please try again.');
        } catch (\Exception $e) {
            \Log::error('Google OAuth Error: ' . $e->getMessage());
            \Log::error('Stack trace: ' . $e->getTraceAsString());
            
            return redirect()->route('login')->with('error', 'Login gagal: ' . $e->getMessage());
        }
    }

    /**
     * Handle logout
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('login');
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