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
        $invalid_number = $this->checkWithPreamble(25);

        return <<<HTML
        <p>The invalid number has been found! it's <b>$invalid_number</b>.</p>
HTML;
    }

    public function secondPuzzle(): string
    {
        $weakness = $this->findEncryptionWeakness(25);

        return <<<HTML
        <p>Therefore, after moult péripéties, the encryption weakness number is <b>$weakness</b>.<p>
HTML;
    }

    public function checkWithPreamble(int $preamble): int
    {
        $invalid_number = 0;
        $dataset = clone $this->dataset;
        $checklist = $dataset->splice(0, $preamble);

        while (!$invalid_number) {
            $number_to_check = $dataset->shift();

            // AHAH GOTCHA, I ALREADY DID THAT SUM THING!
            $one = new One($checklist);

            try {
                $one->findSumForNElements($number_to_check, 2);

                $checklist->shift();
                $checklist->push($number_to_check);
            } catch (\Throwable $e) {
                $invalid_number = $number_to_check;
            }
        }

        return $invalid_number;
    }

    public function findEncryptionWeakness(int $preamble): int
    {
        $encryption_key = 0;

        $invalid_number = $this->checkWithPreamble($preamble);

        $original_dataset = (clone $this->dataset)
            ->slice(0, $this->dataset->search($invalid_number));
        $dataset = $original_dataset->toArray();
        $count = count($dataset);

        while (
            !$encryption_key
            && ($lower_bound = key($dataset)) !== false
        ) {
            $upper_bound = $lower_bound + 1;

            while (!$encryption_key && $upper_bound <= $count) {
                $operands = $original_dataset->filter(
                    function ($_, $key) use ($lower_bound, $upper_bound) {
                        return $key >= $lower_bound && $key <= $upper_bound;
                    }
                );
                $sum = $operands->sum();

                if ($sum === $invalid_number) {
                    $encryption_key = $operands->min() + $operands->max();
                } elseif ($sum < $invalid_number) {
                    $upper_bound++;
                } else {
                    break;
                }
            }

            next($dataset);
        }

        return $encryption_key;
    }
}
