<?php
/*
Plugin Name: Quick Contact Cards
Plugin URI: https://xnite.me/code/wordpress/plugins/quick-contact-cards
Description: Embeds stackable contact cards into page or post with a shortcode.
Version: 1.0
Author: Robert Whitney &lt;<a href="mailto:xnite@xnite.me">xnite@xnite.me</a>&gt;
Author URI: https://xnite.me
License: <a href="http://www.gnu.org/copyleft/gpl.html" target=_new>GNU GPLv3</a>
*/
add_action('wp_head','quick_contact_cards_hook_css');
add_shortcode( 'contact', 'embed_quick_contact_card' );

function quick_contact_cards_hook_css() {
	echo '<link rel="stylesheet" type="text/css" href="'.plugins_url('css/contact_cards_default.css', __FILE__).'" />';
}
function embed_quick_contact_card($atts) {
	extract(
		shortcode_atts(
			array(
				'name'		=> '???',
				'title'		=> NULL,
				'bio'		=> NULL,
				'img'		=> plugins_url( 'images/default.png', __FILE__ ),
				
				'twitter'	=> NULL,
				'facebook'	=> NULL,
				'github'	=> NULL,
				'linkedin'	=> NULL,
				'skype'		=> NULL,
				'tumblr'	=> NULL,
				'youtube'	=> NULL,
				'email'		=> NULL
			),
			$atts
		)
	);
	$return = array();
	array_push($return, '<div class="contactCard">');
	array_push($return, '<div class="contactCardNamePlate">');
	array_push($return, '<span class="contactCardName">'.$name.'</span>');
	array_push($return,	'</div>');
	array_push($return, '<img class="contactCardImage" src="'.$img.'" />');
	array_push($return, '<div class="contactCardLinks">');
	
	if($twitter != NULL) {
		array_push($return, '<a href="https://twitter.com/'.$twitter.'"><img class="contactCardSocialIcon" src="'.plugins_url( 'img/twitter.png', __FILE__ ).'" /></a>');
	}

	if($facebook != NULL) {
		array_push($return, '<a href="'.$facebook.'"><img class="contactCardSocialIcon" src="'.plugins_url( 'img/facebook.png', __FILE__ ).'" /></a>');
	}

	if($github != NULL) {
		array_push($return, '<a href="'.$github.'"><img class="contactCardSocialIcon" src="'.plugins_url( 'img/github.png', __FILE__ ).'" /></a>');
	}

	if($linkedin != NULL) {
		array_push($return, '<a href="https://linkedin.com/in/'..'"><img class="contactCardSocialIcon" src="'.plugins_url( 'img/linkedin.png', __FILE__ ).'" /></a>');
	}
	
	if($skype != NULL) {
		array_push($return, '<a href="skype://'..'"><img class="contactCardSocialIcon" src="'.plugins_url( 'img/skype.png', __FILE__ ).'" /></a>');
	}
	
	array_push($return, '</div>');
	
	if($email != NULL) {
		array_push($return, '<div class="contactCardEmail">');
		array_push($return, '<img class="contactCardEmailIcon" src="'.plugins_url( 'images/email.png', __FILE__ ).'">');
		array_push($return, '<a class="contactCardEmailLink" href="mailto:'.$email.'" target=_new>'.$email.'</a>');
		array_push($return, '</div>');
	}

	array_push($return, '<div class="contactCardContents">');
	array_push($return, '<p class="contactCardBio">');
	
	if($title != NULL) {
		array_push($return, '<strong>'.$title.'</strong><br />');
	}
	
	if($bio != NULL) {
		array_push($return, $bio);
	}
	
	
	array_push($return, '</p>');
	array_push($return, '</div>');
	array_push($return, '</div>');
	
	return implode("\n", $return);
}
?>