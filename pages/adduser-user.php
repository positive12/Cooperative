<?php include('../php/adduser-exec.php') ?>
<?php include "../php/session.php" ?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="../Css/styless.css">
</head>
<body>
<form action="../php/adduser-exec.php" method= "POST">
  <div class="container">

  	<?php include('../php/errors.php'); ?>
    <label for="uname"><b>First Name:</b></label>
    <input type="text"  name="fname"  placeholder="First Name">

    <label for="uname"><b>Last Name:</b></label>
    <input type="text" name="lname" placeholder="LastName">

    <label for="psw"><b>Middle Name</b></label>
    <input type="text" name="mname"  placeholder="Middle Name" >

    <label for="psw"><b>Extension Name</b></label>
    <input type="text"  name="ename" placeholder="Extension Name" >

    <label for="psw"><b>Age</b></label>
    <input type="text" name="age" id="tbNumbers" value=""  onkeypress="javascript:return isNumber(event)" placeholder="Age" maxlength="2" >

    <label for="psw"><b>Address</b></label>
    <input type="text"  name="address" placeholder="Address" >

    <label for="psw"><b>Type</b></label>
    <select name="type" class="select" required>
        <option selected="false" value="" disabled="disabled" required>Choose Type</option>
        <option name="Regular" value="Regular">Regular</option>
        <option name="Casual" value="Casual">Casual</option>
    </select>
        
    <button type="submit" name="add_users">Submit</button>
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
<!-- Max Length FOr numbers -->
<script>
$('.test-input').unbind('keyup change input paste').bind('keyup change input paste',function(e){
    var $this = $(this);
    var val = $this.val();
    var valLength = val.length;
    var maxCount = $this.attr('maxlength');
    if(valLength>maxCount){
        $this.val($this.val().substring(0,maxCount));
    }
}); 
</script>