<?php
include_once "config.conf";
include_once "db_connect.php";

//include_once "lib/db/company.php";
//include_once "lib/db/accounttype.php";

?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Loan Manager</title>

<link rel="stylesheet" type="text/css" href="ext/resources/css/ext-all.css" />

    <!-- GC -->
 	<!-- LIBS -->
 	<script type="text/javascript" src="ext/adapter/ext/ext-base.js"></script>
 	<!-- ENDLIBS -->

    <script type="text/javascript" src="ext/ext-all.js"></script>

    <script type="text/javascript" src="GroupingView.js"></script>
    
    <link rel="stylesheet" type="text/css" href="grid-examples.css" />

<!-- Common Styles for the examples -->
<link rel="stylesheet" type="text/css" href="shared/examples.css" />
</head>
<body style="background: #cccccc;">
<script type="text/javascript" src="shared/examples.js"></script><!-- EXAMPLES -->

<div style="background: #cccccc; height: 600px;">
<table width=80%>
 <tr>
  <td style="background-color: #657383;">&nbsp;
  </td>
 </tr>
</table>

<table width=80%>
 <tr>
  <td><a href="index.php?page=company">Company</a></td>
  <td><a href="companytype.php">Company Type</a></td>
  <td><a href="index.php?page=account">Account</a></td>
  <td><a href="accounttype.php">Account Type</a></td>
  <td><a href="index.php?page=loan">Loan</a></td>
  <td><a href="index.php?page=schd">Schedule</a></td>
  <td><a href="index.php?page=tran">Transaction</a></td>
  <td><a href=""></a></td>
  </tr>
  </table>

<script type="text/javascript" src="appjs.php?page=<?php echo $_GET['page']; ?>"></script>