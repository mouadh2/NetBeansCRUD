<?php 
require_once ("Includes/db.php");
$logonSuccess=false;
if($_SERVER['REQUEST_METHOD']=="POST"){
    $logonSuccess=(wishDb::getInstance()->verify_wisher_credentials($_POST['user'],$_POST['userpassword']));
    if($logonSuccess==true){
        
        session_start();
        $_SESSION['user']=$_POST['user'];
        header('Location: editWishList.php');
        exit;
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <form name="wishList" method="GET" action="wishlist.php">show list wish of:
            <input type="text" name="user" value="" />
            <input type="submit" value="Go" />
        </form>
        <br>Still don't have a wish list?!<a href="createNewWisher.php">Create now</a>
        <form name="logon" action="index.php" method="POST">
            UserName:<input type="text" name="user" value="" />
            Password:<input type="password" name="userpassword" value="" />
            <?php 
            if($_SERVER['REQUEST_METHOD']=="POST"){
                if(!$logonSuccess)
                    echo"Invalid name and/or password";
            }
            ?>
            <input type="submit" value="edit my wish list">
        </form>
        
    </body>
</html>
