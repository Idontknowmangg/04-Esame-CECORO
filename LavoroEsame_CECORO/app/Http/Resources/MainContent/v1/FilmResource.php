<?php

namespace App\Http\Resources\MainContent\v1;

use Illuminate\Http\Resources\Json\JsonResource;

class FilmResource extends JsonResource
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
            "titoloFilm" => $this->titoloFilm,
            "idGenere" => $this->idGenere,
            "idImmagineFilm" => $this->idImmagineFilm,
            "idFormatoFilm" => $this->idFormatoFilm,
            "descrizione" => $this->descrizione,
            "regista" => $this->regista,
            "anno" => $this->anno,
            "durata" => $this->durata,
        ];
    }
}
