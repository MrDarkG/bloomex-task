<?php

namespace App\Http\Resources\Issues;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Log;


/**
 * @method currentPage()
 * @method items()
 * @method url(int $int)
 * @method firstItem()
 * @method lastPage()
 * @method lastItem()
 * @method links()
 * @method nextPageUrl()
 * @method path()
 * @method perPage()
 * @method previousPageUrl()
 * @method total()
 */
class IssuesPaginatedResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        Log::info("",[$this->links()]);
        return [
            'current_page' => $this->currentPage(),
            'data' => IssueResource::collection($this->items()),
            'first_page_url' => $this->url(1),
            'from' => $this->firstItem(),
            'last_page' => $this->lastPage(),
            'last_page_url' => $this->url($this->lastPage()),
            'links' => $this->links(),
            'next_page_url' => $this->nextPageUrl(),
            'path' => $this->path(),
            'per_page' => $this->perPage(),
            'prev_page_url' => $this->previousPageUrl(),
            'to' => $this->lastItem(),
            'total' => $this->total(),
        ];
    }

}
