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
	
	if($twitter != NULL) {
		array_push($return, '<div class="contactCardTwitter">');
		array_push($return, '<img class="contactCardTwitterIcon" src="'.plugins_url( 'images/twitter.png', __FILE__ ).'">');
		array_push($return, '<a class="contactCardTwitterLink" href="https://twitter.com/'.$twitter.'" target=_new>@'.$twitter.'</a>');
		array_push($return, '</div>');
	}
	
	if($facebook != NULL) {
		$fb = json_decode(file_get_contents("https://graph.facebook.com/".$facebook));
		array_push($return, '<div class="contactCardFacebook">');
		array_push($return, '<img class="contactCardFacebookIcon" src="'.plugins_url( 'images/facebook.png', __FILE__ ).'">');
		array_push($return, '<a class="contactCardFacebookLink" href="https://www.facebook.com/'.$facebook.'" target=_new>'.$fb->name.'</a>');
		array_push($return, '</div>');
	}
	if($github != NULL) {
		array_push($return, '<div class="contactCardGithub">');
		array_push($return, '<img class="contactCardGithubIcon" src="'.plugins_url( 'images/github.png', __FILE__ ).'">');
		array_push($return, '<a class="contactCardGithubLink" href="https://github.com/'.$github.'" target=_new>@'.$github.'</a>');
		array_push($return, '</div>');
	}
	
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