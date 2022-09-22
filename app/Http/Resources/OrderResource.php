<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{

    public function toArray($request)
    {
      //  return parent::toArray($request);
        return [
            'date'=> $this->date,
            'total_price'=>$this->total_price,
            'supplier_name'=>$this->supplier_name,
            'paid'=>$this->paid,
            'remaining'=>$this->remaining,
        ];
    }
}
