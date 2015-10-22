<?php
require_once("service.php");

ajaxResponse();

function ajaxResponse(){
  if($_POST){
    if($_POST["method"] === "addList") {
      addList($_POST["list_name"]);
      changeCurrList($_POST["list_name"]);
      include("lists.php");
      include("stocks.php");
      include("update_list_members_form.php");
    }elseif($_POST["method"] === "changeList") {
      changeCurrList($_POST["list_name"]);
      include("lists.php");
      include("stocks.php");
      include("update_list_members_form.php");
    }elseif($_POST["method"] === "buyStock") {
      addStockInfos($_POST["stock_num"]);
      $data = array("stock_num"=>$_POST["stock_num"], "buy_date"=>$_POST["buy_date"], "sale_date"=>"", "price"=>$_POST["price"], "amount"=>$_POST["amount"]);
      addStockData($data);
      header("Location: index.php");
    }elseif($_POST["method"] === "sellStock") {
      addStockInfos($_POST["stock_num"]);
      $data = array("stock_num"=>$_POST["stock_num"], "buy_date"=>"", "sale_date"=>$_POST["sell_date"], "price"=>$_POST["price"], "amount"=>$_POST["amount"]);
      addStockData($data);
      header("Location: index.php");  
    }elseif($_POST["method"] === "updateListMembers") {
      updateCurrListMembers($_POST["stocks"]);
      header("Location: index.php");  
    }elseif($_POST["method"] === "loadTradeDetail") {
      setViewStock($_POST["stock_num"]);
      require("trade_detail.php");
    }
  }
}

?>
