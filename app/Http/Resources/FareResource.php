<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FareResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request): array
    {
        $statusMap = [
          0 => 'Unactive',
          1 => 'Active'
        ];

        return [
            'id' => $this->id,
            'operatorId' => $this->operator_id,
            'status' => $statusMap[$this->status],
            'value' => (float) $this->value
        ];
    }
}
