<?php

namespace App\Http\Resources\ImpostazioniSito;

use Illuminate\Http\Resources\Json\JsonResource;

class see_DocCompletaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
