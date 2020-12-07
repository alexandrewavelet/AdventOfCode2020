<?php

namespace App\Days;

use Illuminate\Support\Collection;

class Seven extends Day
{
    public $title = 'Handy Haversacks';

    /** @var Collection */
    private $bag_dict = null;

    public function description(): string
    {
        return <<<HTML
        <p>Find all the bags that can contain a shiny gold bag.<p>
HTML;
    }

    public function firstPuzzle(): string
    {
        $number_of_bags = $this->findBagsThatCanContain('shiny gold')->count();

        return <<<HTML
        <p><b>$number_of_bags</b> bags can contain a <b>shiny gold</b> bag.</p>
HTML;
    }

    public function secondPuzzle(): string
    {
        $number_of_bags = $this->findHowManyBagsBagCanContain('shiny gold');

        return <<<HTML
        <p>A <b>shiny gold bag</b> bags can contain <b>$number_of_bags</b> bags.</p>
HTML;
    }

    public function findBagsThatCanContain(string $bag_to_find): Collection
    {
        $this->bag_dict = $this->formatDataset();

        return $this->bag_dict->map(function ($bags) use ($bag_to_find) {
            return $this->hasBagIn($bag_to_find, array_keys($bags));
        })->filter()->keys();
    }

    private function hasBagIn(string $bag_to_find, array $bags_to_search) : bool
    {
        if (in_array($bag_to_find, $bags_to_search)) {
            return true;
        }

        foreach ($bags_to_search as $bag) {
            if ($this->hasBagIn(
                $bag_to_find,
                array_keys($this->bag_dict->get($bag, []))
            )) {
                return true;
            }
        }

        return false;
    }

    public function findHowManyBagsBagCanContain(string $bag): int
    {
        $this->bag_dict = $this->formatDataset();

        $bag_contains = $this->bag_dict->get($bag);

        return $this->sumBags($bag_contains);
    }

    private function sumBags(array $bags): int
    {
        $sum = 0;

        foreach ($bags as $bag => $number) {
            $sum += $number + $number * $this->sumBags($this->bag_dict->get($bag, []));
        }

        return $sum;
    }

    public function formatDataset()
    {
        $bags = collect();

        $bag_keys = [];
        preg_match_all(
            "/(\w* \w*) bags contain/",
            $this->dataset->join("\r\n"),
            $bag_keys
        );
        $bag_keys = $bag_keys[1];

        foreach ($this->dataset as $key => $row) {
            $contained_bags = [];
            preg_match_all(
                "/(\d+) (\w* \w*) bags*/",
                $row,
                $contained_bags
            );

            $bags->put(
                $bag_keys[$key],
                array_combine($contained_bags[2], $contained_bags[1])
            );
        }

        return $bags;
    }
}
