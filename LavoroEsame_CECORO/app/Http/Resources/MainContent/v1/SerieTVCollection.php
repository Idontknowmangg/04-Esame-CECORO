<?php

namespace App\Http\Resources\MainContent\v1;

use Illuminate\Http\Resources\Json\ResourceCollection;

class SerieTVCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return $this->collection;
    }
}
