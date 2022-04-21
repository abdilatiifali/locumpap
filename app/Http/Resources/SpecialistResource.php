<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SpecialistResource extends JsonResource
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
            'photo' => asset($this->profile_photo),
            'name' => $this->name,
            'email' => $this->email,
            'phoneNumber' => $this->number,
            'address' => $this->address,
            'about' => $this->about,
            'attachments' => [
                ['name' => $this->cv, 'href' => asset($this->cv)],
                ['name' => $this->degree, 'href' => asset($this->degree)],
                ['name' => $this->master, 'href' => asset($this->master)],
                ['name' => $this->licence_number, 'href' => asset($this->licence_number)]
            ]
        ];
    }
}
