<?php

namespace App\Services\RedmineService;

use App\Exceptions\RedmineException;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class GuzzleService
{
    public Client $client;
    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => config('services.redmine.url'),
            'headers' => [
                'X-Redmine-API-Key' => config('services.redmine.key'),
                'Content-Type' => 'application/json',
            ],
        ]);
    }

    /**
     * @throws RedmineException
     */
    public function apiCall(
        string $method,
        string $url,
        array $data
    ): ?array
    {
        try {
            $response = $this->client->request($method, $url, [
                'json' => $data,
            ]);
            return json_decode($response->getBody()->getContents(), true);
        } catch(\Throwable $e) {
            Log::error($e->getMessage());
            throw new RedmineException($e->getMessage(), $e->getCode());
        }
    }
}
