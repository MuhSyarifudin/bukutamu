<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */

    protected $email;

    public function create(): View
    {
        return view('auth.login',['title'=>'Log In']);
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {

        $this->email = $request->email;
        
        $request->authenticate();

        $request->session()->regenerate();
        
        DB::transaction(function () {
            $user = User::where('email',$this->email)->first();
            $token = $user->createToken($user->name)->plainTextToken;
            session(['token'=>$token]);  
        });

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $user = User::where('id',Auth::user()->id)->first();
        $user->tokens()->where('tokenable_id',$user->id)->delete();

        Auth::guard('web')->logout();
        
        $request->session()->invalidate();

        $request->session()->regenerateToken();


        return redirect('/');
    }
}
