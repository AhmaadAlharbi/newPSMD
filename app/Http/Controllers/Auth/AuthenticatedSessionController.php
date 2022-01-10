<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('protection.user.auth.login');
    }

   

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        // /dashboard/admin/query_section_id=2
        if (Auth::attempt($request->only(['email', 'password']))) {
            $user = Auth::user();
             $user->is_admin = $user->is_admin ? 'admin':'user';
            return redirect(
                // 'dashboard/section'. $user->section_id.'/'.$user->is_admin
                'dashboard/'.$user->is_admin.'/query_section_id='. $user->section_id

            );
        }
        
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
        
    }

    
    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}