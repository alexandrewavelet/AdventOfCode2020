<?php

namespace Tests\Unit;

use App\Days\Two;
use PHPUnit\Framework\TestCase;

class TwoTest extends TestCase
{
    /** @test */
    public function itFindsWhetherPasswordAreValidPart1(): void
    {
        $two = new Two(collect());

        $this->assertTrue($two->isPasswordValidPart1('1-3 a: abcde'));
        $this->assertTrue($two->isPasswordValidPart1('2-9 c: ccccccccc'));

        $this->assertFalse($two->isPasswordValidPart1('1-3 b: cdefg'));
    }

    /** @test */
    public function itFindsWhetherPasswordAreValidPart2(): void
    {
        $two = new Two(collect());

        $this->assertTrue($two->isPasswordValidPart2('1-3 a: abcde'));

        $this->assertFalse($two->isPasswordValidPart2('2-9 c: ccccccccc'));
        $this->assertFalse($two->isPasswordValidPart2('1-3 b: cdefg'));
    }
}
