<?php
include './includes/config.php';
include './includes/server.php';

if(isset($_GET['id'])){
    $post_id = (int)$_GET['id'];

    $sql = "SELECT * FROM posts WHERE content_id = {$post_id}";

    // First, make a connection and store the results in $result
    $db = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die;
    $result = mysqli_query($db, $sql) or die;
    // Next, check to see if we got a response, and if so, echo the page in the proper format.
    if (mysqli_num_rows($result) > 0){ // Assign the records
        while($row = mysqli_fetch_assoc($result)){ // For each row in the results, do these things
            $content_title = $row['title']; // This is all just to set the title to the title of the post from the database!!!!
            $content_description = $row['description'];
            $old_content = $row['content'];
            $content_category = $row['category_id'];
            $content_lastedit = $row['date_added'];
            $content_author = $row['author'];
            $content_id = (int)$row['content_id'];
            $form_type = "edit";
        }
    }
    // Free the results
    @mysqli_free_result($result);
    // Close the connection
    @mysqli_close($db);
} else {
    $content_title = "New Content";
    $content_description = '';
    $old_content = '';
    $content_category = '';
    $content_lastedit = '';
    $content_lastedit = '';
    $content_author = '';
    $form_type = "new";
}

include './includes/short_header.php';?>
</header>
<main>
<section id="header_image"><img src="./images/header_keyboard.png" class="header" /></section>
<section id="header_text"><h1><?= $content_title ?></h1></section>
<article class='add_content'>
    
    <?php 
        foreach($errors as $error){
            echo '<section class="header">';
            echo '<h2>'.$error.'</h2>';
            echo '</section>';
        }
    ?>
    
    <form action="./add_content.php" method="POST" class="add_content" >
        <label>Title</label>
        <input type="text" name="title" value="<?php 
            if(isset($_GET['id'])){
                echo $content_title;
            }
        ?>"/>
        <label>Author</label>
        <input type="text" name="author" value="<?php 
            if(isset($_GET['id'])){
                echo $content_author;
            }
        ?>"/>
        <label>Category</label>
        <select name="category">
            <option value="NULL">
                Select One</option>
            <?php // Get the list of categories from the database!
            $sql = "SELECT * FROM categories";
            $db = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die;
            $result = mysqli_query($db, $sql) or die;
            // Next, check to see if we got a response, and if so, echo the page in the proper format.
            while($row = mysqli_fetch_assoc($result)){
                echo "<option value='{$row['category_id']}}'";
                if(isset($_GET['id'])){
                    if($content_category == $row['category_id']){
                        echo "selected = selected";
                    }
                }
                echo ">{$row['category_name']}</option>";
            }
            @mysqli_free_result($result);
            // Close the connection
            @mysqli_close($db);        
            ?>
        </select>
        <label>Description</label>
        <input type="textarea" name="description" value="<?php 
            if(isset($_GET['id'])){
                echo $content_description;
            }
        ?>"></textarea>
        <textarea name="editor1" id="editor1" rows="10" cols="80">
            <?php 
            if(isset($_GET['id'])){
                echo $old_content;
            } else {
                echo 'Start writing!!';
            }
            ?>
        </textarea>
        <script>
            // Replace the <textarea id="editor1"> with a CKEditor 4
            // instance, using default configuration.
            CKEDITOR.replace( 'editor1' );
        </script>
        <?php
        if($form_type==='edit'){
            echo "<input type='hidden' name='id' value='".$content_id."' />";
        }
        ?>

        <button type="submit" id="submit_button" name="<?php 
            if($form_type === "edit"){
                echo 'edit';
            } else if($form_type === 'new'){
                echo 'new';
            }
        ?>">SUBMIT</button>
    </form>
</article>

<?php include './includes/footer.php'; ?>