<?php
/**
 * Contains theme Walker_Nav_Menu
 *
 * @author     Denis Zharov
 * @category   Class
 * @package    adswtheme/Classes
 * @since      0.1.0
 */

namespace adswth\walker;

class adsMenuDropdown extends \Walker_Nav_Menu {

	function display_element ($element, &$children_elements, $max_depth, $depth, $args, &$output)
	{
		// check, whether there are children for the given ID and append it to the element with a (new) ID
		$element->hasChildren = isset($children_elements[$element->ID]) && !empty($children_elements[$element->ID]);

		return parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
	}

	function start_lvl( &$output, $depth = 0, $args = array() ) {
		$display_depth = ($depth + 1);
		if($display_depth == '1'){$class_names[] = 'nav-dropdown';}

		else {$class_names[] = 'nav-column';}

		// Add Dropdown Styles
		$class_names[] = 'nav-dropdown-'.get_theme_mod('dropdown_style', 'default');
		if(get_theme_mod('dropdown_text') == 'dark'){$class_names[] = 'dark';}
		if(get_theme_mod('dropdown_text_style') == 'uppercase'){$class_names[] = 'dropdown-uppercase';}

		$class_names = implode(' ', $class_names);

		$indent = str_repeat("\t", $depth);
		$output .= "\n$indent<ul class='".$class_names."'>\n";
	}

	function end_lvl( &$output, $depth = 1, $args = array() ) {
		$indent = str_repeat("\t", $depth);
		$output .= "$indent</ul>\n";
	}

	function start_el ( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {

		global $wp_query;
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$class_names = $value = '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;

		// Set Active Class
		if (in_array("current-page-ancestor", $classes) || in_array("current_page_item", $classes)) {
			$classes[] = 'active';
		}

		$classes[] = ' menu-item-' . $item->ID;


		if($item->hasChildren && $depth == 0){ $classes[] = 'has-dropdown';}
		if($item->hasChildren && $depth == 1){ $classes[] = 'nav-dropdown-col';}

		$menu_icon = '';

		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
		$class_names = ' class="' . esc_attr( $class_names ) . '"';


		$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
		$id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';

		$output .= $indent . '<li' . $id . $value . $class_names .'>';

		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

		// Check if menu item is in main menu
		if ( $depth == 0 ) {
			// These lines adds your custom class and attribute
			$attributes .= ' class="nav-top-link"';
		}


		// Normal Items
		$item_output = '<a'. $attributes .'>';

		// Add menu
		if($menu_icon) $item_output .= $menu_icon;
		$item_output .= apply_filters( 'the_title', $item->title, $item->ID );


		if( $item->type == 'taxonomy' && $item->object == 'product_cat' && isset( $args->show_count ) && $args->show_count ) {

			$count = adswth_get_category_products_count($item->object_id);

			// Check count, if more than 0 display count
			if($count > 0) {
				$item_output .= '&nbsp;<span class="count">(' . $count . ')</span>';
			}
		}
		$item_output .= '</a>';

		//pr($args);



		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );

	}

	public function end_el( &$output, $item, $depth = 0, $args = array() ) {
		$output .= "</li>";
	}

}