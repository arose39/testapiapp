<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OneProductResource extends JsonResource
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
            'name' => $this->localizations->where('locale', app()->getLocale())->first()->name,
            'description' => $this->localizations->where('locale', app()->getLocale())->first()->description,
            'make_order_link' => route('makeOrder', ['productId' => $this->id]),
        ];
    }
}
