<?php

namespace App\Http\Resources\ImpostazioniSito;

use Illuminate\Http\Resources\Json\JsonResource;

class NazioniResource extends JsonResource
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
            "nome" => $this->nome,
            "continente" => $this->continente,
            "iso" => $this->iso,
            "iso3" => $this->iso3,
            "prefissoTelefonico" => $this->prefissoTelefonico,
        ];
    }
}
