<?php

declare(strict_types=1);

namespace App\Application\Query;

final class Hotels
{
    public function __construct(
        public readonly array $hotels,
        public readonly string $checkIn,
        public readonly int $total,
        public readonly string $checkOut,
    ) {
    }

    public static function fromArray(array $response): self
    {
        return new self(
            $response['hotels'],
            $response['checkIn'],
            (int) $response['total'],
            $response['checkOut'],
        );
    }
}
