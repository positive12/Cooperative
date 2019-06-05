<?php
	require 'connection.php';
        if(isset($_POST['edit_user'])) {

        	$id = mysqli_real_escape_string ($connect, $_POST['Id']);
        	$fname = mysqli_real_escape_string ($connect, $_POST['fname']);
        	$lname = mysqli_real_escape_string ($connect, $_POST['lname']);
            $mname  =mysqli_real_escape_string ($connect, $_POST['mname']);
            $ename = mysqli_real_escape_string ($connect, $_POST['ename']);
            $address = mysqli_real_escape_string ($connect, $_POST['address']);
            $age = mysqli_real_escape_string ($connect, $_POST['age']);
            $type = mysqli_real_escape_string ($connect, $_POST['type']);

            $update = "UPDATE members SET firstname = '$fname',  lastname ='$lname', middlename = '$mname',  exname ='$ename', address ='$address', age = '$age', type = '$type' WHERE Id = '$id'";
            $updates = mysqli_query($connect, $update);

            if (!$updates) {
            	echo "ERROR DISOLAY";
            }else{
            	header('Location: ../Admin/Dashboard.php');
            }
        }

        //------- Users
        if(isset($_POST['edit_users'])) {

            $id = mysqli_real_escape_string ($connect, $_POST['Id']);
            $fname = mysqli_real_escape_string ($connect, $_POST['fname']);
            $lname = mysqli_real_escape_string ($connect, $_POST['lname']);
            $mname  =mysqli_real_escape_string ($connect, $_POST['mname']);
            $ename = mysqli_real_escape_string ($connect, $_POST['ename']);
            $address = mysqli_real_escape_string ($connect, $_POST['address']);
            $age = mysqli_real_escape_string ($connect, $_POST['age']);
            $type = mysqli_real_escape_string ($connect, $_POST['type']);

            $update = "UPDATE members SET firstname = '$fname',  lastname ='$lname', middlename = '$mname',  exname ='$ename', address ='$address', age = '$age', type = '$type' WHERE Id = '$id'";
            $updates = mysqli_query($connect, $update);

            if (!$updates) {
                echo "ERROR DISOLAY";
            }else{
                header('Location: ../User/Dashboard.php');
            }
        }




?>