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

   // Delete images function
   $(document).on('submit', '.delete-element', function(event){
      event.preventDefault();
       if(confirm(config.others[0].deletemsg)) {
           $.post(
            $(this).prop( 'action' ),
             $(this).serialize(),
            function(id){
               if(id != null){
                  $('li[data-id='+id+']').remove();
               }
               // $('.list-group-item[data-id="'+id+'"]').remove();
            }
         );
       }
   });

   $(document).on('click', '.state .btn', function(event){
      event.preventDefault();
      $.ajax({
         headers: { 'X-XSRF-TOKEN' : config.others[0].csrf }, 
         url: config.routes[0].state,
         type: 'POST',
         data: {
            state: $(this).attr('data-state'),
            "_token": config.others[0].csrf
         },
      })
      .done(function(data) {
         updateStates(data.state);
      });
   });


   function updateStates(state) {
      $('.state .btn').removeClass('active');
      $('.btn.state-'+state).addClass('active');
   }

})(jQuery);