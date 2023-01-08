<?php

declare(strict_types=1);

namespace App\Infrastructure\HttpClient;

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use Psr\Http\Message\ResponseInterface;

abstract class GuzzleHttpClient
{
    public function __construct(
        private readonly Client $client
    ) {
    }

    abstract protected function responseParser(int $code, string $message): void;

    public function get(string $url, array $data = [], array $headers = []): ResponseInterface
    {
        return $this->request('GET', 'query', $url, $data, $headers);
    }

    public function postJson(string $url, array $data = [], array $headers = []): ResponseInterface
    {
        return $this->request('POST', RequestOptions::JSON, $url, $data, $headers);
    }

    private function request(string $method, string $optionKey, string $url, array $data = [], array $headers = []): ResponseInterface
    {
        try {
            $response = $this->client->request($method, $url, [
                $optionKey => $data,
                'headers' => $headers,
            ]);
        } catch (\Exception $e) {
            $this->responseParser($e->getCode(), $e->getMessage());
        }

        return $response;
    }
}
