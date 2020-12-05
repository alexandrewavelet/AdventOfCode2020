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

    public function __construct($dataset = null)
    {
        $this->dataset = $dataset instanceof Collection
            ? $dataset
            : collect(preg_split(
                $this->getSplitDelimiterForDataset(),
                $dataset
            ));

        if (!$this->dataset->last()) {
            $this->dataset->pop();
        }
    }

    abstract public function description(): string;

    abstract public function firstPuzzle(): string;

    abstract public function secondPuzzle(): string;

    protected function getSplitDelimiterForDataset(): string
    {
        return '/\r\n|\r|\n/';
    }
}
