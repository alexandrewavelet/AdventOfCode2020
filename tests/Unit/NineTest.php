<?php

namespace Tests\Unit;

use App\Days\Nine;
use PHPUnit\Framework\TestCase;

class NineTest extends TestCase
{
    /** @test */
    public function itDoesSomething(): void
    {
        $day = new Nine(collect([
            35,
            20,
            15,
            25,
            47,
            40,
            62,
            55,
            65,
            95,
            102,
            117,
            150,
            182,
            127,
            219,
            299,
            277,
            309,
            576,
        ]));

        $this->assertEquals(127, $day->checkWithPreamble(5));
    }
}
