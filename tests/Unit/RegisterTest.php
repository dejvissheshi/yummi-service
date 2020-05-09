<?php

namespace Tests\Unit;

use App\Client\Client;
use App\Domain\Auth\RegisterCommander;
use App\LoginHistory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;

    public function testRegisterSaveUser()
    {
        $defaultClient = factory(Client::class)->make();
        RegisterCommander::register($defaultClient);

        $this->expectException('Login history not created successfully!');
//        $this->assertDatabaseHas('clients',[
//            'name' => $defaultClient->name
//        ]);
    }
}
