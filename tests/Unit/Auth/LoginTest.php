<?php

namespace Tests\Unit\Auth;

use App\Domain\Auth\LoginCommander;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    public function testFailCreatingClient()
    {
        $testData = [
            'email' => 'test',
            'password' => 'test',
        ];
        $this->expectExceptionMessage('Client not found!');
        LoginCommander::login($testData);
    }
}
