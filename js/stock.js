function popupBuyForm(){
  $.magnificPopup.open({
    items: {
      src: $('#buy_form'),
      type: 'inline'
    }
  });
}

function popupSellForm(){
  $.magnificPopup.open({
    items: {
      src: $('#sell_form'),
      type: 'inline'
    }
  });
}

function update_list(){
  $.magnificPopup.open({
    items: {
      src: $('#update_list_form'),
      type: 'inline'
    }
  });
}

function load_trade_detail($stock_num) {
  $.magnificPopup.open({
    items: {
      src: $('#update_list_form'),
      type: 'inline'
    }
  });
}

function addList(){
  var list_name = prompt('enter a list name you want to create.');
  
  if(list_name){
    $.post("ajax_service.php", {'method':'addList', 'list_name':list_name})
     .done(function(data){
	$("#stock_info_area").html(data);
      });
  }
}

function changeList(list_name) {
  $.post("ajax_service.php", {'method':'changeList', 'list_name':list_name})
   .done(function(data){
      $("#stock_info_area").html(data);
    });
}

