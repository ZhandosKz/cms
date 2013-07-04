$(document).ready(function(){
    $.jGrowl.defaults.closerTemplate = '<div>закрыть все</div>';
    for (var i in flashMessages){
        //console.log(flashMessages[i]);
        $.jGrowl(flashMessages[i].text, {
            sticky: true,
            theme: flashMessages[i].type
        })
    }
    $('.nav-list .confirm-delete a').click(function(e){
        if (!confirm($(this).parent('li').data('confirm-delete-question')))
        {
            return false;
        }
    });
});