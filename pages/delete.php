<?php


  $_SESSION['success'] = "";
  
  require '../php/connection.php';
  
    if(isset($_GET ['Id'])) {
      $id = $_GET['Id'];
      $delete = ("DELETE FROM members where Id = '$id'");
      mysqli_query($connect, $delete);
      
      header ('Location:../Admin/Dashboard.php');
    }

    /*~~~~~~~~~~~~~ For Deleteng users ~~~~~~~~~~~~~*/

    if(isset($_GET ['id'])) {
      $id = $_GET['id'];
      $ids =1;
      if ($id == $ids) {
        echo'
          <link rel="stylesheet" type="text/css" href="../Css/try.css">
          <div id="myModal" class="">
            <div class="modal-content">
             <div class="modal-header">
                <a href="../Admin/Dashboard.php"><span class="close">&times;</span></a>
                <h2></br><br></h2>
              </div>
                <div class="modal-body"></br><br>
                  <h1> <center> Stop Admin Account cannot be Deleted!</h1></br><br> 
                </div>
                <div class="modal-footer">
                  <h3> </br><br></h3>
                </div>
            </div>
          </div>';
      }else{
        $delete = ("DELETE FROM users where Id = '$id'");
        mysqli_query($connect, $delete);
        header ('Location:../pages/users.php');
      }
    }
?>


                