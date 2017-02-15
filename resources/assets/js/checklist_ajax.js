(function($) {

   /* Update the checklist answers database function */
   function updateChecklistPoint (form) {
		$.post(
	        form.prop( 'action' ),
	        form.serialize(),
	        function(data) {
	        },
	        'json'
	    ).fail(function(data) {
		    // errorsHtml = '<div class="alert alert-danger"><ul>';
		    // $.each( data.responseJSON, function( key, value ) {
		    //     errorsHtml += '<li>' + value[0] + '</li>';
		    // });
		    // errorsHtml += '</ul></diV>';
		    // $('.errors').html(errorsHtml);
		});
   }
   $(document).ready(function() {
   	$('.checklist-form textarea').on('change', function(event) {
   		event.preventDefault();
   		updateChecklistPoint($(this).parents('form'));
   	});
   	// Since the checkboxes use iCheck, we use the iCheck Callback 'ifToggled'
   	// https://github.com/fronteed/iCheck
   	$(document).on('ifToggled', '.checklist-form input[type="checkbox"], .checklist-form input[type="radio"]', function(event) {
   		event.preventDefault();
   		 updateChecklistPoint($(this).parents('form'));
   	});
    $(document).on('change', '.checklist-form input[type="checkbox"], .checklist-form input[type="radio"]', function(event) {
   		event.preventDefault();
   		updateChecklistPoint($(this).parents('form'));
   	});
   });

})(jQuery);
