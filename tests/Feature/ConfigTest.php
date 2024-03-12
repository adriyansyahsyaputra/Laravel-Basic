<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ConfigTest extends TestCase
{
   public function testConfig()
   {
    $firstname = config('contoh.author.first');
    $lastName = config('contoh.author.last');
    $email = config('contoh.email');
    $web = config('contoh.web');

    self::assertEquals('Adriyansyah', $firstname);
    self::assertEquals('Nasution', $lastName);
    self::assertEquals('adriyansyah@gmail.com', $email);
    self::assertEquals('adriyansyah.com', $web);
}
}
