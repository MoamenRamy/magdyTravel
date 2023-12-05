<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class Trip extends JsonResource
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
            'name' => $this->userName,
            'dateTime' => $this->dateTime,
            'phoneNumber' => $this->phone,
            'guest' => $this->guest,
            'cost' => $this->price,
            'code' => $this->code,
            'note' => $this->note,
            'at' => $this->created_at->diffForHumans(),
        ];
    }
}
