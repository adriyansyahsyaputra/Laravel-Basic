<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class InputControllerTest extends TestCase
{
    public function testInput()
    {
        $this->get('/input/hello?name=riyan')->assertSeeText('Hello riyan');

        $this->post('/input/hello' ,[
            "name" => "riyan"
        ])->assertSeeText('Hello riyan');
    }

    public function testNestedInput()
    {
        $this->post('/input/hello/first', ['name' => [
            "first" => "riyan"
            ]
        ])->assertSeeText('Hello riyan');
    }

    public function testInputAll()
    {
        $this->post('/input/hello/input', ['name' => [
            "first" => "riyan",
            "last" => "nasution"
            ]
        ])->assertSeeText('name')->assertSeeText('first')
        ->assertSeeText('last')->assertSeeText('nasution');
    }

    // public function testInputArray()
    // {
    //     $this->post('/input/hello/array', [
    //     'products' => [
    //         "name" => "Apple Mac Book",
    //         "price" => 9000000
    //     ],
    //     [
    //         "name" => "Samsung Galaxy",
    //         "price" => 600000
    //     ]
    //     ])->assertSeeText("Samsung Galaxy") 
    //       ->assertSeeText("Apple Mac Book");
    // }

    public function testInputType()
    {
        $this->post('/input/type', [
            "name" => "Budi",
            "married" => "true",
            "birth_date" => "1990-10-10"
        ])->assertSeeText('Budi')->assertSeeText('true')->assertSeeText('1990-10-10');
    }

    public function testFilterOnly()
    {
        $this->post('/input/filter/only', [
            "name" => [
                "first" => "Adriyansyah",
                "middle" => "Syaputra",
                "last" => "Nasution"
            ]
        ])->assertSeeText("Adriyansyah")->assertSeeText("Syaputra")->assertSeeText("Nasution");
    }

    public function testFilterExcept()
    {
        $this->post('/input/filter/only', [
           "username" => "Adriyansyah",
           "password" => "rahasia",
           "admin" => "true"
        ])->assertSeeText("Adriyansyah")->assertSeeText("rahasia")->assertSeeText("admin");
    }

    public function testFilterMerge()
    {
        $this->post('/input/filter/merge', [
           "username" => "Adriyansyah",
           "password" => "rahasia",
           "admin" => "true"
        ])->assertSeeText("Adriyansyah")->assertSeeText("rahasia")->assertSeeText("admin")->assertSeeText("false");
    }
}