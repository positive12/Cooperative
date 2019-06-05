<?php include "../php/asession.php" ?>
<?php include "../php/edit-exec.php" ?>
    <?php
        require '../php/connection.php';
        if (isset($POST['Id'])) {
                $id = $_POST['Id'];

                $select =("SELECT * from members where Id='$id'");
                $stmt = mysqli_query($connect, $select);

                $row=mysqli_fetch_assoc($stmt);
                // $id = $row['Id'];
                $fname = $row['firstname'];
                $lname  = $row['lastname'];
                $mname  =$row['middlename'];
                $ename = $row['exname'];
                $address = $row['address'];
                $age = $row['age'];
                $type = $row['type'];
        }
        else{   echo "Nothing found";
        }

    ?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="../Css/styless.css">
</head>
<body>
<form action="../php/edit-exec.php" method= "POST">
  <div class="container">

    <input type="hidden"  name="Id"  value="<?php echo $id; ?>" >

    <label for="uname"><b>First Name:</b></label>
    <input type="text"  name="fname"  value="<?php echo $fname; ?>" >

    <label for="uname"><b>Last Name:</b></label>
    <input type="text" name="lname" value="<?php echo $lname; ?>">

    <label for="psw"><b>Middle Name</b></label>
    <input type="text" name="mname" value="<?php echo $mname; ?>"  >

    <label for="psw"><b>Extension Name</b></label>
    <input type="text"  name="ename" value="<?php echo $ename; ?>" >

    <label for="psw"><b>Age</b></label>
    <input type="text" name="age" id="tbNumbers" value="<?php echo $age; ?>" >

    <label for="psw"><b>Address</b></label>
    <input type="text"  name="address" value="<?php echo $address; ?>" >

    <label for="psw"><b>Type</b></label>
    <select name="type" class="select" >
        <option selected="false" value="<?php echo $type; ?>" style="display:none;"> <?php echo $type; ?></option>
        <option name="Regular" value="Regular">Regular</option>
        <option name="Casual" value="Casual">Casual</option>
    </select>
        
    <button type="submit" name="edit_users">Submit</button>
  </div>
</form>
<script>
    // WRITE THE VALIDATION SCRIPT.
    function isNumber(evt) {
        var iKeyCode = (evt.which) ? evt.which : evt.keyCode
        if (iKeyCode != 46 && iKeyCode > 31 && (iKeyCode < 48 || iKeyCode > 57))
            return false;

        return true;
    }    
</script>