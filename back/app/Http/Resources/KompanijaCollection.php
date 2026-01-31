<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class KompanijaCollection extends ResourceCollection
{
    public static $wrap = 'kompanije';

    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
