<?php
session_start();
require_once 'includes/db.php';
require_once 'includes/functions.php';

$page = isset($_GET['page']) ? $_GET['page'] : 'home';

// Include header
include 'includes/header.php';

// Include page content
$allowed_pages = ['home', 'login', 'register', 'dashboard'];
if (in_array($page, $allowed_pages) && file_exists("pages/$page.php")) {
    include "pages/$page.php";
} else {
    include 'pages/404.php';
}

// Include footer
include 'includes/footer.php';
?>
