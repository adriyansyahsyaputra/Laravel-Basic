<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CookieControllerTest extends TestCase
{
    public function testCreateCookie()
    {
        $this->get('/cookie/set')
        ->assertCookie("User-Id", "Adriyansyah")
        ->assertCookie("Is-Member", "true");
    }

    public function testGetCookie()
    {
        $this->withCookie("User-Id", "Adriyansyah")
        ->withCookie("Is-Member", "true")
        ->get('/cookie/get')
        ->assertJson([
            "userId" => "Adriyansyah",
            "isMember" => "true"
        ]);
    }
}
