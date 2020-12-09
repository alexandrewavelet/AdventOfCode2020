<?php

namespace Tests\Unit;

use App\Days\One;
use PHPUnit\Framework\TestCase;

class OneTest extends TestCase
{
    /** @test */
    public function itFinds2020SumForNElements(): void
    {
        $one = new One(collect([979, 2020, 366, 299, 675, 1456, 1721]));

        $this->assertEqualsCanonicalizing(
            [299, 1721],
            $one->findSumForNElements(2020, 2)
        );

        $this->assertEqualsCanonicalizing(
            [979, 366, 675],
            $one->findSumForNElements(2020, 3)
        );
    }

    /** @test */
    public function itThrowsExceptionWhenNo2020Sum(): void
    {
        $this->expectExceptionMessage('No sum found');

        $one = new One(collect([4, 8, 15, 16, 23, 42]));
        $one->findSumForNElements(2020, 3);
    }
}
