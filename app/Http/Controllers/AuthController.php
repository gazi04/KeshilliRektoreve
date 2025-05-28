<?php

namespace App\Http\Controllers;

use App\Http\Requests\Authentication\LoginRequest;
use Illuminate\Http\Request;
use App\Traits\AuthHelper;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    use AuthHelper;

    public function showLoginPage(): View
    {
        return view('Auth.Login');
    }

    public function login(LoginRequest $request): RedirectResponse
    {
        $credentials = $request->only('username', 'password');

        /** @var SessionGuard $guard */
        $guard = Auth::guard('admin');
        if ($guard->attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->route('admin.index');
        }

        return back()->withErrors('Kyçja dështoi, emri i përdoruesit ose fjalëkalimi janë të pasaktë.');
    }

    public function logout(Request $request): RedirectResponse
    {
        return $this->logoutUser($request);
    }
}
