<?php

namespace Tests\Unit;

use App\Days\Four;
use PHPUnit\Framework\TestCase;

class FourTest extends TestCase
{
    /** @test */
    public function itFindsValidPasswords(): void
    {
        $day = new Four();

        $this->assertTrue($day->isPassportValid("ecl:gry pid:860033327 eyr:2020 hcl:#fffffd\r\nbyr:1937 iyr:2017 cid:147 hgt:183cm"));
        $this->assertTrue($day->isPassportValid("hcl:#ae17e1 iyr:2013\r\neyr:2024\r\necl:brn pid:760753108 byr:1931\r\nhgt:179cm"));

        $this->assertFalse($day->isPassportValid("iyr:2013 ecl:amb cid:350 eyr:2023 pid:028048884\r\nhcl:#cfa07d byr:1929"));
        $this->assertFalse($day->isPassportValid("hcl:#cfa07d eyr:2025 pid:166559648\r\niyr:2011 ecl:brn hgt:59in"));
    }
}
