<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HelloController extends Controller
{
    private HelloService $helloService;

    public function __construct(HelloService $helloService)
    {
        $this->helloService = $helloService;
    }


    public function hello(string $name): string
    {
        return $this->helloService->hello($name);
    }

    public function request(Request $request)
    {
        return $request ->path();
            $request->url();
            $request->fullUrl();
            $request->method();
            $request->header('Accept');

    }
}
