( function( $ ) {
    'use strict'; 

    $(document).on('change', '#geometry', function(){
        let mapField = $(this).closest('.rwmb-meta-box').find('#map');
        if(mapField.length > 0){
            mapField.val($(this).val()+',14').trigger('change');
        }
    });

} )( jQuery );  