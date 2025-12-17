<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class KompanijaResource extends JsonResource
{
    public static $wrap = 'kompanija';

    public function toArray($request)
    {
        return [
            'id' => $this->resource->id,
            'naziv' => $this->resource->naziv,
            'opis' => $this->resource->opis,
            'adresa' => $this->resource->adresa,
            'grad' => $this->resource->grad,
            'email' => $this->resource->email,
            'telefon' => $this->resource->telefon,
            'website' => $this->resource->website,
            'logo' => $this->resource->logo,
            'created_at' => $this->resource->created_at,
            'updated_at' => $this->resource->updated_at,
        ];
    }
}
