<?php

namespace App\Days;

use Exception;

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
            [$first, $second] = $this->find2020sum();
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

    public function find2020sum(): array
    {
        $first = $second = $sum = null;
        $expenses = $this->dataset->sort()->toArray();

        // While there's still expenses to process and that the sum isn't found yet
        while (count($expenses) > 0 && $sum !== 2020) {
            $first = array_shift($expenses);
            $second = current($expenses);

            // While the array pointer isn't at the end of $expenses and that the sum isn't found yet
            while (key($expenses) !== null && $sum !== 2020) {
                $second = current($expenses);
                $sum = $first + $second;

                // Break the loop when total > 2020 (because expenses are sorted ASC)
                if ($sum > 2020) {
                    break;
                }

                next($expenses);
            }
        }

        throw_if($sum !== 2020, new Exception('No expenses adding to 2020'));

        return [$first, $second];
    }

    public function secondPuzzle(): string
    {
        return '';
    }
}
