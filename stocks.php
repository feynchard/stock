<?php
function roi($price, $value) {
  $diff = $value - $price;
  return round($diff / $price, 2);
}

$total_price = 0;
$total_value = 0;
$stocks = getStocksInCurrList();
$prices = getPricesInCurrList();
$amounts = getAmountsInCurrList();
$values = getValuesInCurrList();

?>
<table <?=empty($stocks)?"style='display:none'":""?>>
  <tr>
    <th>stock</th>
    <th>price</th>
    <th>value</th>
    <th>amount</th>
    <th>ROI</th>
  </tr>
  <?php
    foreach($stocks as $stock) {
      $price = $prices[$stock["stock_num"]];
      $value = $values[$stock["stock_num"]];
      $amount = $amounts[$stock["stock_num"]];
      $total_price += $price * $amount;
      $total_value += $value * $amount;
  ?>
  <tr>
    <td><a href="#" onclick="load_trade_detail(".$stock["stock_num"].")"><?=$stock["stock_name"]?></a></td>
    <td><?=$price?></td>
    <td><?=$value?></td>
    <td><?=$amount?></td>
    <td><?=roi($price, $value)?></td>
  </tr>
  <?php } ?>
  <tr>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td><?=roi($total_price, $total_value)?></td>
  </tr>
</table>

