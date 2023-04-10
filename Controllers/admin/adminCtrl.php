<?php

$act = 'home';
if (isset($_GET['act'])) {
    $act = $_GET['act'];
}

switch($act) {
    case 'home':
        include "../Views/admin/dashboard.php";
        break;
    case 'auth':
        include "../Views/admin/auth.php";
}

?>