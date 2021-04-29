<?php
include './includes/config.php';
include './includes/server.php';

set_var();

if(isset($_GET['logout'])){
    session_destroy();
    unset($_SESSION['user_name']);
    header('Location: login.php');
}
include './includes/short_header.php';
?>

    </header>
    <main>
    <section id="header_image"><img src="./images/<?= $header_image ?>" class="header" /></section>
    <section id="header_text"><h1><?= $page_title ?></h1></section>