<?php

declare(strict_types=1);

namespace App\Application\Query;

final class AuditData
{
    public function __construct(
        public readonly int $processTime,
        public readonly string $timestamp,
        public readonly string $requestHost,
        public readonly string $serverId,
        public readonly string $environment,
        public readonly string $release,
        public readonly string $token,
        public readonly string $internal,
    ) {
    }

    public static function fromArray(array $response): self
    {
        return new self(
            (int) $response['processTime'],
            $response['timestamp'],
            $response['requestHost'],
            $response['serverId'],
            $response['environment'],
            $response['release'],
            $response['token'],
            $response['internal'],
        );
    }
}
