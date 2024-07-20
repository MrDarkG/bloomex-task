<?php

namespace App\Http\Controllers\Statuses;

use App\Http\Controllers\Controller;
use App\Services\CrossRoadService;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class StatusesController extends Controller
{
    use ResponseTrait;

    public function __construct(
        protected CrossRoadService $crossRoadService
    ) {
    }

    public function index(): JsonResponse
    {
        return $this->successResponse($this->crossRoadService->getStatuses()->get());
    }
}
