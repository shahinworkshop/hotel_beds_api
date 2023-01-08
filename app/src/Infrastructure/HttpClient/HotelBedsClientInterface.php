<?php

declare(strict_types=1);

namespace App\Infrastructure\HttpClient;

use App\Domain\Booking\Dto\Availability\CheckAvailability;

interface HotelBedsClientInterface
{
    public function getHotelsAvailability(CheckAvailability $checkAvailability): array;
}