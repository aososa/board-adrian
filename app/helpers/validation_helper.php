<?php

function validate_between($check, $min, $max) {
    $n = mb_strlen($check);
    return $min <= $n && $n <=$max;
}

function is_logged_in()
{
    return (isset($_SESSION["id"]));
}

function letters_only($name)
{
    return preg_match ("/^[a-zA-Z0-9\_]+$/",$name);
}


?>
