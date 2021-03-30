<?php
ob_start(); // Prevents header errors before reading the whole page
define('DEBUG', 'TRUE'); // We want to see our errors!

include('credentials.php'); // The PHP credentials, allows us to get into our database

define('THIS_PAGE', basename($_SERVER['PHP_SELF']));

// Switch for individual page variables
switch(THIS_PAGE){
    case 'index.php' :
        $title = "Robin VanGilder: Seattle-based Web Design and Development";
        $main_headline = "Welcome!";
        $query = "SELECT * FROM posts WHERE category = 'main'";
    break;
    case 'resume.php' :
        $title = "Resume";
        $main_headline = "My Current Resume";
        $query = "SELECT * FROM posts WHERE category = 'resume'";

} // End switch

// A function to take the sql query and use it to build a page, fully displaying all content that is taken in
function Make_Page($sql){
    // First, make a connection and store the results in $result
    $i_conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die;
    $result = mysqli_query($i_conn, $sql) or die;

    // Next, check to see if we got a response, and if so, echo the page in the proper format.
    if (mysqli_num_rows($result) > 0){ // Show the records
        while($row = mysqli_fetch_assoc($result)){
            ?>
            <article>
                <section class="header">
                    <h2><?= $row['title'] ?></h2>
                    <p class="byline"><?= $row['author'] ?> - Posted <?= $row['date_added'] ?></p>
                </section>
                <section class="body">
                    <?= $row['content'] ?>
                </section>
            </article>
            <?php
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