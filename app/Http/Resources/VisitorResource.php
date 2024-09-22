<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VisitorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'visitor_id' => $this->visitor_id, 
            'visit_date' => $this->visit_date, 
            'ip_address' => $this->ip_address, 
            'city' => $this->city, 
            'country' => $this->country, 
            'region' => $this->region, 
            'timezone' => $this->timezone, 
            'latitude' => $this->latitude, 
            'longitude' => $this->longitude, 
            'created_at' => $this->created_at, 
            'updated_at' => $this->updated_at, 
        ];
    }
}
