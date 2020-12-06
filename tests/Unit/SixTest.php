<?php

namespace Tests\Unit;

use App\Days\Six;
use PHPUnit\Framework\TestCase;

class SixTest extends TestCase
{
    /** @test */
    public function itFindsTheNumberOfYesInAGroup(): void
    {
        $day = new Six();

        $this->assertEquals(3, $day->numberOfYesForGroup('abc'));
        $this->assertEquals(3, $day->numberOfYesForGroup("a\r\nb\r\nc"));
        $this->assertEquals(3, $day->numberOfYesForGroup("ab\r\nac"));
        $this->assertEquals(1, $day->numberOfYesForGroup("a\r\na\r\na\r\na"));
        $this->assertEquals(1, $day->numberOfYesForGroup('b'));
    }
}
