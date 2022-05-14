<?php

namespace App\Services;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class FibonacciService
{

    private Collection $fibList;

    private int $f1 = 0;
    private int $f2 = 1;

    public function __construct(
        private int $from,
        private int $to
    )
    {
        $this->fibList = collect([0, 1]);

        if (Cache::has('fibList') && !empty(Cache::get('fibList'))) {
            $this->fibList = collect(Cache::get('fibList'));
            $this->f1 = $this->fibList[count($this->fibList) - 2];
            $this->f2 = $this->fibList[count($this->fibList) - 1];
        }
    }

    public function getSlice(): Collection
    {
        if ($this->from == 0 || $this->from == 1) {
            if ($this->to == 1) {
                return collect([$this->from, $this->to]);
            }
            if ($this->to == 0) {
                return collect([$this->from]);
            }
        }

        if (empty($this->fibList) || $this->to > $this->f2) {
            $this->calculate();
            cache()->put('fibList', $this->fibList);
        }

        $this->updateFromTo();

        return $this->searchSlice();
    }

    private function calculate(): void
    {
        $f1 = $this->f1;
        $f2 = $this->f2;
        $fibList = [];

        $fN = 0;
        while ($fN < $this->to) {
            $fN = $f1 + $f2;
            $f1 = $f2;
            $f2 = $fN;

            if ($fN <= $this->to) {
                $fibList[] = $fN;
            }

        }

        $this->fibList = $this->fibList->merge($fibList);
    }

    private function updateFromTo(): void
    {
        if (!$this->fibList->contains($this->from)) {
            $this->from = $this->fibList->first(fn($value): int => $value > $this->from);
        }
        if (!$this->fibList->contains($this->to)) {
            $this->to = $this->fibList->last(fn($value): int => $value < $this->to);
        }
    }

    private function searchSlice(): Collection
    {
        $start = $this->fibList->search($this->from);
        $end = $this->fibList->search($this->to) - $start + 1;

        return $this->fibList->slice($start, $end);
    }
}
