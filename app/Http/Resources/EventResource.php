<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
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
            'image' => $this->s3Url($this->image),
            'description' => $this->description,
            'title' => $this->title,
            'host' => $this->author,
            'slug' => $this->slug,
            'location' => $this->address,
            'date' => $this->published_at->format('D,M d, g:ia'),
            'month' => $this->published_at->format('M, d'),
            'time' => $this->published_at->format('g:ia'),
        ];
    }

    private function s3Url($file): string
    {
        $disk = \Storage::disk('s3');
        $disk->setVisibility($file, 'public');
        
        return $disk->url($file);
    }
}
