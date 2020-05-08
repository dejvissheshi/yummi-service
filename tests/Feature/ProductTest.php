<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductTest extends TestCase
{
    /**
     * A basic feature Product example.
     *
     * @return void
     */
    use RefreshDatabase;

    public function testGetProducts()
    {
        $response = $this->get('/products');
        $response->assertStatus(200);
    }


}
