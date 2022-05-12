<?php

namespace App\Http\Controllers;

use App\Http\Requests\FibonacciRequest;
use App\Services\FibonacciResponse;
use App\Services\FibonacciService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Response;

class HomeController extends Controller
{
    public function index(): View
    {
        return view('index');
    }

    public function getSlice(FibonacciRequest $request): Response
    {
        $from = $request->input('from');
        $to = $request->input('to');

        $data = (new FibonacciService($from, $to))->getSlice();

        return response([
            'data' => FibonacciResponse::getResponse($data)
        ], 200);
    }

}
