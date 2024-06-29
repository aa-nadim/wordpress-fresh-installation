( function( $ ) {
    'use strict'; 
    
    function citykid_add_container_wrapper_class(){
        let container = $('#container').val();
        if( 'container' !== container ){
            $('body').addClass('editor-styles-wrapper-full');
            console.log('full-container #######');
        }else{
            $('body').removeClass('editor-styles-wrapper-full');
            console.log('container #######')
        }
    }

    function init() {
        if($('#container').length){
            $(document).on('change', '#container', function(){
                citykid_add_container_wrapper_class();
            });
            $('#container').trigger('change');
        }
        
    }

    // Container Margin options
    function citykidMarginAfterOptions( marginAfterOptions ) {
        marginAfterOptions = citykidEditor.margin;
        return marginAfterOptions;
    }
    wp.hooks.addFilter(
        'wpBootstrapBlocks.container.marginAfterOptions',
        'myplugin/wp-bootstrap-blocks/container/marginAfterOptions',
        citykidMarginAfterOptions
    );
    
    // Horizontal gutters for row
    function citykidRowHorizontalGuttersOptions( horizontalGuttersOptions ) {
        horizontalGuttersOptions = citykidEditor.gutterX;
        return horizontalGuttersOptions;
    }
    wp.hooks.addFilter(
        'wpBootstrapBlocks.row.horizontalGuttersOptions',
        'myplugin/wp-bootstrap-blocks/row/horizontalGuttersOptions',
        citykidRowHorizontalGuttersOptions
    );

    // Vertical gutters for row
    function citykidRowVerticalGuttersOptions( verticalGuttersOptions ) {
        verticalGuttersOptions = citykidEditor.gutterY;
        return verticalGuttersOptions;
    }
    wp.hooks.addFilter(
        'wpBootstrapBlocks.row.verticalGuttersOptions',
        'myplugin/wp-bootstrap-blocks/row/verticalGuttersOptions',
        citykidRowVerticalGuttersOptions
    );

    // Column paddings
    function citykidColumnPaddingOptions( paddingOptions ) {
        paddingOptions = citykidEditor.padding;
        return paddingOptions;
    }
    wp.hooks.addFilter(
        'wpBootstrapBlocks.column.paddingOptions',
        'myplugin/wp-bootstrap-blocks/column/paddingOptions',
        citykidColumnPaddingOptions
    );


    function citykidRowTemplates( templates ) {
        citykidEditor.columnTemplates.forEach(function(template){
            templates.push(template);
        });
        
        return templates;
    }
    wp.hooks.addFilter(
        'wpBootstrapBlocks.row.templates',
        'myplugin/wp-bootstrap-blocks/row/templates',
        citykidRowTemplates
    );


    function citykidColumnBgColorOptions( bgColorOptions ) {
        bgColorOptions = citykidEditor.colors;      
        return bgColorOptions;
    }
    wp.hooks.addFilter(
        'wpBootstrapBlocks.column.bgColorOptions',
        'myplugin/wp-bootstrap-blocks/column/bgColorOptions',
        citykidColumnBgColorOptions
    );

    

    // Run when a document ready on the front end.
    $( document ).ready( init );

} )( jQuery );