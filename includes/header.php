<?php
include './includes/config.php';
include './includes/server.php';

if(isset($_GET['logout'])){
    session_destroy();
    unset($_SESSION['user_name']);
    header('Location: login.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex,nofollow" />
    <title><?= $title ?></title>

    <!-- Master CSS sheet, generated from the myriad SCSS files -->
    <link rel="stylesheet" href="css/newstyles.css">
    <!-- Google fonts: Fira Mono, Nanum Gothic Coding, Gothic A1, and DotGothic16 -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=DotGothic16&family=Fira+Mono&family=Gothic+A1:wght@100;300;400;700&family=Nanum+Gothic+Coding:wght@400;700&display=swap" rel="stylesheet">


</head>
<body>
    <header>
        <nav id="horizontalnav">
            <a href="index.php"><img src='images/arrow_icon.png' /><p>Home</p></a>
            <a href="resume.php"><img src='images/arrow_icon.png' /><p>Resume</p></a>
            <a href="portfolio.php"><img src='images/arrow_icon.png' /><p>Portfolio</p></a>
            <a href="experiments.php"><img src='images/arrow_icon.png' /><p>Experiments</p></a>
            <a href="contact.php"><img src='images/arrow_icon.png' /><p>Contact</p></a>
            <?php
            if ( isset($_SESSION['success']) && $_SESSION['success'] === 'success' ){
            ?>
                <a href="index.php?logout=1"><p>Log Out</p></a>
                <a href="backend.php"><p>CMS</p></a>
            <?php } ?>
        </nav>
        <nav id="verticalnav">
            <a href="index.php"><img src='images/arrow_icon.png' /><p>Home</p></a>
            <a href="resume.php"><img src='images/arrow_icon.png' /><p>Resume</p></a>
            <a href="portfolio.php"><img src='images/arrow_icon.png' /><p>Portfolio</p></a>
            <a href="experiments.php"><img src='images/arrow_icon.png' /><p>Experiments</p></a>
            <a href="contact.php"><img src='images/arrow_icon.png' /><p>Contact</p></a>
            <a id="navbutton"><img src='images/arrow_icon.png' /><p>Menu</p></a>
        </nav>
        <nav id="bottomnav">
            <a id="topbutton"><p>Back to Top</p></a>
        </nav>
        <h1 id="title"><?= $main_headline ?></h1>
    </header>
    <main>
    <?php 
        if(isset($_SESSION['user_name'])){
            ?>
            <h2>Welcome, <?= $_SESSION['user_name'] ?></h2>
            <?php
        }
    ?>