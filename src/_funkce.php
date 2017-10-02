<?php

function back() {
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}

function post($name) {
    return $_POST[$name] ?? null;
}
