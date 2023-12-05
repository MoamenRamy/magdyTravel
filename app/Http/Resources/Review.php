<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Travel as TravelResource;
use App\Http\Resources\User as UserResource;

class Review extends JsonResource
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
            'review' => $this->review,
            'service' => $this->service_rating,
            'amenities' => $this->amenities_rating,
            'location' => $this->location_rating,
            'price' => $this->price_rating,
            'average' => $this->avgRating(),
            'travel' => new TravelResource($this->travel),
            'user' => new UserResource($this->user),
        ];
    }
}
