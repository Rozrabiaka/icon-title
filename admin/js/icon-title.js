var $ = jQuery;

$(document).ready(function(){
    $('#content_menu_dashicon_icon').change(function(){
        var icon = $('#content_menu_dashicon_icon').val();
        // clear and add selected dashicon class
        $('#content_icon').removeClass().addClass(icon);
    });
});

//add data selected input to main input( name="name-page-choose")
$(document).ready(function(){
    $('input:radio[name=pages]').change(function(){
        $("input[name=name-page-choose]").val(this.value);
    });
});/*end  ready*/


$(".input-selected-item").click(function () {
    $('.drop-down-page-menu').toggle();
});

$(document).mouseup(function (e) {
    var container = $("#drop-down");
    if (container.has(e.target).length === 0) {
        container.hide();
    }
});

$("#tab_menu a").click(function () {
    $("#tab_menu a").removeAttr("class");
    $(this).attr("class", "checked");
    $("#tabs .tab_box").removeAttr("style");
    $("#tabs div[tab=" + $(this).attr("tab") + "]").attr("style", "display:block;");
});