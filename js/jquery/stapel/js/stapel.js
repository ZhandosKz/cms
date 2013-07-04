$(function() {

    var $grid = $( '#tp-grid' ),
        $name = $( '#name' ),
        $close = $( '#close' ),
        $loader = $( '<div class="loader"><i></i><i></i><i></i><i></i><i></i><i></i><span>Loading...</span></div>' ).insertBefore( $grid ),
        stapel = $grid.stapel( {
            onLoad : function() {
                $loader.remove();
            },
            onBeforeOpen : function( pileName ) {
                $name.html( pileName );
            },
            onAfterOpen : function( pileName ) {
                $close.show();
                $('.topbar').show();
            },
            onAfterClose: function(nileName){
                $('.topbar').hide();
            }
        } );

    $close.on( 'click', function() {
        $close.hide();
        $name.empty();
        stapel.closePile();
    } );

} );