<?php
  require_once("service.php");
function testAddStocks(){
  $data = array("stock_num"=>1111, "buy_date"=>date("Y-m-d"), "sale_date"=>"", "single_price"=>100, "number"=>3);
   addStockData($data);
}

function testAddList(){
  addList("myList");
}

function testAddListMembers(){
  $members = array("123", "456", "789");
  addListMembers("myList", $members);
}

function testGetAllLists(){
  $file = openDataFile("lists.csv", "a");
  echo $file;
  print_r(fgetc($file));
  fclose($file); 
}

print_r(getMembers("All"));
?>
