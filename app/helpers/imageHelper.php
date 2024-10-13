<?php

// namespace App\helpers;

if (!function_exists('img_d_url')) {
    function img_d_url($filename) {
        return asset("storage/img/downloads/$filename");
    }
}

if (!function_exists('img_u_url')) {
    function img_u_url ($filename) {
        return asset('storage/img/uploads/'.$filename); 
    }
}

if (!function_exists('img_a_url')) {
    function img_a_url($filename) {
        return asset('storage/img/avatars/'.$filename);
    }
}
