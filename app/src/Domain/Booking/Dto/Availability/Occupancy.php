<?php

declare(strict_types=1);

namespace App\Domain\Booking\Dto\Availability;

final class Occupancy
{
    public function __construct(
        public readonly int $rooms,
        public readonly int $adults,
        public readonly int $children,
    ) {
    }
}
