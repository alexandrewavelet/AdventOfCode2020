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
        return <<<HTML
        <p>Ahah<p>
HTML;
    }

    public function numberOfYesForGroup(string $forms): int
    {
        $yes_answers =  array_unique(
            str_split(preg_replace('/\s+/', '', $forms))
        );

        return count($yes_answers);
    }

    public function getSplitDelimiterForDataset(): string
    {
        return '/\r\n|\r|\n\s/';
    }
}
