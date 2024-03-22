<?php

namespace App\Http\Resources\Monitoring\Project;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProgressPageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        if ($request->route()->getName() === 'api.progressPage') {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'developer_name' => $this->developer_name,
            'developer_phone' => $this->developer_phone,
            'address' => $this->address,
            'district' => $this->district,
            'city' => $this->city,
            'province' => $this->province,
            'status' => $this->status,
            'price' => $this->price,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'progresses' => $this->progresses->map(function ($progress) {
                return [
                    'id' => $progress->id,
                    'title' => $progress->brief_description,
                    'percentage' => $progress->percentage,
                ];
            }),
        ];
        } elseif ($request->route()->getName() === 'api.progressIndex') {
            return [
                'id' => $this->id,
                'title' => $this->title,
                'buyer_name' => $this->buyer_name,
                'buyer_phone' => $this->buyer_phone,
                'address' => $this->address,
                'district' => $this->district,
                'city' => $this->city,
                'province' => $this->province,
                'status' => $this->status,
                'price' => $this->price,
                'start_date' => $this->start_date,
                'end_date' => $this->end_date,
                'progresses' => $this->progresses->map(function ($progress) {
                    return [
                        'id' => $progress->id,
                        'title' => $progress->brief_description,
                        'percentage' => $progress->percentage,
                    ];
                }),
            ];
        }
        return parent::toArray($request);
    }
}