<?php

namespace App\Services;

use Illuminate\Support\Collection;

class FibonacciResponse
{
    public static function getResponse(Collection $data): string
    {
        if ($data->isNotEmpty()) {
            return $data->implode(', ');
        }
        return 'Срез отсутствует';
    }
}
