<?php


if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_GET['lang']) && $_GET['lang'] === 'ar') {
    $_SESSION['lang'] = 'ar';
} else {
    $_SESSION['lang'] = 'en';
}

$translates = require __DIR__ . '/../lang/' . $_SESSION['lang'] . '.php';

function __($key) {
    global $translates;
    $keys = explode('.', $key);
    $value = $translates;
    foreach ($keys as $key) {
        $value = $value[$key];
    }
    return $value ?? $key;
}
