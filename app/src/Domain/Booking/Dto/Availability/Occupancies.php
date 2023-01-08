<?php

declare(strict_types=1);

namespace App\Domain\Booking\Dto\Availability;

use App\Framework\Collection;

final class Occupancies extends Collection
{
    public function add(Occupancy $item): void
    {
        ++$this->position;
        $this->array[$this->position] = $item;
    }

    public function toArray(): array
    {
        $occupancies = [];
        foreach ($this->array as $occupancy) {
            $occupancies[] = [
                'rooms' => $occupancy->rooms,
                'adults' => $occupancy->adults,
                'children' => $occupancy->children,
            ];
        }

        return $occupancies;
    }
}
