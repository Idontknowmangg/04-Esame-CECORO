<?php

namespace App\Http\Resources\ImpostazioniSito;

use Illuminate\Http\Resources\Json\JsonResource;

class AttoriResource extends JsonResource
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
            "nomeAttore" => $this->nomeAttore,
            "cognomeAttore" => $this->cognomeAttore,
            "annoNascita" => $this->annoNascita
        ];
    }
}
