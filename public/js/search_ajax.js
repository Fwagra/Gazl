var selectors = config.selectors[0];

jQuery(document).ready(function($) {
	$(selectors.input).val('');
});

// Search resource on submit
$(document).on('submit', selectors.form, function(event){
	event.preventDefault();

	// Do nothing if no search terms provided
	if(!$(selectors.input).val())
		return;

	$.post(
        $(this).prop( 'action' ),
        $(this).serialize(),
        function(data) {
            $(selectors.replace).html(data.html);
            if(selectors.reini){
            	$(selectors.reini).removeClass('hide');
            }
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