<?php

namespace PayPalRestApi\Core;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class PayPalClient
{
    protected string $clientId;
    protected string $clientSecret;
    protected string $baseUrl;
    protected string $accessToken;
    protected Client $http;

    public function __construct(string $clientId, string $clientSecret, bool $sandbox)
    {
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
        $this->baseUrl = $sandbox 
            ? 'https://api-m.sandbox.paypal.com' 
            : 'https://api-m.paypal.com';

        $this->http = new Client(['base_uri' => $this->baseUrl]);
        $this->authenticate();
    }

    private function authenticate(): void
    {
        $response = $this->http->post('/v1/oauth2/token', [
            'auth' => [$this->clientId, $this->clientSecret],
            'form_params' => ['grant_type' => 'client_credentials'],
        ]);

        $data = json_decode($response->getBody(), true);
        $this->accessToken = $data['access_token'];
    }

    public function request(string $method, string $uri, array $body = null): array
    {
        $options = [
            'headers' => [
                'Authorization' => "Bearer {$this->accessToken}",
                'Content-Type' => 'application/json',
            ]
        ];

        if ($body !== null) {
            $options['body'] = json_encode($body);
        }

        try {
            $response = $this->http->request($method, $uri, $options);
            $decoded = json_decode((string) $response->getBody(), true); // Always return as array
            return $decoded ?? []; // fallback to empty array if decode fails
        } catch (RequestException $e) {
            // Log error or handle specific cases (e.g., retry on 500, etc.)
            $responseBody = $e->getResponse() ? $e->getResponse()->getBody()->getContents() : null;
            $responseCode = $e->getResponse() ? $e->getResponse()->getStatusCode() : null;

            // Throw a custom ApiException with relevant details
            throw new ApiException(
                "API request failed: " . $e->getMessage(),
                $e->getCode(),
                $e,
                $responseBody,
                $responseCode
            );
        }
    }
}
