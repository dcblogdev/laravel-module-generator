<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class {Module}Resource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'         => (string) $this->uuid,
            'name'       => $this->name,
            'added_by'   => $this->addedBy->name,
            'created_at' => $this->created_at->format('d-m-Y H:i:s'),
            'updated_at' => $this->updated_at->format('d-m-Y H:i:s')
        ];
    }
}
