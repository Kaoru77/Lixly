<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_password_is_hashed_and_email_verified_at_is_a_date(): void
    {
        $user = User::create([
            'name' => 'Kaoru',
            'email' => 'kaoru@example.com',
            'password' => 'secret-password',
        ]);

        $user->forceFill(['email_verified_at' => '2026-01-02 03:04:05'])->save();

        $this->assertNotSame('secret-password', $user->password);
        $this->assertTrue(Hash::check('secret-password', $user->password));
        $this->assertSame('2026-01-02 03:04:05', $user->email_verified_at->toDateTimeString());
    }

    public function test_sensitive_attributes_are_hidden_from_serialization(): void
    {
        $user = User::factory()->create();

        $this->assertArrayNotHasKey('password', $user->toArray());
        $this->assertArrayNotHasKey('remember_token', $user->toArray());
    }
}
