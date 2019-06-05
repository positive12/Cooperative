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

  	<body onload="startTime()">
        
      <!-- ==== FOR HEADER =======-->
    	<div class="header">
      		<div class="header-right">
          		<a href="../pages/logout.php" rel="facebox" style="color: red;">Logout</a>
        	</div>
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
      <section id="dtime">
        <span id="date"></span><span id="clock"></span>
      </section>
        </br></br>



        <div id="tabs">
            <ul>
              <li><a href="#Members">Members</a></li>
              <li><a href="#Trans">Transaction</a></li>
              <li><a href="#loan  ">Loan</a></li>
              <li><a href="#reports">Reports</a></li>
            </ul>

          <!------------- Members Tab------------>      
            <div id="Members">
              <!------------ facebox Modals ----------->
                <a href="../pages/adduser.php" rel="facebox"> <input id="buttons" type="submit" value="Add User"></a> 
              </br>
              <!------------ end of Facebox Modal ------>
                  </br></br>
                <table id="example" class="display" style="width:100%">
                    <thead>

                        <tr>
                            <th>Name</th>
                            <th>Age</th>
                            <th>Address</th>
                            <th>Type</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php

                          require'../php/connection.php';
                          
                            $show = ("SELECT * From members order by lastname");
                              $shows= mysqli_query ($connect, $show);
                              while ($row = mysqli_fetch_assoc($shows)){

                                ?>
                              <tr id="<?php echo $row['Id']; ?>">
                                  <td data-target="firstname"><center><?php echo $row ['lastname'].", ".$row['firstname']. " " .$row['middlename']." ".$row['exname'];?></td>
                                  <td data-target="exname"><center><?php echo $row['age']; ?></td>
                                  <td data-target="address"><center><?php echo $row['address']; ?></td>
                                  <td data-target="lastname"><center><?php echo $row ['type'];?></center></td> 
                                  <td data-target="lastname"><center><?php echo $row ['date'];?></center></td> 
                                  <td>
                                    <a rel="facebox" href=../pages/edit.php?Id=<?php echo $row['Id']; ?>><img  src="../images/edit.png" width="25" ></a>
                                    <a onclick="return confirmDelete(this);"  href=../php/delete.php?Id=<?php echo $row['Id']; ?>><img src="../images/delete.png" width="35" ></a>
                                    <a href=../pages/views.php?id=<?php echo $row["Id"] ?> ><img src="../images/detail.png" width="35" ></a>
                                  </td>
                              </tr>
                          <?php } ?>
                    </tbody>
                    <tfoot>
                        <tr>
                             <th>Name</th>
                            <th>Age</th>
                            <th>Address</th>
                            <th>Type</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>




           <!------------------------- for Transaction ---------------------------------- -->

             <div id="Trans">
                <a href="../pages/transaction.php" rel="facebox"><input id="buttons" type="submit" value="Diposit"></a> 
                <a href="../pages/withdraw.php" rel="facebox"><input id="buttons" type="submit" value="Witdraw"></a> 
              </br></br>

                <table id="examples" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID Number</th>
                            <th>Name</th>
                            <th> Total Contribution</th>
                            <th>Total Witdraw</th>
                            <th>Difference</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php
                          require'../php/connection.php';
                            $show = ("SELECT * From members order by lastname");
                              $shows= mysqli_query ($connect, $show);
                               
                              while ($row = mysqli_fetch_assoc($shows)){
                                $contrib = $row['contrib'];
                                $withdraw = $row['withdraw'];
                                $difference = $row['difference'];
                                ?>

                              <tr id="<?php echo $row['Id']; ?>">
                                 <td data-target="exname"><center>  <?php echo $row['Id']; ?></td>
                                  <td data-target="firstname"><center><?php echo $row ['lastname'].", ".$row['firstname']. " " .$row['middlename']." ".$row['exname'];?></td>
                                  <td data-target="exname"><center> ₱ <?php echo number_format($contrib,2); ?></td>
                                  <td data-target="exname"><center> ₱ <?php echo number_format ($withdraw,2) ; ?></td>
                                  <td data-target="exname"><center> ₱ <?php echo number_format ($difference,2) ; ?></td>
                                  <td>
                                    <a href=../pages/Deposit-stat.php?Id=<?php echo $row['Id']; ?>><img src="../images/depo.png" width="35" ></a> |
                                    <a href=../pages/withdraw-stat.php?id=<?php echo $row['Id']; ?>><img  src="../images/with.jpg" width="35" ></a>
                                  </td>
                              </tr>
                      <?php } ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>ID Number</th>
                            <th>Name</th>
                            <th> Total Contribution</th>
                            <th>Total Witdraw</th>
                            <th>Difference</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
              </div>



              <!--========================================  Loan Area  ============================================= -->


             <div id="loan">
                <a href="../pages/loan.php" rel="facebox"><input id="buttons" type="submit" value="Loan"></a> 
              </br></br>

                <table id="loans" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID Number</th>
                            <th>Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php
                          require'../php/connection.php';
                            $show = ("SELECT loan.id, members.Id, members.firstname, members.lastname, members.middlename, members.exname FROM loan INNER JOIN members ON loan.mid=members.Id GROUP By mid ");
                              $shows= mysqli_query ($connect, $show);
                              while ($row = mysqli_fetch_array($shows)){

                                ?>

                              <tr id="<?php echo $row['Id']; ?>">
                                  <td data-target="exname"><center> ₱ <?php echo $row ['Id'] ; ?></td>
                                  <td data-target="firstname"><center><?php echo $row ['lastname'].", ".$row['firstname']. " " .$row['middlename']." ".$row['exname'];?></td>
                                  <td>
                                    <a href=../pages/loan-stat.php?Idl=<?php echo $row['Id']; ?>><img src="../images/loan.png" width="45" ></a> |
                                    <a href=../pages/withdraw-stat.php?id=<?php echo $row['Id']; ?>><img  src="../images/payment.png" width="45" ></a>
                                  </td>
                              </tr>
                      <?php } ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>ID Number</th>
                            <th>Name</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
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
        </div>
        <div class="containers">
          
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
              <script>
            $(document).ready(function() {
              $('#examples').DataTable();
            } );


          </script>

                        <script>
            $(document).ready(function() {
              $('#loans').DataTable();
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

        <script type="text/javascript"> 
      function startTime() {
          var today = new Date();
          var hr = today.getHours();
          var min = today.getMinutes();
          var sec = today.getSeconds();
          ap = (hr < 12) ? "<span>AM</span>" : "<span>PM</span>";
          hr = (hr == 0) ? 12 : hr;
          hr = (hr > 12) ? hr - 12 : hr;
          //Add a zero in front of numbers<10
          hr = checkTime(hr);
          min = checkTime(min);
          sec = checkTime(sec);
          document.getElementById("clock").innerHTML = hr + ":" + min + ":" + sec + " " + ap;
          
          var months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
          var days = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
          var curWeekDay = days[today.getDay()];
          var curDay = today.getDate();
          var curMonth = months[today.getMonth()];
          var curYear = today.getFullYear();
          var date = curWeekDay+", "+curDay+" "+curMonth+" "+curYear;
          document.getElementById("date").innerHTML = date;
          
          var time = setTimeout(function(){ startTime() }, 500);
      }
      function checkTime(i) {
          if (i < 10) {
              i = "0" + i;
          }
          return i;
      }
      </script>
     
     

    <?php include "../pages/footer.php"?>

</body>
</html>
