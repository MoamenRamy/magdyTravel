<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class Travel extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'slug' => $this->slug,
            'name' => $this->name,
            'description' => $this->description,
            'plan' => $this->plan,
            'address' => $this->address,
            'cost' => $this->price,
            'dateTime' => $this->dateTime,
            'booked' => $this->bookedCount,
            'period' => $this->period,
            'imageUrls' => Photo::collection($this->photos),
            'category' => new Category($this->category),
        ];
    }
}
