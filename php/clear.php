  <?php

    require '../php/connection.php';  
    if(isset($_GET ['id'])) {
      $id = $_GET['id'];



        $delete = ("DELETE FROM withdraw where mid = '$id'");
        mysqli_query($connect, $delete);
        $delete  = ("DELETE FROM Diposit where mid = '$id'");
          mysqli_query($connect, $delete);


          $update = ("UPDATE members SET contrib ='0' where Id= '$id'");
          $queryUP = mysqli_query($connect, $update);

          $update = ("UPDATE members SET difference ='0' where Id= '$id'");
          $queryUP = mysqli_query($connect, $update);
          $update = ("UPDATE members SET withdraw ='0' where Id= '$id'");
          $queryUP = mysqli_query($connect, $update);
        
      header ('Location:../Admin/Dashboard.php');
    }
?>