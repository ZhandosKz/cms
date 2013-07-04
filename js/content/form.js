$(document).ready(function(){
    if ($('input#Content_is_homepage').is(':checked') === true){
        $('input#Content_url').prop('disabled', true);
    }

    $('input#Content_is_homepage').change(function(){
        if ($(this).is(':checked') === true){
            $('input#Content_url').prop('disabled', true);
        }
        else{
            $('input#Content_url').prop('disabled', false);
        }

    })
});
