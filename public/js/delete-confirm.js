// Prevent unwanted deletions by displaying a confirm popup before
$(document).on('click', '.delete-confirm',function(event) {
    event.preventDefault();
    if(confirm(config.messages.deletemsg)){
        $(this).parents('form').submit();
    }
});
