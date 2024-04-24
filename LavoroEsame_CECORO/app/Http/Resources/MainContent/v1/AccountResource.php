<?php

namespace App\Http\Resources\MainContent\v1;

use Illuminate\Http\Resources\Json\JsonResource;

class AccountResource extends JsonResource
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
            "cognome" => $this->cognome,
            "sesso" => $this->sesso,
            "codiceFiscale" => $this->codiceFiscale,
            "partitaIva" => $this->partitaIva,
            "cittadinanza" => $this->cittadinanza,
            "cittaNascita" => $this->cittaNascita,
            "provinciaNascita" => $this->provinciaNascita,
            "dataNascita" => $this->dataNascita,
            "email" => $this->email,
            "password" => $this->password
        ];
    }
}
