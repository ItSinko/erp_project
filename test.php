<?php

$pattern = "*127.0.0.1:8000/home/tambah";
$request = "http://127.0.0.1:8000/home";

function wrap($value)
{
    if (is_null($value)) {
        return [];
    }

    return is_array($value) ? $value : [$value];
}

function is($pattern, $value)
{
    $patterns = wrap($pattern);

    if (empty($patterns)) {
        return false;
    }

    foreach ($patterns as $pattern) {
        // If the given value is an exact match we can of course return true right
        // from the beginning. Otherwise, we will translate asterisks and do an
        // actual pattern match against the two strings to see if they match.
        if ($pattern == $value) {
            return true;
        }

        $pattern = preg_quote($pattern, '#');

        // Asterisks are translated into zero-or-more regular expression wildcards
        // to make it convenient to check if the strings starts with the given
        // pattern such as "library/*", making any string check convenient.
        $pattern = str_replace('\*', '.*', $pattern);

        if (preg_match('#^' . $pattern . '\z#u', $value) === 1) {
            return true;
        }
    }

    return false;
}

if (is($pattern, $request)) {
    echo "true\n";
} else {
    echo "false\n";
}
