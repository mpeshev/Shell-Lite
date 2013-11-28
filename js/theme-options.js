/*
 * Dismiss Button in Shell Lite Option Page
 */
jQuery( document ).ready( function( $ ) {
	
	// Handle the AJAX field save action
	$( '#shell-lite-notice-dismiss' ).on( 'click', function( e ) {
		e.preventDefault();

		 $.post( ajaxurl, {
		 	data: { },
	             action: 'store_ajax_value'
			 }, function( status ) {
				 $( '.shell-lite-theme-notice' ).hide();
			 }
		);
	});
});