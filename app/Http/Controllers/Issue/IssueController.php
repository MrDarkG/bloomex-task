<?php

namespace App\Http\Controllers\Issue;

use App\Exceptions\RedmineException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Issues\CreateIssueRequest;
use App\Http\Requests\Issues\UpdateIssueRequest;
use App\Services\CrossRoadService;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class IssueController extends Controller
{
    use ResponseTrait;
    public function __construct(
        protected CrossRoadService $crossRoadService
    ) {
    }

    /**
     * @throws RedmineException
     */
    public function index(): JsonResponse
    {
        $query = "?";
        foreach (request()->query() as $key => $value) {
            $query .= $key . "=" . $value . "&";
        }
        return $this->successResponse($this->crossRoadService->getIssues()->get($query));
    }

    public function store(CreateIssueRequest $request): JsonResponse
    {
        try {
            $storeData = $this->crossRoadService->getIssues()->create(
                $request->getIssueData()
            );
        } catch (RedmineException $e) {
            return $this->errorResponse($e->getMessage());
        }
        return $this->successResponse($storeData);
    }

    public function update(UpdateIssueRequest $request): JsonResponse
    {
        try {
            $updateData = $this->crossRoadService->getIssues()->update(
                $request->getId(),
                $request->getIssueData()
            );
        } catch (RedmineException $e) {
            return $this->errorResponse($e->getMessage());
        }
        return $this->successResponse($updateData);
    }

    public function destroy(int $id): JsonResponse
    {
        try {
            $this->crossRoadService->getIssues()->delete($id);
        } catch (RedmineException $e) {
            return $this->errorResponse($e->getMessage());
        }
        return $this->successResponse('Issue deleted successfully');
    }

    public function show(int $id): JsonResponse
    {
        try {
            $showData = $this->crossRoadService->getIssues()->show($id);
        } catch (RedmineException $e) {
            return $this->errorResponse($e->getMessage());
        }
        return $this->successResponse($showData);
    }
}
