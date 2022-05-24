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
            'attachments' => $this->attachments($this->cv, $this->recommendation_letter),
        ];
    }

    public function attachments($cv, $recommendation_letter)
    {
        $attachments = collect([]);

        is_null($cv) ? null : $attachments->push(['name' => 'cv', 'href' => '/download/' . basename($cv)]);

        is_null($recommendation_letter) 
            ? null 
            : $attachments->push(['name' => 'recommendation letter', 'href' => '/download/' . basename($recommendation_letter)]);


        return $attachments;
    }

}
