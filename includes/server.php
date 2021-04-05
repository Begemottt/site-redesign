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
        $result = mysqli_query($db, $query);

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
    $date = date('y-m-d');
    $category = mysqli_real_escape_string($db, $_POST['category']);
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
    if(empty($category)){
        array_push($errors, 'A category is required.');
    }
    // Then, if there are no errors, add or edit the data!
    if (count($errors)==0){
        if(isset($_POST['new'])){ // If this is a new post
            $sql = "INSERT INTO posts (title, author, content, description, date_added, category) VALUES ('{$title}', '{$author}', '{$content}', '{$description}', '{$date}', '{$category}');";
            // Send the query!
            mysqli_query($db, $sql);
            // Close the connection
            @mysqli_close($db);
            header('Location: cms.php?status=new');
        } else if(isset($_POST['edit'])){ // If this is an edit of an old post
            $id = (int)$_POST['id'];
            $sql = "UPDATE posts SET title = '{$title}', author = '{$author}', content = '{$content}', description = '{$description}', category = '{$category}' WHERE content_id = {$id};";
            // Send the query!
            if (!mysqli_query($db, $sql)){
                array_push($errors, "An SQL error occurred: ".mysqli_error($db));
            } else{
                header('Location: cms.php?status=edit');
            }
            // Close the connection
            @mysqli_close($db);
            ;
        }
    } // End if
} // End isset