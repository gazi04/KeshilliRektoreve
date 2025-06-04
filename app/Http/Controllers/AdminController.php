<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\AdminIdValidationRequest;
use App\Http\Requests\Admin\CreateAdminRequest;
use App\Http\Requests\Admin\EditAdminRequest;
use App\Models\Admin;
use App\Traits\AuthHelper;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    use AuthHelper;

    public function index(Request $request): View|RedirectResponse
    {
        try {
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
        } catch (Exception $e) {
            Log::error('Error fetching administrators: '.$e->getMessage());

            return view('errors.custom-error', ['message' => 'Nuk mund të merreshin administratorët.']);
        }
    }

    public function create(): View
    {
        return view('Admin.create');
    }

    public function store(CreateAdminRequest $request): View|RedirectResponse
    {
        try {
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

            return redirect()->route('admin.index')
                ->with('success', 'Administratori u krijua me sukses.');
        } catch (Exception $e) {
            Log::error('Error storing administrator: '.$e->getMessage());

            return view('errors.custom-error', ['message' => 'Nuk mund të krijohej administratori.']);
        }
    }

    public function edit(AdminIdValidationRequest $request): View|RedirectResponse
    {
        try {
            $validated = $request->only('id');

            $admin = Admin::select([
                'id',
                'name',
                'lastname',
                'email',
                'phoneNumber',
                'address',
            ])
                ->findOrFail($validated['id']);

            return view('Admin.edit', ['admin' => $admin]);
        } catch (ModelNotFoundException $e) {
            Log::warning('Admin not found for editing (ID: '.$request->input('id').'): '.$e->getMessage());

            return view('errors.custom-error', ['message' => 'Administratori nuk u gjet për redaktim.']);
        } catch (Exception $e) {
            Log::error('Error retrieving administrator for editing (ID: '.$request->input('id').'): '.$e->getMessage());

            return view('errors.custom-error', ['message' => 'Nuk mund të merrej administratori për redaktim.']);
        }
    }

    public function update(EditAdminRequest $request): RedirectResponse|View
    {
        try {
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

            $updateData = [
                'name' => $validated['name'],
                'lastname' => $validated['lastname'],
                'phoneNumber' => $validated['phoneNumber'],
                'email' => $validated['email'],
                'address' => $validated['address'],
            ];

            if (! empty($validated['password'])) {
                $updateData['password'] = Hash::make($validated['password']);
            }

            $admin->update($updateData);

            return redirect()->route('admin.index')
                ->with('success', 'Administratori u përditësua me sukses.');
        } catch (ModelNotFoundException $e) {
            Log::warning('Admin not found for update (ID: '.($validated['id'] ?? 'N/A').'): '.$e->getMessage());

            return view('errors.custom-error', ['message' => 'Administratori nuk u gjet për përditësim.']);
        } catch (Exception $e) {
            Log::error('Error updating administrator (ID: '.($validated['id'] ?? 'N/A').'): '.$e->getMessage());

            return view('errors.custom-error', ['message' => 'Nuk mund të përditësohej administratori.']);
        }
    }

    public function activate(AdminIdValidationRequest $request): RedirectResponse|View
    {
        try {
            $admin = Admin::findOrFail($request->id);
            $admin->update(['isActive' => true]);

            return back()->with('success', 'Administratori u aktivizua me sukses.');
        } catch (ModelNotFoundException $e) {
            Log::warning('Admin not found for activation (ID: '.$request->id.'): '.$e->getMessage());

            return view('errors.custom-error', ['message' => 'Administratori nuk u gjet për aktivizim.']);
        } catch (Exception $e) {
            Log::error('Error activating administrator (ID: '.$request->id.'): '.$e->getMessage());

            return view('errors.custom-error', ['message' => 'Nuk mund të aktivizohej administratori.']);
        }
    }

    public function deactivate(AdminIdValidationRequest $request): RedirectResponse|View
    {
        try {
            $admin = Admin::findOrFail($request->id);
            $admin->update(['isActive' => false]);

            return back()->with('success', 'Administratori u çaktivizua me sukses');
        } catch (ModelNotFoundException $e) {
            Log::warning('Admin not found for deactivation (ID: '.$request->id.'): '.$e->getMessage());

            return view('errors.custom-error', ['message' => 'Administratori nuk u gjet për çaktivizim.']);
        } catch (Exception $e) {
            Log::error('Error deactivating administrator (ID: '.$request->id.'): '.$e->getMessage());

            return view('errors.custom-error', ['message' => 'Nuk mund të çaktivizohej administratori.']);
        }
    }
}
