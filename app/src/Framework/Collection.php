<?php

declare(strict_types=1);

namespace App\Framework;

abstract class Collection implements \Iterator
{
    protected int $position = 0;
    protected array $array = [];

    public function __construct(array $array = [])
    {
        $this->array = $array;
        $this->position = \count($array);
    }

    public function current(): mixed
    {
        return $this->array[$this->position];
    }

    public function next(): void
    {
        ++$this->position;
    }

    public function key(): mixed
    {
        return $this->position;
    }

    public function valid(): bool
    {
        return isset($this->array[$this->position]);
    }

    public function rewind(): void
    {
        $this->position = 0;
    }
}
