<?php

namespace App\Http\Resources\MainContent\v1;

use Illuminate\Http\Resources\Json\JsonResource;

class SerieTVResource extends JsonResource
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
            "titoloSerieTV" => $this->titoloSerieTV,
            "idGenere" => $this->idGenere,
            "idImmagineSerieTV" => $this->idImmagineSerieTV,
            "descrizione" => $this->descrizione,
            "regista" => $this->regista,
            "totStagioni" => $this->totStagioni,
            "totEp" => $this->totEp,
            "anno" => $this->anno,
        ];
    }
}
