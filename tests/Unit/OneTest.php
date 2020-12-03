<?php

namespace Tests\Unit;

use App\Days\One;
use PHPUnit\Framework\TestCase;

class OneTest extends TestCase
{
    /** @test */
    public function itFinds2020sum(): void
    {
        $one = new One(collect([1000, 1020]));

        $this->assertEquals([1000, 1020], $one->find2020Sum());

        $one = new One(collect([979, 366, 299, 675, 1456, 1721]));

        $this->assertEquals([299, 1721], $one->find2020Sum());
    }

    /** @test */
    public function itThrowsExceptionWhenNo2020Sum(): void
    {
        $this->expectExceptionMessage('No expenses adding to 2020');

        $one = new One(collect([4, 8, 15, 16, 23, 42]));
        $one->find2020Sum();
    }

    /** @test */
    // public function itFinds2020SumForNElements(): void
    // {
    //     $this->expectExceptionMessage('No expenses adding to 2020');

    //     $one = new One(collect([979, 366, 299, 675, 1456, 1721]));
    //     $one->find2020SumFor(3);
    // }
}
