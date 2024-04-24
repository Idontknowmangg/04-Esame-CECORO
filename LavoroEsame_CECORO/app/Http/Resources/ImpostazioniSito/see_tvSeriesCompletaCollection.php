<?php

namespace App\Http\Resources\ImpostazioniSito;

use Illuminate\Http\Resources\Json\ResourceCollection;

class see_tvSeriesCompletaCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
