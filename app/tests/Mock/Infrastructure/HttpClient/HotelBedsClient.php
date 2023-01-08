<?php

declare(strict_types=1);

namespace App\Tests\Mock\Infrastructure\HttpClient;

use App\Domain\Booking\Dto\Availability\CheckAvailability;
use App\Infrastructure\HttpClient\HotelBedsClientInterface;

final class HotelBedsClient implements HotelBedsClientInterface
{
    private array $hotelsAvailabilityResult;

    public function setHotelsAvailabilityResult(array $result): void
    {
        $this->hotelsAvailabilityResult = $result;
    }

    public function getHotelsAvailability(CheckAvailability $checkAvailability): array
    {
        return $this->hotelsAvailabilityResult;
    }
}