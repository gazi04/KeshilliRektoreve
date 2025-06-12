<?php

namespace App\Http\Controllers;

use App\Http\Requests\Authentication\LoginRequest;
use App\Models\Admin;
use App\Traits\AuthHelper;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    use authhelper;

    public function showloginpage(): view|RedirectResponse
    {
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.index');
        }

        return view('auth.login');
    }

    public function login(loginrequest $request): redirectresponse
    {
        try {
            $credentials = $request->only('username', 'password');

            $admin = admin::where('username', $credentials['username'])
                ->firstorfail();

            if (! $admin->isactive) {
                return redirect()
                    ->route('loginpage')
                    ->witherrors('nuk mund të kyçeni sepse llogaria jote është çaktivizuar.');
            }

            /** @var sessionguard $guard */
            $guard = auth::guard('admin');
            if ($guard->attempt($credentials)) {
                $request->session()->regenerate();

                return redirect()->route('admin.index');
            }

            return redirect()
                ->route('loginpage')
                ->witherrors('kyçja dështoi fjalëkalimi është i pasaktë.');
        } catch (modelnotfoundexception $e) {
            return redirect()->back()->witherrors('kyçja dështoi emri i përdoruesit është i pasaktë.');
        }
    }

    public function logout(request $request): redirectresponse
    {
        return $this->logoutuser($request);
    }
}
