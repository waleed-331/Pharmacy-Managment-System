<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DrugEditResource extends JsonResource
{

    public function toArray($request)
    {
//        return parent::toArray($request);

        return[

            'price'=>$this->price,
            'quantity'=>$this->quantity,
            'price_for_public'=>$this->price_for_public,
            'place'=>$this->place,
        ];
    }
}
