<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RoutingTest extends TestCase
{
  public function testGet()
  {
    $this->get('/pzn')
    ->assertStatus(200)
    ->assertSeeText('Hello Programmer Zaman Now!');
  }

  public function testRedirect()
  {
    $this->get('/youtube')
    ->assertRedirect('/pzn');
  }

  public function testFallback()
  {
    $this->get('/tidakada')
    ->assertSeeText('404 by Adriyansyah');
  }

  public function testRouteParameter()
  {
    $this->get('/products/1')
    ->assertSeeText('Product 1');

    $this->get('/products/1/items/XXX')
    ->assertSeeText('Product 1, Item XXX');
  }

  public function testRouteparameterRegex()
  {
    $this->get('/categories/100')
    ->assertSeeText("Category 100");
  }

  public function testRouteParameterOptional()
  {
    $this->get('/users/adriyansyah')
    ->assertSeeText('User adriyansyah');

    $this->get('/users/')
    ->assertSeeText('User 404');
  }

  public function testNamed()
  {
    $this->get('/product/12345')
    ->assertSeeText('Link http://localhost/products/12345');

    $this->get('/product-redirect/12345')
    ->assertSeeText('/products/12345');
  }
}