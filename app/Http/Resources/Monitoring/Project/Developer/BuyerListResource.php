<?php

namespace App\Http\Resources\Monitoring\Project\Developer;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BuyerListResource extends JsonResource
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
            'account_id' => $this->account_id,
            'name' => $this->userData->full_name,
            'phone' => $this->userData->phone,
            'city' => $this->userData->city,
        ];
    }
}
