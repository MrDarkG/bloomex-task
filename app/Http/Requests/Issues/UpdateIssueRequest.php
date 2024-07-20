<?php

namespace App\Http\Requests\Issues;

use Illuminate\Foundation\Http\FormRequest;

class UpdateIssueRequest extends FormRequest
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
            'issue' => [
                'id' => 'required|integer',
                'subject' => 'string',
                'priority_id' => 'integer',
                'project_id' => 'integer',
                'status_id' => 'integer',
            ]
        ];
    }

    public function getSubject(): ?string
    {
        return $this->get('subject');
    }

    public function getPriorityId(): ?int
    {
        return $this->get('priority_id');
    }

    public function getProjectId(): ?int
    {
        return $this->get('project_id');
    }

    public function getId(): int
    {
        return $this->get('id');
    }

    public function getStatusId(): ?int
    {
        return $this->get('status_id');
    }

    public function getIssueData(): array
    {
        return [
            'issue' => [
                'id' => $this->getId(),
                'subject' => $this->getSubject(),
                'priority_id' => $this->getPriorityId(),
                'project_id' => $this->getProjectId(),
                'status_id' => $this->getStatusId(),
            ]
        ];
    }
}
