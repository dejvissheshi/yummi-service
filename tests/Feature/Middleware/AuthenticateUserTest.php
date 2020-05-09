<?php

namespace Tests\Feature\Middleware;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthenticateUserTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use RefreshDatabase;

    public function testAuthenticateUserMiddleware()
    {
//       $defaultClient = factory(Client::class)->create();
//       $loginHistory = factory(LoginHistory::class)->create([
//           'client_id' => $defaultClient->id,
//           'token' => Validator::generateJwt(),
//           'email' => $defaultClient->email
//       ]);
//
//       AuthenticateUser::handle();
    }
}
