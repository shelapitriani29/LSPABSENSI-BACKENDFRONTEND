<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthAndRoleAccessTest extends TestCase
{
    protected function makeUser(string $role): User
    {
        return new User([
            'id' => 1,
            'name' => ucfirst($role),
            'username' => strtolower($role),
            'email' => strtolower($role) . '@example.com',
            'password' => Hash::make('Password123!'),
            'role' => $role,
        ]);
    }

    public function test_guest_can_view_login_page(): void
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
        $response->assertViewIs('auth.login');
    }

    public function test_seeded_admin_can_login_with_default_credentials(): void
    {
        $this->seed(DatabaseSeeder::class);

        $response = $this->post('/login', [
            'username' => 'admin',
            'password' => '1',
        ]);

        $response->assertRedirect(route('admin.dashboard'));
        $this->assertTrue(Auth::check());
        $this->assertSame('admin', User::normalizeRole(Auth::user()->role));
    }

    public function test_authenticated_user_can_logout_and_clear_session(): void
    {
        $user = $this->makeUser('admin');
        $this->actingAs($user);

        $this->assertTrue(Auth::check());

        $response = $this->post('/logout');

        $response->assertRedirect('/login');
        $this->assertFalse(Auth::check());
    }

    public function test_admin_dashboard_redirect_uses_normalized_role(): void
    {
        $user = $this->makeUser('Administrator');
        $this->actingAs($user);

        $response = $this->get('/dashboard');

        $response->assertRedirectToRoute('admin.dashboard');
    }

    public function test_asesor_dashboard_redirect_uses_normalized_role(): void
    {
        $user = $this->makeUser('Examiner');
        $this->actingAs($user);

        $response = $this->get('/dashboard');

        $response->assertRedirectToRoute('asesor.dashboard');
    }

    public function test_participant_dashboard_redirect_uses_normalized_role(): void
    {
        $user = $this->makeUser('Student');
        $this->actingAs($user);

        $response = $this->get('/dashboard');

        $response->assertRedirectToRoute('peserta.dashboard');
    }

    public function test_admin_cannot_access_asesor_or_participant_routes(): void
    {
        $user = $this->makeUser('admin');
        $this->actingAs($user);

        $this->get('/asesor/dashboard')->assertStatus(403);
        $this->get('/peserta/dashboard')->assertStatus(403);
    }

    public function test_asesor_cannot_access_admin_or_participant_routes(): void
    {
        $user = $this->makeUser('asesor');
        $this->actingAs($user);

        $this->get('/admin/dashboard')->assertStatus(403);
        $this->get('/peserta/dashboard')->assertStatus(403);
    }

    public function test_participant_cannot_access_admin_or_asesor_routes(): void
    {
        $user = $this->makeUser('peserta');
        $this->actingAs($user);

        $this->get('/admin/dashboard')->assertStatus(403);
        $this->get('/asesor/dashboard')->assertStatus(403);
    }
}
