<?php

namespace App\Http\Resources\Monitoring\Project;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectProgressListResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        if ($request->route()->getName() === 'api.projectProgressPage') {
            return [
                'id' => $this->id,
                'title' => $this->title,
                'developer_name' => $this->developer_name,
                'developer_phone' => $this->developer_phone,
                'address' => $this->address,
                'status' => $this->status,
                'price' => $this->price,
                'picture_file' => $this->picture_file,
                'start_date' => $this->start_date,
                'end_date' => $this->end_date,
                'progressPercentage' => optional($this->progresses()->latest()->first())->percentage,
            ];
        } elseif ($request->route()->getName() === 'api.projectProgressIndex') {
            return [
                'id' => $this->id,
                'title' => $this->title,
                'buyer_name' => $this->buyer_name,
                'buyer_phone' => $this->buyer_phone,
                'address' => $this->address,
                'status' => $this->status,
                'price' => $this->price,
                'picture_file' => $this->picture_file,
                'start_date' => $this->start_date,
                'end_date' => $this->end_date,
                'progressPercentage' => optional($this->progresses()->latest()->first())->percentage,
            ];
        } elseif ($request->route()->getName() === 'api.editProjectProgress') {
            return [
                'id' => $this->id,
                'title' => $this->title,
                'buyer_name' => $this->buyer_name,
                'buyer_phone' => $this->buyer_phone,
                'address' => $this->address,
                'province' => $this->province,
                'city' => $this->city,
                'district' => $this->district,
                'status' => $this->status,
                'price' => $this->price,
                'picture_file' => $this->picture_file,
                'start_date' => $this->start_date,
                'end_date' => $this->end_date,
            ];
        }

        return parent::toArray($request);
    }
}
