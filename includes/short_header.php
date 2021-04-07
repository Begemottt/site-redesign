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
    <!-- Google fonts: Fira Mono, Nanum Gothic Coding, and Nixie One -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Fira+Mono&family=Nanum+Gothic+Coding&family=Nixie+One&display=swap" rel="stylesheet">
    <script src="./ckeditor/ckeditor.js"></script>

</head>
<body>
    <header>
        <nav id="horizontalnav">
            <a href="index.php"><img src='images/arrow_icon.png' /><p>Home</p></a>
            <a href="resume.php"><img src='images/arrow_icon.png' /><p>Resume</p></a>
            <a href="portfolio.php"><img src='images/arrow_icon.png' /><p>Portfolio</p></a>
            <a href="experiments.php"><img src='images/arrow_icon.png' /><p>Experiments</p></a>
            <a href="contact.php"><img src='images/arrow_icon.png' /><p>Contact</p></a>
        </nav>
        <?php if ( isset($_SESSION['success']) && $_SESSION['success'] === 'success' ){ ?>
        <nav id="adminnav">
            <a><p>Welcome, <?= $_SESSION['user_name'] ?></p></a>
            <a href="cms.php"><p>CMS</p></a>
            <a href="add_content.php"><p>Add Content</p></a>
            <a href="index.php?logout=1"><p>Log Out</p></a>
        </nav>
        <?php } ?>
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
