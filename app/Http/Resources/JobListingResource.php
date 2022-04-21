<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\UserResource;

class JobListingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'postedAt' => $this->created_at->diffForHumans(),
            'totalApplicants' => $this->totalApplicants,
            'applicants' => UserResource::collection($this->users),
            'bgColorClass' => 'bg-red-600',
            'organization' => $this->organization->name,
        ];
    }
}
