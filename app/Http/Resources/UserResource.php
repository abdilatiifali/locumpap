<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\ProfileResource;

class UserResource extends JsonResource
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
            'name' => $this->name,
            'email' => $this->email,
            'profession' => $this->profile->profession?->name,
            'specialist' => $this->profile->speciality?->name,
            'organizationId' => $this->organization_id,
            'avatar' => $this->profilePhotoUrl,
            'profile' => ProfileResource::make($this->whenLoaded('profile')),
        ];
    }

    // public function cv()
    // {
    //     [$folder, $file] = explode('/', auth()->user()->profile->cv);

    //     return asset(\Storage::url($file));
    // }
}
