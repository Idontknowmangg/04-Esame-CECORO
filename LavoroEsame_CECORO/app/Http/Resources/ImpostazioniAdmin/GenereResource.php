<?php

namespace App\Http\Resources\ImpostazioniAdmin;

use Illuminate\Http\Resources\Json\JsonResource;

class GenereResource extends JsonResource
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
            "idGenere" => $this->idGenere,
            "nomeGenere" => $this->nomeGenere
        ];
    }
}
