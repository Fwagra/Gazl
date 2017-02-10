jQuery(document).ready(function($) {
    $( "#project-autocomplete" ).autocomplete({
      source: configAutocomplete.urls.source,
      minLength: 2,
      response: function( event, ui ) {
        if (ui.content.length === 0) {
            $("#empty-message").text(configAutocomplete.messages.noresult);
        } else {
            $("#empty-message").empty();
        }
      },
      select: function(event, ui) {
        $('#project-autocomplete').val(ui.item.name);
        $('#project-autocomplete').data('slug', ui.item.slug);
      }
    });
    $(".form-search").on('submit', function(event) {
        if($('#project-autocomplete').data('slug')){
            event.preventDefault();
            window.location.href = configAutocomplete.urls.redirect + '/' + $('#project-autocomplete').data('slug');
        }
    });
});
