<?php

declare(strict_types=1);

namespace App\Domain\Booking\Dto\Availability;

use App\Framework\Collection;

final class Hotels extends Collection
{
    public function add(int $item): void
    {
        ++$this->position;
        $this->array[$this->position] = $item;
    }

    public function toArray(): array
    {
        $hotels = [];
        foreach ($this->array as $hotel) {
            $hotels['hotel'][] = $hotel;
        }

        return $hotels;
    }
}
