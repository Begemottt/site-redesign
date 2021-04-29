<?php
/**
 * config.php brings together the various functions required to make a page work
 * and also contains boilerplate code to be used on any page.
 * 
 * @author Robin VanGilder <poliosis@gmail.com>
 * @version 1.0 2021/04/29
 * @link http://www.rtvgilder.com/ 
 * @license https://www.apache.org/licenses/LICENSE-2.0
 * @todo none
 */

ob_start(); // Prevents header errors before reading the whole page
define('DEBUG', 'TRUE'); // We want to see our errors!

include('credentials.php'); // The PHP credentials, allows us to get into our database
include('set_var.php'); // The function containing a switch case that sets variables for the page.
include('connection.php'); // The database connection and closing functions
include('make_page.php'); // A function to take the sql query and use it to build a page, fully displaying all content that is taken in

define('THIS_PAGE', basename($_SERVER['PHP_SELF']));

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