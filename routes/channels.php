<?php

use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('streaming-channel.{id}', function ($user, $id) {
    //
    return ($user->role_id == 1) ? $user : (\App\Models\CourseSession::where([
        ['course_id', $id],
        ['user_id', $user->id],
    ])->exists() ? $user: null);
});

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int)$user->id === (int)$id;
});
