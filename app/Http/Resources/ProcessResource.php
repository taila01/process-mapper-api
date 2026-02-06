<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProcessResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'sector_id' => $this->sector_id,
            'parent_id' => $this->parent_id,
            'name' => $this->name,
            'description' => $this->description,
            'type' => $this->type,
            'status' => $this->status,
            'sector' => new SectorResource($this->whenLoaded('sector')),
            'details' => new ProcessResource($this->whenLoaded('details')),
            'children' => ProcessResource::collection($this->whenLoaded('children')),
        ];
    }
}