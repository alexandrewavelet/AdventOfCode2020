<?php

namespace App\Days;

use App\Data\Seat;

class Five extends Day
{
    public $title = 'Binary Boarding';

    public function description(): string
    {
        return <<<HTML
        <p>Check the boarding passes before getting on the plane.<p>
HTML;
    }

    public function firstPuzzle(): string
    {
        $max_seat_id = $this->dataset->map(function (string $row) {
            return $this->findSeat($row)->seat_id;
        })->max();

        return <<<HTML
        <p>The maximum seat ID on boarding passes is <b>$max_seat_id</b>.</p>
HTML;
    }

    public function secondPuzzle(): string
    {
        $seats = $this->dataset->map(function (string $row) {
            return $this->findSeat($row)->seat_id;
        })->sort()->values();

        $seat_before_mine_index = $seats->search(function ($item, $key) use ($seats) {
            return $seats->get($key + 1) - $item === 2;
        });

        $my_seat = $seats->get($seat_before_mine_index) + 1;

        return <<<HTML
        <p>I'm in seat <b>$my_seat</b>!<p>
HTML;
    }

    public function findSeat(string $barcode): Seat
    {
        [$row_code, $column_code] = str_split($barcode, 7);

        $row = $this->binToDec($row_code, 'B', 'F');
        $column = $this->binToDec($column_code, 'R', 'L');
        $seat_id = $row * 8 + $column;

        return new Seat($row, $column, $seat_id);
    }

    private function binToDec(string $code, string $one, string $zero): string
    {
        $bin = str_replace([$one, $zero], [1, 0], $code);

        return bindec($bin);
    }
}
