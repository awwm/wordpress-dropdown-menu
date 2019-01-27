<?php
/*
Plugin Name: AWWM Dropdown Menu
Plugin URI:  https://github.com/awwm
Description: On click open custom menu on homepage
Version:     1.0.0
Author:      Abdul Wahab
Author URI:  https://www.freelancer.com/u/wahab1983pk
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/

/* [dropdown_menu name=”fhtra-categories”] */


class Walker_Nav_Menu_Dropdown extends Walker_Nav_Menu {
	function start_lvl(&$output, $depth){
		$indent = str_repeat("\t", $depth); // don't output children opening tag (`<ul>`)
	}
	function end_lvl(&$output, $depth){
		$indent = str_repeat("\t", $depth); // don't output children closing tag
	}
	/**
	* Start the element output.
	*
	* @param  string $output Passed by reference. Used to append additional content.
	* @param  object $item   Menu item data object.
	* @param  int $depth     Depth of menu item. May be used for padding.
	* @param  array $args    Additional strings.
	* @return void
	*/
	function start_el(&$output, $item, $depth, $args) {
 		$url = '#' !== $item->url ? $item->url : '';
 		$output .= '<option class="'.$item->ID.'" value="' . $url . '">' . $item->title;
	}	
	function end_el(&$output, $item, $depth){
		$output .= "</option>\n"; // replace closing </li> with the option tag
	}
}


function awwm_dropdown_menu($atts, $content = null) {
        extract(shortcode_atts(array( 'name' => null, ), $atts));
       return wp_nav_menu(
            array(
                'menu' => $name, 
                'echo' => false,
                'walker' => new Walker_Nav_Menu_Dropdown(),
		        'items_wrap' => '<div class="mobile-menu"><form class="dropDownFormClass"><select class="dropDownSelectClass" onchange="if (this.value) window.location.href=this.value">%3$s</select></form></div>',
                )
        );
        

}
    
    
    add_shortcode('dropdown_menu', 'awwm_dropdown_menu');

?>