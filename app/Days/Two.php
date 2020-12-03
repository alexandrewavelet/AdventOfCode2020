<?php

namespace App\Days;

use Exception;

class Two extends Day
{
    public $title = 'Password Philosophy';

    public function description(): string
    {
        return <<<HTML
        <p>Find the number of secure passwords from the list.<p>
HTML;
    }

    public function firstPuzzle(): string
    {
        $valid_passwords_count = $this->dataset->filter(function (string $row) {
            return $this->isPasswordValidPart1($row);
        })->count();

        return <<<HTML
        <p>The number of valid passwords is $valid_passwords_count.<p>
HTML;
    }

    public function isPasswordValidPart1(string $row): bool
    {
        $matches = [];
        preg_match_all('#(\d+)-(\d+) ([a-z]): ([a-z]*)#i', $row, $matches);

        [,$lower_bound, $upper_bound, $letter, $password] = $matches;

        $lower_bound = $lower_bound[0];
        $upper_bound = $upper_bound[0];
        $letter = $letter[0];
        $password = $password[0];

        $byte_letter = ord($letter);

        $letters = count_chars($password);

        return array_key_exists($byte_letter, $letters)
            && $letters[$byte_letter] >= $lower_bound
            && $letters[$byte_letter] <= $upper_bound
        ;
    }

    public function secondPuzzle(): string
    {
        $valid_passwords_count = $this->dataset->filter(function (string $row) {
            return $this->isPasswordValidPart2($row);
        })->count();

        return <<<HTML
        <p>The number of valid passwords is $valid_passwords_count.<p>
HTML;
    }

    public function isPasswordValidPart2(string $row): bool
    {
        $matches = [];
        preg_match_all('#(\d+)-(\d+) ([a-z]): ([a-z]*)#i', $row, $matches);

        [,$first_position, $second_position, $letter, $password] = $matches;

        $first_position = $first_position[0] -1;
        $second_position = $second_position[0] - 1;
        $letter = $letter[0];
        $password = $password[0];

        return substr($password, $first_position, 1) === $letter
            xor substr($password, $second_position, 1) === $letter;
    }
}
