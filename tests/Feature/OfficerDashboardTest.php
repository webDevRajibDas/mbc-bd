<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class OfficerDashboardTest extends TestCase
{
    use RefreshDatabase;

    public function testGuestCannotAccessOfficerDashboard(): void
    {
        $this->get(route('officer.dashboard'))
            ->assertRedirect(route('login'));
    }

    public function testOfficerRoleUserCanAccessOfficerDashboard(): void
    {
        $officer = $this->createUserWithRole('officer@example.com', 'Officer');

        $this->actingAs($officer)
            ->get(route('officer.dashboard'))
            ->assertOk()
            ->assertSee('Officer Panel')
            ->assertDontSee('Access Control')
            ->assertSee('No records found');
    }

    public function testSuperAdminCanAccessOfficerDashboardForUiTesting(): void
    {
        $user = $this->createUserWithRole('admin@example.com', 'Super Admin');

        $this->actingAs($user)
            ->get(route('officer.dashboard'))
            ->assertOk()
            ->assertSee('Officer Panel');
    }

    public function testNonOfficerAuthenticatedUserCannotAccessOfficerDashboard(): void
    {
        $user = $this->createUserWithRole('staff@example.com', 'Staff');

        $this->actingAs($user)
            ->get(route('officer.dashboard'))
            ->assertForbidden();
    }

    public function testOfficerCannotAccessAccessControlRoutes(): void
    {
        $officer = $this->createUserWithRole('blocked-officer@example.com', 'Officer');

        $this->actingAs($officer)
            ->get(route('user.index'))
            ->assertForbidden();
    }

    public function testOfficerRouteNameResolvesCorrectly(): void
    {
        $this->assertSame(url('/officer/dashboard'), route('officer.dashboard'));
    }

    public function testOfficerCanAccessBookingFormPage(): void
    {
        $officer = $this->createUserWithRole('booking-officer@example.com', 'Officer');

        $this->actingAs($officer)
            ->get(route('officer.booking-form'))
            ->assertOk()
            ->assertSee('Booking Form')
            ->assertSee('Officer ID ' . $officer->id)
            ->assertDontSee('Access Control');
    }

    public function testOfficerLoginRedirectsToOfficerDashboard(): void
    {
        $this->createUserWithRole('login-officer@example.com', 'Officer');

        $this->post(route('login'), [
            'email' => 'login-officer@example.com',
            'password' => 'password',
        ])->assertRedirect(route('officer.dashboard'));
    }

    public function testLogoutWorksThroughPost(): void
    {
        $officer = $this->createUserWithRole('logout-officer@example.com', 'Officer');

        $this->actingAs($officer)
            ->post(route('logout'))
            ->assertRedirect('/');

        $this->assertGuest();
    }

    public function testExistingDashboardRemainsAccessibleToNonOfficerUser(): void
    {
        $user = $this->createUserWithRole('dashboard@example.com', 'Super Admin');

        $this->actingAs($user)
            ->get(route('home'))
            ->assertOk()
            ->assertSee('MBC Bangladesh - Dashboard')
            ->assertSee('Access Control')
            ->assertSee('Geographic Config');
    }

    public function testSuperAdminCanAccessAdminMenusWithoutExplicitPermissions(): void
    {
        $user = $this->createUserWithRole('menu-admin@example.com', 'Super Admin');

        $this->assertTrue($user->getAllPermissions()->isEmpty());

        $this->actingAs($user)
            ->get(route('user.index'))
            ->assertOk()
            ->assertSee('User directory')
            ->assertSee('Total users')
            ->assertSee('Active users');

        $this->actingAs($user)
            ->get(route('geographic.divisions.index'))
            ->assertOk();
    }

    private function createUserWithRole(string $email, string $roleName): User
    {
        $role = Role::firstOrCreate([
            'name' => $roleName,
            'guard_name' => 'web',
        ]);

        $user = User::create([
            'name' => $roleName . ' User',
            'email' => $email,
            'password' => Hash::make('password'),
            'status' => 'active',
        ]);

        $user->assignRole($role);

        return $user;
    }
}
