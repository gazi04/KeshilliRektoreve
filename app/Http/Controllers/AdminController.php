<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\AdminIdValidationRequest;
use App\Http\Requests\Admin\CreateAdminRequest;
use App\Http\Requests\Admin\EditAdminRequest;
use App\Models\Admin;
use App\Traits\AuthHelper;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    use AuthHelper;

    public function index(Request $request): View
    {
        /* TODO- IN THE ADMIN INDEX PAGE WHERE IT LISTS ALL THE ADMINS SHOULD THE CURRENT LOGGED ADMIN BE DISPLAYED OR NOT */
        $admins = Admin::select([
            'id',
            'name',
            'lastname',
            'phoneNumber',
            'email',
            'address',
            'isActive',
            'username',
        ])
            ->where('id', '!=', $this->getLoggedUserID());

        if ($request->filled('search')) {
            $search = $request->input('search');
            $admins->where(function ($query) use ($search): void {
                $query->where('name', 'like', '%'.$search.'%')
                    ->orWhere('lastname', 'like', '%'.$search.'%')
                    ->orWhere('email', 'like', '%'.$search.'%')
                    ->orWhere('phoneNumber', 'like', '%'.$search.'%')
                    ->orWhere('address', 'like', '%'.$search.'%')
                    ->orWhere('username', 'like', '%'.$search.'%');
            });
        }

        if ($request->filled('status')) {
            $status = $request->input('status');
            if ($status === 'active') {
                $admins->where('isActive', true);
            } elseif ($status === 'inactive') {
                $admins->where('isActive', false);
            }
        }

        if ($request->filled('order_by')) {
            match ($request->input('order_by')) {
                'name_asc' => $admins->orderBy('name', 'asc'),
                'name_desc' => $admins->orderBy('name', 'desc'),
                default => $admins->orderBy('id', 'desc'),
            };
        } else {
            $admins->orderBy('id', 'desc');
        }

        $admins = $admins->paginate(10);

        $admins->appends($request->query());

        return view('Admin.index', ['admins' => $admins]);
    }

    public function create(): View
    {
        return view('Admin.create');
    }

    public function store(CreateAdminRequest $request): RedirectResponse
    {
        $validated = $request->only([
            'name',
            'lastname',
            'phoneNumber',
            'email',
            'address',
            'username',
            'password',
        ]);

        Admin::create([
            'name' => $validated['name'],
            'lastname' => $validated['lastname'],
            'phoneNumber' => $validated['phoneNumber'],
            'email' => $validated['email'],
            'address' => $validated['address'],
            'username' => $validated['username'],
            'password' => Hash::make($validated['password']),
            'isActive' => true,
        ]);

        return redirect()->route('admin.admins.index')
            ->with('success', 'Administratori u krijua me sukses.');
    }

    public function edit(AdminIdValidationRequest $request)
    {
        $validated = $request->only('id');

        try {
            $admin = Admin::select([
                'id',
                'name',
                'lastname',
                'email',
                'phoneNumber',
                'address',
                'password',
            ])
                ->findOrFail($validated['id']);

            return view('Admin.edit', ['admin' => $admin]);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException) {
            return redirect()->route('admin.index')->with('error', 'Regjistri i të dhënave të përdoruesit të dhënë nuk mund të gjendet në bazën e të dhënave.');
        }
    }

    public function update(EditAdminRequest $request)
    {
        $validated = $request->only([
            'id',
            'name',
            'lastname',
            'phoneNumber',
            'email',
            'address',
            'password',
        ]);

        $admin = Admin::findOrFail($validated['id']);

        $admin->update([
            'name' => $validated['name'],
            'lastname' => $validated['lastname'],
            'phoneNumber' => $validated['phoneNumber'],
            'email' => $validated['email'],
            'address' => $validated['address'],
            'password' => Hash::make($validated['password']),
            'isActive' => true,
        ]);

        return redirect()->route('admin.index')
            ->with('success', 'Administratori u përditësua me sukses.');
    }

    public function activate(AdminIdValidationRequest $request)
    {
        $admin = Admin::findOrFail($request->id);
        $admin->update(['isActive' => true]);

        return back()->with('success', 'Administratori u aktivizua me sukses.');
    }

    public function deactivate(AdminIdValidationRequest $request)
    {
        $admin = Admin::findOrFail($request->id);
        $admin->update(['isActive' => false]);

        return back()->with('success', 'Administratori u çaktivizua me sukses');
    }
}
