  <!-- Deleting transaction area -->
  <?php

    require '../php/connection.php';  
    if(isset($_GET ['idm'])) {
      $id = $_GET['idm'];

        $select = ("SELECT * from withdraw where Idw= '$id'");
          $query = mysqli_query($connect,$select);
            $row = mysqli_fetch_assoc($query);
              $with = $row['wamount'];
              $withs = $row['wamount'];
              $mid = $row['mid'];

        $delete = ("DELETE FROM withdraw where Idw = '$id'");
          mysqli_query($connect, $delete);
      
        $selects = ("SELECT * FROM members where Id = '$mid' ");
          $querys = mysqli_query($connect, $selects);
            $rows = mysqli_fetch_assoc($querys);
              $id = $rows ['Id'];
              $contrib = $rows['contrib'];
              $withdraw = $rows ['withdraw'];
              $diff = $rows ['difference'];
              $total = $with + $diff;
              $subtract = $withdraw - $withs;

              $updates = ("UPDATE members SET difference ='$total' , withdraw ='$subtract' where Id= '$mid'");
              $queryUP = mysqli_query($connect, $updates);
      header ('Location:../Admin/Dashboard.php');
    }




    // ======== Delete Transaction in Deposit ========= //
    
    if(isset($_GET ['idd'])) {
      $id = $_GET['idd'];

        $select = ("SELECT * from Diposit where Idd= '$id'");
          $query = mysqli_query($connect,$select);
            $row = mysqli_fetch_assoc($query);
              $damount = $row['damount'];
              $mid = $row['mid'];

        $selects = ("SELECT * FROM members where Id = '$mid' ");
          $querys = mysqli_query($connect, $selects);
            $rows = mysqli_fetch_assoc($querys);
              $contrib = $rows['contrib'];
              $withdraw = $rows['withdraw'];
              $difference = $rows['difference'];

              $subtract = $contrib - $damount;
              $def = $difference - $damount;

              if ($contrib == $withdraw) {
                echo "Please delete withdraw first";
              }else{
                if ($difference == 0) {
                  if ($subtract < 0) {
                      echo "Please Check The Withdraw First";
                  }else{
                    $updates = ("UPDATE members SET contrib ='$subtract' where Id= '$mid'");
                    mysqli_query($connect, $updates);

                    $deleted = ("DELETE FROM Diposit where Idd = '$id'");
                    mysqli_query($connect, $deleted); 
                    header ('Location:../Admin/Dashboard.php');
                  }

               }if ($subtract < 0) {
                  echo "Please Check The Withdraw First";
               }elseif ($def < 0) {
                  echo "Please Check The Withdraw";
               }else{
                    $updates = ("UPDATE members SET contrib ='$subtract' where Id= '$mid'");
                    mysqli_query($connect, $updates);

                    $updatess = ("UPDATE members SET difference ='$def' where Id= '$mid'");
                    mysqli_query($connect, $updatess);

                    $deleted = ("DELETE FROM Diposit where Idd = '$id'");
                    mysqli_query($connect, $deleted); 
                    header ('Location:../Admin/Dashboard.php');

               }

              }
              
    }


  ?>