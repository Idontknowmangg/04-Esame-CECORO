<?php

namespace App\Http\Resources\MainContent\v1;

use Illuminate\Http\Resources\Json\JsonResource;

class DocResource extends JsonResource
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
            "titoloDocumentario" => $this->titoloDocumentario,
            "idGenere" => $this->idGenere,
            "idImmagineDocumentario" => $this->idImmagineDocumentario,
            "idFormatoDocumentario" => $this->idFormatoDocumentario,
            "descrizione" => $this->descrizione,
            "regista" => $this->regista,
            "anno" => $this->anno,
            "durata" => $this->durata,
        ];
    }
}
