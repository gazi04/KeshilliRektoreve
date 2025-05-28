<?php

namespace App\Traits;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

trait AuthHelper
{
    /**
     * Log out the user and invalidate the session.
     */
    public function logoutUser(Request $request): RedirectResponse
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('index')->with('success', 'Je çkyçur me sukses.');
    }

    public function getLoggedUserID(): int
    {
        $loggedUser = Auth::guard('admin')->user();

        return $loggedUser->employeeID;
    }
}
