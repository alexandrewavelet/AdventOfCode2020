<?php

namespace App\Days;

class Four extends Day
{
    public $title = 'Passport Processing';

    public function description(): string
    {
        return <<<HTML
        <p>Detect the number of valid passwords from a list.<p>
HTML;
    }

    public function firstPuzzle(): string
    {
        return <<<HTML
        <p>Ohoh</p>
HTML;
    }

    public function secondPuzzle(): string
    {
        return <<<HTML
        <p>Ahah<p>
HTML;
    }

    public function isPassportValid(string $password): bool
    {
        return true;
    }

    public function getSplitDelimiterForDataset(): string
    {
        return '/\r\n|\r|\n\s/';
    }
}
