<?php include './includes/header.php';
if ( $_SESSION['success'] != 'success' ){
    header('Location: index.php');
}
echo "<article class='cms'><form>";
Make_Page($sql, $type);
echo "</form></article>";

include './includes/footer.php'; ?>