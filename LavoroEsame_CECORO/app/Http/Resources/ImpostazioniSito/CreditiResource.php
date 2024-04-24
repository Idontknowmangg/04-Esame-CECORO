<?php

namespace App\Http\Resources\ImpostazioniSito;

use Illuminate\Http\Resources\Json\JsonResource;

class CreditiResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return $this->getCampi();
    }
    
    protected function getCampi()
    {
        return [
            "idContatto" => $this->idContatto,
            "crediti" => $this->crediti
        ];
    }
}
