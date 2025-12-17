<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PrijavaResource extends JsonResource
{
    public static $wrap = 'prijava';

    public function toArray($request)
    {
        return [
            'id' => $this->resource->id,
            'user' => $this->resource->user,
            'oglas' => $this->resource->oglas,
            'motivaciono_pismo' => $this->resource->motivaciono_pismo,
            'status' => $this->resource->status,
            'datum_prijave' => $this->resource->datum_prijave,
            'user_info' => new UserResource($this->whenLoaded('userkey')),
            'oglas_info' => new OglasResource($this->whenLoaded('oglaskey')),
            'created_at' => $this->resource->created_at,
            'updated_at' => $this->resource->updated_at,
        ];
    }
}
