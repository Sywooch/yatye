/**
 * Created by ntezi on 13/02/2016.
 */

//Bootstrap snippet: accordion collapse buttons
$(function(){
    $('.panel-heading').click(function(e) {
        $('.panel-heading').removeClass('tab-collapsed');
        var collapsCrnt = $(this).find('.collapse-controle').attr('aria-expanded');
        if (collapsCrnt != 'true') {
            $(this).addClass('tab-collapsed');
        }
    });
})