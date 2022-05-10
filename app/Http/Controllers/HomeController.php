<?php

namespace App\Http\Controllers;

use App\Http\Requests\FibonacciRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class HomeController extends Controller
{
    public function index(): View
    {
        return view('index');
    }

    public function getSlice(FibonacciRequest $request): Response
    {
        return response([], 200);
    }
}
