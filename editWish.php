<?php
session_start();
if(!array_key_exists("user", $_SESSION)){
    header('Location: index.php');
    exit;
}
require_once("Includes/db.php");
$wisherID= wishDb::getInstance()->get_wisher_id_by_name($_SESSION['user']);

$wisherDescriptionIsEmpty=false;
if($_SERVER['REQUEST_METHOD']=="POST"){
    if(array_key_exists("back", $_POST)){
        header('Location:editWishList.php');
        exit;
    }
    else if($_POST['wishID']==""){
            wishDb::getInstance()->insert_wish($wisherID,$_POST["wish"],$_POST["dueDate"]);
            header('Location:editWishList.php');
            exit;
        }
        else if ($_POST["wishID"]!=""){
            wishDb::getInstance()->update_wish($_POST["wishID"],$_POST["wish"],$_POST["dueDate"]);
            header('Location:editWishList.php');
            exit;
        }
}
?>
<html>
    <head>
        <meta http-equiv="Contetn-Type" contetn="text/html; charset=UTF-8">
    </head>
    <body>
        <?php
        if ($_SERVER['REQUEST_METHOD']=="POST"){
            $wish=array("id"=>$_POST['wishID'], "description"=>$_POST['wish'],
        "due_date"=>$_POST['dueDate']);}
        else if (array_key_exists("wishID", $_GET)){
        $wish= mysqli_fetch_array(wishDb::getInstance()->get_wish_by_wish_id($_GET["wishID"]));
        }
        else {
                $wish=array("id"=>"", "description"=>"","due_date"=>"");
        }
                ?>
        <form name="editWish" action="editWish.php" method="POST">
            <input type="hidden" name="wishID" value="<?php echo $wish ['id']; ?>" />
            Describe your wish: <input type="text" name="wish"  value="<?php echo $wish['description'];?>" /><br/>
            <?php
            if($wisherDescriptionIsEmpty)
                echo "Please enter description<br/>";
            ?>
            When do you want to get it? <input type="text" name="dueDate" value="<?php echo $wish['due_date']; ?>"/><br/>
            <input type="submit" name="saveWish" value="save Changes"/>
            <input type="submit" name="back" value="back to  list"/>
        </form>
    </body>
</html>
