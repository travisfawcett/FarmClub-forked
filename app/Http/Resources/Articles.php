<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Articles extends JsonResource
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
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'total_in_shelf' => $this->total_in_shelf,
            'total_in_vault' => $this->total_in_vault,
            'store_id' => $this->store_id
        ];
    }
}
