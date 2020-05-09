<?php

namespace Tests\Feature\Auth;

use App\Client\Client;
use App\Domain\Auth\LoginCommander;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use RefreshDatabase;
    public function testLogin()
    {
        $defaultClient = factory(Client::class)->create();
        $testData = [
            'email' => $defaultClient->email,
            'password' => $defaultClient->password,
        ];
        $token = LoginCommander::login($testData);

        $this->assertDatabaseHas('login_histories',[
            'email' => $defaultClient->email,
            'token' => $token
        ]);
    }
}
