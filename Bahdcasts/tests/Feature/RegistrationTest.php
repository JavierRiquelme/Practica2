<?php

namespace Tests\Feature;

use Mail;
use Bahdcasts\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_user_has_a_default_username_after_registration(){

        Mail::fake();
        $this->withoutExceptionHandling();

        $this->post('/register', [
            'name' => 'Mrs. Ora Gibson DDS',
            'email' => 'adriel70@example.com',
            'password' => 'secret'
        ])->assertRedirect();
        $this->assertDatabaseHas('users', [
            'username' => str_slug('Mrs. Ora Gibson DDS')
        ]);
    }

    public function test_a_user_has_a_token_after_registration(){

        Mail::fake();
        $this->withoutExceptionHandling();

        $this->post('/register', [
            'name' => 'Mrs. Ora Gibson DDS',
            'email' => 'adriel70@example.com',
            'password' => 'secret'
        ])->assertRedirect();
        $user=User::find(1);
        $this->assertNotNull($user->confirm_token);
        $this->assertFalse($user->isConfirmed());
    }

    public function test_an_email_is_sent_to_newly_registered_users(){

        $this->withoutExceptionHandling();
        $mail=Mail::fake();

        //register new user
        $this->post('/register', [
            'name' => 'Mrs. Ora Gibson DDS',
            'email' => 'adriel70@example.com',
            'password' => 'secret'
        ])->assertRedirect();
        //assert that a particular email was sent
        Mail::assertSent(ConfirmYourEmail::class);
    }    
}
