<?php

namespace App\Services\RedmineService;

use App\Exceptions\RedmineException;
use App\Http\Resources\Redmine\RedmineResource;
use Illuminate\Http\Resources\Json\JsonResource;

class RedmineService extends GuzzleService
{
    protected string $endpoint = '';
    protected RedmineResource $redmineResource;
    public function __construct(
        string $endpoint,
    )
    {
        parent::__construct();
        $this->endpoint = $endpoint;
        $this->redmineResource = new RedmineResource($endpoint, []);
    }

    /**
     * @throws RedmineException
     */
    public function get(string $query = ""): array|JsonResource
    {
        $response = $this->apiCall(
            'GET',
            sprintf('%s.json%s', $this->endpoint, $query),
            []
        );
        $responseCollection = collect($response)->first();
        return $this->redmineResource->collection($responseCollection)??[];
    }

    /**
     * @throws RedmineException
     */
    public function create($data): array|JsonResource
    {
        $response = $this->apiCall(
            'POST',
            sprintf('/%s.json', $this->endpoint),
            $data
        );

        $responseCollection = collect($response)->first();
        return $this->redmineResource->single($responseCollection)??[];
    }

    /**
     * @throws RedmineException
     */
    public function update($id, $data): ?array
    {
        return $this->apiCall(
            'PUT',
            sprintf('/%s/%d.json', $this->endpoint, $id),
            $data
        );
    }

    /**
     * @throws RedmineException
     */
    public function delete($id): ?array
    {
        return $this->apiCall(
            'DELETE',
            sprintf('/%s/%d.json', $this->endpoint, $id),
            []
        );
    }

    /**
     * @throws RedmineException
     */
    public function show($id)
    {
        $response = $this->apiCall('GET',
            sprintf('/%s/%d.json', $this->endpoint, $id),
            []
        );
        $responseCollection = collect($response)->first();
        return $this->redmineResource->single($responseCollection)??[];
    }
}
