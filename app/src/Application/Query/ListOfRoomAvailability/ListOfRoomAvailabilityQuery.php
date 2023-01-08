<?php

declare(strict_types=1);

namespace App\Application\Query\ListOfRoomAvailability;

use App\Domain\Booking\Dto\Availability\CheckAvailability;
use App\Infrastructure\HttpClient\HotelBedsClientInterface;

final class ListOfRoomAvailabilityQuery
{
    public function __construct(
        private readonly HotelBedsClientInterface $hotelBedsClient,
    ) {
    }

    public function byHotelCodeList(CheckAvailability $checkAvailability): ListOfRoomAvailability
    {
        $response = $this->hotelBedsClient->getHotelsAvailability($checkAvailability);

        try {
            return ListOfRoomAvailability::from($response);
        } catch (\InvalidArgumentException $e) {
            throw new \InvalidArgumentException('Error while parsing response: '.$e->getMessage());
        }
    }
}
