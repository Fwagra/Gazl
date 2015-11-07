jQuery(document).ready(function($) {
    $('.sortable').sortable({
        cursor: 'move',
        axis: 'y',
        handle: 'i',
        update: function (event, ui) {
            var order = $(this).sortable('toArray',	{attribute: 'data-id'});
            $.post(config.routes[0].sort, { order: order, "_token": config.routes[0].csrf });
        }
    });
});
$(document).on('submit', '#add_category', function(event){
	event.preventDefault();
		$.post(
	        $(this).prop( 'action' ),
	        $(this).serialize(),
	        function(data) {
	            $('.list-group').html(data.view);
	            $('input[type="text"],textarea').val('');
	        },
	        'json'
	    ).fail(function(data) {
		    errorsHtml = '<div class="alert alert-danger"><ul>';
		    $.each( data.responseJSON, function( key, value ) {
		        errorsHtml += '<li>' + value[0] + '</li>';
		    });
		    errorsHtml += '</ul></diV>';
		    $('.errors').html(errorsHtml);
		});
});