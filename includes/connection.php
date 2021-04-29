<?php
/**
 * connection.php contains the functions for opening and closing connections to the database
 * Always remember to run the closing one after opening it!
 * 
 * @author Robin VanGilder <poliosis@gmail.com>
 * @version 1.0 2021/04/29
 * @link http://www.rtvgilder.com/ 
 * @license https://www.apache.org/licenses/LICENSE-2.0
 * @todo none
 */

function db_connect($sql_query){
    $db = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die;
    $result = mysqli_query($db, $sql_query) or die;
    @mysqli_close($db);
    return $result;
}

function db_close($result){
    // Free the results
    @mysqli_free_result($result);
}