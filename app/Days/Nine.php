<?php

namespace App\Days;

class Nine extends Day
{
    public $title = 'Encoding Error';

    public function description(): string
    {
        return <<<HTML
        <p>Find the XMAS protocol weakness #hacking<p>
HTML;
    }

    public function firstPuzzle(): string
    {
        $faulty_number = $this->checkWithPreamble(25);

        return <<<HTML
        <p>The faulty number has been found! it's <b>$faulty_number</b>.</p>
HTML;
    }

    public function secondPuzzle(): string
    {
        return <<<HTML
        <p>Ahah<p>
HTML;
    }

    public function checkWithPreamble(int $preamble): int
    {
        $faulty_number = 0;
        $dataset = clone $this->dataset;
        $checklist = $dataset->splice(0, $preamble);

        while (!$faulty_number) {
            $number_to_check = $dataset->shift();

            // AHAH GOTCHA, I ALREADY DID THAT SUM THING!
            $one = new One($checklist);

            try {
                $one->findSumForNElements($number_to_check, 2);

                $checklist->shift();
                $checklist->push($number_to_check);
            } catch (\Throwable $e) {
                $faulty_number = $number_to_check;
            }
        }

        return $faulty_number;
    }

    public function findEncryptionWeakness(int $preamble): int
    {
        return 0;
    }
}
