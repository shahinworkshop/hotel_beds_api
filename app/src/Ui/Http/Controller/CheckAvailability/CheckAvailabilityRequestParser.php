<?php

declare(strict_types=1);

namespace App\Ui\Http\Controller\CheckAvailability;

use App\Domain\Booking\Dto\Availability\CheckAvailability;
use App\Domain\Booking\Dto\Availability\Hotels;
use App\Domain\Booking\Dto\Availability\Occupancies;
use App\Domain\Booking\Dto\Availability\Occupancy;
use App\Framework\InvalidArgumentException;
use App\Framework\Ui\Http\Controller\PayloadProcessor;
use Symfony\Component\HttpFoundation\Request;

final class CheckAvailabilityRequestParser implements PayloadProcessor
{
    public function generate(Request $request): CheckAvailability
    {
        $parameters = \json_decode($request->getContent(), true);
        try {
            $occupancies = new Occupancies();
            $occupancies->add(new Occupancy(
                rooms: $parameters['rooms'],
                adults: $parameters['adults'],
                children: $parameters['children'],
            ));

            return new CheckAvailability(
                new \DateTimeImmutable($parameters['checkIn']),
                new \DateTimeImmutable($parameters['checkOut']),
                $occupancies,
                new Hotels($parameters['hotels']),
            );
        } catch (InvalidArgumentException $e) {
            throw new InvalidArgumentException($e->getMessage());
        }
    }
}
