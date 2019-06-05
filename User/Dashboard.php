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

      <script>
          $(function() {
            $( "#tabs" ).tabs();
          $('a[rel*=facebox]').facebox();
          $( ".datepicker" ).datepicker();
          });
        $.extend($.expr[":"], 
        {
            "contains-ci": function(elem, i, match, array) 
          {
            return (elem.textContent || elem.innerText || $(elem).text() || "").toLowerCase().indexOf((match[3] || "").toLowerCase()) >= 0;
          }
        });
    </script>

  	</head>

  	<body>

	<!-- ==== FOR HEADER =======-->
  	<div class="header">
  		<div class="header-right">
      		<a href="../pages/logout.php" rel="facebox" style="color: red;">Logout</a>
    	</div>
  		<div class="dropdown">
  			<button onclick="myFunction()" class="dropbtn">Settings</button>
  			<div id="myDropdown" class="dropdown-content">
    			<a href="../pages/changepass-user.php">Change Password</a>
  			</div>
		</div>
    	<a href="#default" class="logo">Fantastic Member Cooperative</a>
		<div class="header-right">
      		<a class="active" href="#home">Home</a>
    	</div>
    	
    	<div class="header-rightx">
      		<?php  if (isset($_SESSION['username'])) : ?>
            	<p>Welcome <strong><?php echo $_SESSION['username']; ?></strong></p>
        	<?php endif ?>
    	</div>
  	</div>
  </br>
    <!-- ===== END OF HEADER ============================------>

    <div id="tabs">
        <ul>
          <li><a href="#Members">Members</a></li>
          <li><a href="#Trans">Transaction</a></li>
          <li><a href="#reports">Reports</a></li>
        </ul>

  <!------------- Members Tab------------>      
    <div id="Members">
      <!------------ facebox Modals ----------->
        <a href="../pages/adduser-user.php" rel="facebox"> <input id="buttons" type="submit" value="Add User"></a> 
      </br>
      <!------------ end of Facebox Modal ------>

          </br></br>
        <table id="example" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Middlename</th>
                    <th>Extension</th>
                    <th>Age</th>
                    <th>Address</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
              <?php
                  require'../php/connection.php';
                    $show = ("SELECT * From members");
                      $shows= mysqli_query ($connect, $show);
                      while ($row = mysqli_fetch_assoc($shows)){?>
                      <tr id="<?php echo $row['Id']; ?>">
                          <td data-target="firstname"><center><?php echo $row ['lastname']; echo', '; echo $row['firstname']; ?></td>
                          <td data-target="lastname"><center><?php echo $row['middlename']; ?></td>
                          <td data-target="middlename"><center><?php echo $row['exname']; ?></td>
                          <td data-target="exname"><center><?php echo $row['age']; ?></td>
                          <td data-target="address"><center><?php echo $row['address']; ?></td>
                          <td>
                            <a rel="facebox" href=../pages/edit.php?Id=<?php echo $row['Id']; ?>><img  src="../images/edit.png" width="25" ></a>
                            <a onclick="return confirmDelete(this);"  href=../php/delete.php?Ids=<?php echo $row['Id']; ?>><img src="../images/delete.png" width="25" ></a>
                            <a href=../pages/views.php?id=<?php echo $row["Id"] ?> ><img src="../images/detail.png" width="25" ></a>
                          </td>
                      </tr>
                  <?php } ?>
            </tbody>
            <tfoot>
                <tr>
                    <th>Name</th>
                    <th>Middlename</th>
                    <th>Extension</th>
                    <th>Age</th>
                    <th>Address</th>
                    <th>Action</th>
                </tr>
            </tfoot>
        </table>
    </div>


       <!------------------------- for Order ---------------------------------- -->

     <div id="Trans">
        <a href="addcustomer.php" rel="facebox"><input type="button" class="button button2" name="Add Customer" value="dasd"></a>
        <a href="addcustomers.php" rel="facebox"><input type="button" class="button button2" name="Add Customer" value="ADD "></a>  
        <a href="addcustomerc.php" rel="facebox"><input type="button" class="button button2" name="Add Customer" value="ADD "></a>  
      </div>


<!-- -------------------------   Sales    --------------------------------------  -->
   <div id="reports" >
       <a href="updateqty-exec.php">  <input class="button button2" type="submit" value="  Books Total"></a>
       </br></br>
     <form action="total.php" method="post">
     <h2> Report By Purchased</h2>
    From: <input type="text" class="datepicker" placeholder="Click me" name="dayfrom"> To: <input type="text" class="datepicker" placeholder="Click me" name="dayto">
    <input type="submit" value="Show Sales" name="salesbtn">
   </form>
  </div>

 
 

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
