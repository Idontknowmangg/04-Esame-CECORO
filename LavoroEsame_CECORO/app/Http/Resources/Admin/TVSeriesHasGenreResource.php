<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

class TVSeriesHasGenreResource extends JsonResource
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
            "idSerieTV" => $this->idSerieTV,
            "idGenere" => $this->idGenere
        ];
    }
}
