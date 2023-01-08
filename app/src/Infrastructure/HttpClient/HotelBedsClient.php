<?php

declare(strict_types=1);

namespace App\Infrastructure\HttpClient;

use App\Domain\Booking\Dto\Availability\CheckAvailability;
use GuzzleHttp\Client;
use Symfony\Component\HttpKernel\Exception\HttpException;

final class HotelBedsClient extends GuzzleHttpClient implements HotelBedsClientInterface
{
    public function __construct(
        string $baseUrl,
        string $apiKey,
        string $secret,
    ) {
        parent::__construct(new Client([
            'base_uri' => $baseUrl,
            'headers' => [
                'Api-key' => $apiKey,
                'X-Signature' => $this->generateSignature($apiKey, $secret),
                'Accept' => 'application/json',
                'Accept-Encoding' => 'gzip',
                'Content-Type' => 'application/json',
            ],
        ]));
    }

    public function getHotelsAvailability(CheckAvailability $checkAvailability): array
    {
        $response = $this->postJson('hotels', $checkAvailability->toArray());

        return \json_decode($response->getBody()->getContents(), true);
    }

    private function generateSignature(string $apiKey, string $secret): string
    {
        return \hash('sha256', $apiKey.$secret.\time());
    }

    protected function responseParser(int $code, string $message): void
    {
        throw new HttpException($code, $message);
    }
}
