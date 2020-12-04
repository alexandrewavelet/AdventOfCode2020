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
        $valid_passports_count = $this->dataset->filter(function (string $passport) {
            return $this->isPassportValid($passport);
        })->count();

        return <<<HTML
        <p>The number of valid passwords is <b>$valid_passports_count</b>.</p>
HTML;
    }

    public function secondPuzzle(): string
    {
        return <<<HTML
        <p>Ahah<p>
HTML;
    }

    public function isPassportValid(string $passport): bool
    {
        return (bool)preg_match(
            '/(?=\X*pid)(?=\X*ecl)(?=\X*eyr)(?=\X*hcl)(?=\X*byr)(?=\X*iyr)(?=\X*hgt)/',
             $passport
        );
    }

    public function isPassportFullyValid(string $passport): bool
    {
        return (bool)preg_match(
            '/(?=\X*pid)(?=\X*ecl)(?=\X*eyr)(?=\X*hcl)(?=\X*byr)(?=\X*iyr)(?=\X*hgt)/',
             $passport
        );
    }

    public function getSplitDelimiterForDataset(): string
    {
        return '/\r\n|\r|\n\s/';
    }
}
