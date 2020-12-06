<?php

namespace App\Days;

class Six extends Day
{
    public $title = 'Custom customs';

    public function description(): string
    {
        return <<<HTML
        <p>Help groups fill their customs forms (so nice!).<p>
HTML;
    }

    public function firstPuzzle(): string
    {
        $count = $this->dataset->sum(function ($row) {
            return $this->numberOfYesForGroup($row);
        });

        return <<<HTML
        <p>The number of "Yes" in the customs forms is <b>$count</b>.</p>
HTML;
    }

    public function secondPuzzle(): string
    {
        $count = $this->dataset->sum(function ($row) {
            return $this->numberOfYesForAllInGroup($row);
        });

        return <<<HTML
        <p>The number of "Yes" per question for all people in the same group is <b>$count</b>.</p>
HTML;
    }

    public function numberOfYesForGroup(string $forms): int
    {
        $yes_answers =  array_unique(
            str_split(preg_replace('/\s+/', '', $forms))
        );

        return count($yes_answers);
    }

    public function numberOfYesForAllInGroup(string $forms): int
    {
        $number_of_lines = preg_match_all('/\s+/', trim($forms)) + 1;

        return collect(
                str_split(preg_replace('/\s+/', '', $forms))
            )
            ->countBy()
            ->filter(function (int $value) use ($number_of_lines) {
                return $value === $number_of_lines;
            })
            ->count()
        ;
    }

    public function getSplitDelimiterForDataset(): string
    {
        return '/\r\n|\r|\n\s/';
    }
}
