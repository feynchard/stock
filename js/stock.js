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

function updateListMembers(){
  $.magnificPopup.open({
    items: {
      src: $('#update_list_members_form'),
      type: 'inline'
    }
  });
}

function load_trade_detail(stock_num) {
   $.post("ajax_service.php", {'method':'loadTradeDetail', 'stock_num':stock_num})
   .done(function(data){
      $("#trade_detail").html(data);
   });
  console.log($('#trade_detail'));
  $.magnificPopup.open({
    items: {
      src: $('#trade_detail'),
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

