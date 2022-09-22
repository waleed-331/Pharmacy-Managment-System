<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DrugNewResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
      //  return parent::toArray($request);
        return [
            'id'=>$this->id,
            'name'=>$this->name,
            'expiration_date'=>$this->expiration_date,
            'price'=>$this->price,
            'quantity'=>$this->quantity,
            'dose'=>$this->dose,
            'form'=>$this->form,
            'body_system'=>$this->body_system,
            'price_for_public'=>$this->price_for_public,
            'scientific_name'=>$this->scientific_name,
            'prescription'=>$this->prescription,
            'place'=>$this->place,
            'company'=>$this->company,
        ];
    }
}
