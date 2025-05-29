<?php

use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->admin = Admin::factory()->create();
});

it('shows login page', function () {
    $response = $this->get(route('loginPage'));

    $response->assertOk();
    $response->assertViewIs('Auth.login');
});

it('logs in admin with correct credentials', function () {
    $response = $this->post(route('login'), [
        'username' => $this->admin->username,
        'password' => 'password',
    ]);

    $response->assertRedirect(route('admin.index'));
    $this->assertAuthenticatedAs($this->admin, 'admin');
});

it('fails to login with incorrect credentials', function () {
    $response = $this->post(route('login'), [
        'username' => 'testadmin',
        'password' => 'wrongpassword',
    ]);

    $response->assertRedirect(route('index'));
    $response->assertSessionHasErrors();
    $this->assertGuest('admin');
});

it('fails to login with non-existent username', function () {
    $response = $this->post(route('login'), [
        'username' => 'nonexistent',
        'password' => 'password123',
    ]);

    $response->assertRedirect();
    $response->assertSessionHasErrors();
    $this->assertGuest('admin');
});

it('requires username and password', function () {
    $response = $this->post(route('login'), []);

    $response->assertSessionHasErrors(['username', 'password']);
});

it('validates username is not too long', function () {
    $response = $this->post(route('login'), [
        'username' => str_repeat('a', 16), // 16 characters (max is 15)
        'password' => 'password123',
    ]);

    $response->assertSessionHasErrors(['username']);
});

it('validates password is at least 8 characters', function () {
    $response = $this->post(route('login'), [
        'username' => 'testadmin',
        'password' => 'short', // 5 characters
    ]);

    $response->assertSessionHasErrors(['password']);
});

it('cannot login if account is inactive', function () {
    $inactiveAdmin = Admin::factory()->create([
        'username' => 'inactive',
        'password' => Hash::make('password123'),
        'isActive' => false,
    ]);

    $response = $this->post(route('login'), [
        'username' => 'inactive',
        'password' => 'password123',
    ]);

    $response->assertRedirect();
    $response->assertSessionHasErrors();
    $this->assertGuest('admin');
});

it('logs out admin and redirects to home page', function () {
    $response = $this->actingAs($this->admin, 'admin')
        ->post(route('logout'));

    $response->assertRedirect(route('index'));
    $response->assertSessionHas('success');
    $this->assertGuest('admin');
});
