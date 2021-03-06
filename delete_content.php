<?php
include './includes/config.php';
include './includes/server.php';

if(isset($_GET['id'])){
    $post_id = (int)$_GET['id'];

    $sql = "SELECT * FROM posts WHERE content_id = {$post_id}";

    // First, make a connection and store the results in $result
    $result = db_connect($sql);
    // Next, check to see if we got a response, and if so, echo the page in the proper format.
    if (mysqli_num_rows($result) > 0){ // Assign the records
        while($row = mysqli_fetch_assoc($result)){ // For each row in the results, do these things
            $content_title = $row['title']; // This is all just to set the title to the title of the post from the database!!!!
            $content_description = $row['description'];
            $old_content = $row['content'];
            $content_category = $row['category'];
            $content_lastedit = $row['date_added'];
            $content_author = $row['author'];
            $header_image = $row['header_image'];
            $content_id = (int)$row['content_id'];
            $form_type = "edit";
        }
    }
    // Free the results
    @mysqli_free_result($result);
}

include './includes/short_header.php';?>
</header>
<main>
<section id="header_image"><img src="./images/header_martha.png" class="header" /></section>
<section id="header_text"><h1> DELETE <?= $content_title ?>?</h1></section>
<article class='single'>
<?php 
    foreach($errors as $error){
        echo '<h2>'.$error.'</h2>';
    }
?>
<section class="header">
    <h2 class='article_header'><?= $content_title ?></h2>
    <p class="byline"><?= $content_author ?></p>
</section>
<section class="body">
    <?= $old_content ?>
</section>
<form action="./delete_content.php" method="POST" class="add_content">
    <label>Are you SURE you want to delete <?= $content_title ?>?</label>
    <input type='hidden' name='id' value='<?= $content_id ?>' />
    <input type="submit" id="submit_button" name="confirm_delete" value="YES, DELETE <?= $content_title ?>" />
    <input type="submit" id="reset_buytton" name="deny_delete" value="NO, I CHANGED MY MIND" />
</form>
</article>

<?php include './includes/footer.php'; ?>