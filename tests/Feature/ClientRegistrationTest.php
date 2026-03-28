<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\Client;
use App\Models\MailLog;
use App\Models\Role;
use App\Models\User;
use Database\Seeders\RoleSeeder;
use Illuminate\Foundation\Http\Middleware\ValidateCsrfToken;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ClientRegistrationTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutMiddleware(ValidateCsrfToken::class);
        $this->seed(RoleSeeder::class);
    }

    public function test_registration_rejects_email_when_active_client_exists(): void
    {
        $adminRoleId = Role::query()->where('name', 'Admin')->value('id');
        $client = Client::query()->create([
            'name' => 'Existing',
            'email' => 'taken@example.com',
            'phone' => '08123456789',
            'company_name' => 'Existing Co',
            'package_type' => 'basic',
            'status' => 'active',
            'registration_date' => now()->toDateString(),
            'expiry_date' => now()->addMonth()->toDateString(),
            'notes' => null,
        ]);
        User::query()->create([
            'name' => 'Existing Admin',
            'email' => 'taken@example.com',
            'password' => 'secret123',
            'role' => 'admin',
            'role_id' => $adminRoleId,
            'client_id' => $client->id,
        ]);

        $response = $this->post('http://www.pos-system.test/daftar', [
            'name' => 'New',
            'email' => 'taken@example.com',
            'phone' => '08987654321',
            'company_name' => 'New Co',
            'package_type' => 'basic',
        ]);

        $response->assertSessionHasErrors('email');
        $this->assertSame(1, Client::query()->where('email', 'taken@example.com')->count());
    }

    public function test_registration_with_inactive_client_email_archives_legacy_user_and_writes_mail_log(): void
    {
        $adminRoleId = Role::query()->where('name', 'Admin')->value('id');
        $oldClient = Client::query()->create([
            'name' => 'Old',
            'email' => 'reuse@example.com',
            'phone' => '08111111111',
            'company_name' => 'Old Co',
            'package_type' => 'basic',
            'status' => 'inactive',
            'registration_date' => now()->subYear()->toDateString(),
            'expiry_date' => now()->subMonth()->toDateString(),
            'notes' => null,
        ]);
        User::query()->create([
            'name' => 'Old Admin',
            'email' => 'reuse@example.com',
            'password' => 'secret123',
            'role' => 'admin',
            'role_id' => $adminRoleId,
            'client_id' => $oldClient->id,
        ]);

        $response = $this->post('http://www.pos-system.test/daftar', [
            'name' => 'New Admin',
            'email' => 'reuse@example.com',
            'phone' => '08222222222',
            'company_name' => 'New Co',
            'package_type' => 'basic',
        ]);

        $response->assertRedirect(route('client.register.thanks'));

        $this->assertTrue(
            User::query()->where('email', 'reuse@example.com')->where('client_id', $oldClient->id)->doesntExist()
        );
        $this->assertTrue(
            User::query()->where('email', 'reuse@example.com')->where('client_id', '!=', $oldClient->id)->exists()
        );

        $log = MailLog::query()->where('type', 'client_welcome')->where('to_email', 'reuse@example.com')->first();
        $this->assertNotNull($log);
        $this->assertSame(MailLog::STATUS_SENT, $log->status);
        $this->assertNotNull($log->sent_at);
    }
}
