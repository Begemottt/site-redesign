<?php include './includes/header.php';
if ( $_SESSION['success'] != 'success' ){
    header('Location: index.php');
}
echo "<article class='cms'>";
if(isset($_GET['status'])){
    if($_GET['status']==='new'){
        echo "<section class='header'><h2 class='article_header'>NEW CONTENT ADDED!</h2></section>";
    } else if($_GET['status']==='edit'){
        echo "<section class='header'><h2 class='article_header'>CONTENT UPDATED!</h2></section>";
    } else if($_GET['status']==='delete'){
        echo "<section class='header'><h2 class='article_header'>CONTENT DELETED!</h2></section>";
    }
}
Make_Page($query, $page_type);
echo "</article>";

include './includes/footer.php'; ?>