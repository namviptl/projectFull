$(document).ready(function(){
  $('.dropdown-size').on('click', function(e){
      e.preventDefault();
      var size = $(this).attr('data-id');
      $('.size-up').text(size);
      $('.size-up').attr('value', size);
  });
  
  $(document).on('click', '#price-asc', function (e) {
    e.preventDefault();
    let urlRequest = $(this).data('url');
    let that = $(this);


    $.ajax({
      type: 'GET',
      url: urlRequest,

      success: function(data){

      },
      error: function(){

      }
    });
      
  })

});