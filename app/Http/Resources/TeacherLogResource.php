<?php

namespace App\Http\Resources;

use App\Models\Teachers;
use Illuminate\Http\Resources\Json\JsonResource;

class TeacherLogResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'name23' => $this->fullName. "Hello",
            'status' => $this->status,
        ];
    }
}
