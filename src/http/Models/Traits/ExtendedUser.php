<?php

namespace AbediMostafa\ToDo\http\Models\Traits;

use AbediMostafa\ToDo\http\Models\Task;
use App\User;
use \Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Hash;

trait ExtendedUser
{
    /**
     * Get the tasks of the user
     */
    public function tasks():HasMany
    {
        return $this->hasMany(Task::class);
    }

    /**
     * Add api_token to the user fillable property
     */
    public function addApiTokenToFillAble()
    {
        $this->fillable[] = 'api_token';
        return $this;
    }

    /**
     * Makes new user
     */
    public function makeUser($token)
    {
        $this->name = request('name');
        $this->email = request('email');
        $this->password = Hash::make(request('password'));
        $this->api_token = $token;
        $this->save();
    }

    /**
     * Regenerate user's token
     */
    public function tokenRenew($token)
    {
        $this->api_token = $token;
        $this->save();
    }
}
