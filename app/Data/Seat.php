<?php

namespace App\Data;

class Seat
{
    /** @var int */
    public $row;
    /**  @var int */
    public $column;
    /** @var int */
    public $seat_id;

    public function __construct(int $row, int $column, int $seat_id) {
        $this->row = $row;
        $this->column = $column;
        $this->seat_id = $seat_id;
    }
}
