
<?php

    if (!function_exists('hashPassword')) {
        function hashPassword($password) {
            return password_hash($password, PASSWORD_DEFAULT);
        }
    }

    
    if (!function_exists('verifyPassword')) {
        function verifyPassword($password, $hashPassword) {
            return password_verify($password, $hashPassword);
        }
    }
