<?php

namespace App\Days;

class Ten extends Day
{
    public $title = 'Adapter Array';

    public function description(): string
    {
        return <<<HTML
        <p>Plug adapters to recharge battery.<p>
HTML;
    }

    public function firstPuzzle(): string
    {
        $jolt_difference = $this->solvePartOne();

        return <<<HTML
        <p>The jolt difference is <b>$jolt_difference</b></p>
HTML;
    }

    public function secondPuzzle(): string
    {
        return <<<HTML
        <p>Ahah<p>
HTML;
    }

    public function solvePartOne(): int
    {
        $jolts = [1 => 0, 3 => 0];
        $dataset = $this->dataset->sort()->values();
        $dataset->prepend(0);

        $dataset->each(function ($joltage, $key) use (&$jolts, $dataset) {
            if ($key === 0) {
                return;
            }

            $jolts[$joltage - $dataset->get($key - 1)]++;
        });

        return $jolts[1] * ($jolts[3] + 1);
    }
}
