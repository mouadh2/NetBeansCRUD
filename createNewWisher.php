<?php
require_once ("Includes/db.php");
?>
<?php
      $dbHost="localhost";
      $dbUsername="root";
      $userNameIsUnique = true;
      $passwordIsValid = true;
      $userIsEmpty = false;
      $passwordIsEmpty = false;
      $password2IsEmpty = false;
      
      $passwordIsValid=$_POST['password']===$_POST['password2'];
      
      if($_SERVER["REQUEST_METHOD"]=="POST"){
          if($_POST["user"]==""){
              $userIsEmpty=true;
          }
          $wisherID=wishDb::getInstance()->get_wisher_id_by_name($_POST["user"]);
          if($wisherID){
              $userNameIsUnique=false;
          }
          if($_POST['password']==""){
              $passwordIsEmpty=true;
          }
          if($_POST['password2']==""){
              $password2IsEmpty=true;
          }
          if($_POST['password']=!$_POST['password2']){
             $passwordIsValid=false;
          }
          
          if(!$userIsEmpty && $userNameIsUnique && !$password2IsEmpty && $passwordIsValid){
              wishDb::getInstance()->create_wisher($_POST["user"],$_POST["password"]);
              session_start();
              $_SESSION['user']=$_POST['user'];
              header('Location:editWishList.php');
              exit;
          }
      }
?>
        <html>
         <head>
          <meta http-equiv="content-type" content="text/html; charset=UTF-8">
          <title></title>
         </head>
         <body>Welcome!<br>
             <form action="createNewWisher.php" method="POST">
                 Your name:<input type="text" name="user"/><br/>
                 <?php
                 if($userIsEmpty){
                     echo("enter your name please");
                 }
                 if(!$userNameIsUnique){
                     echo("the person already exists.please check");
                 }
                 ?>
                 Password:<input type="password" name="password"/><br/>
                 <?php
                 if($passwordIsEmpty){
                     echo ("enter the password ,please");
                 }
                 ?>
                 Please confirm your password:<input type="password" name="password2"/><br/>
                 <?php
                 if(!$passwordIsEmpty & !$passwordIsValid){
                     echo ("the password do not match!");
                 }
                 ?>
                 <input type="submit" value="Register"/>
             </form>
         </body>
        </html>
    </body>
</html>
