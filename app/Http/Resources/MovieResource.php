<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MovieResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'release_date' => $this->release_date->format('Y-m-d'),
            'duration' => $this->duration, // ใช้ถ้ามี
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
        ];
    }
}
