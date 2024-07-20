<?php

namespace App\Services\IssueService;

use App\Http\Resources\Issues\IssueResource;
use App\Http\Resources\Issues\IssuesPaginatedResource;
use App\Models\Issue;
use Illuminate\Support\Facades\Log;

class IssueService
{
    public function parsePaginationFromQuery(string $query): int
    {
        $pagination = 10;
        $query = explode('&', $query);
        foreach ($query as $item) {
            $item = explode('=', $item);
            if (str_ends_with($item[0],'per_page')) {
                $pagination = $item[1];
            }
        }

        return $pagination;
    }
    public function get(string $query): IssuesPaginatedResource
    {
        $pagination = $this->parsePaginationFromQuery($query);

        $issues = Issue::filtered()->paginate($pagination);


        return new IssuesPaginatedResource($issues);
    }

    public function create(array $data): IssueResource
    {

        $issue = new Issue();
        $issue->setSubject($data['issue']['subject']);
        $issue->setProjectId($data['issue']['project_id']);
        $issue->setPriorityId($data['issue']['priority_id']);
        $issue->setStatusId($data['issue']['status_id']);
        $issue->save();

        return new IssueResource($issue);
    }

    public function update(int $id, array $data): IssueResource
    {
        $issue = Issue::find($id);

        $issue->subject = $data['issue']['subject']??$issue->subject;
        $issue->project_id = $data['issue']['project_id']??$issue->project_id;
        $issue->priority_id = $data['issue']['priority_id']??$issue->priority_id;
        $issue->status_id = $data['issue']['status_id']??$issue->status_id;

        $issue->save();

        return new IssueResource($issue);
    }

    public function delete(int $id): void
    {
        $issue = Issue::find($id);
        $issue->delete();
    }

    public function show(int $id): IssueResource
    {
        $issue = Issue::findOrFail($id);
        return new IssueResource($issue);
    }
}
