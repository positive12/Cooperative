<?php include "../php/asession.php" ?>
<head>
    <link rel="stylesheet" type="text/css" href="../Css/styless.css">
</head>
  	<form method="post" action="../php/loan-exc.php">
  		<fieldset>
			<h1><legend><U>Loan Transaction</U></legend></h1>
				<label for="uname">Member:</label>
		        <select name="admembers" class="select" required>
		            <option selected="false" value="" disabled="disabled" required>Choose Members</option>
		               <?php
		                require'../php/connection.php';
		                        $show = ("SELECT * From members order by lastname");
		                        $query = mysqli_query($connect, $show);
		                        while ($row = mysqli_fetch_assoc($query)) {
		                          $id = $row['Id'];
		                          $name = $row ['firstname'];
		                          $lname = $row ['lastname'];       
		                ?>
		            <option value="<?php echo $id; ?>"><?php echo $lname;?> ,<?php echo $name;?></option>
		                <?php } ?>
		        </select>

		        <label for="uname">Amount:</label>
        			<input type="text" name="lamount" id="currency-field" pattern="^\₱\d{1,3}(,\d{3})*(\.\d+)?" value="" data-type="currency" placeholder="₱1,000,000.00">

        		<label for="uname">Interest:</label>
        			<input type="text" name="interest" id="tbNumbers" value=""  onkeypress="javascript:return isNumber(event)" placeholder="Interest Rate" maxlength="4" >

        		<label for="uname">Payment Terms:</label>
	        		<select name="terms" class="selects" required>
			            <option selected="false" value="" disabled="disabled" required>Payment Terms</option>
			           		<?php
		                    	for ($i=1; $i <= 40; $i++) { 
	                    	?>
			            <option value="<?php echo $i ;?>"><?php echo $i ;?></option>
			                <?php } ?>
			        </select>

        		<button type="submit" name="loan_exc">Add</button>
	</form>
	
	<script>
		// Jquery Dependency

		$("input[data-type='currency']").on({
		    keyup: function() {
		      formatCurrency($(this));
		    },
		    blur: function() { 
		      formatCurrency($(this), "blur");
		    }
		});


		function formatNumber(n) {
		  // format number 1000000 to 1,234,567
		  return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",")
		}


		function formatCurrency(input, blur) {
		  // appends $ to value, validates decimal side
		  // and puts cursor back in right position.
		  
		  // get input value
		  var input_val = input.val();
		  
		  // don't validate empty input
		  if (input_val === "") { return; }
		  
		  // original length
		  var original_len = input_val.length;

		  // initial caret position 
		  var caret_pos = input.prop("selectionStart");
		    
		  // check for decimal
		  if (input_val.indexOf(".") >= 0) {

		    // get position of first decimal
		    // this prevents multiple decimals from
		    // being entered
		    var decimal_pos = input_val.indexOf(".");

		    // split number by decimal point
		    var left_side = input_val.substring(0, decimal_pos);
		    var right_side = input_val.substring(decimal_pos);

		    // add commas to left side of number
		    left_side = formatNumber(left_side);

		    // validate right side
		    right_side = formatNumber(right_side);
		    
		    // On blur make sure 2 numbers after decimal
		    if (blur === "blur") {
		      right_side += "";
		    }
		    
		    // Limit decimal to only 2 digits
		    right_side = right_side.substring(0, 2);

		    // join number by .
		    input_val = "₱" + left_side + "." + right_side;

		  } else {
		    // no decimal entered
		    // add commas to number
		    // remove all non-digits
		    input_val = formatNumber(input_val);
		    input_val = "₱" + input_val;
		    
		    // final formatting
		    if (blur === "blur") {
		      input_val += "";
		    }
		  }
		  
		  // send updated string to input
		  input.val(input_val);

		  // put caret back in the right position
		  var updated_len = input_val.length;
		  caret_pos = updated_len - original_len + caret_pos;
		  input[0].setSelectionRange(caret_pos, caret_pos);
		}



	</script>

	<!------ For The Number Validations ------>
<!-- 	<script>
    function isNumber(evt) {
        var iKeyCode = (evt.which) ? evt.which : evt.keyCode
        if (iKeyCode != 46 && iKeyCode > 31 && (iKeyCode < 48 || iKeyCode > 57))
            return false;

        return true;
    }    
	</script>
 -->