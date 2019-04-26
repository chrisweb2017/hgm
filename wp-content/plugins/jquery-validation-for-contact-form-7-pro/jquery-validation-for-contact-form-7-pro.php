<?php
/* 
Plugin Name: Jquery Validation For Contact Form 7 Pro
Plugin URI: http://dnesscarkey.com/jquery-validation/
Description: This plugin integrates jquery validation in contact form 7
Author: Dinesh Karki
Version: 4.1
Author URI: http://www.dineshkarki.com.np
*/

/*  Copyright 2012  Dinesh Karki  (email : dnesskarki@gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

$defaultOptionValues['jvcf7p_show_label_error'] 		= "errorMsgshow";
$defaultOptionValues['jvcf7p_invalid_field_design'] 	= "theme_1";
$defaultOptionValues['jvcf7p_hide_contact_form_7_validation_error'] = "yes";
$defaultOptionValues['jvcf7p_msg_required'] 			= "This field is required.";
$defaultOptionValues['jvcf7p_msg_email'] 				= "Please enter a valid email address.";
$defaultOptionValues['jvcf7p_msg_url'] 					= "Please enter a valid URL.";
$defaultOptionValues['jvcf7p_msg_date'] 				= "Please enter a valid date.";
$defaultOptionValues['jvcf7p_msg_dateISO'] 				= "Please enter a valid date (ISO).";
$defaultOptionValues['jvcf7p_msg_number'] 				= "Please enter a valid number.";
$defaultOptionValues['jvcf7p_msg_digits'] 				= "Please enter only digits.";
$defaultOptionValues['jvcf7p_msg_alpha_numeric'] 		= "Letters, numbers, and underscores only.";
$defaultOptionValues['jvcf7p_msg_letters_only'] 		= "Letters only please.";
$defaultOptionValues['jvcf7p_msg_letters_space'] 		= "Letters and space only.";
$defaultOptionValues['jvcf7p_msg_creditcard'] 			= "Please enter a valid credit card number.";
$defaultOptionValues['jvcf7p_msg_phoneUS'] 				= "Please specify a valid phone number";
$defaultOptionValues['jvcf7p_msg_equalTo'] 				= "Please enter the same value again.";
$defaultOptionValues['jvcf7p_msg_extension'] 			= "Please enter a file with a valid extension.";
$defaultOptionValues['jvcf7p_msg_require_from_group'] 	= "Please fill at least {0} of these fields.";
$defaultOptionValues['jvcf7p_msg_maxlength'] 			= "Please enter no more than {0} characters.";
$defaultOptionValues['jvcf7p_msg_minlength'] 			= "Please enter at least {0} characters.";
$defaultOptionValues['jvcf7p_msg_rangelength'] 			= "Please enter a value between {0} and {1} characters long.";
$defaultOptionValues['jvcf7p_msg_range'] 				= "Please enter a value between {0} and {1}.";
$defaultOptionValues['jvcf7p_msg_max'] 					= "Please enter a value less than or equal to {0}.";
$defaultOptionValues['jvcf7p_msg_min'] 					= "Please enter a value greater than or equal to {0}.";
$defaultOptionValues['jvcf7p_msg_iban'] 				= "Please specify a valid IBAN.";
$defaultOptionValues['jvcf7p_msg_custom_code'] 			= "Please enter valid code.";


$optionValues = array();
foreach ($defaultOptionValues as $key=>$value){
	$optionValues[$key] = get_option($key);
	if (empty($optionValues[$key])){
		update_option($key, $value);
		$optionValues[$key] = $value;
	}
}

function jvcf7p_validation_js(){
  global $optionValues;
  $customCodes 		=  strtolower(get_option("jvcf7p_custom_codes"));
  $customCodesArray =  json_decode(get_option("jvcf7p_custom_codes"),true);
  
  echo '<script>
  	jvcf7p_loading_url= "'.plugins_url('contact-form-7/images/ajax-loader.gif').'";
    jvcf7p_optionValues	= '.json_encode($optionValues).';
	jvcf7p_invalid_field_design = "'.$optionValues["jvcf7p_invalid_field_design"].'";
	jvcf7p_show_label_error = "'.$optionValues["jvcf7p_show_label_error"].'";
	jvcf7p_custom_code = '.strtolower(json_encode($customCodesArray)).';
  </script>';
  
  $wpcf7 = array(
		'apiSettings' => array(
			'root' => esc_url_raw( get_rest_url() ),
			'namespace' => 'contact-form-7/v1',
		),
		'recaptcha' => array(
			'messages' => array(
				'empty' =>
					__( 'Please verify that you are not a robot.', 'contact-form-7' ),
			),
		),
	);
	
  wp_dequeue_script( 'contact-form-7' );  
  wp_enqueue_script('jvcf7p_jquery_validate', plugins_url('jquery-validation-for-contact-form-7-pro/js/jquery.validate.min.js'), array('jquery'), '', true);
  wp_enqueue_script('jvcf7p_validation_custom', plugins_url('jquery-validation-for-contact-form-7-pro/js/jquery.jvcf7p_validation.js'), '', '', true);
  wp_localize_script( 'jvcf7p_validation_custom', 'wpcf7', $wpcf7 );
  
  wp_register_style('jvcf7p_style', plugins_url('jquery-validation-for-contact-form-7-pro/css/jvcf7p_validate.css'));
  wp_enqueue_style('jvcf7p_style');	
}

function jvcf7p_adminCsslibs(){
	wp_register_style('jvcf7p_style', plugins_url('jquery-validation-for-contact-form-7-pro/css/jvcf7p_validate.css'));
    wp_enqueue_style('jvcf7p_style');	
}

add_action('wp_enqueue_scripts', 'jvcf7p_validation_js');
add_action("admin_print_styles", 'jvcf7p_adminCsslibs');

include('jvcf7p_updater.php');
include('plugin_interface.php');
?>