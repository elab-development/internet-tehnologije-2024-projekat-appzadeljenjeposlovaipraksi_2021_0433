<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class PrijavaCollection extends ResourceCollection
{
    public static $wrap = 'prijave';

    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
