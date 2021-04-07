<?php
ob_start(); // Prevents header errors before reading the whole page
define('DEBUG', 'TRUE'); // We want to see our errors!

include('credentials.php'); // The PHP credentials, allows us to get into our database

define('THIS_PAGE', basename($_SERVER['PHP_SELF']));

// Switch for individual page variables
switch(THIS_PAGE){
    case 'index.php' :
        $page_title = "Robin VanGilder: Seattle-based Web Design and Development";
        $main_headline = "Robin VanGilder: Web Design & Development";
        $header_class = 'main';
        $query = "SELECT * FROM posts WHERE category = 'main'";
        $page_type = 'topic';
    break;
    case 'resume.php' :
        $page_title = "Resume";
        $main_headline = "My Current Resume";
        $header_class = 'resume';
        $query = "SELECT * FROM posts WHERE category = 'resume'";
        $page_type = 'topic';
    break;
    case 'portfolio.php' :
        $page_title = "Portfolio";
        $main_headline = "My Portfolio";
        $header_class = 'portfolio';
        $query = "SELECT * FROM posts WHERE category = 'main'";
        $page_type = 'list';
    break;
    case 'post_view.php' :
        $page_title = '';
        $main_headline = '';
        $header_class = 'small';
        $query = '';
        $page_type = 'article';
    break;
    case 'login.php' :
        $page_title = 'Super Secret Login Page';
        $main_headline = 'SUPER SECRET LOGIN PAGE!!';
        $header_class = 'login';
        $query = '';
        $page_type = '';
    break;
    case 'cms.php' :
        $page_title = 'Content Management System';
        $main_headline = 'Content Management System';
        $header_class = 'cms';
        $query = "SELECT * FROM posts";
        $page_type = 'backend';
    break;
    case 'add_content.php' :
        $page_title = '';
        $main_headline = '';
        $header_class = 'small';
        $query = '';
        $page_type = '';
    break;
    case 'add_content.php' :
        $page_title = '';
        $main_headline = '';
        $header_class = 'small';
        $query = '';
        $page_type = '';
    break;


} // End switch

// A function to take the sql query and use it to build a page, fully displaying all content that is taken in
function Make_Page($sql, $type){
    // First, make a connection and store the results in $result
    $i_conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die;
    $result = mysqli_query($i_conn, $sql) or die;

    // Next, check to see if we got a response, and if so, echo the page in the proper format.
    if (mysqli_num_rows($result) > 0){ // Show the records
        while($row = mysqli_fetch_assoc($result)){ // For each row in the results, do these things
            if ($type === 'topic'){ // Filly display every piece of content
                ?>
                <article>
                    <section class="header">
                        <h2 class="article_header"><?= $row['title'] ?></h2>
                        <p class="byline"><?= $row['author'] ?> - Posted <?= $row['date_added'] ?></p>
                    </section>
                    <section class="body">
                        <?= $row['content'] ?>
                    </section>
                </article>
                <?php
            } else if ($type === 'list'){ // Show a list with just title, author, and date
                $id = (int)$row['content_id'];
                ?>
                <article class="list">
                    <section>
                    <a href="post_view.php?id=<?= $id ?>">
                    <section class="list_item">
                    <p><?= $row['title'] ?> <span class="byline"> - <?= $row['author'] ?> - <?= $row['date_added'] ?></span></p>
                    <p class="description"> > <?= $row['description'] ?></p>
                    </section>
                    </a>
                    </section>
                </article>

                <?php
            } else if($type === 'article'){
                $post_title = $row['title'];
                if(isset($_GET['id'])){
                    $post_id = (int)$_GET['id'];
                } else {
                    header('Location:invalid_id.php');
                }
                // This one is designed to follow after short_header.php
                ?>
                </header>
                <main>
                <section class="headline"><h1 id="title"><?= $post_title ?></h1></section>
                <section class="page_headline"></section>

                <article class="single">
                    <section class="header">
                        <p class="byline"><?= $row['author'] ?> - Posted <?= $row['date_added'] ?></p>
                    </section>
                    <section class="body">
                        <?= $row['content'] ?>
                    </section>
                </article>
                <?php
            } else if ($type === 'backend'){
                $id = (int)$row['content_id'];
                ?>
                <article class="list">
                    <section class="backend_list">
                        <a href="post_view.php?id=<?= $id ?>">
                            <section class="list_item">
                                <p><?= $row['title'] ?> <span class="byline"> - <?= $row['author'] ?> - <?= $row['date_added'] ?></span></p>
                                <p class="description"> > <?= $row['description'] ?></p>
                            </section>
                        </a>
                    </section>
                    <section class="backend_buttons">
                        <a href="delete_content.php?id=<?= $id ?>" class="delete"><p>DELETE</p></a>
                        <a href="add_content.php?id=<?= $id ?>" class="edit"><p>EDIT</p></a>
                    </section>
                </article>
                <?php
            } // End If
        } // End While
    } else {
        echo 'Sorry, no content!!';
    } // End if

    // Free the results
    @mysqli_free_result($result);
    // Close the connection
    @mysqli_close($i_conn);
}


// PLEASE REMEMBER  - THIS IS PLACED AT THE VERY BOTTOM OF YOUR CONFIG FILE!
function my_errors($my_file, $my_line, $error_message){

    if(defined('DEBUG') && DEBUG){
        echo 'Error in file: <b>'.$my_file.'</b> on line <b>'.$my_line.'</b>.';
        echo 'Error messsage: <b>'.$error_message.'</b>.';
        die();
    } else {
        echo 'Woops! Something went wrong.';
        die();
    }
}