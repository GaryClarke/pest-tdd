<?php

namespace App\Routing;

use App\Http\Request;
use App\Http\Response;

class Router
{
    public function dispatch(Request $request): Response
    {
        return new Response();
    }
}