<?php
session_start();

// Initialize variables

$errors = array();
$user_name = '';
$password = '';

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