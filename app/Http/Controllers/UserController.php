<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;

class UserController extends Controller
{
    public function userOnlineStatus()
    {
        $users = User::all();
        foreach ($users as $user) {
            if (Cache::has('user-is-online-' . $user->id)) {
                echo $user->nama . ' is online, last seen' . Carbon::parse($user->last_seen)->diffForHumans() . "<br>";
            } else {
                echo $user->nama . ' is offline, last seen' . Carbon::parse($user->last_seen)->diffForHumans() . "<br>";
            }
        }
    }
}
