
<?php

    if (!function_exists('guia_url')) {
        function guia_url($filename) {
            return asset('storage/guias/'.$filename);
        }
    }

    if (!function_exists('triptico_url')) {
        function triptico_url($filename) {
            return asset('storage/tripticos/'.$filename);
        }
    }

