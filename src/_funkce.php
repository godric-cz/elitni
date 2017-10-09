<?php

function back() {
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}

function cookie_flag_push($name) {
    setcookie($name, '1');
}

function cookie_flag_pop($name) {
    if(isset($_COOKIE[$name])) {
        setcookie($name, null, 1);
        return true;
    } else {
        return false;
    }
}

function get($name) {
    return $_GET[$name] ?? null;
}

function post($name) {
    return $_POST[$name] ?? null;
}
