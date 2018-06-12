<?php
/**
 * @package MRK FAQ
 */

namespace MRK_FAQ\Classes;

class ShortCodeClass 
{

	public static function register( $atts ) 
	{
		$defaults = apply_filters('mrk_faq_shortcode_defaults', array(
		 'display'  => 'default',
		 'post_type'=> \MRK_FAQ\Classes\PostTypeClass::$postTypeName,
		 'limit'    =>  -1,
		 'faq_cat'  => false,
		 'faq_tag'  => false,
		 'relation' => 'OR',
		 'per_grid' => 2,
		 'color' 	=> false,
		 'theme' 	=> false,
		 'offset'	=> 0,
		));

		$attributes  = shortcode_atts($defaults, $atts);
		$attributes['view_file'] = self::getViewNameByDisplay( $attributes['display'] );
		$attributes 			 = apply_filters('mrk_faq_shortcode_atts', $attributes );	

		return MRK_FAQRenderItems( $attributes );
	}



	public static function getViewNameByDisplay($display)
	{
		$displayArray = array(
			'simple_one'  => 'simple_faq',
			'simple_two'  => 'simple_two_faq',
			'simple_three'=> 'simple_three_faq',
			'grid'  	  => 'grid_items',
		);

		$return = 'default';

		if( isset( $displayArray[$display] )){
			$return = $displayArray[ $display ];
		}

		return apply_filters( 'mrk_faq_get_view_name_by_display', $return , $display );
	}



}