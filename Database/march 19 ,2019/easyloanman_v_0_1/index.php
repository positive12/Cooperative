<?php
include 'lib/header.php';

 switch ($_GET['page']) {
	 
	 case 'account':
		 include "account.php";
	     break;
	 case 'company':
		 include "company.php";
	     break;
	 case 'loan':
		 include 'loan.php';
	     break;
	 case 'schd':
		 include 'schedule.php';
	     break;
     case 'tran':
		 include 'transaction.php';
	     break;
     default:
		 include "account.php";
	     break; 
    
 }

include 'lib/footer.php';
?>