(function($){
  
  $("#add-currency").click(function(){
    $.ajax({
      url:"requests.php",
      type:"post",
      data: {show:"add-currency"},
      success: function(response){
        $("#main").html(response);
      }
    });
  });
  
  $('.base_currency').keypress(function(event){
    if(event.which < 46
    || event.which > 59) {
        event.preventDefault();
    } // prevent if not number/dot

    if(event.which === 46 && $(this).val().indexOf('.') !== -1) {
        event.preventDefault();
    }// prevent if dot already in value
  });
  
  $('.base_currency').keyup(function(){
    var val = $(this).val();
    var base = $(this).attr("id");
    var posting = $.post({
      url:"requests.php",
      data:{"base_id" : base, "value" : val}
    });
    posting.done(function( response ){
      var data = $.parseJSON(response);
      $('.results').append(data);
      for(var i in data){
        var target_currency = ".to_"+data[i][0];
        $(target_currency).val(data[i][1]);
      }
    });
  });
  
  $('.select_base').change(function() {
    var new_base = $(".select_base option:selected").val();
    $(".base_currency").attr("id",new_base);
    
  });
})(jQuery);