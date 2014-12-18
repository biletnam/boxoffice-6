<?php
/**
*  Adds the form to purchase a ticket to a post or page (submit adds ticket to Dash)
*
*  @since 1.0.0
*
*  
*/

function purchase_shortcode_function( $atts ) {
	
	$a = shortcode_atts( array(
	'foo' => 'something',
	'bar' => 'something else',
	), $atts ); 
	
	if($_POST['submit'] === 'submit') {
		BOffice::process_purchase();
	} else {
		$html = '<form method="post">';
		$html .= '<label for="title">Title</label>
			<input type="text" name="title" id="title" value="">';
			$action = 'purchase_ticket';
			$name = 'purchase_ticket_nonce';
			$referer = true;
			$echo = true;
		$html .= wp_nonce_field( $action, $name, $referer, $echo );
		$html .= '<br><br><input type="submit" name="submit" value="submit">';
		$html .= '</form>';
		return $html;
	}
	
}

add_shortcode( 'purchase-form', 'purchase_shortcode_function' );

?>