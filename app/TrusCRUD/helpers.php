<?php

use App\Helpers\Role;
use App\UserProvider;

//Role Allowed
function is_allow($action_name) {

    return Role::isAllow($action_name);
}

//Get Image Avatar
function avatar_image($user) {
    return isset($user->get_avatar->url) == '' ? url('data/images/default.png') :$user->get_avatar->url;
}


//Count Notification Unread
function count_notify($user) {
    $notify = $user->notifications()->where('read_at', NULL)->count();
    return $notify;
}

//Check Socialite Connected
function has_provider($user_id, $provider) {
    $provider = UserProvider::where('user_id', $user_id)->where('provider', $provider)->count();

    return $provider;
}

//TrusLabs Config
function conf($name) {
    return config('truslabs.'.$name);
}