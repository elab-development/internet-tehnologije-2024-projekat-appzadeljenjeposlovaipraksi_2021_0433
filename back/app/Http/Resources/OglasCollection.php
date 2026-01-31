<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class OglasCollection extends ResourceCollection
{
    public static $wrap = 'oglasi';

    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
