<?php

namespace Yazan\MpsLibrary;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;
use Yazan\MpsLibrary\DTO\PaymentRequest;

class MpsPayment {

    protected string $baseUrl;
    protected string $clientId;
    protected string $clientSecret;
    protected ?string $accessToken = null;
    protected Client $http;

    public function __construct(?string $baseUrl = null, ?string $clientId = null, ?string $clientSecret = null)
    {
        $this->baseUrl =  $baseUrl ?? getenv('PAYMENT_BASE_URL');
        $this->clientId = $clientId ?? getenv('PAYMENT_CLIENT_ID');
        $this->clientSecret = $clientSecret ?? getenv('PAYMENT_CLIENT_SECRET');
        $this->http = new Client(['base_uri' => $this->baseUrl]);
    }

    /**
     * @throws GuzzleException
     */
    public function authenticate(): bool
    {
        try {
            $response = $this->http->post('/api/auth/token', [
                'form_params' => [
                    'client_id' => $this->clientId,
                    'client_secret' => $this->clientSecret,
                    'grant_type' => 'client_credentials',
                ],
            ]);

            $data = json_decode($response->getBody()->getContents(), true);
            $this->accessToken = $data['access_token'] ?? null;

            return isset($this->accessToken);
        } catch (RequestException $e) {
            // Log error or handle exception
            return false;
        }
    }

    /**
     * @throws GuzzleException
     * @throws Exception
     */
    public function createPayment(PaymentRequest  $payload): array
    {
        if (!$this->accessToken) {
            throw new Exception('You must authenticate first');
        }

        $response = $this->http->post('/api/payment/create', [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->accessToken,
                'Accept' => 'application/json',
            ],
            'json' => $payload->toArray(),
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }

}