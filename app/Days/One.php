<?php

namespace App\Days;

use Exception;
use Illuminate\Support\Collection;

class One extends Day
{
    public $title = 'Report Repair';

    public function description(): string
    {
        return <<<HTML
        <p>Find the two entries of the expense report that sum to 2020 and then multiply those two numbers together.<p>
HTML;
    }

    public function firstPuzzle(): string
    {
        try {
            [$first, $second] = $this->find2020SumForNElements(2);
        } catch (\Throwable $e) {dd($e);
            return <<<HTML
            <p>There was no expenses whose sum was equal to 2020 :'(</p>
HTML;
        }
        $multiplication = $first * $second;

        return <<<HTML
        <p>The two expenses whose sum equals <b>2020</b> are:</p>
        <ul>
            <li>$first</li>
            <li>$second</li>
        </ul>
        <p>Their multiplication equals <b>$multiplication</b>.</p>
HTML;
    }

    public function secondPuzzle(): string
    {
        try {
            [$first, $second, $third] = $this->find2020SumForNElements(3);
        } catch (\Throwable $e) {
            return <<<HTML
            <p>There was no expenses whose sum was equal to 2020 :'(</p>
HTML;
        }
        $multiplication = $first * $second * $third;

        return <<<HTML
        <p>The three expenses whose sum equals <b>2020</b> are:</p>
        <ul>
            <li>$first</li>
            <li>$second</li>
            <li>$third</li>
        </ul>
        <p>Their multiplication equals <b>$multiplication</b>.</p>
HTML;
    }

    public function find2020SumForNElements(int $n): array
    {
        throw_if($n < 2, new Exception('N needs to be greater than 1'));
        throw_if(
            $n > $this->dataset->count(),
            new Exception('N is bigger than the number of expenses')
        );

        $expenses = $this->dataset->combine($this->dataset);

        // n - 1 since one call returns 2 operands
        $operands = $this->findSum($expenses, $n - 1, 2020);

        throw_unless($operands, new Exception('No expenses adding to 2020'));

        return $operands;
    }

    private function findSum(
        Collection $expenses,
        int $iteration,
        int $sum
    ): array {
        $operands = [];
        $iterations_left = max(--$iteration, 0);

        foreach ($expenses as $expense) {
            $rest = $sum - $expense;

            if ($iterations_left) {
                $next_operands =$this->findSum($expenses, $iterations_left, $rest);

                if ($next_operands) {
                    return array_merge([$expense], $next_operands);
                }
            } elseif ($expenses->has($rest)) {
                return [$expense, $rest];
            }
        }

        return $operands;
    }
}
