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
        return <<<HTML
        <p>Ahah<p>
HTML;
    }

    public function findBagsThatCanContain(string $bag_to_find): Collection
    {
        $this->bag_dict = $this->formatDataset();

        return $this->bag_dict->map(function ($contains) use ($bag_to_find) {
            return $this->hasBagIn($bag_to_find, $contains);
        })->filter()->keys();
    }

    public function hasBagIn(string $bag_to_find, array $bags_to_search) : bool
    {
        if (in_array($bag_to_find, $bags_to_search)) {
            return true;
        }

        foreach ($bags_to_search as $bag) {
            if ($this->hasBagIn(
                $bag_to_find,
                $this->bag_dict->get($bag, [])
            )) {
                return true;
            }
        }

        return false;
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
                "/\d+ (\w* \w*) bags*/",
                $row,
                $contained_bags
            );

            $bags->put($bag_keys[$key], $contained_bags[1]);
        }

        return $bags;
    }
}
