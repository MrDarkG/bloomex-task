<?php

namespace App\Http\Requests\Issues;

use Illuminate\Foundation\Http\FormRequest;

/*
 * @property int $project_id
 * @property string $subject
 * @property read-only int $priority_id
 */
class CreateIssueRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'project_id' => 'required|integer',
            'subject' => 'required|string',
            'priority_id' => 'required|integer',
            'status_id' => 'required|integer',
        ];
    }

    public function getProjectId(): int
    {
        return $this->get('project_id');
    }

    public function getSubject(): string
    {
        return $this->get('subject');
    }

    public function getPriorityId(): int
    {
        return $this->get('priority_id');
    }

    public function getStatusId(): int
    {
        return $this->get('status_id');
    }

    public function getIssueData(): array
    {
        return [
            'issue' => [
                'project_id' => $this->getProjectId(),
                'subject' => $this->getSubject(),
                'priority_id' => $this->getPriorityId(),
                'status_id' => $this->getStatusId(),
            ]
        ];
    }
}
