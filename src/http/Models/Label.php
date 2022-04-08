<?php

namespace Abedimostafa\ToDo\http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany ;

class Label extends Model
{
    /**
     * Get the tasks of the label
     */
    public function tasks():BelongsToMany
    {
        return $this->belongsToMany(Task::class);
    }
}
