<?php

namespace Tests\Unit;

use App\Data\Seat;
use App\Days\Five;
use PHPUnit\Framework\TestCase;

class FiveTest extends TestCase
{
    /** @test */
    public function itFindsSeatFromBoardingPass(): void
    {
        $day = new Five();

        $this->assertEquals(new Seat(44, 5, 357), $day->findSeat('FBFBBFFRLR'));
        $this->assertEquals(new Seat(70, 7, 567), $day->findSeat('BFFFBBFRRR'));
        $this->assertEquals(new Seat(14, 7, 119), $day->findSeat('FFFBBBFRRR'));
        $this->assertEquals(new Seat(102, 4, 820), $day->findSeat('BBFFBBFRLL'));
    }
}
