<select onchange="changeList(this.value)">
  <?php
    global $curr_list;
    $lists = getAllLists();
    foreach($lists as $list) { 
      $list_name = $list[0];
  ?>
    <option value="<?=$list_name?>" <?=$curr_list===$list_name?selected:""?>><?=$list_name?></option> 
  <?php } ?>
</select>

<input type="button" value="add list" onclick="addList()" />
