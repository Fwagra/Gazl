jQuery(document).ready(function($) {
    if ($('.mockup-container').length != -1) {
        $("body").keydown(function(e) {
            if(e.which == 37) { // left
                if($('.previous-link').length)
                    $('.previous-link')[0].click();
            }
            else if(e.which == 39) { // right
                if($('.next-link').length)
                    $('.next-link')[0].click();
            }
        });
    }

    $(document).on('click', '.delete-mockup-image', function(event){
		event.preventDefault();
	    if(confirm(config.others.deletemsg)) {
			var route = config.routes.delete + '/' + $(this).attr('data-type');
	        $.ajax({
	    		url: route,
				type:'POST',
				data: {
	               "_token": config.others.csrf
			   }
			})
	    	.done(function(id) {
				if (id != false) {
					$('span[data-type="'+id+'"]').remove();
				}
	    	});
	    }
	});
});
