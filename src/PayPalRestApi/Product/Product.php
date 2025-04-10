<?php

namespace PayPalRestApi\Product;

use PayPalRestApi\Core\PayPalClient;
use PayPalRestApi\Product\Response\ProductResponse;

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

        // detailed output
        $this->client->preferRepresentation();
        $response = $this->client->request('GET', $uri);

        // Map each plan array into a ProductResponse object
        $products = array_map(
            fn(array $product) => new ProductResponse($product),
            $response['products'] ?? []
        );

        return $products;

    }

    public function create(string $name, string $description = '', string $type = self::TYPE_SERVICE): ProductResponse
    {
        $response =  $this->client->request('POST', '/v1/catalogs/products', [
            'name' => $name,
            'description' => $description,
            'type' => $type
        ]);

        return new ProductResponse($response);
    }

    public function get(string $productId): ProductResponse
    {
        $response = $this->client->request('GET', "/v1/catalogs/products/{$productId}");

        return new ProductResponse($response);
    }
}
