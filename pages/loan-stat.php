<?php include "../php/asession.php" ?>
<!DOCTYPE html>
<html>
  <head>
    <title>Cooperative</title>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" type="text/css" href="../Css/styles.css">
      <link rel="stylesheet" type="text/css" href="../Css/datatable.css">
      <link href="facefiles/facebox.css" media="screen" rel="stylesheet" type="text/css" />
      <script src="../Js/jquery-1.10.2.js"></script>
      <script src="../Js/jquery-ui.js"></script>
      <link type="text/css" href="../Css/jquery-ui.css" rel="stylesheet" />
      <script type="text/javascript" src="facefiles/facebox.js"></script>
    </head>

    <body>

  <!-- ==== FOR HEADER =======-->
    <div class="header">
      <a href="#default" class="logo">Fantastic Member Cooperative</a>
    <div class="header-right">
          <a href="../Admin/Dashboard.php">Home</a>
      </div>
      
      <div class="header-rightx">
          <?php  if (isset($_SESSION['username'])) : ?>
              <p>Welcome <strong><?php echo $_SESSION['username']; ?></strong></p>
          <?php endif ?>
      </div>
    </div>

    <body></br></br>
        <table id="example" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>Transaction ID </th>
                    <th>Loan Amount</th>
                    <th>Interest</th>
                    <th>Terms</th>
                    <th>Monthly</th>
                    <th>Total Payment</th>
                    <th>Difference</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                  require'../php/connection.php';

                   if (isset($_GET['Idl'])) {
                        $id = $_GET['Idl'];


                    $show = ("SELECT loan.id, loan.amount, loan.date, loan.terms, loan.interest ,loan.monthly, loan.tamounts,loan.tamount, members.Id, members.firstname, members.lastname, members.middlename, members.exname FROM loan INNER JOIN members ON loan.mid=members.Id where mid='$id'");
                      $hows= mysqli_query ($connect, $show);
                      $shows= mysqli_query ($connect, $show);
                      $rows =mysqli_fetch_array($hows);
                        echo "<center>". "<h1>".$rows ['lastname'].", ".$rows['firstname']. " " .$rows['middlename']." ".$rows['exname']. "</h1>";
                        echo "<br> <br>";
                      while ($row = mysqli_fetch_assoc($shows))
                          
                        {?>

                      <tr id="<?php echo $row['Id']; ?>">

                          <td data-target="LoanId"><center><?php echo $row['id']; ?></td>
                          <td data-target="middlename"><center>₱ <?php $damount=$row['amount']; echo number_format($damount, 2);  ?></td>
                          <td data-target="exname"><center><?php echo $row['interest']; ?>%</td>
                          <td data-target="exname"><center><?php echo $row['terms']; ?></td>
                          <td data-target="exname"><center>₱ <?php  $monthly= $row['monthly'];  echo number_format($monthly,2);?></td>
                          <td data-target="exname"><center>₱ <?php $tamount = $row['tamount']; echo number_format($tamount,2) ?></td>
                          <td data-target="exname"><center>₱ <?php $defs = $row['tamounts']; echo number_format($defs,2) ?></td>
                          <td data-target="exname"><center><?php echo $row['date']; ?></td>
                          <?php
                            if ($defs <= 0) {?>
                          <td>
                            <a onclick="return confirmDelete(this);"  href=../php/delete-transactions.php?idd=<?php echo $row['id']; ?>><img src="../images/delete.png" width="25" ></a>
                            <a href=../pages/print.php?Idp=<?php echo $row['id']; ?>><img src="../images/print.png" width="35" ></a>
                          </td>
                        <?php }else {?>
                          <td>
                            <a onclick="return confirmDelete(this);"  href=../php/delete-transactions.php?idd=<?php echo $row['id']; ?>><img src="../images/delete.png" width="25" ></a>
                             <a href=../pages/print.php?Idp=<?php echo $row['id']; ?>><img src="../images/print.png" width="35" ></a>
                             <a href=../pages/-stat.php?id=<?php echo $row['Id']; ?>><img  src="../images/payment.png" width="35" ></a>
                             
                          </td>
                      
                      </tr>

                <?php }}} ?>
            </tbody>
            <tfoot>
                <tr>
                    <th>Transaction ID </th>
                    <th>Loan Amount</th>
                    <th>Interest</th>
                    <th>Terms</th>
                    <th>Monthly</th>
                    <th>Total Payment</th>
                    <th>Difference</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>

            </tfoot>

  <!--== DataTables =====-->
<!--<script type="text/javascript" src="../Js/jquery-3.3.1.js"></script> -->

  <!-- ==========JAVASCRIPT AREA  ======================-->

  <!--== DataTables =====-->
<!--<script type="text/javascript" src="../Js/jquery-3.3.1.js"></script> -->
    <script type="text/javascript" src="../Js/jquery.dataTables.min.js"></script>
    <script>
      $(document).ready(function() {
        $('#example').DataTable();
    } );
    </script>


  <!-- For NavBar Drop Down -->
    <script>
    /* When the user clicks on the button, 
    toggle between hiding and showing the dropdown content */
    function myFunction() {
      document.getElementById("myDropdown").classList.toggle("show");
    }

    // Close the dropdown if the user clicks outside of it
    window.onclick = function(event) {
      if (!event.target.matches('.dropbtn')) {
        var dropdowns = document.getElementsByClassName("dropdown-content");
        var i;
        for (i = 0; i < dropdowns.length; i++) {
          var openDropdown = dropdowns[i];
          if (openDropdown.classList.contains('show')) {
            openDropdown.classList.remove('show');
          }
        }
      }
    }
    </script>

      <script>
      function confirmDelete(link) {
         if (confirm("Are you sure you want to delete?")) {
            doAjax(link.href, "POST"); // doAjax needs to send the "confirm" field
         }
         return false;
      }

      function confirmDeletes(link) {
         if (confirm("Are you sure you want to delete?")) {
            doAjax(link.href, "POST"); // doAjax needs to send the "confirm" field
         }
         return false;
      }
  </script>


</body>
</html>



