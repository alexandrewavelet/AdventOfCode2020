<?php

namespace Tests\Unit;

use App\Days\Ten;
use PHPUnit\Framework\TestCase;

class TenTest extends TestCase
{
    /** @test */
    public function partOne(): void
    {
        $day = new Ten(collect([16, 10, 15, 5, 1, 11, 7, 19, 6, 12, 4]));

        $this->assertEquals(35, $day->solvePartOne());

        $day = new Ten(collect([28, 33, 18, 42, 31, 14, 46, 20, 48, 47, 24, 23, 49, 45, 19, 38, 39, 11, 1, 32, 25, 35, 8, 17, 7, 9, 4, 2, 34, 10, 3]));

        $this->assertEquals(220, $day->solvePartOne());
    }
}
