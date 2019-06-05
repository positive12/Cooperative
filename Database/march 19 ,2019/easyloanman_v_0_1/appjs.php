
Ext.onReady(function() {
Ext.QuickTips.init();

Ext.BLANK_IMAGE_URL = '/finman/ext/resources/images/default/s.gif'; 
<?php

 switch ($_GET['page']) {
	 
	 case 'account':
		 include 'js/account.inc';
	     break;
     case 'company':
		 include 'js/company.inc';
	     break;
	 case 'loan':
		 include 'js/loan.inc';
	     break;
	 case 'schd':
		 include 'js/schedule.inc';
	     break;
	 case 'tran':
		 include "js/transaction.inc";
	     break;

 }

?>
});