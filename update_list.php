<table>
  <tr>
    <th></th>
    <th>stock</th>
  </tr>
  <?php
    foreach($stock_names as $stock_name) {
  ?>
  <tr>
    <td><input type="checkbox" name="stock" value="<?=$stock_num?>"/></td>
    <td><?=$stock_name?></td>
  </tr>
  <? } ?>
</table>
