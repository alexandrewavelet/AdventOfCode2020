<?php

namespace App\Data;

class Direction
{
    /** @var int $right */
    public $right;
    /** @var int $down */
    public $down;

    public function __construct(int $right, int $down) {
        $this->right = $right;
        $this->down = $down;
    }
}
