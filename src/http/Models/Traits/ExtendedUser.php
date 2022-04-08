<?php

namespace Abedimostafa\ToDo\http\Models\Traits;

use Abedimostafa\ToDo\http\Models\Task;
use \Illuminate\Database\Eloquent\Relations\HasMany;

trait ExtendedUser
{
    /**
     * Get the tasks of the user
     */
    public function tasks():HasMany
    {
        return $this->hasMany(Task::class);
    }
}
