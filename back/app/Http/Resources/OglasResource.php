<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OglasResource extends JsonResource
{
    public static $wrap = 'oglas';

    public function toArray($request)
    {
        return [
            'id' => $this->resource->id,
            'naslov' => $this->resource->naslov,
            'opis' => $this->resource->opis,
            'lokacija' => $this->resource->lokacija,
            'tip_posla' => $this->resource->tip_posla,
            'plata' => $this->resource->plata,
            'zahtevi' => $this->resource->zahtevi,
            'kompanija' => $this->resource->kompanija,
            'kompanija_info' => new KompanijaResource($this->whenLoaded('kompanijakey')),
            'created_at' => $this->resource->created_at,
            'updated_at' => $this->resource->updated_at,
        ];
    }
}
