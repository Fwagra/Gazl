(function($) {
   // Add images function
   $(document).on('submit', '.add-element', function(event){
      event.preventDefault();
      var formSelect = new FormData($(this).get(0));

      $.ajax({
        url:$(this).prop( 'action' ),
        data:formSelect,
        dataType:'json',
        async:false,
        type:'post',
        processData: false,
        contentType: false,
        success:function(data){
            $(data.selector).html(data.view);
            $('.add-element input[type=file]').val("");
        },
        error:function(data) {
         console.log(data);
            errorsHtml = '<div class="alert alert-danger"><ul>';
            $.each( data.responseJSON, function( key, value ) {
                errorsHtml += '<li>' + value[0] + '</li>';
            });
            errorsHtml += '</ul></diV>';
            $('.errors').html(errorsHtml);
        }
      });
   });
})(jQuery);