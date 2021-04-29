<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex,nofollow" />
    <title><?= $page_title ?></title>

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
            <a href="index"><p>Home</p></a>
            <a href="about"><p>About</p></a>
            <a href="resume"><p>Resume</p></a>
            <a href="portfolio"><p>Portfolio</p></a>
            <a href="contact"><p>Contact</p></a>
        </nav>
        <?php if ( isset($_SESSION['success']) && $_SESSION['success'] === 'success' ){ ?>
        <nav id="adminnav">
            <a><p>Welcome, <?= $_SESSION['user_name'] ?></p></a>
            <a href="cms"><p>CMS</p></a>
            <a href="add_content"><p>Add Content</p></a>
            <a href="index.php?logout=1"><p>Log Out</p></a>
        </nav>
        <?php } ?>
        <nav id="singlenav">
            <a id="navbutton"><span class="arrow">➤</span><p>Menu</p></a>
        </nav>
        <nav id="verticalnav">
            <a href="index" class="submenu1"><span class="arrow">➤</span><p>Home</p></a>
            <a href="about"  class="submenu1"><span class="arrow">➤</span><p>About</p></a>
            <a href="resume"  class="submenu1"><span class="arrow">➤</span><p>Resume</p></a>
            <a href="portfolio"  class="submenu1"><span class="arrow">➤</span><p>Portfolio</p></a>
            <a href="contact"  class="submenu1"><span class="arrow">➤</span><p>Contact</p></a>
        </nav>
        <nav id="bottomnav">
            <a id="topbutton"><p>Back to Top</p></a>
        </nav>
