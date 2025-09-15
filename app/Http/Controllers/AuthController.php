<?php

namespace App\Http\Controllers;

use App\Http\Requests\Authentication\LoginRequest;
use App\Models\Admin;
use App\Traits\AuthHelper;
use Illuminate\Auth\SessionGuard;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    use AuthHelper;

    public function showLoginPage(): View|RedirectResponse
    {
        if (Auth::guard('admin')->check()) {
            return redirect()->route('Admin.index');
        }

        return view('Auth.login');
    }

    public function login(LoginRequest $request): RedirectResponse
    {
        try {
            $credentials = $request->only('username', 'password');

            $admin = Admin::where('username', $credentials['username'])
                ->firstOrFail();

            if (! $admin->isActive) {
                return redirect()
                    ->route('loginPage')
                    ->witherrors('Nuk mund të kyçeni sepse llogaria jote është çaktivizuar.');
            }

            /** @var SessionGuard $guard */
            $guard = Auth::guard('admin');
            if ($guard->attempt($credentials)) {
                $request->session()->regenerate();

                return redirect()->route('admin.index');
            }

            return redirect()
                ->route('loginPage')
                ->witherrors('Kyçja dështoi fjalëkalimi është i pasaktë.');
        } catch (modelnotfoundexception $e) {
            return redirect()->back()->withErrors('Kyçja dështoi emri i përdoruesit është i pasaktë.');
        }
    }

    public function logout(Request $request): RedirectResponse
    {
        return $this->logoutUser($request);
    }
}
