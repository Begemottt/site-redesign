<?php
/**
 * make_page.php contains the massive, unwield function for filling in the content of a page
 * based on a sql query and a page type.
 * 
 * @author Robin VanGilder <poliosis@gmail.com>
 * @version 1.0 2021/04/29
 * @link http://www.rtvgilder.com/ 
 * @license https://www.apache.org/licenses/LICENSE-2.0
 * @todo none
 */


function Make_Page($sql, $type){
    // First, make a connection and store the results in $result
    $result = db_connect($sql);

    // Next, check to see if we got a response, and if so, echo the page in the proper format.
    if (mysqli_num_rows($result) > 0){ // Show the records
        while($row = mysqli_fetch_assoc($result)){ // For each row in the results, do these things
            if ($type === 'topic'){ // Filly display every piece of content
                ?>
                <article class="multi">
                    <section class="header">
                        <h2 class="article_header"><?= $row['title'] ?></h2>
                        <p class="byline"><?= $row['author'] ?> - Posted <?= $row['date_added'] ?></p>
                    </section>
                    <div class="body_wrapper">
                    <section class="body">
                        <?= $row['content'] ?>
                    </section>
                    </div>
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
                $header_image = $row['header_image'];
                if(isset($_GET['id'])){
                    $post_id = (int)$_GET['id'];
                } else {
                    header('Location:invalid_id.php');
                }
                // This one is designed to follow after short_header.php
                ?>
                </header>
                <main>
                <section id="header_image"><img src="./images/<?= $header_image ?>" class="header" /></section>
                <section id="header_text"><h1><?= $post_title ?></h1></section>

                <article class="single">
                    <section class="header">
                        <p class="byline"><?= $row['author'] ?> - Posted <?= $row['date_added'] ?></p>
                    </section>
                    <div class="body_wrapper">
                    <section class="body">
                        <?= $row['content'] ?>
                    </section>
                    </div>
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
}