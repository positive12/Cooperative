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
      <div class="dropdown">
        <button onclick="myFunction()" class="dropbtn">Settings</button>
        <div id="myDropdown" class="dropdown-content">
          <a href="../pages/changepass.php">Change Password</a>
          <a href="../pages/register.php">Register</a>
          <a href="../pages/users.php">Users</a>
        </div>
    </div>
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
                    <th>Username</th>
                    <th>Role</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
              <?php
                  require'../php/connection.php';
                    $users = $_SESSION['username'];
                    $show = ("SELECT * From users WHERE NOT username = '$users'");
                      $shows= mysqli_query ($connect, $show);
                      while ($row = mysqli_fetch_assoc($shows)){?>
                      <tr id="<?php echo $row['Id']; ?>">

                          <td data-target="lastname"><center><?php echo $row['Username']; ?></td>
                          <td data-target="middlename"><center><?php echo $row['Role']; ?></td>
                          <td data-target="exname"><center><?php echo $row['Date']; ?></td>

                          <td>
                            <a onclick="return confirmDelete(this);"  href=../php/delete.php?id=<?php echo $row['Id']; ?>><img src="../images/delete.png" width="25" ></a>
                          </td>
                      </tr>
                  <?php } ?>
            </tbody>
            <tfoot>
                <tr>
                    <th>Username</th>
                    <th>Date</th>
                    <th>Role</th>
                    <th>Action</th>
                </tr>
            </tfoot>
        </table>
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
