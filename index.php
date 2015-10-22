<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="js/jquery.magnific-popup.min.js" type="text/javascript"></script>
<script src="js/stock.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="css/magnific-popup.css"/>
<link rel="stylesheet" type="text/css" href="css/stock.css"/>
</head>
<body>
<H2>Return of Investment</H2>
<?php
  require_once("service.php");
?>
<div>
  <input type="button" value="buy stock" onclick="popupBuyForm()" />
  <input type="button" value="sell stock" onclick="popupSellForm()" />
<div>
<div id="stock_info_area">
<?php 
  require "lists.php";
  require "stocks.php";
  require "update_list_members_form.php";
?>
</div>
<div>
<input type="button" value="update list" onclick="updateListMembers()" />
</div>
<?php 
  require "stock_form.php";
?>
<div id="trade_detail" class="mfp-hide"></div>
</body>
<html>

