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
		$title = $_POST['title'];
		
	} else {
		$html = '<form method="post">';
		$html .= '<label for="title">Title</label>
			<input type="text" name="title" id="title" value="">';
		$html .= '<br><br><input type="submit" name="submit" value="submit">';
		$html .= '</form>';
		
		return $html;
	}
}

add_shortcode( 'purchase-form', 'purchase_shortcode_function' );

?>