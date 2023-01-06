<?php

declare(strict_types=1);

namespace App\Infrastructure\HttpClient;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\RequestOptions;
use Psr\Http\Message\ResponseInterface;

abstract class GuzzleHttpClient
{
    private array $headers;

    public function __construct(private readonly string $baseUrl, private readonly Client $client)
    {
        $this->headers = [];
    }

    protected function setHeaders(array $params): self
    {
        $this->headers = $params;

        return $this;
    }

    public function get(string $url, array $data = [], array $headers = []): ResponseInterface
    {
        return $this->request('GET', 'query', $url, $data, $headers);
    }

    public function postJson(string $url, array $data = [], array $headers = []): ResponseInterface
    {
        return $this->request('POST', RequestOptions::JSON, $url, [
            'json' => $data,
        ]);
    }

    private function request(string $method, string $optionKey, string $url, array $data = [], array $headers = []): ResponseInterface
    {
        try {
            $response = $this->client->request($method, $this->baseUrl.$url, [$optionKey => $data, 'headers' => \array_merge($this->headers, $headers)]);
        } catch (ClientException|ServerException $error) {
            $response = $error->getResponse();
        }

        return $response;
    }
}
