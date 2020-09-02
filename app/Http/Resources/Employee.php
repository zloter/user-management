<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Employee extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'address_voivodeship' => $this->address_voivodeship,
            'address_city' => $this->address_city,
            'address_postal_code' => $this->address_postal_code,
            'address_street' => $this->address_street,
            'address_number' => $this->address_number,
            'correspondence_voivodeship' => $this->correspondence_voivodeship,
            'correspondence_city' => $this->correspondence_city,
            'correspondence_postal_code' => $this->correspondence_postal_code,
            'correspondence_street' => $this->correspondence_street,
            'correspondence_number' => $this->correspondence_number
        ];
    }
}
