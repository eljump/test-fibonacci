<?php

namespace App\Services;

use Illuminate\Support\Collection;

class FibonacciResponse
{
    public static function getResponse(Collection $data): string
    {
        if ($data->isNotEmpty()) {
            if ($data->count() === 1) {
                return "{$data->first()} - число из ряда Фибоначчи";
            }
            return $data->implode(',');
        }
        return 'Срез отсутствует или число не из ряда Фибоначчи';
    }
}
