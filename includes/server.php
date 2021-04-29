<?php
session_start();

// Initialize variables
// Login Form
$errors = array();
$user_name = '';
$password = '';
// Content addition/editing
$title = '';
$author = '';
$content = '';
$date = '';
$description = '';
$category = '';
$image = '';

// Connect to the database

$db = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die;

if(isset($_POST['login_user'])){
    $user_name = mysqli_real_escape_string($db, $_POST['user_name']);
    $password = mysqli_real_escape_string($db, $_POST['password']);

    if(empty($user_name)){
        array_push($errors, 'User name is required.');
    }
    if(empty($password)){
        array_push($errors, 'Password is required.');
    }

    if(count($errors) == 0){
        $password = md5($password);

        $query = "SELECT * FROM users WHERE username = '$user_name' AND pass_word = '$password'";
        $result = db_connect($query);

        if(mysqli_num_rows($result) === 1){
            $_SESSION['user_name'] = $user_name;
            $_SESSION['success'] = "success";

            header('Location: index.php');
        } else {
            array_push($errors, 'Wrong user name/password combination!');
        }
    } // Close count errors
} // isset close

// Function for adding or editing posts!
if(isset($_POST['edit']) || isset($_POST['new'])){
    // First, assign variables from data
    $title = mysqli_real_escape_string($db, $_POST['title']);
    $author = mysqli_real_escape_string($db, $_POST['author']);
    $content =  mysqli_real_escape_string($db, $_POST['editor1']);
    $description = mysqli_real_escape_string($db, $_POST['description']);
    $image = mysqli_real_escape_string($db, $_POST['header_image']);
    $date = date('y-m-d');
    $category_id = (int)$_POST['category'];
    // Then, check to see if anything is empty.
    if(empty($title)){
        array_push($errors, 'A title is required.');
    }
    if(empty($author)){
        array_push($errors, 'An author name is required.');
    }
    if(empty($content)){
        array_push($errors, 'Some content is required.');
    }
    if(empty($description)){
        array_push($errors, 'A short description is required.');
    }
    if(empty($image)){
        array_push($errors, 'A header image url is required.');
    }
    if(empty($category_id) || !is_integer($category_id)){
        array_push($errors, 'A category is required.');
    }
    // Then, if there are no errors, add or edit the data!
    if (count($errors)==0){
        if(isset($_POST['new'])){ // If this is a new post
            $sql = "INSERT INTO posts (title, author, content, description, date_added, header_image, category_id) VALUES ('{$title}', '{$author}', '{$content}', '{$description}', '{$date}', '{$image}', '{$category_id}');";
            // Send the query!
            db_connect($sql);
            header('Location: cms.php?status=new');
        } else if(isset($_POST['edit'])){ // If this is an edit of an old post
            $id = (int)$_POST['id'];
            $sql = "UPDATE posts SET title = '{$title}', author = '{$author}', content = '{$content}', description = '{$description}', header_image = '{$image}', category_id = '{$category_id}' WHERE content_id = {$id};";
            // Send the query!
            db_connect($sql);
        }
    } // End if
} // End isset

// Function for DELETING an existing post!
if(isset($_POST['confirm_delete'], $_POST['id'])){
    $id = (int)$_POST['id'];
    $sql = "DELETE FROM posts WHERE content_id={$id}";
    // Run the query!
    db_connect($sql);
} else if(isset($_POST['deny_delete'])){
    header('Location: cms.php');
}