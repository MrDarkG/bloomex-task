<?php

namespace App\Http\Controllers\Projects;

use App\Http\Controllers\Controller;
use App\Services\CrossRoadService;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    use ResponseTrait;

    public function __construct(
        protected CrossRoadService $crossRoadService
    ) {
    }

    public function index(): JsonResponse
    {
        return $this->successResponse($this->crossRoadService->getProjects()->get());
    }
}
