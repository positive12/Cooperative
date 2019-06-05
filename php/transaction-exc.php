	<?php
	include "../php/asession.php";
	require "connection.php";
	$date = date('m/d/Y');
		if (isset($_POST['tras_exc'])) {
			$addtrans =   mysqli_real_escape_string ($connect, $_POST['addtrans']);
			$amounts  =	  mysqli_real_escape_string  ($connect, $_POST['amount']);
			$search =  array('₱' ,',');
			$replace = array('','' );
			$amount = str_replace($search, $replace, $amounts);
			

			if ($amount <= 0 || empty($addtrans) || empty($amount)) {
		    	echo '
			        <link rel="stylesheet" type="text/css" href="../Css/try.css">
			        <div id="myModal" class="">
			            <div class="modal-content">
				            <div class="modal-header">
				                <a href="../Admin/Dashboard.php"><span class="close">&times;</span></a>
				                <h2></br><br></h2>
				            </div>
				            <div class="modal-body"></br><br>
				                <h1> <center> Stop, Ypu have Less Than 0 Transaction!</h1></br><br> 
				            </div>
				            <div class="modal-footer">
				                <h3> </br><br></h3>
				             </div>
			            	</div>
			         </div>';
			         exit();
			    }else{
				     	$select = ("SELECT * from members where Id= '$addtrans'");
							$query  = mysqli_query($connect, $select);

								$row = mysqli_fetch_assoc($query);
						            $id = $row['Id'];
						            $qty = $row['contrib'];
						            $deff =$row ['difference'];
						            $withdraw =$row ['withdraw'];
						        	$total = $qty + $amount;
						        	$deffs = $deff + $amount; 

						    if ($deff == 0  and $withdraw == 0) {
					    	$insert = ("INSERT INTO Diposit (Idd, damount, mid, date) VALUES (null, '$amount', $id, '$date')");
					    	$querys = mysqli_query($connect, $insert);

					    	$update = ("UPDATE members SET contrib ='$total' where Id= '$id'");
					    	$queryUP = mysqli_query($connect, $update);

					    	header('Location: ../Admin/Dashboard.php?success=successfully');
					    	exit();

					    	}else{
					    	$insert = ("INSERT INTO Diposit (Idd, damount, mid, date) VALUES (null, '$amount', $id, '$date')");
					    	$querys = mysqli_query($connect, $insert);

					    	$update = ("UPDATE members SET contrib ='$total' where Id= '$id'");
					    	$queryUP = mysqli_query($connect, $update);

					    	$update = ("UPDATE members SET difference ='$deffs' where Id= '$id'");
					    	$queryUP = mysqli_query($connect, $update);

					   
					    header('Location: ../Admin/Dashboard.php?success=successfully');
				    }
			    }
		}

?>
<!------ Withdraw PHP ----------->

<?php
	require "connection.php";
	$date = date('m/d/Y');
		if (isset($_POST['with_exc'])) {
			$addtrans = mysqli_real_escape_string ($connect, $_POST['addtrans']);
			$amounts  =	  mysqli_real_escape_string  ($connect, $_POST['amount']);
			$search =  array('₱' ,',');
			$replace = array('','' );
			$amount = str_replace($search, $replace, $amounts);


			if ($amount <= 0 || empty($addtrans) || empty($amount)) {
		    	echo '
			        <link rel="stylesheet" type="text/css" href="../Css/try.css">
			        <div id="myModal" class="">
			            <div class="modal-content">
				            <div class="modal-header">
				                <a href="../Admin/Dashboard.php"><span class="close">&times;</span></a>
				                <h2></br><br></h2>
				            </div>
				            <div class="modal-body"></br><br>
				                <h1> <center> Stop, Ypu have Less Than 0 Transaction!</h1></br><br> 
				            </div>
				            <div class="modal-footer">
				                <h3> </br><br></h3>
				             </div>
			            	</div>
			         </div>';
			         exit();
			    }else{

					$select = ("SELECT * from members where Id= '$addtrans'");
					$query  = mysqli_query($connect, $select);

						$row = mysqli_fetch_assoc($query);
				            $id = $row['Id'];
				            $qty = $row['contrib'];
				            $with = $row['withdraw'];
				            $difference = $row['difference'];
				        	$total = $qty - $amount;
				        	$sub = $difference - $amount;
				        	$twith = $amount + $with;

					    if ($difference == 0 and $with == 0) {

					    	if ($qty >= $amount) {
						    $insert = ("INSERT INTO withdraw (Idw, wamount, mid, date) VALUES (null, '$amount', $id, '$date')");
						    $querys = mysqli_query($connect, $insert);

						    $update = ("UPDATE members SET difference ='$total' where Id= '$id'"); /*instet sa deffence*/
						    $queryUP = mysqli_query($connect, $update);

						    $updates = ("UPDATE members SET withdraw ='$twith' where Id= '$id'");
						    $queryUP = mysqli_query($connect, $updates);

						    header('Location: ../Admin/Dashboard.php?success=successfully');
						 	}
						 	
					    }
					    if ($difference >= $amount) {
								$insert = ("INSERT INTO withdraw (Idw, wamount, mid, date) VALUES (null, '$amount', $id, '$date')");
							    $querys = mysqli_query($connect, $insert);

							    $update = ("UPDATE members SET difference ='$sub' where Id= '$id'"); /*instet sa deffence*/
							    $queryUP = mysqli_query($connect, $update);

							    $updates = ("UPDATE members SET withdraw ='$twith' where Id= '$id'");
							    $queryUP = mysqli_query($connect, $updates);
							    header('Location: ../Admin/Dashboard.php?success=successfully');
						 		
						 	}else{
						 		echo '
						        <link rel="stylesheet" type="text/css" href="../Css/try.css">
						        <div id="myModal" class="">
						            <div class="modal-content">
							            <div class="modal-header">
							                <a href="../Admin/Dashboard.php"><span class="close">&times;</span></a>
							                <h2></br><br></h2>
							            </div>
							            <div class="modal-body"></br><br>
							                <h1> <center> Stop, Invalid Transaction!</h1></br><br> 
							            </div>
							            <div class="modal-footer">
							                <h3> </br><br></h3>
							             </div>
						            	</div>
						         </div>';
						 	 } 	 
				}   	
		}

?>

