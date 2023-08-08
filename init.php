<?php

$tmbl = 'inc/tmbl/'; 

include $tmbl . 'header.php';

$sessionUser ='';

if (isset($_SESSION['user'])) {
    $sessionUser = $_SESSION['user'];
}