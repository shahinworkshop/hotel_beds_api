<?php

declare(strict_types=1);

namespace App\Domain\Booking\Dto\Availability;

final class CheckAvailability
{
    public function __construct(
        public readonly \DateTimeImmutable $checkIn,
        public readonly \DateTimeImmutable $checkOut,
        public readonly Occupancies $occupancies,
        public readonly Hotels $hotels,
    ) {
    }

    public function toArray(): array
    {
        return [
            'stay' => [
                'checkIn' => $this->checkIn->format('Y-m-d'),
                'checkOut' => $this->checkOut->format('Y-m-d'),
            ],
            'occupancies' => $this->occupancies->toArray(),
            'hotels' => $this->hotels->toArray(),
        ];
    }
}
