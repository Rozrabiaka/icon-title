var $ = jQuery;

$(document).ready(function(){
    $('#content_menu_dashicon_icon').change(function(){
        var icon = $('#content_menu_dashicon_icon').val();
        // clear and add selected dashicon class
        $('#content_icon').removeClass().addClass(icon);
    });
});
