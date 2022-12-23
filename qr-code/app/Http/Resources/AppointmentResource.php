<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class AppointmentResource extends JsonResource
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
            'id' => $this->id,
            'user_name' => $this->user->name,
            'day' => $this->day,
            'price' => $this->extra_price != null ? $this->villa->price + $this->extra_price : $this->villa->price,
            'villa_name' => $this->villa->name,
            'start' => date('Y-m-d\Th:m:s',  strtotime($this->start_date)),
            'end' => date('Y-m-d\Th:m:s',  strtotime($this->end_date)),
            'backgroundColor' => $this->backgroundColor,
            'start_show' =>  (new Carbon($this->start_show))->format('Y-m-d'),
            'created' =>  $this->created_at->format('d M') .' ' . $this->created_at->format('Y'),
        ];
    }
}
