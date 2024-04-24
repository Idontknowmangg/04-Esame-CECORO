<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

class FilmHasGenereResource extends JsonResource
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
            "idFilm" => $this->idFilm,
            "idGenere" => $this->idGenere
        ];
    }
}
