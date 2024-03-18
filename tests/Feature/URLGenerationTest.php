<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class URLGenerationTest extends TestCase
{
   public function testURLCurrent()
   {
        $this->get('/url/current?name=Adriyansyah')
        ->assertSeeText('/url/current?name=Adriyansyah');
   }

   public function testNamed()
   {
        $this->get('/redirect/named')
        ->assertSeeText('/redirect/name/Adriyansyah');
   }

   public function testAction()
   {
    $this->get('/udl/action')
    ->assertSeeText('/form');
   }
}
