<?php
function redirect($controller)
{
    switch ($controller) {
    case 'thread':
        header('Location: /thread/index');
        break;
    case 'user':
        header('Location: /user/login');
        break;
    default:
        header('Location: login');
        break;
    }
}
?>
