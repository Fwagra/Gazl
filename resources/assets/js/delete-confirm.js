/**
 *  Prevent unwanted deletions by displaying a confirm popup before
 *  Just add the 'delete-confirm' class to the submit button
 */
$(document).on('click', '.delete-confirm',function(event) {
    event.preventDefault();
    if(confirm(config.messages.deletemsg)){
        $(this).parents('form').submit();
    }
});
