<form id="update_list_members_form" action="ajax_service.php" method="post" class="mfp-hide">
<table>
  <tr>
    <th></th>
    <th>stock</th>
  </tr>
  <?php
    $stocks = getStocks("All");
    foreach($stocks as $stock) {
  ?>
  <tr>
    <td><input type="checkbox" name="stocks[]" value="<?=$stock["stock_num"]?>"/></td>
    <td><?=$stock["stock_name"]?></td>
  </tr>
  <?php } ?>
  <tr>
    <td></td>
    <td><input type="submit" value="update" /></td>
  </tr>
</table>
<input type="hidden" name="method" value="updateListMembers" />
</form>
