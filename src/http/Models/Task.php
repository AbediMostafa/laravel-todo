<?php

namespace AbediMostafa\ToDo\http\Models;

use AbediMostafa\ToDo\http\Notifications\TaskClosedNotification;
use App\User;
use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\Relations\BelongsToMany;
use \Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class Task extends Model
{
    protected $fillable = ['title', 'description', 'status', 'user_id'];

    protected static function booted()
    {
        static::saving(function ($task) {

            // if status changed
            if (array_key_exists('status', $task->getDirty())) {
                // if task closed
                if (!$task->status) {
                    dispatch(function () use ($task) {
                        try {
                            Auth::user()->notify(new TaskClosedNotification($task));

                        } catch (\Exception $e) {
                            Log::error($e->getMessage());
                        }
                    })->afterResponse();
                }
            }
        });
    }

    /**
     * Scope query to only get authenticated user's tasks
     *
     * @param $query
     * @return mixed
     */
    public function scopeOfAuthenticatedUser($query)
    {
        $query->whereUserId(Auth::id());
    }

    /**
     * get the task's status as boolean
     *
     * @return bool
     */
    public function getStatusAttribute()
    {
        return $this->attributes['status'] === 'open';
    }

    /**
     * set the task's status as string
     *
     * @param $value
     */
    public function setStatusAttribute($value)
    {
        $this->attributes['status'] = $value ? 'open' : 'close';
    }

    /**
     * Get the labels of the task
     */
    public function labels(): BelongsToMany
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
