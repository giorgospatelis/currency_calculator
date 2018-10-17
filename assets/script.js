(function($){
  /*
  * App navigation
  */
  $("#add-currency").click(function(){
    $.ajax({
      url:"requests.php",
      type:"post",
      data: {"show":"add-currency"},
      success: function(response){
        $('#mainview').slideUp();
        $("#mainview").html(response);
        $('#mainview').slideDown();
      }
    });
  });
  
  $("#currency-converter").click(function(){
    $.ajax({
      url:"requests.php",
      type:"post",
      data: {"show":"currency-converter"},
      success: function(response){
        $('#mainview').slideUp();
        $("#mainview").html(response);
        $('#mainview').slideDown();
      }
    });
  });
  
  /*
  * Converter functionality
  */
  $(document).on('keypress', '.base_currency', function(event){
    if(event.which < 46
    || event.which > 59) {
        event.preventDefault();
    } // prevent if not number/dot

    if(event.which === 46 && $(this).val().indexOf('.') !== -1) {
        event.preventDefault();
    }// prevent if dot already in value
  });
  
  $(document).on('keyup', '.base_currency', function(){
    var val = $(this).val();
    var base = $(this).attr("id");
    var posting = $.post({
      url:"requests.php",
      data:{"base_id" : base, "value" : val}
    });
    posting.done(function( response ){
      var data = $.parseJSON(response);
      for(var i in data){
        var target_currency = ".to_"+data[i][0];
        $(target_currency).val(data[i][1]);
      }
    });
  });
  
  $(document).on('change', '.select_base', function(){
    $(".base_currency").val(0);
    var new_base = $(".select_base option:selected").val();
    $(".base_currency").attr("id",new_base);
    var posting = $.post({
      url:"requests.php",
      data:{"show":"refresh-converter","base_id":new_base}
    });
    posting.done(function(response){
      $('#convert_to_currencies').slideUp();
      $('#convert_to_currencies').html(response);
      $('#convert_to_currencies').slideDown();
    });
  });
  
  /*
  * Add new currency functionality
  */
  $(document).on('click', '.add-another-rate', function(event){
    event.preventDefault();
    var posting = $.post({
      url:"requests.php",
      data:{"add":"currency-rates"}
    });
    posting.done(function(response){
      $('.rates-fields').append(response).slideDown();
    });
  });
  
  $(document).on('click', '.store-new-currency', function(event){
    event.preventDefault();
    var symbol = $('#new-symbol').val();
    var name = $('#new-name').val();
    
    var data = decodeURI($( "form" ).serialize());
    var posting = $.post({
      url:"requests.php",
      data:{"store":data}
    });
    posting.done(function(response){
      $('.debug').append(response).slideDown();
    });
  });
})(jQuery);