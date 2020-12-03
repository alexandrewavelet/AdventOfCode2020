<?php

namespace App\Days;

use App\Data\Direction;
use Illuminate\Support\Collection;

class Three extends Day
{
    public $title = 'Toboggan Trajectory';

    private const TREE = '#';

    public function description(): string
    {
        return <<<HTML
        <p>Let's slide the toboggan through the forest! But how many trees will we encounter?<p>
HTML;
    }

    public function firstPuzzle(): string
    {
        $direction = new Direction(3, 1);
        $number_of_trees = $this->traverse($direction);

        return <<<HTML
        <p>By sliding though the forest with direction
            <b>($direction->right, $direction->down)</b>, we're going to
            encounter $number_of_trees trees.
        </p>
HTML;
    }

    public function secondPuzzle(): string
    {
        $multiplication = $this->traverse(new Direction(1, 1))
            * $this->traverse(new Direction(3, 1))
            * $this->traverse(new Direction(5, 1))
            * $this->traverse(new Direction(7, 1))
            * $this->traverse(new Direction(1, 2));

        return <<<HTML
        <p>This has absolutely no sense, but for all possible slopes we'll encounter <b>$multiplication</b> trees<p>
HTML;
    }

    public function traverse(Direction $direction): int
    {
        $trees = 0;
        $position = ['x' => 0, 'y' => 0];
        $number_of_moves = ceil(($this->dataset->count() - 1) / $direction->down);

        for ($i = 1; $i <= $number_of_moves; $i++) {
            $position['x'] += $direction->right;
            $position['y'] += $direction->down;

            $latitude = $this->dataset->get($position['y']);
            $simulated_longitude = $position['x'] % strlen($latitude);

            $simulated_landing_position = substr($latitude, $simulated_longitude, 1);

            if ($simulated_landing_position === self::TREE) {
                $trees++;
            }
        }

        return $trees;
    }
}
