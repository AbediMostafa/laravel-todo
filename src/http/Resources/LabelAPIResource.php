<?php

namespace AbediMostafa\ToDo\http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LabelAPIResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'label'=>$this->label,
            'tasks'=>$this->tasks
        ];
    }
}
