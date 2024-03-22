<?php

namespace App\Http\Resources\Monitoring\Project\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DetailProgressResource extends JsonResource
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
            'brief_description' => $this->brief_description,
            'detail_description' => $this->detail_description,
            'pictures' => $this->progressPictures->map(function ($picture) {
                return [
                    'id' => $picture->id,
                    'picture_file' => 'storage/monitoring/'.$picture->picture_file,
                ];
            }),
        ];
    }
}
