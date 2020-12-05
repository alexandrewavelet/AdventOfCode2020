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

    /** @test */
    public function itFindsFullyValidPasswords(): void
    {
        $day = new Four();

        $this->assertTrue($day->isPassportFullyValid("pid:087499704 hgt:74in ecl:grn iyr:2012 eyr:2030 byr:1980\r\nhcl:#623a2f"));
        $this->assertTrue($day->isPassportFullyValid("eyr:2029 ecl:blu cid:129 byr:1989\r\niyr:2014 pid:896056539 hcl:#a97842 hgt:165cm"));
        $this->assertTrue($day->isPassportFullyValid("hcl:#888785\r\nhgt:164cm byr:2001 iyr:2015 cid:88\r\npid:545766238 ecl:hzl\r\neyr:2022"));
        $this->assertTrue($day->isPassportFullyValid("iyr:2010 hgt:158cm hcl:#b6652a ecl:blu byr:1944 eyr:2021 pid:093154719"));

        $this->assertFalse($day->isPassportFullyValid("eyr:1972 cid:100\r\nhcl:#18171d ecl:amb hgt:170 pid:186cm iyr:2018 byr:1926"));
        $this->assertFalse($day->isPassportFullyValid("iyr:2019\r\nhcl:#602927 eyr:1967 hgt:170cm\r\necl:grn pid:012533040 byr:1946"));
        $this->assertFalse($day->isPassportFullyValid("hcl:dab227 iyr:2012\r\necl:brn hgt:182cm pid:021572410 eyr:2020 byr:1992 cid:277"));
        $this->assertFalse($day->isPassportFullyValid("hgt:59cm ecl:zzz\r\neyr:2038 hcl:74454a iyr:2023\r\npid:3556412378 byr:2007"));
    }
}
