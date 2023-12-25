<?php
require_once ("Includes/db.php");
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        Wish List of <?php echo htmlentities($_GET["user"])."<br/>";?>
        <?php
        
        $wisherID=wishDb::getInstance()->get_wisher_id_by_name($_GET["user"]);
        if(!$wisherID){
            exit("The person".$_GET["user"]."is not found.Please check ");
        }
        ?>
        <table border="black">
          <tr>
           <th>Item</th>
           <th>Due Date</th>
          </tr>
          <?php 
          $result =wishDb::getInstance()->get_wishes_by_wisher_ID($wisherID);
          while($row = mysqli_fetch_array($result)){
              echo "<tr><td>".htmlentities($row["description"])."</td>";
              echo "<td>".htmlentities($row["due_date"])."</td></tr>\n";
              
          }
          mysqli_free_result($result);   
          ?>
        </table>
    </body>
</html>
