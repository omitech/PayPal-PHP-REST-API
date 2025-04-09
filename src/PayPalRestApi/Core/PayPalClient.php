<?php

namespace PayPalRestApi\Core;

use GuzzleHttp\Client;

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
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            // Optionally log or rethrow with custom exception
            throw new \RuntimeException(
                'PayPal API Request failed: ' . $e->getMessage(),
                $e->getCode(),
                $e
            );
        }
    }
}
