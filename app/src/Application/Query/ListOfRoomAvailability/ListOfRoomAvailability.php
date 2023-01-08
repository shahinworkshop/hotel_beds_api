<?php

declare(strict_types=1);

namespace App\Application\Query\ListOfRoomAvailability;

use App\Application\Query\AuditData;
use App\Application\Query\Hotels;

final class ListOfRoomAvailability
{
    public function __construct(
        public readonly AuditData $auditData,
        public readonly Hotels $hotels,
    ) {
    }

    public static function from(array $response): self
    {
        if(!isset($response['auditData'], $response['hotels'])) {
            throw new \InvalidArgumentException('Invalid response');
        }

        return new self(
            AuditData::fromArray($response['auditData']),
            Hotels::fromArray($response['hotels']),
        );
    }
}
