<form id="buy_form" action="ajax_service.php" method="post" class="mfp-hide">
  <table>
     <tr>
         <th>stock number</th>
         <td><input type="text" name="stock_num" required ></td>
     </tr>
     <tr>
         <th>price</th>
         <td><input type="text" name="price" required /></td>
     </tr>
     <tr>
         <th>amount</th>
         <td><input type="text" name="amount" required /></td>
     </tr>
     <tr>
         <th>buy date</th>
         <td><input type="text" name="buy_date" required /></td>
     </tr>
     <tr>
         <th></th>
         <td><input type="submit" value="add" /></td>
     </tr>
  </table>
  <input type="hidden" name="method" value="buyStock" />
</form>
<form id="sell_form" action="ajax_service.php" method="post" class="mfp-hide">
  <table>
     <tr>
         <th>stock number</th>
         <td><input type="text" name="stock_num" /></td>
     </tr>
     <tr>
         <th>price</th>
         <td><input type="text" name="price" /></td>
     </tr>
     <tr>
         <th>amount</th>
         <td><input type="text" name="amount" /></td>
     </tr>
     <tr>
         <th>sell date</th>
         <td><input type="text" name="sell_date" /></td>
     </tr>
     <tr>
         <th></th>
         <td><input type="submit" value="add" /></td>
     </tr>
  </table>
  <input type="hidden" name="method" value="sellStock" />
</form>

