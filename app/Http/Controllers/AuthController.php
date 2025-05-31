<?php

namespace App\Http\Controllers;

use App\Http\Requests\Authentication\LoginRequest;
use App\Models\Admin;
use App\Traits\AuthHelper;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    use AuthHelper;

    public function showLoginPage(): View
    {
        return view('Auth.login');
    }

    public function login(LoginRequest $request): RedirectResponse
    {
        $credentials = $request->only('username', 'password');

        $isActiveAdmin = Admin::where('username', $credentials['username'])
            ->value('isActive');

        if (! $isActiveAdmin) {
            return redirect()
                ->route('index')
                ->withErrors('Nuk mund të kyçeni sepse llogaria jote është çaktivizuar.');
        }

        /** @var SessionGuard $guard */
        $guard = Auth::guard('admin');
        if ($guard->attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->route('admin.index');
        }

        return redirect()->
            route('loginPage')
                ->withErrors('Kyçja dështoi, emri i përdoruesit ose fjalëkalimi janë të pasaktë.');
    }

    public function logout(Request $request): RedirectResponse
    {
        return $this->logoutUser($request);
    }
}
