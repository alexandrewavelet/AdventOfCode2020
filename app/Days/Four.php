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
        $valid_passports_count = $this->dataset->filter(function (string $passport) {
            return $this->isPassportFullyValid($passport);
        })->count();

        return <<<HTML
        <p>The number of fully valid passwords is <b>$valid_passports_count</b>.</p>
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
            '/(?=\X*pid:\d{9}\b)(?=\X*ecl:(amb|blu|brn|gry|grn|hzl|oth)\b)(?=\X*eyr:20(2\d|30)\b)(?=\X*hcl:#[\da-f]{6}\b)(?=\X*byr:(19[2-9]\d|200[0-2])\b)(?=\X*iyr:20(1\d|20)\b)(?=\X*hgt:(1([5-8]\d|9[0-3])cm|(59|6\d|7[0-6])in)\b)/',
             $passport
        );
    }

    public function getSplitDelimiterForDataset(): string
    {
        return '/\r\n|\r|\n\s/';
    }
}
