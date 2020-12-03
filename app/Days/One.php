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
            [$first, $second] = $this->find2020Sum();
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

    public function find2020Sum(): array
    {
        $expenses = $this->dataset->sort();
        $expenses = $expenses->combine($expenses);

        foreach ($expenses as $expense) {
            $rest = 2020 - $expense;

            if ($expenses->has($rest)) {
                return [$expense, $rest];
            }
        }

        throw new Exception('No expenses adding to 2020');
    }

    public function secondPuzzle(): string
    {
        try {
            [$first, $second, $third] = $this->find2020SumFor3Elements();
        } catch (\Throwable $e) {dd($e);
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

    public function find2020SumFor3Elements(): array
    {
        $expenses = $this->dataset->sort();
        $expenses = $expenses->combine($expenses);

        foreach ($expenses as $expense) {
            $rest = 2020 - $expense;

            foreach ($expenses as $second_expense) {
                $second_rest = $rest - $second_expense;

                if ($expenses->has($second_rest)) {
                    return [$expense, $second_expense, $second_rest];
                }
            }
        }

        throw new Exception('No expenses adding to 2020');
    }
}
