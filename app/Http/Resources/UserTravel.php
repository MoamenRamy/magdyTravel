<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserTravel extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'bookDate' => $this->bookDate,
            'Address' => $this->userAddress,
            'phoneNumber' => $this->phone,
            'cost' => $this->price,
            'code' => $this->code,
            'at' => $this->created_at->diffForHumans(),
            'travel' => new Travel($this->travel),
        ];
    }
}
