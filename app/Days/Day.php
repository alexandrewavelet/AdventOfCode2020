<?php

namespace App\Days;

use Illuminate\Support\Collection;

abstract class Day
{
    public $title = '';

    /**
     * Day dataset
     *
     * @var Collection
     */
    protected $dataset;

    public function __construct(Collection $dataset)
    {
        $this->dataset = $dataset;
    }

    abstract public function description(): string;

    abstract public function firstPuzzle(): string;

    abstract public function secondPuzzle(): string;
}
