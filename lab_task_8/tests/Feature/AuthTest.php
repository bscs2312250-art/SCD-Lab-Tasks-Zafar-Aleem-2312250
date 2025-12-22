<?php

namespace Tests\Feature;

use App\Models\User;
use App\Mail\VerificationMail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_flow()
    {
        Mail::fake();

        // 1. Visit Register Page
        $response = $this->get(route('register'));
        $response->assertStatus(200);

        // 2. Submit Registration Form
        $userData = [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ];

        $response = $this->post(route('register.submit'), $userData);

        // 3. Assert Redirect and DB state
        $response->assertRedirect(route('login'));
        $this->assertDatabaseHas('users', ['email' => 'test@example.com']);
        
        $user = User::where('email', 'test@example.com')->first();
        $this->assertNotNull($user->verification_token);
        $this->assertNull($user->email_verified_at);

        // 4. Assert Email Sent
        Mail::assertSent(VerificationMail::class, function ($mail) use ($user) {
            return $mail->hasTo($user->email) && $mail->token === $user->verification_token;
        });

        // 5. Try Login (Unverified)
        $response = $this->post(route('login.submit'), [
            'email' => 'test@example.com',
            'password' => 'password',
        ]);
        $response->assertSessionHasErrors('email');
        $this->assertGuest();

        // 6. Verify Email
        $response = $this->get(route('verify', ['token' => $user->verification_token]));
        $response->assertRedirect(route('login'));
        
        $user->refresh();
        $this->assertNull($user->verification_token);
        $this->assertNotNull($user->email_verified_at);

        // 7. Login (Verified)
        $response = $this->post(route('login.submit'), [
            'email' => 'test@example.com',
            'password' => 'password',
        ]);
        $response->assertRedirect(route('dashboard'));
        $this->assertAuthenticatedAs($user);

        // 8. Access Dashboard
        $response = $this->get(route('dashboard'));
        $response->assertStatus(200);
        $response->assertSee('Test User');

        // 9. Logout
        $response = $this->post(route('logout'));
        $response->assertRedirect(route('login'));
        $this->assertGuest();
    }
}
