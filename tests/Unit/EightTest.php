<?php

namespace Tests\Unit;

use App\Days\Eight;
use PHPUnit\Framework\TestCase;

class EightTest extends TestCase
{
    /** @test */
    public function itFindsAccumulatorValueBeforeLoop(): void
    {
        $day = new Eight(collect([
            'nop +0',
            'acc +1',
            'jmp +4',
            'acc +3',
            'jmp -3',
            'acc -99',
            'acc +1',
            'jmp -4',
            'acc +6',
        ]));

        $this->assertEquals(5, $day->getAccumulatorValueBeforeLoop());
    }

    /** @test */
    public function itFixesTheProgramAndReturnAccumulator(): void
    {
        $day = new Eight(collect([
            'nop +0',
            'acc +1',
            'jmp +4',
            'acc +3',
            'jmp -3',
            'acc -99',
            'acc +1',
            'jmp -4',
            'acc +6',
        ]));

        $this->assertEquals(8, $day->fixBoot());
    }
}
