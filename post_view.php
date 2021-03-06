<?php
include './includes/config.php';
include './includes/server.php';
// ^^^ JUST config first, this time
// post_view.php
// Set the post ID for the query based on the GET data, casting to int first
if(isset($_GET['id'])){
    $post_id = (int)$_GET['id'];
} else {
    header('Location:invalid_id.php');
}
$sql = "SELECT * FROM posts WHERE content_id = {$post_id}";

// First, make a connection and store the results in $result
$result = db_connect($sql);
// Next, check to see if we got a response, and if so, echo the page in the proper format.
if (mysqli_num_rows($result) > 0){ // Show the records
    while($row = mysqli_fetch_assoc($result)){ // For each row in the results, do these things
        $page_title = $row['title']; // This is all just to set the title to the title of the post from the database!!!!
    }
}
// Free the results
@mysqli_free_result($result);

// Once all that is set, create the actual content for the page with the config-free short_header and make_page!
include './includes/short_header.php';
Make_Page($sql, $page_type);
include './includes/footer.php';