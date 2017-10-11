<?php

use Michelf\Markdown;

function back() {
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}

function config_merge($a, $b) {
    foreach($b as $k => $v) {
        if(!is_array($v)) {
            $a[$k] = $v;
        } else {
            $a[$k] = config_merge($a[$k] ?? [], $v);
        }
    }
    return $a;
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

function markdown(string $markdown): string {
    return Markdown::defaultTransform($markdown);
}

function post($name) {
    return $_POST[$name] ?? null;
}

function sort_by_methods(&$array, ...$methods) {
    return usort($array, function($a, $b)use($methods) {
        for($i = 0, $max = count($methods); $i < $max; $i++) {
            $cmp = $a->{$methods[$i]}() <=> $b->{$methods[$i]}();
            if($cmp) return $cmp;
        }
        return 0;
    });
}
