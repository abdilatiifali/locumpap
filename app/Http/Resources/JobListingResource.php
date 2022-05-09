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
            'description' => $this->description,
            'rate_per_hour' => $this->rate_per_hour,
            'profession' => $this->whenLoaded('profession'),
            'type' => $this->type(),
            'county' => $this->whenLoaded('county'),
            'department' => $this->whenLoaded('department'),
            'bgColorClass' => 'bg-red-600',
            'organization' => $this->whenLoaded('organization'),
            'users' => $this->whenLoaded('users')->map(function ($user) {
                return [
                    'id' => $user->id,
                    'name' => $user->name,
                    'avatar' => $user->profilePhotoUrl
                ];
            }),
            'totalApplicants' => 0,
        ];
    }
}
