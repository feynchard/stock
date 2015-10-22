<?php
  $trade_detail = loadTradeDetail();
?>

<table>
  <tr>
    <th>stock num</th>
    <th>buy date</th>
    <th>sell date</th>
    <th>price</th>
    <th>amount</th>
  </tr>
  <?php 
    foreach($trade_detail as $each) {
  ?>
  <tr>
    <td><?=$each[0]?></td>
    <td><?=$each[1]?></td>
    <td><?=$each[2]?></td>
    <td><?=$each[3]?></td>
    <td><?=$each[4]?></td>
  </tr>
  <?php } ?>
</table>
