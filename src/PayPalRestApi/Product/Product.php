<?php

namespace PayPalRestApi\Product;

use PayPalRestApi\Core\PayPalClient;

class Product
{
    const TYPE_PHYSICAL  = 'PHYSICAL'; // Physical goods.
    const TYPE_DIGITAL	 = 'DIGITAL'; // For digital goods
    const TYPE_SERVICE	 = 'SERVICE'; // A service. 

    private PayPalClient $client;

    public function __construct(PayPalClient $client)
    {
        $this->client = $client;
    }

    public function list(array $params = []): array
    {
        $query = http_build_query($params);
        $uri = '/v1/catalogs/products' . ($query ? "?$query" : '');

        return $this->client->request('GET', $uri);
    }


    public function create(string $name, string $description = '', string $type = self::TYPE_SERVICE): array
    {
        return $this->client->request('POST', '/v1/catalogs/products', [
            'name' => $name,
            'description' => $description,
            'type' => $type
        ]);
    }

    public function get(string $productId): array
    {
        return $this->client->request('GET', "/v1/catalogs/products/{$productId}");
    }
}
