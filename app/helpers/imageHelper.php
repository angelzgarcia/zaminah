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

    if (!function_exists('img_p_url')) {
        function img_p_url($filename) {
            return asset("storage/img/profiles/$filename");
        }
    }

    function hash_img($img) {
        return hash_hmac('sha256', base64_encode($img), env('APP_KEY'));
    }


