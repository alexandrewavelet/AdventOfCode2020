<?php

namespace App\Days;

use Exception;
use Illuminate\Support\Collection;

class Eight extends Day
{
    public $title = 'Handheld Halting';

    private const NOP = 'nop';
    private const ACC = 'acc';
    private const JMP = 'jmp';
    private const STOP = 'stop';

    public function description(): string
    {
        return <<<HTML
        <p>Debug the gameboy boot w00t!<p>
HTML;
    }

    public function firstPuzzle(): string
    {
        $accumulator = $this->getAccumulatorValueBeforeLoop();

        return <<<HTML
        <p>The accumulator value before the bootloop is <b>$accumulator</b>.</p>
HTML;
    }

    public function secondPuzzle(): string
    {
        $accumulator = $this->fixBoot();

        return <<<HTML
        <p>When fixing the boot, we get an accumulator of <b>$accumulator</b>.<p>
HTML;
    }

    public function getAccumulatorValueBeforeLoop(): int
    {
        $accumulator = 0;
        $dataset = clone $this->dataset;
        $instruction_key = 0;
        $instruction_matches = [];

        preg_match("/(nop|acc|jmp|stop) ([\+-]\d+)/", $dataset->first(), $instruction_matches);
        [, $instruction, $number] = $instruction_matches;
        $number = intval($number);

        while ($instruction !== self::STOP) {
            $dataset->put($instruction_key, self::STOP . ' +0');

            switch ($instruction) {
                case Self::ACC:
                    $accumulator += $number;
                    $instruction_key++;
                    break;

                case self::JMP:
                    $instruction_key += $number;
                    break;

                case self::NOP:
                    $instruction_key++;
                    break;

                default:
                    throw new Exception('Hey you! Watcha doing here?');
            }

            preg_match(
                "/(nop|acc|jmp|stop) ([\+-]\d+)/",
                $dataset->get($instruction_key),
                $instruction_matches
            );
            [, $instruction, $number] = $instruction_matches;
            $number = intval($number);
        }

        return $accumulator;
    }

    public function fixBoot(): int
    {
        $accumulator = 0;
        $dataset = $this->dataset->toArray();

        while(($row = next($dataset)) && !$accumulator) {
            if (strpos($row, 'acc') === 0) {
                continue;
            }

            try {
                $copy = $dataset;
                $copy[key($dataset)] = str_replace(
                    [self::NOP, self::JMP],
                    [self::JMP, self::NOP],
                    $row
                );

                $accumulator = $this->testBoot(collect($copy));
            } catch (\Throwable $e) {}
        }

        return $accumulator;
    }

    public function testBoot(Collection $dataset): int
    {
        $accumulator = 0;
        $instruction_key = 0;
        $instruction_matches = [];

        preg_match("/(nop|acc|jmp|stop) ([\+-]\d+)/", $dataset->first(), $instruction_matches);
        [, $instruction, $number] = $instruction_matches;
        $number = intval($number);

        while ($instruction) {
            $dataset->put($instruction_key, self::STOP . ' +0');

            switch ($instruction) {
                case Self::ACC:
                    $accumulator += $number;
                    $instruction_key++;
                    break;

                case self::JMP:
                    $instruction_key += $number;
                    break;

                case self::NOP:
                    $instruction_key++;
                    break;

                case self::STOP:
                    throw new Exception('Bootloop!');

                default:
                    throw new Exception('Hey you! Watcha doing here?');
            }

            preg_match(
                "/(nop|acc|jmp|stop) ([\+-]\d+)/",
                $dataset->get($instruction_key),
                $instruction_matches
            );

            if (!$instruction_matches) {
                $instruction = false;
            } else {
                [, $instruction, $number] = $instruction_matches;
                $number = intval($number);
            }
        }

        return $accumulator;
    }
}
