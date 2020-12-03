<?php

namespace Tests\Unit;

use App\Data\Direction;
use App\Days\Three;
use PHPUnit\Framework\TestCase;

class ThreeTest extends TestCase
{
    /** @test */
    public function itCalculatesTheNumberOfTreesEncountered(): void
    {
        $day = new Three(collect([
            '..##.......',
            '#...#...#..',
            '.#....#..#.',
            '..#.#...#.#',
            '.#...##..#.',
            '..#.##.....',
            '.#.#.#....#',
            '.#........#',
            '#.##...#...',
            '#...##....#',
            '.#..#...#.#',
        ]));

        $this->assertEquals(2, $day->traverse(new Direction(1, 1)));
        $this->assertEquals(7, $day->traverse(new Direction(3, 1)));
        $this->assertEquals(3, $day->traverse(new Direction(5, 1)));
        $this->assertEquals(4, $day->traverse(new Direction(7, 1)));
        $this->assertEquals(2, $day->traverse(new Direction(1, 2)));
    }
}
