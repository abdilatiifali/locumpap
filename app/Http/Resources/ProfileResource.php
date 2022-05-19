<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
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
            'gender' =>   $this->gender,
            'about' =>    $this->about,
            'qualification' => $this->qualification,
            'level' => $this->experience,
            'nationalId' =>   $this->nationalId,
            'cv' => $this->cv,
            'recommendation_letter' => $this->recommendation_letter,
            'availability' => $this->from . ' to ' . $this->to,
            'phoneNumber' => $this->mobile_number,
            'registrationNumber' => $this->professional_registration_number,
            'attachments' => $this->cv ? [
                [ 
                    'name' => 'cv', 
                    'href' => '/download/' . basename($this->cv),
                ],
                [
                    'name' => 'recommendation_letter', 
                    'href' => '/download/' . basename($this->recommendation_letter)
                ],
            ] : null
        ];
    }

    public function assetUrl($path)
    {
        if (is_null($path)) return null;

        [$folder, $file] = explode('/', $path);

        return asset(\Storage::url($file));
    }

}
