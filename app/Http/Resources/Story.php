<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Story extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->serial,
            'title' => $this->title,
            'content' => $this->content,
            'summary' => $this->summary,
            'story_number' => $this->order,
            'status' => $this->status,
            'updated_at' => $this->updated_at->timestamp,
            'created_at' => $this->created_at->timestamp,
        ];
    }
}
