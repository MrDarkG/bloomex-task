<?php

namespace App\Services;

use App\Models\Issue;
use App\Services\IssueService\IssueService;
use App\Services\PriorityService\PriorityService;
use App\Services\ProjectService\ProjectService;
use App\Services\RedmineService\RedmineService;
use App\Services\Statuses\StatusesService;

class CrossRoadService
{
    public function getIssues(): RedmineService|IssueService
    {
        if (config('services.redmine.enabled')) {
            return new RedmineService('issues');
        } else {
            return new IssueService();
        }
    }

    public function getProjects(): RedmineService|ProjectService
    {
        if (config('services.redmine.enabled')) {
            return new RedmineService('projects');
        } else {
            return new ProjectService();
        }
    }

    public function getPriorities(): RedmineService|PriorityService
    {
        if (config('services.redmine.enabled')) {
            return new RedmineService('/enumerations/issue_priorities');
        } else {
            return new PriorityService();
        }
    }

    public function getStatuses(): RedmineService|StatusesService
    {
        if (config('services.redmine.enabled')) {
            return new RedmineService('/issue_statuses');
        } else {
            return new StatusesService();
        }
    }
}
