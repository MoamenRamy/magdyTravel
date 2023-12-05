<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Destination as DestinationResource;


class Ride extends JsonResource
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
            'from' => $this->from,
            'to' => $this->to,
            'dateTime' => $this->dateTime,
            'guest' => $this->guest,
            'phone' => $this->phoneNumber,
            'note' => $this->note,
            'cost' => $this->price,
            'code' => $this->code,
            'at' => $this->created_at->diffForHumans(),
            'destination' => new DestinationResource($this->destination),
        ];
    }
}
