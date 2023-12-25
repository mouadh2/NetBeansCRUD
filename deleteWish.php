<?php
require_once ("Includes/db.php");

wishDb::getInstance()->delete_wish($_POST['wishID']);
header('Location: editWishList.php');
?>

