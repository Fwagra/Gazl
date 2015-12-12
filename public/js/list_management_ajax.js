/* Trigger sortable elements */
jQuery(document).ready(function($) {
    $('.sortable').sortable({
    	connectWith: '.sortable',
        cursor: 'move',
        cancel: '.panel-heading',
        items: '.list-group-item',
        handle: 'i',
        update: function (event, ui) {
            var order = $(this).sortable('toArray',	{attribute: 'data-id'});
            $.post(config.routes[0].sort, { order: order, "_token": config.others[0].csrf });
        }
    });
});
/* Add element */
$(document).on('submit', '.add_element', function(event){
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
/* Delete element */
$(document).on('submit', '.delete-element', function(event){
	event.preventDefault();
    if(confirm(config.others[0].deletemsg)) {
        $.post(
    		$(this).prop( 'action' ),
    	    $(this).serialize(),
    		function(id){
    			$('li[data-id="'+id+'"]').remove();
    		}
    	);
    }
});

/* Trigger edit form */
$(document).on('click', '.edit-element', function(event){
	event.preventDefault();
	var form = '<form method="POST" class="edit-submit"><input value="put" type="hidden" name="_method" /><input type="hidden" name="_token" value="'+ config.others[0].csrf +'" /><input type="text" class="edit-input" name="edit-input" value="'+ $(this).text() +'" /></form>';
	$(this).replaceWith(form);
	$('input.edit-input').focus();
});
$(document).on('blur', 'input.edit-input', function(event) {
	// if(!$(this).val()){
	// 	event.preventDefault();
	// }else{
	// 	$(this).parent().replaceWith('<span class="edit-element">'+$(this).val()+'</div>');
	// }
	form = $(this).parent('form');
	form.trigger('submit');
});
/* Edit element */
$(document).on('submit', '.edit-submit', function(event){
	event.preventDefault();
	form = $(this);
	// Generating edit url
	var editUrl = config.routes[0].edit.replace('url_id', form.parent().attr('data-id'));
	if($('.edit-input', this).val()){
	    $.post(
			editUrl,
		    form.serialize(),
			function(data){
				form.replaceWith('<span class="edit-element">'+data+'</div>');
			}
		);
	}
});
