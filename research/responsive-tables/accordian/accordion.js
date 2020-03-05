( function( $ ) {

    "use strict";

    $.fn.responsiveTable = function() {

        var toggleColumns = function( $table ) {

            var selectedControls = [];

            $table.find( ".accordion, .tab" )
                .each( function() {
                    selectedControls.push( $( this )
                        .attr( "aria-selected" ) );
                } );

            var cellCount = 0,
                colCount = 0;

            var setNum = $table.find( ".responsive-table-cell" )
                .length / Math.max( $table.find( ".tab" )
                .length, $table.find( ".accordion" )
                .length );

            $table.find( ".responsive-table-cell" )
                .each( function() {
                    $( this )
                        .addClass( "hiddenSmall" );
                    if ( selectedControls[ colCount ] === "true" ) $( this )
                        .removeClass( "hiddenSmall" );
                    cellCount++;
                    if ( cellCount % setNum === 0 ) colCount++;
                } );
        };

        $( this )
            .each( function() { toggleColumns( $( this ) ); } );

        $( this )
            .find( ".tab" )
            .click( function() {
                $( this )
                    .attr( "aria-selected", "true" )
                    .siblings()
                    .attr( "aria-selected", "false" );
                toggleColumns( $( this )
                    .parents( ".responsive-table" ) );
            } );

        $( this )
            .find( ".accordion" )
            .click( function() {
                $( this )
                    .attr( "aria-selected", $( this )
                        .attr( "aria-selected" ) !== "true" );
                toggleColumns( $( this )
                    .parents( ".responsive-table" ) );
            } );

    };
}( jQuery ) );

$( ".js-responsive-table-tabs, .js-responsive-table-accordions" )
    .responsiveTable();
