<?php

namespace Tests\Feature;

use App\Client\Client;
use App\Common\Validator;
use App\Domain\GetAuthenticatedUserQuery;
use App\LoginHistory\LoginHistory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GetAuthenticatedUserQueryTest extends TestCase
{
    use RefreshDatabase;
    public function testExample()
    {
        $defaultClient = factory(Client::class)->create();
        $loginHistory = factory(LoginHistory::class)->create([
            'client_id' => $defaultClient->id,
            'token' => Validator::generateJwt(),
            'email' => $defaultClient->email
        ]);

       $client = GetAuthenticatedUserQuery::getUserInfo($loginHistory->token);

       $this->assertDatabaseCount('clients',1);
       $this->assertEquals($defaultClient->surname, $client->first()['surname']);
       $this->assertNotContains($defaultClient->password, $client);
    }
}
