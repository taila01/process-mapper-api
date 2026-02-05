<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProcessResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'          => $this->id,
            'name'        => (string) $this->name,
            'description' => (string) $this->description,
            'sectorId'    => $this->sector_id,
            'parentId'    => $this->parent_id,
            'type'        => $this->type,
            'status'      => $this->status,

            'details'  => new ProcessDetailsResource($this->whenLoaded('details')),
            'sector'   => new SectorResource($this->whenLoaded('sector')),
            'children' => ProcessResource::collection($this->whenLoaded('children')),

            'createdAt' => $this->created_at?->toDateTimeString(),
            'updatedAt' => $this->updated_at?->toDateTimeString(),
        ];
    }
}
