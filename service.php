<?php
// stocks.csv file format: stock_num, buy_date, sale_date, price, number
// lists.csv file format: name, member

$curr_list = "All";

function addStock($stock_num, $stock_name) {
  $stocks = openDataFile("stocks.csv", "a");
  fwrite($stocks, preg_replace("/.tw/", "", $stock_num).", ".$stock_name.PHP_EOL);
  fclose($stocks);
}

function addStockData($data){
  global $curr_list;
  $stock_data = openDataFile("stock_data.csv", "a");
  fwrite($stock_data, implode(", ", [$data["stock_num"], $data["buy_date"], $data["sale_date"], $data["price"], $data["amount"]]));
  fwrite($stock_data, PHP_EOL);
  fclose($stocks_data);
  addListMember($curr_list, $data["stock_num"]);
}

function changeCurrList($list_name) {
  global $curr_list;
  $curr_list = $list_name;
}

function addList($list_name){
  $list_file = openDataFile("lists.csv", "a");
  fwrite($list_file, $list_name.",".PHP_EOL);
  fclose($list_file);
}

function getAllLists(){
   $list_file = openDataFile("lists.csv", "r");
   $list_names = csvFileToArray($list_file);
   fclose($list_file);
  return $list_names;
}

function addListMember($list_name, $member) {
  $list_file = openDataFile("lists.csv", "r+");
  $lists = csvFileToArray($list_file, 0);
  fclose($list_file);

  $i = $lists[$list_name][1];
  if($i && !in_array($member, explode("|", $i))) {
    $lists[$list_name][1] = $i."|".$member;
  }else{
    $lists[$list_name][1] = $member;
  }
  
  putArrayIntoListsCsvFile($lists);
}

function updateListMembers($list_name, $members) {
  $list_file = openDataFile("lists.csv", "r+");
  $lists = csvFileToArray($list_file, 0);
  fclose($list_file);

  // clear old file and fill in latest data 
  if($list_name !== "All" && array_key_exists($list_name, $lists)) {
    $lists[$list_name][1] = implode("|", $members);
    putArrayIntoListsCsvFile($lists);
  }
}

function putArrayIntoListsCsvFile($lists) {
  if(!empty($lists)) {
    $list_file = openDataFile("lists.csv", "w");
    foreach($lists as $list) {
      fputcsv($list_file, $list);
    }
    fclose($list_file);
  }
}

function openDataFile($file_name, $mode){
  $path = __FILE__;
  $dir = pathinfo($path, PATHINFO_DIRNAME);
  if(!opendir($dir."/data")){
    mkdir($dir."/data");
  }
  $file = fopen($dir."/data/".$file_name, $mode);
  return $file;
}

function csvFileToArray($file, $index=null){
  $rets = array();
  while(($csv = fgetcsv($file)) !== false) {
    if($index !== null ){
      $rets[$csv[$index]] = $csv;
    } else {
      $rets[] = $csv;
    }
  }
  return $rets;
}

// stock_num, stock_name, stock_price
function getYahooFinance($stock_num){
  $url = "http://finance.yahoo.com/d/quotes.csv?s=".$stock_num.".tw&f=snl1";
  $stock_cvs = file_get_contents($url);
  $temp = "temp.csv";
  file_put_contents("data/".$temp, $stock_cvs);

  $path = __FILE__;
  $dir = pathinfo($path, PATHINFO_DIRNAME);
  $file = fopen($dir."/data/".$temp, "r+");
  $stock_infos = fgetcsv($file);
  fclose($temp);
  return $stock_infos;
}

function checkIfStockExist($stock_num){
  $file = openDataFile("stocks.csv", "a");
  $stocks = csvFileToArray($file, 0);
  fclose($file);

  if(empty($stocks)) return false;

  return array_key_exists($stock_num, $stocks);
}

function addStockInfos($stock_num){
  if(!checkIfStockExist($stock_num)) {
    $stock_infos = getYahooFinance($stock_num);
    addStock($stock_infos[0], $stock_infos[1]);
  }
}

function getMembers($list_name) {
  $file = openDataFile("lists.csv", "r");
  $lists = csvFileToArray($file, 0);
  fclose($file);
  
  if(empty($lists)) return array();

  if(array_key_exists($list_name, $lists)) {
    $i = $lists[$list_name][1];
    if($i) return explode("|", $i);
  }

  return array();
}

function getStocksInCurrList() {
  global $curr_list;
  $members = getMembers($curr_list);
  if(empty($members)) return array();

  $file = openDataFile("stocks.csv", "r");
  $lists = csvFileToArray($file, 0);
  fclose($file);
  if(empty($lists)) return array();

  $rets = array();
  foreach($members as $member) {
    if(array_key_exists($member, $lists)) {
      $rets[] = array("stock_num"=>$member, "stock_name"=>$lists[$member][1]); 
    }
  }
  return $rets;
}

function getPricesInCurrList() {
  global $curr_list;
  $members = getMembers($curr_list);
  if(empty($members)) return array();

  $file = openDataFile("stock_data.csv", "r");
  $stocks = csvFileToArray($file);
  fclose($file);

  $prices = array();
  $amounts = array();
  foreach($members as $member) {
    $prices[$member] = 0;
    $amounts[$member] = 0;
  }
 
  foreach($stocks as $stock) {
    if(in_array($stock[0], $members)) {
      if($stock[1] != " ") {
        $prices[$stock[0]] += $stock[3] * $stock[4];
        $amounts[$stock[0]] += $stock[4];
      } elseif($stock[2] != " ") {
        $prices[$stock[0]] -= $stock[3] * $stock[4];
        $amounts[$stock[0]] -= $stock[4];
      }
    }
  }
  foreach($members as $member) {
    $prices[$member] = round($prices[$member] / $amounts[$member], 2);
  }

  return $prices;
}

function getAmountsInCurrList() {
  global $curr_list;
  $members = getMembers($curr_list);
  if(empty($members)) return array();

  $file = openDataFile("stock_data.csv", "r");
  $stocks = csvFileToArray($file);
  fclose($file);

  $amounts = array();
  foreach($members as $member) {
    $amounts[$member] = 0;
  }
 
  foreach($stocks as $stock) {
    if(in_array($stock[0], $members)) {
      if($stock[1]!=" ") {
        $amounts[$stock[0]] += $stock[4];
      } elseif($stock[2]!=" ") {
        $amounts[$stock[0]] -= $stock[4];
      }
    }
  }

  return $amounts;
}


function getValuesInCurrList() {
  global $curr_list;
  $members = getMembers($curr_list);
  if(empty($members)) return array();

  $values = array();
  foreach($members as $member) {
    $values[$member] = getYahooFinance($member)[2];
  }
  
  return $values;
}

?>
