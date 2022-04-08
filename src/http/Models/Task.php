<?php

namespace AbediMostafa\ToDo\http\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\Relations\BelongsToMany;
use \Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    /**
     * Get the labels of the task
     */
    public function labels():BelongsToMany
    {
        return $this->belongsToMany(Label::class);
    }

    /**
     * Get the user that owns the task
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
