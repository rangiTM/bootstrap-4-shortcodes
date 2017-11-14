<?php
/*
Plugin Name: Bootstrap 4 Shortcodes
Plugin URI: https://github.com/ciromattia/bootstrap-4-shortcodes
Description: The plugin adds a shortcodes for all Bootstrap 4 elements.
Version: 4.0
Author: Ciro Mattia Gonano, Michael W. Delaney, Filip Stefansson, and Simon Yeldon
Author URI:
License: MIT
*/

// ======================================================================== //
// Include necessary functions and files
// ======================================================================== //

require_once( dirname( __FILE__ ) . '/includes/defaults.php' );
require_once( dirname( __FILE__ ) . '/includes/functions.php' );
require_once( dirname( __FILE__ ) . '/includes/actions-filters.php' );

// ======================================================================== //

// Begin Shortcodes
class BoostrapShortcodes {

	// ======================================================================== //
	// Initialize shortcodes and conditionally include opt-in Bootstrap scripts
	// ======================================================================== //

	function __construct() {

		//Initialize shortcodes
		add_action( 'init', array( $this, 'add_shortcodes' ) );

		//Conditionally include tooltip functionality (see function for conditionals)
		add_action( 'the_post', array( $this, 'bootstrap_shortcodes_tooltip_script' ), 9999 );

		//Conditionally include popupver functionality (see function for conditionals)
		add_action( 'the_post', array( $this, 'bootstrap_shortcodes_popover_script' ), 9999 );
	}

	// ======================================================================== //


	// ======================================================================== //
	// Conditionally include tooltip initialization script.
	// See details for why this is necessary here: http://getbootstrap.com/javascript/#callout-tooltip-opt-in
	//
	//  Only includes script if content contains [tooltip] shortcode
	// ======================================================================== //

	function bootstrap_shortcodes_tooltip_script() {
		global $post;
		if ( has_shortcode( $post->post_content, 'tooltip' ) ) {
			// Bootstrap tooltip js
			wp_enqueue_script( 'bootstrap-shortcodes-tooltip', BS_SHORTCODES_URL . 'js/bootstrap-shortcodes-tooltip.js', array( 'jquery' ), false, true );
		}
	}

	// ======================================================================== //


	// ======================================================================== //
	// Conditionally include popover initialization script.
	// See details for why this is necessary here: http://getbootstrap.com/javascript/#callout-popover-opt-in
	//
	//  Only includes script if content contains [popover] shortcode
	// ======================================================================== //

	function bootstrap_shortcodes_popover_script() {
		global $post;
		if ( has_shortcode( $post->post_content, 'popover' ) ) {
			// Bootstrap popover js
			wp_enqueue_script( 'bootstrap-shortcodes-popover', BS_SHORTCODES_URL . 'js/bootstrap-shortcodes-popover.js', array( 'jquery' ), false, true );
		}
	}

	// ======================================================================== //

	/*--------------------------------------------------------------------------------------
		*
		* add_shortcodes
		*
		* @author Filip Stefansson
		* @since 1.0
		*
		*-------------------------------------------------------------------------------------*/
	function add_shortcodes() {

		$shortcodes = array(
			'accordion',
			'alert',
			'badge',
			'breadcrumb',
			'breadcrumb-item',
			'button',
			'button-group',
			'button-toolbar',
			'card',
			'card-deck',
			'caret',
			'carousel',
			'carousel-item',
			'carousel-caption',
			'code',
			'collapse',
			'column',
			'container',
			'container-fluid',
			'divider',
			'dropdown',
			'dropdown-header',
			'dropdown-item',
			'emphasis',
			'icon',
			'img',
			'embed-responsive',
			'jumbotron',
			'label',
			'lead',
			'list-group',
			'list-group-item',
			'list-group-item-heading',
			'list-group-item-text',
			'media',
			'media-body',
			'media-list',
			'media-object',
			'modal',
			'modal-footer',
			'nav',
			'nav-item',
			'page-header',
			'popover',
			'progress',
			'progress-bar',
			'responsive',
			'row',
			'span',
			'tab',
			'table',
			'table-wrap',
			'tabs',
			'tooltip',
		);

		foreach ( $shortcodes as $shortcode ) {

			$function = 'bs_' . str_replace( '-', '_', $shortcode );
			add_shortcode( $shortcode, array( $this, $function ) );

		}
	}

	/*--------------------------------------------------------------------------------------
		*
		* bs_button
		*
		* @author Filip Stefansson, Nicolas Jonas
		* @since 1.0
		* //DW mod added xclass var
		*-------------------------------------------------------------------------------------*/
	function bs_button( $atts, $content = null ) {

		$atts = shortcode_atts( array(
			"type"     => false,
			"size"     => false,
			"block"    => false,
			"dropdown" => false,
			"link"     => '',
			"target"   => false,
			"disabled" => false,
			"active"   => false,
			"xclass"   => false,
			"title"    => false,
			"data"     => false
		), $atts );

		$class = 'btn';
		$class .= ( $atts['type'] ) ? ' btn-' . $atts['type'] : ' btn-default';
		$class .= ( $atts['size'] ) ? ' btn-' . $atts['size'] : '';
		$class .= ( $atts['block'] == 'true' ) ? ' btn-block' : '';
		$class .= ( $atts['dropdown'] == 'true' ) ? ' dropdown-toggle' : '';
		$class .= ( $atts['disabled'] == 'true' ) ? ' disabled' : '';
		$class .= ( $atts['active'] == 'true' ) ? ' active' : '';
		$class .= ( $atts['xclass'] ) ? ' ' . $atts['xclass'] : '';

		$data_props = $this->parse_data_attributes( $atts['data'] );

		return sprintf(
			'<a href="%s" class="%s"%s%s%s>%s</a>',
			esc_url( $atts['link'] ),
			esc_attr( trim( $class ) ),
			( $atts['target'] ) ? sprintf( ' target="%s"', esc_attr( $atts['target'] ) ) : '',
			( $atts['title'] ) ? sprintf( ' title="%s"', esc_attr( $atts['title'] ) ) : '',
			( $data_props ) ? ' ' . $data_props : '',
			do_shortcode( $content )
		);

	}

	/*--------------------------------------------------------------------------------------
		*
		* bs_button_group
		*
		* @author M. W. Delaney
		*
		*-------------------------------------------------------------------------------------*/
	function bs_button_group( $atts, $content = null ) {

		$atts = shortcode_atts( array(
			"size"      => false,
			"vertical"  => false,
			"justified" => false,
			"dropup"    => false,
			"xclass"    => false,
			"data"      => false
		), $atts );

		$class = 'btn-group';
		$class .= ( $atts['size'] ) ? ' btn-group-' . $atts['size'] : '';
		$class .= ( $atts['vertical'] == 'true' ) ? ' btn-group-vertical' : '';
		$class .= ( $atts['justified'] == 'true' ) ? ' btn-group-justified' : '';
		$class .= ( $atts['dropup'] == 'true' ) ? ' dropup' : '';
		$class .= ( $atts['xclass'] ) ? ' ' . $atts['xclass'] : '';

		$data_props = $this->parse_data_attributes( $atts['data'] );

		return sprintf(
			'<div class="%s"%s>%s</div>',
			esc_attr( trim( $class ) ),
			( $data_props ) ? ' ' . $data_props : '',
			do_shortcode( $content )
		);
	}

	/*--------------------------------------------------------------------------------------
		*
		* bs_button_toolbar
		*
		*
		*-------------------------------------------------------------------------------------*/
	function bs_button_toolbar( $atts, $content = null ) {

		$atts = shortcode_atts( array(
			"xclass" => false,
			"data"   => false
		), $atts );

		$class = 'btn-toolbar';
		$class .= ( $atts['xclass'] ) ? ' ' . $atts['xclass'] : '';

		$data_props = $this->parse_data_attributes( $atts['data'] );

		return sprintf(
			'<div class="%s"%s>%s</div>',
			esc_attr( trim( $class ) ),
			( $data_props ) ? ' ' . $data_props : '',
			do_shortcode( $content )
		);
	}

	/*--------------------------------------------------------------------------------------
		   *
		   * bs_caret
		   *
		   * @author Filip Stefansson
		   * @since 1.0
		   *
		   *-------------------------------------------------------------------------------------*/
	function bs_caret( $atts, $content = null ) {

		$atts = shortcode_atts( array(
			"xclass" => false,
			"data"   => false
		), $atts );

		$class = 'caret';
		$class .= ( $atts['xclass'] ) ? ' ' . $atts['xclass'] : '';

		$data_props = $this->parse_data_attributes( $atts['data'] );

		return sprintf(
			'<span class="%s"%s>%s</span>',
			esc_attr( trim( $class ) ),
			( $data_props ) ? ' ' . $data_props : '',
			do_shortcode( $content )
		);
	}

	/*--------------------------------------------------------------------------------------
		   *
		   * bs_container
		   *
		   * @author Robin Wouters
		   * @since 3.0.3.3
		   *
		   *-------------------------------------------------------------------------------------*/
	function bs_container( $atts, $content = null ) {

		$atts = shortcode_atts( array(
			"fluid"  => false,
			"xclass" => false,
			"data"   => false
		), $atts );

		$class = ( $atts['fluid'] == 'true' ) ? 'container-fluid' : 'container';
		$class .= ( $atts['xclass'] ) ? ' ' . $atts['xclass'] : '';

		$data_props = $this->parse_data_attributes( $atts['data'] );

		return sprintf(
			'<div class="%s"%s>%s</div>',
			esc_attr( trim( $class ) ),
			( $data_props ) ? ' ' . $data_props : '',
			do_shortcode( $content )
		);
	}


	/*--------------------------------------------------------------------------------------
		 *
		 * bs_container_fluid
		 *
		 * @author Robin Wouters
		 * @since 3.0.3.3
		 *
		 *-------------------------------------------------------------------------------------*/
	function bs_container_fluid( $atts, $content = null ) {

		$atts = shortcode_atts( array(
			"xclass" => false,
			"data"   => false
		), $atts );

		$class = 'container-fluid';
		$class .= ( $atts['xclass'] ) ? ' ' . $atts['xclass'] : '';

		$data_props = $this->parse_data_attributes( $atts['data'] );

		return sprintf(
			'<div class="%s"%s>%s</div>',
			esc_attr( trim( $class ) ),
			( $data_props ) ? ' ' . $data_props : '',
			do_shortcode( $content )
		);
	}

	/*--------------------------------------------------------------------------------------
		*
		* bs_dropdown
		*
		* @author M. W. Delaney
		*
		*-------------------------------------------------------------------------------------*/
	function bs_dropdown( $atts, $content = null ) {

		$atts = shortcode_atts( array(
			"xclass" => false,
			"data"   => false
		), $atts );

		$class = 'dropdown-menu';
		$class .= ( $atts['xclass'] ) ? ' ' . $atts['xclass'] : '';

		$data_props = $this->parse_data_attributes( $atts['data'] );

		return sprintf(
			'<ul role="menu" class="%s"%s>%s</ul>',
			esc_attr( trim( $class ) ),
			( $data_props ) ? ' ' . $data_props : '',
			do_shortcode( $content )
		);
	}

	/*--------------------------------------------------------------------------------------
		*
		* bs_dropdown_item
		*
		* @author M. W. Delaney
		*
		*-------------------------------------------------------------------------------------*/
	function bs_dropdown_item( $atts, $content = null ) {

		$atts = shortcode_atts( array(
			"link"     => false,
			"disabled" => false,
			"xclass"   => false,
			"data"     => false
		), $atts );

		$li_class = '';
		$li_class .= ( $atts['disabled'] == 'true' ) ? ' disabled' : '';

		$a_class = '';
		$a_class .= ( $atts['xclass'] ) ? ' ' . $atts['xclass'] : '';

		$data_props = $this->parse_data_attributes( $atts['data'] );

		return sprintf(
			'<li role="presentation" class="%s"><a role="menuitem" href="%s" class="%s"%s>%s</a></li>',
			esc_attr( $li_class ),
			esc_url( $atts['link'] ),
			esc_attr( $a_class ),
			( $data_props ) ? ' ' . $data_props : '',
			do_shortcode( $content )
		);
	}

	/*--------------------------------------------------------------------------------------
		*
		* bs_dropdown_divider
		*
		* @author M. W. Delaney
		*
		*-------------------------------------------------------------------------------------*/
	function bs_divider( $atts, $content = null ) {

		$atts = shortcode_atts( array(
			"xclass" => false,
			"data"   => false
		), $atts );

		$class = 'divider';
		$class .= ( $atts['xclass'] ) ? ' ' . $atts['xclass'] : '';

		$data_props = $this->parse_data_attributes( $atts['data'] );

		return sprintf(
			'<li class="%s"%s>%s</li>',
			esc_attr( trim( $class ) ),
			( $data_props ) ? ' ' . $data_props : '',
			do_shortcode( $content )
		);
	}

	/*--------------------------------------------------------------------------------------
		*
		* bs_dropdown_header
		*
		* @author M. W. Delaney
		*
		*-------------------------------------------------------------------------------------*/
	function bs_dropdown_header( $atts, $content = null ) {

		$atts = shortcode_atts( array(
			"xclass" => false,
			"data"   => false
		), $atts );

		$class = 'dropdown-header';
		$class .= ( $atts['xclass'] ) ? ' ' . $atts['xclass'] : '';

		$data_props = $this->parse_data_attributes( $atts['data'] );

		return sprintf(
			'<li class="%s"%s>%s</li>',
			esc_attr( trim( $class ) ),
			( $data_props ) ? ' ' . $data_props : '',
			do_shortcode( $content )
		);
	}

	/*--------------------------------------------------------------------------------------
		*
		* bs_nav
		*
		*
		*-------------------------------------------------------------------------------------*/
	function bs_nav( $atts, $content = null ) {

		$atts = shortcode_atts( array(
			"type"      => false,
			"stacked"   => false,
			"justified" => false,
			"xclass"    => false,
			"data"      => false
		), $atts );

		$class = 'nav';
		$class .= ( $atts['type'] ) ? ' nav-' . $atts['type'] : ' nav-tabs';
		$class .= ( $atts['stacked'] == 'true' ) ? ' nav-stacked' : '';
		$class .= ( $atts['justified'] == 'true' ) ? ' nav-justified' : '';
		$class .= ( $atts['xclass'] ) ? ' ' . $atts['xclass'] : '';

		$data_props = $this->parse_data_attributes( $atts['data'] );

		return sprintf(
			'<ul class="%s"%s>%s</ul>',
			esc_attr( trim( $class ) ),
			( $data_props ) ? ' ' . $data_props : '',
			do_shortcode( $content )
		);
	}

	/*--------------------------------------------------------------------------------------
		*
		* bs_nav_item
		*
		*
		*-------------------------------------------------------------------------------------*/
	function bs_nav_item( $atts, $content = null ) {

		$atts = shortcode_atts( array(
			"link"     => false,
			"active"   => false,
			"disabled" => false,
			"dropdown" => false,
			"xclass"   => false,
			"data"     => false,
		), $atts );

		$li_classes = '';
		$li_classes .= ( $atts['dropdown'] ) ? 'dropdown' : '';
		$li_classes .= ( $atts['active'] == 'true' ) ? ' active' : '';
		$li_classes .= ( $atts['disabled'] == 'true' ) ? ' disabled' : '';

		$a_classes = '';
		$a_classes .= ( $atts['dropdown'] == 'true' ) ? ' dropdown-toggle' : '';
		$a_classes .= ( $atts['xclass'] ) ? ' ' . $atts['xclass'] : '';

		$data_props = $this->parse_data_attributes( $atts['data'] );

		# Wrong idea I guess ....
		#$pattern = ( $dropdown ) ? '<li%1$s><a href="%2$s"%3$s%4$s%5$s></a>%6$s</li>' : '<li%1$s><a href="%2$s"%3$s%4$s%5$s>%6$s</a></li>';

		//* If we have a dropdown shortcode inside the content we end the link before the dropdown shortcode, else all content goes inside the link
		$content = ( $atts['dropdown'] ) ? str_replace( '[dropdown]', '</a>[dropdown]', $content ) : $content . '</a>';

		return sprintf(
			'<li%1$s><a href="%2$s"%3$s%4$s%5$s>%6$s</li>',
			( ! empty( $li_classes ) ) ? sprintf( ' class="%s"', esc_attr( $li_classes ) ) : '',
			esc_url( $atts['link'] ),
			( ! empty( $a_classes ) ) ? sprintf( ' class="%s"', esc_attr( $a_classes ) ) : '',
			( $atts['dropdown'] ) ? ' data-toggle="dropdown"' : '',
			( $data_props ) ? ' ' . $data_props : '',
			do_shortcode( $content )
		);

	}

	/*--------------------------------------------------------------------------------------
		*
		* bs_alert
		*
		* @author Filip Stefansson
		* @since 1.0
		*
		*-------------------------------------------------------------------------------------*/
	function bs_alert( $atts, $content = null ) {

		$atts = shortcode_atts( array(
			"type"        => false,
			"dismissable" => false,
			"xclass"      => false,
			"data"        => false
		), $atts );

		$class = 'alert';
		$class .= ( $atts['type'] ) ? ' alert-' . $atts['type'] : ' alert-success';
		$class .= ( $atts['dismissable'] == 'true' ) ? ' alert-dismissable' : '';
		$class .= ( $atts['xclass'] ) ? ' ' . $atts['xclass'] : '';

		$dismissable = ( $atts['dismissable'] ) ? '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' : '';

		$data_props = $this->parse_data_attributes( $atts['data'] );

		return sprintf(
			'<div class="%s"%s>%s%s</div>',
			esc_attr( trim( $class ) ),
			( $data_props ) ? ' ' . $data_props : '',
			$dismissable,
			do_shortcode( $content )
		);
	}

	/*--------------------------------------------------------------------------------------
		*
		* bs_progress
		*
		*
		*-------------------------------------------------------------------------------------*/
	function bs_progress( $atts, $content = null ) {

		$atts = shortcode_atts( array(
			"striped"  => false,
			"animated" => false,
			"xclass"   => false,
			"data"     => false
		), $atts );

		$class = 'progress';
		$class .= ( $atts['striped'] == 'true' ) ? ' progress-striped' : '';
		$class .= ( $atts['animated'] == 'true' ) ? ' active' : '';
		$class .= ( $atts['xclass'] ) ? ' ' . $atts['xclass'] : '';

		$data_props = $this->parse_data_attributes( $atts['data'] );

		return sprintf(
			'<div class="%s"%s>%s</div>',
			esc_attr( trim( $class ) ),
			( $data_props ) ? ' ' . $data_props : '',
			do_shortcode( $content )
		);
	}

	/*--------------------------------------------------------------------------------------
		*
		* bs_progress_bar
		*
		*
		*-------------------------------------------------------------------------------------*/
	function bs_progress_bar( $atts, $content = null ) {

		$atts = shortcode_atts( array(
			"type"    => false,
			"percent" => false,
			"label"   => false,
			"xclass"  => false,
			"data"    => false
		), $atts );

		$class = 'progress-bar';
		$class .= ( $atts['type'] ) ? ' progress-bar-' . $atts['type'] : '';
		$class .= ( $atts['xclass'] ) ? ' ' . $atts['xclass'] : '';

		$data_props = $this->parse_data_attributes( $atts['data'] );

		return sprintf(
			'<div class="%s" role="progressbar" %s%s>%s</div>',
			esc_attr( trim( $class ) ),
			( $atts['percent'] ) ? ' aria-value="' . (int) $atts['percent'] . '" aria-valuemin="0" aria-valuemax="100" style="width: ' . (int) $atts['percent'] . '%;"' : '',
			( $data_props ) ? ' ' . $data_props : '',
			( $atts['percent'] ) ? sprintf( '<span%s>%s</span>', ( ! $atts['label'] ) ? ' class="sr-only"' : '', (int) $atts['percent'] . '% Complete' ) : ''
		);
	}

	/*--------------------------------------------------------------------------------------
		*
		* bs_code
		*
		* @author Filip Stefansson
		* @since 1.0
		*
		*-------------------------------------------------------------------------------------*/
	function bs_code( $atts, $content = null ) {

		$atts = shortcode_atts( array(
			"inline"     => false,
			"scrollable" => false,
			"xclass"     => false,
			"data"       => false
		), $atts );

		$class = '';
		$class .= ( $atts['scrollable'] == 'true' ) ? ' pre-scrollable' : '';
		$class .= ( $atts['xclass'] ) ? ' ' . $atts['xclass'] : '';

		$data_props = $this->parse_data_attributes( $atts['data'] );

		return sprintf(
			'<%1$s class="%2$s"%3$s>%4$s</%1$s>',
			( $atts['inline'] ) ? 'code' : 'pre',
			esc_attr( trim( $class ) ),
			( $data_props ) ? ' ' . $data_props : '',
			do_shortcode( $content )
		);
	}

	/*--------------------------------------------------------------------------------------
		*
		* bs_row
		*
		* @author Filip Stefansson
		* @since 1.0
		*
		*-------------------------------------------------------------------------------------*/
	function bs_row( $atts, $content = null ) {

		$atts = shortcode_atts( array(
			"flex-valign-xs"  => '',
			"flex-valign-sm"  => '',
			"flex-valign-md"  => '',
			"flex-valign-lg"  => '',
			"flex-valign-xl"  => '',
			"flex-halign-xs"  => '',
			"flex-halign-sm"  => '',
			"flex-halign-md"  => '',
			"flex-halign-lg"  => '',
			"flex-halign-xl" => '',
			"xclass"          => false,
			"data"            => false
		), $atts );

		$class = 'row';
		$class .= ( $atts['flex-valign-xs'] ) ? ' flex-align-xs-' . $atts['flex-valign-xs'] : '';
		$class .= ( $atts['flex-valign-sm'] ) ? ' flex-align-sm-' . $atts['flex-valign-sm'] : '';
		$class .= ( $atts['flex-valign-md'] ) ? ' flex-align-md-' . $atts['flex-valign-md'] : '';
		$class .= ( $atts['flex-valign-lg'] ) ? ' flex-align-lg-' . $atts['flex-valign-lg'] : '';
		$class .= ( $atts['flex-valign-xl'] ) ? ' flex-align-xl-' . $atts['flex-valign-xl'] : '';
		$class .= ( $atts['flex-halign-xs'] ) ? ' flex-items-xs-' . $atts['flex-halign-xs'] : '';
		$class .= ( $atts['flex-halign-sm'] ) ? ' flex-items-sm-' . $atts['flex-halign-sm'] : '';
		$class .= ( $atts['flex-halign-md'] ) ? ' flex-items-md-' . $atts['flex-halign-md'] : '';
		$class .= ( $atts['flex-halign-lg'] ) ? ' flex-items-lg-' . $atts['flex-halign-lg'] : '';
		$class .= ( $atts['flex-halign-xl'] ) ? ' flex-items-xl-' . $atts['flex-halign-xl'] : '';
		$class .= ( $atts['xclass'] ) ? ' ' . $atts['xclass'] : '';

		$data_props = $this->parse_data_attributes( $atts['data'] );

		return sprintf(
			'<div class="%s"%s>%s</div>',
			esc_attr( trim( $class ) ),
			( $data_props ) ? ' ' . $data_props : '',
			do_shortcode( $content )
		);
	}

	/*--------------------------------------------------------------------------------------
		*
		* bs_column
		*
		* @author Simon Yeldon
		* @since 1.0
		* @todo pull and offset
		*-------------------------------------------------------------------------------------*/
	function bs_column( $atts, $content = null ) {

		$atts = shortcode_atts( array(
			"xl"        => false,
			"lg"        => false,
			"md"        => false,
			"sm"        => false,
			"xs"        => false,
			"offset_xl" => false,
			"offset_lg" => false,
			"offset_md" => false,
			"offset_sm" => false,
			"offset_xs" => false,
			"pull_xl"   => false,
			"pull_lg"   => false,
			"pull_md"   => false,
			"pull_sm"   => false,
			"pull_xs"   => false,
			"push_xl"   => false,
			"push_lg"   => false,
			"push_md"   => false,
			"push_sm"   => false,
			"push_xs"   => false,
			"xclass"    => false,
			"data"      => false
		), $atts );

		$class = '';
		$class .= ( $atts['xl'] ) ? ' col-xl-' . $atts['xl'] : '';
		$class .= ( $atts['lg'] ) ? ' col-lg-' . $atts['lg'] : '';
		$class .= ( $atts['md'] ) ? ' col-md-' . $atts['md'] : '';
		$class .= ( $atts['sm'] ) ? ' col-sm-' . $atts['sm'] : '';
		$class .= ( $atts['xs'] ) ? ' col-xs-' . $atts['xs'] : '';
		$class .= ( $atts['offset_xl'] || $atts['offset_xl'] === "0" ) ? ' offset-xl-' . $atts['offset_xl'] : '';
		$class .= ( $atts['offset_lg'] || $atts['offset_lg'] === "0" ) ? ' offset-lg-' . $atts['offset_lg'] : '';
		$class .= ( $atts['offset_md'] || $atts['offset_md'] === "0" ) ? ' offset-md-' . $atts['offset_md'] : '';
		$class .= ( $atts['offset_sm'] || $atts['offset_sm'] === "0" ) ? ' offset-sm-' . $atts['offset_sm'] : '';
		$class .= ( $atts['offset_xs'] || $atts['offset_xs'] === "0" ) ? ' offset-xs-' . $atts['offset_xs'] : '';
		$class .= ( $atts['pull_xl'] || $atts['pull_xl'] === "0" ) ? ' pull-xl-' . $atts['pull_xl'] : '';
		$class .= ( $atts['pull_lg'] || $atts['pull_lg'] === "0" ) ? ' pull-lg-' . $atts['pull_lg'] : '';
		$class .= ( $atts['pull_md'] || $atts['pull_md'] === "0" ) ? ' pull-md-' . $atts['pull_md'] : '';
		$class .= ( $atts['pull_sm'] || $atts['pull_sm'] === "0" ) ? ' pull-sm' . $atts['pull_sm'] : '';
		$class .= ( $atts['pull_xs'] || $atts['pull_xs'] === "0" ) ? ' pull-xs' . $atts['pull_xs'] : '';
		$class .= ( $atts['push_xl'] || $atts['push_xl'] === "0" ) ? ' push-xl-' . $atts['push_xl'] : '';
		$class .= ( $atts['push_lg'] || $atts['push_lg'] === "0" ) ? ' push-lg-' . $atts['push_lg'] : '';
		$class .= ( $atts['push_md'] || $atts['push_md'] === "0" ) ? ' push-md-' . $atts['push_md'] : '';
		$class .= ( $atts['push_sm'] || $atts['push_sm'] === "0" ) ? ' push-sm-' . $atts['push_sm'] : '';
		$class .= ( $atts['push_xs'] || $atts['push_xs'] === "0" ) ? ' push-xs-' . $atts['push_xs'] : '';
		$class .= ( $atts['xclass'] ) ? ' ' . $atts['xclass'] : '';

		$data_props = $this->parse_data_attributes( $atts['data'] );

		return sprintf(
			'<div class="%s"%s>%s</div>',
			esc_attr( trim( $class ) ),
			( $data_props ) ? ' ' . $data_props : '',
			do_shortcode( $content )
		);
	}

	/*--------------------------------------------------------------------------------------
		*
		* bs_list_group
		*
		* @author M. W. Delaney
		*
		*-------------------------------------------------------------------------------------*/
	function bs_list_group( $atts, $content = null ) {

		$atts = shortcode_atts( array(
			"linked" => false,
			"xclass" => false,
			"data"   => false
		), $atts );

		$class = 'list-group';
		$class .= ( $atts['xclass'] ) ? ' ' . $atts['xclass'] : '';

		$data_props = $this->parse_data_attributes( $atts['data'] );

		return sprintf(
			'<%1$s class="%2$s"%3$s>%4$s</%1$s>',
			( $atts['linked'] == 'true' ) ? 'div' : 'ul',
			esc_attr( trim( $class ) ),
			( $data_props ) ? ' ' . $data_props : '',
			do_shortcode( $content )
		);
	}

	/*--------------------------------------------------------------------------------------
		*
		* bs_list_group_item
		*
		* @author M. W. Delaney
		*
		*-------------------------------------------------------------------------------------*/
	function bs_list_group_item( $atts, $content = null ) {

		$atts = shortcode_atts( array(
			"link"   => false,
			"type"   => false,
			"active" => false,
			"target" => false,
			"xclass" => false,
			"data"   => false
		), $atts );

		$class = 'list-group-item';
		$class .= ( $atts['type'] ) ? ' list-group-item-' . $atts['type'] : '';
		$class .= ( $atts['active'] == 'true' ) ? ' active' : '';
		$class .= ( $atts['xclass'] ) ? ' ' . $atts['xclass'] : '';

		$data_props = $this->parse_data_attributes( $atts['data'] );

		return sprintf(
			'<%1$s %2$s %3$s class="%4$s"%5$s>%6$s</%1$s>',
			( $atts['link'] ) ? 'a' : 'li',
			( $atts['link'] ) ? 'href="' . esc_url( $atts['link'] ) . '"' : '',
			( $atts['target'] ) ? sprintf( ' target="%s"', esc_attr( $atts['target'] ) ) : '',
			esc_attr( trim( $class ) ),
			( $data_props ) ? ' ' . $data_props : '',
			do_shortcode( $content )
		);
	}

	/*--------------------------------------------------------------------------------------
		*
		* bs_list_group_item_heading
		*
		*
		*-------------------------------------------------------------------------------------*/
	function bs_list_group_item_heading( $atts, $content = null ) {

		$atts = shortcode_atts( array(
			"xclass" => false,
			"data"   => false
		), $atts );

		$class = 'list-group-item-heading';
		$class .= ( $atts['xclass'] ) ? ' ' . $atts['xclass'] : '';

		$data_props = $this->parse_data_attributes( $atts['data'] );

		return sprintf(
			'<h4 class="%s"%s>%s</h4>',
			esc_attr( trim( $class ) ),
			( $data_props ) ? ' ' . $data_props : '',
			do_shortcode( $content )
		);
	}

	/*--------------------------------------------------------------------------------------
		*
		* bs_list_group_item_text
		*
		*
		*-------------------------------------------------------------------------------------*/
	function bs_list_group_item_text( $atts, $content = null ) {

		$atts = shortcode_atts( array(
			"xclass" => false,
			"data"   => false
		), $atts );

		$class = 'list-group-item-text';
		$class .= ( $atts['xclass'] ) ? ' ' . $atts['xclass'] : '';

		$data_props = $this->parse_data_attributes( $atts['data'] );

		return sprintf(
			'<p class="%s"%s>%s</p>',
			esc_attr( trim( $class ) ),
			( $data_props ) ? ' ' . $data_props : '',
			do_shortcode( $content )
		);
	}

	/*--------------------------------------------------------------------------------------
		*
		* bs_breadcrumb
		*
		*
		*-------------------------------------------------------------------------------------*/
	function bs_breadcrumb( $atts, $content = null ) {

		$atts = shortcode_atts( array(
			"xclass" => false,
			"data"   => false
		), $atts );

		$class = 'breadcrumb';
		$class .= ( $atts['xclass'] ) ? ' ' . $atts['xclass'] : '';

		$data_props = $this->parse_data_attributes( $atts['data'] );

		return sprintf(
			'<ol class="%s"%s>%s</ol>',
			esc_attr( trim( $class ) ),
			( $data_props ) ? ' ' . $data_props : '',
			do_shortcode( $content )
		);
	}

	/*--------------------------------------------------------------------------------------
		*
		* bs_breadcrumb_item
		*
		* @author M. W. Delaney
		*
		*-------------------------------------------------------------------------------------*/
	function bs_breadcrumb_item( $atts, $content = null ) {

		$atts = shortcode_atts( array(
			"link"   => false,
			"xclass" => false,
			"data"   => false
		), $atts );

		$class = '';
		$class .= ( $atts['xclass'] ) ? ' ' . $atts['xclass'] : '';

		$data_props = $this->parse_data_attributes( $atts['data'] );

		return sprintf(
			'<li><a href="%s" class="%s"%s>%s</a></li>',
			esc_url( $atts['link'] ),
			esc_attr( trim( $class ) ),
			( $data_props ) ? ' ' . $data_props : '',
			do_shortcode( $content )
		);
	}

	/*--------------------------------------------------------------------------------------
		*
		* bs_label
		*
		* @author Filip Stefansson
		* @since 1.0
		*
		*-------------------------------------------------------------------------------------*/
	function bs_label( $atts, $content = null ) {

		$atts = shortcode_atts( array(
			"type"   => false,
			"xclass" => false,
			"data"   => false
		), $atts );

		$class = 'label';
		$class .= ( $atts['type'] ) ? ' label-' . $atts['type'] : ' label-default';
		$class .= ( $atts['xclass'] ) ? ' ' . $atts['xclass'] : '';

		$data_props = $this->parse_data_attributes( $atts['data'] );

		return sprintf(
			'<span class="%s"%s>%s</span>',
			esc_attr( trim( $class ) ),
			( $data_props ) ? ' ' . $data_props : '',
			do_shortcode( $content )
		);
	}

	/*--------------------------------------------------------------------------------------
		*
		* bs_badge
		*
		* @author Filip Stefansson
		* @since 1.0
		*
		*-------------------------------------------------------------------------------------*/
	function bs_badge( $atts, $content = null ) {

		$atts = shortcode_atts( array(
			"right"  => false,
			"xclass" => false,
			"data"   => false
		), $atts );

		$class = 'badge';
		$class .= ( $atts['right'] == 'true' ) ? ' pull-right' : '';
		$class .= ( $atts['xclass'] ) ? ' ' . $atts['xclass'] : '';

		$data_props = $this->parse_data_attributes( $atts['data'] );

		return sprintf(
			'<span class="%s"%s>%s</span>',
			esc_attr( trim( $class ) ),
			( $data_props ) ? ' ' . $data_props : '',
			do_shortcode( $content )
		);
	}

	/*--------------------------------------------------------------------------------------
		*
		* bs_icon
		*
		* @author Filip Stefansson
		* @since 1.0
		*
		*-------------------------------------------------------------------------------------*/
	function bs_icon( $atts, $content = null ) {

		$atts = shortcode_atts( array(
			"type"   => false,
			"xclass" => false,
			"data"   => false
		), $atts );

		$class = 'glyphicon';
		$class .= ( $atts['type'] ) ? ' glyphicon-' . $atts['type'] : '';
		$class .= ( $atts['xclass'] ) ? ' ' . $atts['xclass'] : '';

		$data_props = $this->parse_data_attributes( $atts['data'] );

		return sprintf(
			'<span class="%s"%s>%s</span>',
			esc_attr( trim( $class ) ),
			( $data_props ) ? ' ' . $data_props : '',
			do_shortcode( $content )
		);
	}

	/*--------------------------------------------------------------------------------------
		*
		* simple_table
		*
		* @author Filip Stefansson
		* @since 1.0
		*
		*-------------------------------------------------------------------------------------
	function bs_table( $atts ) {
			extract( shortcode_atts( array(
					'cols' => 'none',
					'data' => 'none',
					'bordered' => false,
					'striped' => false,
					'hover' => false,
					'condensed' => false,
			), $atts ) );
			$cols = explode(',',$cols);
			$data = explode(',',$data);
			$total = count($cols);
			$return  = '<table class="table ';
			$return .= ($bordered) ? 'table-bordered ' : '';
			$return .= ($striped) ? 'table-striped ' : '';
			$return .= ($hover) ? 'table-hover ' : '';
			$return .= ($condensed) ? 'table-condensed ' : '';
			$return .='"><tr>';
			foreach($cols as $col):
					$return .= '<th>'.$col.'</th>';
			endforeach;
			$output .= '</tr><tr>';
			$counter = 1;
			foreach($data as $datum):
					$return .= '<td>'.$datum.'</td>';
					if($counter%$total==0):
							$return .= '</tr>';
					endif;
					$counter++;
			endforeach;
					$return .= '</table>';
			return $return;
	}
	*/

	/*--------------------------------------------------------------------------------------
		*
		* bs_table_wrap
		*
		* @author Filip Stefansson
		* @since 1.0
		*
		*-------------------------------------------------------------------------------------*/
	function bs_table_wrap( $atts, $content = null ) {

		$atts = shortcode_atts( array(
			'bordered'   => false,
			'striped'    => false,
			'hover'      => false,
			'condensed'  => false,
			'responsive' => false,
			'xclass'     => false,
			'data'       => false
		), $atts );

		$class = 'table';
		$class .= ( $atts['bordered'] == 'true' ) ? ' table-bordered' : '';
		$class .= ( $atts['striped'] == 'true' ) ? ' table-striped' : '';
		$class .= ( $atts['hover'] == 'true' ) ? ' table-hover' : '';
		$class .= ( $atts['condensed'] == 'true' ) ? ' table-condensed' : '';
		$class .= ( $atts['xclass'] ) ? ' ' . $atts['xclass'] : '';

		$return = '';

		$tag     = array( 'table' );
		$content = do_shortcode( $content );

		$return .= $this->scrape_dom_element( $tag, $content, $class, '', $atts['data'] );
		$return = ( $atts['responsive'] ) ? '<div class="table-responsive">' . $return . '</div>' : $return;

		return $return;
	}

	/*--------------------------------------------------------------------------------------
			*
			* bs_card_deck
			*
			* @author Ciro Mattia Gonano
			* @since 4.0
			*
			* Options:
			*   size: sm = small, lg = large
			*
			*-------------------------------------------------------------------------------------*/
	function bs_card_deck( $atts, $content = null ) {
		$atts = shortcode_atts( array(
			"xclass" => false,
			"data"   => false
		), $atts );

		$outer_class = 'card-deck-wrapper';
		$class       = 'card-deck';
		$class .= ( $atts['xclass'] ) ? ' ' . $atts['xclass'] : '';

		$data_props = $this->parse_data_attributes( $atts['data'] );

		return sprintf(
			'<div class="%s"><div class="%s"%s>%s</div></div>',
			esc_attr( trim( $outer_class ) ),
			esc_attr( trim( $class ) ),
			( $data_props ) ? ' ' . $data_props : '',
			do_shortcode( $content )
		);
	}

	/*--------------------------------------------------------------------------------------
		*
		* bs_card
		*
		* @author Ciro Mattia Gonano
		* @since 4.0
		*
		* Options:
		*   size: sm = small, lg = large
		*
		*-------------------------------------------------------------------------------------*/
	function bs_card( $atts, $content = null ) {

		$atts = shortcode_atts( array(
			"size"        => false,
			"title"       => '',
			"img_top"     => '',
			"img_bottom"  => '',
			'img_overlay' => false,
			"inverse"     => false,
			"xclass"      => false,
			"data"        => false
		), $atts );

		$class = 'card';
		$class .= ( $atts['inverse'] ) ? ' card-inverse' : '';
		$class .= ( $atts['size'] ) ? ' well-' . $atts['size'] : '';
		$class .= ( $atts['xclass'] ) ? ' ' . $atts['xclass'] : '';
		$card_block_class = ( $atts['img_overlay'] ) ? 'card-img-overlay' : 'card-block';
		$img_top_class    = 'card-img-top';
		$img_bottom_class = 'card-img-bottom';

		$data_props = $this->parse_data_attributes( $atts['data'] );

		return sprintf(
			'<div class="%s"%s>%s<div class="%s">%s</div>%s</div>',
			esc_attr( trim( $class ) ),
			( $data_props ) ? ' ' . $data_props : '',
			( $atts['img_top'] ) ? '<img class="' . $img_top_class . '" src="' . esc_url( $atts['img_top'] ) . '" alt="Card image cap">' : '',
			esc_attr( trim( $card_block_class ) ),
			do_shortcode( $content ),
			( $atts['img_bottom'] ) ? '<img class="' . $img_bottom_class . '" src="' . esc_url( $atts['img_bottom'] ) . '" alt="Card image cap">' : ''
		);
	}

	/*--------------------------------------------------------------------------------------
		*
		* bs_tabs
		*
		* @author Filip Stefansson
		* @since 1.0
		* Modified by TwItCh twitch@designweapon.com
		* Now acts a whole nav/tab/pill shortcode solution!
		*-------------------------------------------------------------------------------------*/
	function bs_tabs( $atts, $content = null ) {

		if ( isset( $GLOBALS['tabs_count'] ) ) {
			$GLOBALS['tabs_count'] ++;
		} else {
			$GLOBALS['tabs_count'] = 0;
		}

		$GLOBALS['tabs_default_count'] = 0;

		$atts = apply_filters( 'bs_tabs_atts', $atts );

		$atts = shortcode_atts( array(
			"type"   => false,
			"xclass" => false,
			"data"   => false,
			"name"   => false,
		), $atts );

		$ul_class = 'nav';
		$ul_class .= ( $atts['type'] ) ? ' nav-' . $atts['type'] : ' nav-tabs';
		$ul_class .= ( $atts['xclass'] ) ? ' ' . $atts['xclass'] : '';

		$div_class = 'tab-content';

		// If user defines name of group, use that for ID for tab history purposes
		if ( isset( $atts['name'] ) ) {
			$id = $atts['name'];
		} else {
			$id = 'custom-tabs-' . $GLOBALS['tabs_count'];
		}


		$data_props = $this->parse_data_attributes( $atts['data'] );

		$atts_map = bs_attribute_map( $content );

		// Extract the tab titles for use in the tab widget.
		if ( $atts_map ) {
			$tabs                           = array();
			$GLOBALS['tabs_default_active'] = true;
			foreach ( $atts_map as $check ) {
				if ( ! empty( $check["tab"]["active"] ) ) {
					$GLOBALS['tabs_default_active'] = false;
				}
			}
			$i = 0;
			foreach ( $atts_map as $tab ) {

				$class = '';
				$class .= ( ! empty( $tab["tab"]["active"] ) || ( $GLOBALS['tabs_default_active'] && $i == 0 ) ) ? 'active' : '';
				$class .= ( ! empty( $tab["tab"]["xclass"] ) ) ? ' ' . sanitize_html_class( $tab["tab"]["xclass"] ) : '';

				if ( ! isset( $tab["tab"]["link"] ) ) {
					$tab_id = 'custom-tab-' . $GLOBALS['tabs_count'] . '-' . md5( $tab["tab"]["title"] );
				} else {
					$tab_id = $tab["tab"]["link"];
				}

				$tabs[] = sprintf(
					'<li%s><a href="#%s" data-toggle="tab" >%s</a></li>',
					( ! empty( $class ) ) ? ' class="' . $class . '"' : '',
					sanitize_html_class( $tab_id ),
					$tab["tab"]["title"]
				);
				$i ++;
			}
		}
		$output = sprintf(
			'<ul class="%s" id="%s"%s>%s</ul><div class="%s">%s</div>',
			esc_attr( $ul_class ),
			sanitize_html_class( $id ),
			( $data_props ) ? ' ' . $data_props : '',
			( $tabs ) ? implode( $tabs ) : '',
			sanitize_html_class( $div_class ),
			do_shortcode( $content )
		);

		return apply_filters( 'bs_tabs', $output );
	}

	/*--------------------------------------------------------------------------------------
		*
		* bs_tab
		*
		* @author Filip Stefansson
		* @since 1.0
		*
		*-------------------------------------------------------------------------------------*/
	function bs_tab( $atts, $content = null ) {

		$atts = shortcode_atts( array(
			'title'  => false,
			'active' => false,
			'fade'   => false,
			'xclass' => false,
			'data'   => false,
			'link'   => false
		), $atts );

		if ( $GLOBALS['tabs_default_active'] && $GLOBALS['tabs_default_count'] == 0 ) {
			$atts['active'] = true;
		}
		$GLOBALS['tabs_default_count'] ++;

		$class = 'tab-pane';
		$class .= ( $atts['fade'] == 'true' ) ? ' fade' : '';
		$class .= ( $atts['active'] == 'true' ) ? ' active' : '';
		$class .= ( $atts['active'] == 'true' && $atts['fade'] == 'true' ) ? ' in' : '';
		$class .= ( $atts['xclass'] ) ? ' ' . $atts['xclass'] : '';


		if ( ! isset( $atts['link'] ) || $atts['link'] == null ) {
			$id = 'custom-tab-' . $GLOBALS['tabs_count'] . '-' . md5( $atts['title'] );
		} else {
			$id = $atts['link'];
		}
		$data_props = $this->parse_data_attributes( $atts['data'] );

		return sprintf(
			'<div id="%s" class="%s"%s>%s</div>',
			sanitize_html_class( $id ),
			esc_attr( trim( $class ) ),
			( $data_props ) ? ' ' . $data_props : '',
			do_shortcode( $content )
		);

	}


	/*--------------------------------------------------------------------------------------
		*
		* bs_accordion
		*
		* @author Ciro Mattia Gonano
		* @since 4.0
		*
		*-------------------------------------------------------------------------------------*/
	function bs_accordion( $atts, $content = null ) {

		if ( isset( $GLOBALS['collapsibles_count'] ) ) {
			$GLOBALS['collapsibles_count'] ++;
		} else {
			$GLOBALS['collapsibles_count'] = 0;
		}

		$atts = shortcode_atts( array(
			"xclass" => false,
			"data"   => false
		), $atts );

		$class = '';
		$class .= ( $atts['xclass'] ) ? ' ' . $atts['xclass'] : '';

		$id = 'custom-collapse-' . $GLOBALS['collapsibles_count'];

		$data_props = $this->parse_data_attributes( $atts['data'] );

		return sprintf(
			'<div class="%s" id="%s" role="tablist" aria-multiselectable="true"%s>%s</div>',
			esc_attr( trim( $class ) ),
			esc_attr( $id ),
			( $data_props ) ? ' ' . $data_props : '',
			do_shortcode( $content )
		);

	}


	/*--------------------------------------------------------------------------------------
		*
		* bs_collapse
		*
		* @author Filip Stefansson
		* @since 1.0
		*
		*-------------------------------------------------------------------------------------*/
	function bs_collapse( $atts, $content = null ) {

		if ( isset( $GLOBALS['single_collapse_count'] ) ) {
			$GLOBALS['single_collapse_count'] ++;
		} else {
			$GLOBALS['single_collapse_count'] = 0;
		}

		$atts = shortcode_atts( array(
			"title"  => false,
			"type"   => false,
			"active" => false,
			"xclass" => false,
			"data"   => false
		), $atts );

		$card_class = 'card';
		$card_class .= ( $atts['type'] ) ? ' card-' . $atts['type'] : ' card-default';
		$card_class .= ( $atts['xclass'] ) ? ' ' . $atts['xclass'] : '';

		$collapse_class = 'collapse';
		$collapse_class .= ( $atts['active'] == 'true' ) ? ' in' : '';

		$a_class = '';
		$a_class .= ( $atts['active'] == 'true' ) ? '' : 'collapsed';

		$parent           = isset( $GLOBALS['collapsibles_count'] ) ? 'custom-collapse-' . $GLOBALS['collapsibles_count'] : 'single-collapse';
		$current_collapse = $parent . '-' . $GLOBALS['single_collapse_count'];

		$data_props = $this->parse_data_attributes( $atts['data'] );

		return sprintf(
			'<div class="%1$s"%2$s>
				<div class="card-header">
					<h5>
						<a class="%3$s" data-toggle="collapse"%4$s href="#%5$s">%6$s</a>
					</h5>
				</div>
				<div id="%5$s" class="%7$s">
					<div class="card-block">%8$s</div>
				</div>
			</div>',
			esc_attr( $card_class ),
			( $data_props ) ? ' ' . $data_props : '',
			$a_class,
			( $parent ) ? ' data-parent="#' . $parent . '"' : '',
			$current_collapse,
			$atts['title'],
			esc_attr( $collapse_class ),
			do_shortcode( $content )
		);
	}


	/*--------------------------------------------------------------------------------------
		*
		* bs_carousel
		*
		* @since 1.0
		*
		*-------------------------------------------------------------------------------------*/
	function bs_carousel( $atts, $content = null ) {

		if ( isset( $GLOBALS['carousel_count'] ) ) {
			$GLOBALS['carousel_count'] ++;
		} else {
			$GLOBALS['carousel_count'] = 0;
		}

		$GLOBALS['carousel_default_count'] = 0;

		$atts = shortcode_atts( array(
			"interval" => false,
			"pause"    => false,
			"wrap"     => false,
			"xclass"   => false,
			"data"     => false,
		), $atts );

		$div_class = 'carousel slide';
		$div_class .= ( $atts['xclass'] ) ? ' ' . $atts['xclass'] : '';

		$inner_class = 'carousel-inner';

		$id = 'custom-carousel-' . $GLOBALS['carousel_count'];

		$data_props = $this->parse_data_attributes( $atts['data'] );

		$atts_map = bs_attribute_map( $content );

		// Extract the slide titles for use in the carousel widget.
		if ( $atts_map ) {
			$indicators                         = array();
			$GLOBALS['carousel_default_active'] = true;
			foreach ( $atts_map as $check ) {
				if ( ! empty( $check["carousel-item"]["active"] ) ) {
					$GLOBALS['carousel_default_active'] = false;
				}
			}
			$i = 0;
			foreach ( $atts_map as $slide ) {
				$indicators[] = sprintf(
					'<li class="%s" data-target="%s" data-slide-to="%s"></li>',
					( ! empty( $slide["carousel-item"]["active"] ) || ( $GLOBALS['carousel_default_active'] && $i == 0 ) ) ? 'active' : '',
					esc_attr( '#' . $id ),
					esc_attr( $i )
				);
				$i ++;
			}
		}

		return sprintf(
			'<div class="%s" id="%s" data-ride="carousel"%s%s%s%s>%s<div class="%s">%s</div>%s%s</div>',
			esc_attr( $div_class ),
			esc_attr( $id ),
			( $atts['interval'] ) ? sprintf( ' data-interval="%d"', $atts['interval'] ) : '',
			( $atts['pause'] ) ? sprintf( ' data-pause="%s"', esc_attr( $atts['pause'] ) ) : '',
			( $atts['wrap'] == 'true' ) ? sprintf( ' data-wrap="%s"', esc_attr( $atts['wrap'] ) ) : '',
			( $data_props ) ? ' ' . $data_props : '',
			( $indicators ) ? '<ol class="carousel-indicators">' . implode( $indicators ) . '</ol>' : '',
			esc_attr( $inner_class ),
			do_shortcode( $content ),
			'<a class="carousel-control-prev" href="' . esc_url( '#' . $id ) . '" role="button" data-slide="prev"><span class="carousel-control-prev-icon" aria-hidden="true"></span><span class="sr-only">' . _x( 'Previous', 'Carousel control arrow' ) . '</span></a>',
			'<a class="carousel-control-next" href="' . esc_url( '#' . $id ) . '" role="button" data-slide="next"><span class="carousel-control-next-icon" aria-hidden="true"></span><span class="sr-only">' . _x( 'Next', 'Carousel control arrow' ) . '</span></a>'
		);
	}


	/*--------------------------------------------------------------------------------------
		*
		* bs_carousel_item
		*
		* @author Filip Stefansson
		* @since 1.0
		*
		*-------------------------------------------------------------------------------------*/
	function bs_carousel_item( $atts, $content = null ) {

		$atts = shortcode_atts( array(
			"active"  => false,
			"caption" => false,
			"xclass"  => false,
			"data"    => false
		), $atts );

		if ( $GLOBALS['carousel_default_active'] && $GLOBALS['carousel_default_count'] == 0 ) {
			$atts['active'] = true;
		}
		$GLOBALS['carousel_default_count'] ++;

		$class = 'carousel-item';
		$class .= ( $atts['active'] == 'true' ) ? ' active' : '';
		$class .= ( $atts['xclass'] ) ? ' ' . $atts['xclass'] : '';

		$data_props = $this->parse_data_attributes( $atts['data'] );

		//$content = preg_replace('/class=".*?"/', '', $content);
		$content = preg_replace( '/alignnone/', '', $content );
		$content = preg_replace( '/alignright/', '', $content );
		$content = preg_replace( '/alignleft/', '', $content );
		$content = preg_replace( '/aligncenter/', '', $content );

		return sprintf(
			'<div class="%s"%s>%s%s</div>',
			esc_attr( trim( $class ) ),
			( $data_props ) ? ' ' . $data_props : '',
			do_shortcode( $content ),
			( $atts['caption'] ) ? '<div class="carousel-caption">' . esc_html( $atts['caption'] ) . '</div>' : ''
		);
	}

	/*--------------------------------------------------------------------------------------
        *
        * bs_carousel_caption
        *
        * @author Ciro Mattia Gonano
        * @since 4.0
        *
        *-------------------------------------------------------------------------------------*/
	function bs_carousel_caption( $atts, $content = null ) {

		$atts = shortcode_atts( array(
			"xclass" => false,
			"data"   => false
		), $atts );

		$class = 'carousel-caption';
		$class .= ( $atts['xclass'] ) ? ' ' . $atts['xclass'] : '';

		$data_props = $this->parse_data_attributes( $atts['data'] );

		return sprintf(
			'<div class="%s"%s>%s</div>',
			esc_attr( trim( $class ) ),
			( $data_props ) ? ' ' . $data_props : '',
			do_shortcode( $content )
		);
	}

	/*--------------------------------------------------------------------------------------
		*
		* bs_tooltip
		*
		* @author
		* @since 1.0
		*
		*-------------------------------------------------------------------------------------*/


	function bs_tooltip( $atts, $content = null ) {

		$atts = shortcode_atts( array(
			'title'     => '',
			'placement' => 'top',
			'animation' => 'true',
			'html'      => 'false',
			'data'      => ''
		), $atts );

		$class = 'bs-tooltip';

		$atts['data'] .= ( $atts['animation'] ) ? $this->check_for_data( $atts['data'] ) . 'animation,' . $atts['animation'] : '';
		$atts['data'] .= ( $atts['placement'] ) ? $this->check_for_data( $atts['data'] ) . 'placement,' . $atts['placement'] : '';
		$atts['data'] .= ( $atts['html'] ) ? $this->check_for_data( $atts['data'] ) . 'html,' . $atts['html'] : '';

		$return  = '';
		$tag     = 'span';
		$content = do_shortcode( $content );
		$return .= $this->get_dom_element( $tag, $content, $class, $atts['title'], $atts['data'] );

		return $return;

	}

	/*--------------------------------------------------------------------------------------
		*
		* bs_popover
		*
		*
		*-------------------------------------------------------------------------------------*/

	function bs_popover( $atts, $content = null ) {

		$atts = shortcode_atts( array(
			'title'     => false,
			'text'      => '',
			'placement' => 'top',
			'animation' => 'true',
			'html'      => 'false',
			'data'      => ''
		), $atts );

		$class = 'bs-popover';

		$atts['data'] .= $this->check_for_data( $atts['data'] ) . 'toggle,popover';
		$atts['data'] .= $this->check_for_data( $atts['data'] ) . 'content,' . str_replace( ',', '&#44;', $atts['text'] );
		$atts['data'] .= ( $atts['animation'] ) ? $this->check_for_data( $atts['data'] ) . 'animation,' . $atts['animation'] : '';
		$atts['data'] .= ( $atts['placement'] ) ? $this->check_for_data( $atts['data'] ) . 'placement,' . $atts['placement'] : '';
		$atts['data'] .= ( $atts['html'] ) ? $this->check_for_data( $atts['data'] ) . 'html,' . $atts['html'] : '';

		$return  = '';
		$tag     = 'span';
		$content = do_shortcode( $content );
		$return .= $this->get_dom_element( $tag, $content, $class, $atts['title'], $atts['data'] );

		return html_entity_decode( $return );

	}


	/*--------------------------------------------------------------------------------------
		*
		* bs_media
		*
		* @author
		* @since 1.0
		*
		*-------------------------------------------------------------------------------------*/

	function bs_media_list( $atts, $content = null ) {

		$atts = shortcode_atts( array(
			"xclass" => false,
			"data"   => false
		), $atts );

		$class = 'media-list';
		$class .= ( $atts['xclass'] ) ? ' ' . $atts['xclass'] : '';

		$data_props = $this->parse_data_attributes( $atts['data'] );

		return sprintf(
			'<div class="%s"%s>%s</div>',
			esc_attr( trim( $class ) ),
			( $data_props ) ? ' ' . $data_props : '',
			do_shortcode( $content )
		);
	}

	function bs_media( $atts, $content = null ) {

		$atts = shortcode_atts( array(
			"xclass" => false,
			"data"   => false
		), $atts );

		$class = 'media';
		$class .= ( $atts['xclass'] ) ? ' ' . $atts['xclass'] : '';

		$data_props = $this->parse_data_attributes( $atts['data'] );

		return sprintf(
			'<div class="%s"%s>%s</div>',
			esc_attr( trim( $class ) ),
			( $data_props ) ? ' ' . $data_props : '',
			do_shortcode( $content )
		);
	}

	function bs_media_object( $atts, $content = null ) {

		$atts = shortcode_atts( array(
			"halign" => "left",
			"valign" => "top",
			"xclass" => false,
			"data"   => false
		), $atts );

		$class = "media-object img-fluid";
		$class .= ( $atts['xclass'] ) ? ' ' . $atts['xclass'] : '';

		$media_class = 'media-' . $atts['halign'];
		$media_class .= ( $atts['valign'] != 'top' ) ? ' media-' . $atts['valign'] : '';

		$return = '';

		$tag     = array( 'figure', 'div', 'img', 'i', 'span' );
		$content = do_shortcode( preg_replace( '/(<br>)+$/', '', $content ) );
		$return .= $this->scrape_dom_element( $tag, $content, $class, '', $atts['data'] );
		$return = '<span class="' . $media_class . '">' . $return . '</span>';

		return $return;
	}

	function bs_media_body( $atts, $content = null ) {

		$atts = shortcode_atts( array(
			"title"  => false,
			"xclass" => false,
			"data"   => false
		), $atts );

		$div_class = 'media-body';
		$div_class .= ( $atts['xclass'] ) ? ' ' . $atts['xclass'] : '';

		$h4_class = 'media-heading';
		$h4_class .= ( $atts['xclass'] ) ? ' ' . $atts['xclass'] : '';

		$data_props = $this->parse_data_attributes( $atts['data'] );

		return sprintf(
			'<div class="%s"%s><h4 class="%s">%s</h4>%s</div>',
			esc_attr( $div_class ),
			( $data_props ) ? ' ' . $data_props : '',
			esc_attr( $h4_class ),
			esc_html( $atts['title'] ),
			do_shortcode( $content )
		);
	}

	/*--------------------------------------------------------------------------------------
		*
		* bs_jumbotron
		*
		*
		*-------------------------------------------------------------------------------------*/
	function bs_jumbotron( $atts, $content = null ) {

		$atts = shortcode_atts( array(
			"title"  => false,
			"xclass" => false,
			"data"   => false
		), $atts );

		$class = 'jumbotron';
		$class .= ( $atts['xclass'] ) ? ' ' . $atts['xclass'] : '';

		$data_props = $this->parse_data_attributes( $atts['data'] );

		return sprintf(
			'<div class="%s"%s>%s%s</div>',
			esc_attr( trim( $class ) ),
			( $data_props ) ? ' ' . $data_props : '',
			( $atts['title'] ) ? '<h1>' . esc_html( $atts['title'] ) . '</h1>' : '',
			do_shortcode( $content )
		);
	}

	/*--------------------------------------------------------------------------------------
		*
		* bs_page_header
		*
		*
		*-------------------------------------------------------------------------------------*/
	function bs_page_header( $atts, $content = null ) {

		$atts = shortcode_atts( array(
			"xclass" => false,
			"data"   => false
		), $atts );

		$data_props = $this->parse_data_attributes( $atts['data'] );

		$class = "page-header";
		$class .= ( $atts['xclass'] ) ? ' ' . $atts['xclass'] : '';

		$return  = '';
		$title   = '';
		$tag     = 'div';
		$content = $this->strip_paragraph( $content );
		$content = $this->nest_dom_element( 'h1', 'div', $content );
		$return .= $this->get_dom_element( $tag, $content, $class, '', $atts['data'] );

		return $return;

	}

	/*--------------------------------------------------------------------------------------
		*
		* bs_lead
		*
		*
		*-------------------------------------------------------------------------------------*/
	function bs_lead( $atts, $content = null ) {

		$atts = shortcode_atts( array(
			"xclass" => false,
			"data"   => false
		), $atts );

		$class = 'lead';
		$class .= ( $atts['xclass'] ) ? ' ' . $atts['xclass'] : '';

		$data_props = $this->parse_data_attributes( $atts['data'] );

		return sprintf(
			'<p class="%s"%s>%s</p>',
			esc_attr( trim( $class ) ),
			( $data_props ) ? ' ' . $data_props : '',
			do_shortcode( $content )
		);
	}

	/*--------------------------------------------------------------------------------------
		*
		* bs_emphasis
		*
		*
		*-------------------------------------------------------------------------------------*/
	function bs_emphasis( $atts, $content = null ) {

		$atts = shortcode_atts( array(
			"type"   => false,
			"xclass" => false,
			"data"   => false
		), $atts );

		$class = '';
		$class .= ( $atts['type'] ) ? 'text-' . $atts['type'] : 'text-muted';
		$class .= ( $atts['xclass'] ) ? ' ' . $atts['xclass'] : '';

		$data_props = $this->parse_data_attributes( $atts['data'] );

		return sprintf(
			'<span class="%s"%s>%s</span>',
			esc_attr( trim( $class ) ),
			( $data_props ) ? ' ' . $data_props : '',
			do_shortcode( $content )
		);
	}

	/*--------------------------------------------------------------------------------------
		*
		* bs_img
		*
		*
		*-------------------------------------------------------------------------------------*/
	function bs_img( $atts, $content = null ) {

		$atts = shortcode_atts( array(
			"type"   => false,
			"fluid"  => false,
			"xclass" => false,
			"data"   => false
		), $atts );

		$class = '';
		$class .= ( $atts['type'] ) ? 'img-' . $atts['type'] . ' ' : '';
		$class .= ( $atts['fluid'] == 'true' ) ? ' img-fluid' : '';
		$class .= ( $atts['xclass'] ) ? ' ' . $atts['xclass'] : '';

		$return  = '';
		$tag     = array( 'img' );
		$content = do_shortcode( $content );
		$return .= $this->scrape_dom_element( $tag, $content, $class, '', $atts['data'] );

		return $return;

	}

	/*--------------------------------------------------------------------------------------
		*
		* bs_embed_responsive
		*
		*
		*-------------------------------------------------------------------------------------*/
	function bs_embed_responsive( $atts, $content = null ) {

		$atts = shortcode_atts( array(
			"ratio"  => false,
			"xclass" => false,
			"data"   => false
		), $atts );

		$class = 'embed-responsive ';
		$class .= ( $atts['ratio'] ) ? ' embed-responsive-' . $atts['ratio'] . ' ' : '';
		$class .= ( $atts['xclass'] ) ? ' ' . $atts['xclass'] : '';

		$embed_class = 'embed-responsive-item';

		$tag        = array( 'iframe', 'embed', 'video', 'object' );
		$content    = do_shortcode( $content );
		$data_props = $this->parse_data_attributes( $atts['data'] );

		return sprintf(
			'<div class="%s"%s>%s</div>',
			esc_attr( trim( $class ) ),
			( $data_props ) ? ' ' . $data_props : '',
			$this->scrape_dom_element( $tag, $content, $embed_class, '', '' )
		);

	}

	/*--------------------------------------------------------------------------------------
	*
	* bs_responsive
	*
	*
	*-------------------------------------------------------------------------------------*/
	function bs_responsive( $atts, $content = null ) {

		$atts = shortcode_atts( array(
			"visible"      => false,
			"hidden"       => false,
			"block"        => false,
			"inline"       => false,
			"inline_block" => false,
			"xclass"       => false,
			"data"         => false
		), $atts );

		$class = '';
		if ( $atts['visible'] ) {
			$visible = explode( ' ', $atts['visible'] );
			foreach ( $visible as $v ):
				$class .= "visible-$v ";
			endforeach;
		}
		if ( $atts['hidden'] ) {
			$hidden = explode( ' ', $atts['hidden'] );
			foreach ( $hidden as $h ):
				$class .= "hidden-$h ";
			endforeach;
		}
		if ( $atts['block'] ) {
			$block = explode( ' ', $atts['block'] );
			foreach ( $block as $b ):
				$class .= "visible-$b-block ";
			endforeach;
		}
		if ( $atts['inline'] ) {
			$inline = explode( ' ', $atts['inline'] );
			foreach ( $inline as $i ):
				$class .= "visible-$i-inline ";
			endforeach;
		}
		if ( $atts['inline_block'] ) {
			$inline_block = explode( ' ', $atts['inline_block'] );
			foreach ( $inline_block as $ib ):
				$class .= "visible-$ib-inline ";
			endforeach;
		}
		$class .= ( $atts['xclass'] ) ? ' ' . $atts['xclass'] : '';

		$data_props = $this->parse_data_attributes( $atts['data'] );

		return sprintf(
			'<span class="%s"%s>%s</span>',
			esc_attr( trim( $class ) ),
			( $data_props ) ? ' ' . $data_props : '',
			do_shortcode( $content )
		);
	}

	/*--------------------------------------------------------------------------------------
		*
		* bs_modal
		*
		* @author M. W. Delaney
		* @since 1.0
		*
		*-------------------------------------------------------------------------------------*/
	function bs_modal( $atts, $content = null ) {

		if ( isset( $GLOBALS['modal_count'] ) ) {
			$GLOBALS['modal_count'] ++;
		} else {
			$GLOBALS['modal_count'] = 0;
		}

		$atts = shortcode_atts( array(
			"text"   => false,
			"title"  => false,
			"size"   => false,
			"xclass" => false,
			"data"   => false
		), $atts );

		$a_class = '';
		$a_class .= ( $atts['xclass'] ) ? ' ' . $atts['xclass'] : '';

		$div_class = 'modal fade';
		$div_class .= ( $atts['size'] ) ? ' bs-modal-' . $atts['size'] : '';

		$div_size = ( $atts['size'] ) ? ' modal-' . $atts['size'] : '';

		$id = 'custom-modal-' . $GLOBALS['modal_count'];

		$data_props = $this->parse_data_attributes( $atts['data'] );

		$modal_output = sprintf(
			'<div class="%1$s" id="%2$s" tabindex="-1" role="dialog" aria-hidden="true">
						<div class="modal-dialog %3$s">
								<div class="modal-content">
										<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
												%4$s
										</div>
										<div class="modal-body">
												%5$s
										</div>
								</div> <!-- /.modal-content -->
						</div> <!-- /.modal-dialog -->
				</div> <!-- /.modal -->
				',
			esc_attr( $div_class ),
			esc_attr( $id ),
			esc_attr( $div_size ),
			( $atts['title'] ) ? '<h4 class="modal-title">' . $atts['title'] . '</h4>' : '',
			do_shortcode( $content )
		);

		add_action( 'wp_footer', function () use ( $modal_output ) {
			echo $modal_output;
		}, 100, 0 );

		return sprintf(
			'<a data-toggle="modal" href="#%1$s" class="%2$s"%3$s>%4$s</a>',
			esc_attr( $id ),
			esc_attr( $a_class ),
			( $data_props ) ? ' ' . $data_props : '',
			esc_html( $atts['text'] )
		);
	}

	/*--------------------------------------------------------------------------------------
		*
		* bs_modal_footer
		*
		* @author M. W. Delaney
		* @since 1.0
		*
		*-------------------------------------------------------------------------------------*/
	function bs_modal_footer( $atts, $content = null ) {

		$atts = shortcode_atts( array(
			"xclass" => false,
			"data"   => false,
		), $atts );

		$class = 'modal-footer';
		$class .= ( $atts['xclass'] ) ? ' ' . $atts['xclass'] : '';

		$data_props = $this->parse_data_attributes( $atts['data'] );

		return sprintf(
			'</div><div class="%s"%s>%s',
			esc_attr( trim( $class ) ),
			( $data_props ) ? ' ' . $data_props : '',
			do_shortcode( $content )
		);
	}

	/*--------------------------------------------------------------------------------------
		*
		* Parse data-attributes for shortcodes
		*
		*-------------------------------------------------------------------------------------*/
	function parse_data_attributes( $data ) {

		$data_props = '';

		if ( $data ) {
			$data = explode( '|', $data );

			foreach ( $data as $d ) {
				$d = explode( ',', $d );
				$data_props .= sprintf( 'data-%s="%s" ', esc_html( $d[0] ), esc_attr( trim( $d[1] ) ) );
			}
		} else {
			$data_props = false;
		}

		return $data_props;
	}

	/*--------------------------------------------------------------------------------------
		*
		* get DOMDocument element and apply shortcode parameters to it. Create the element if it doesn't exist
		*
		*-------------------------------------------------------------------------------------*/
	function get_dom_element( $tag, $content, $class, $title = '', $data = null ) {

		//clean up content
		$content        = trim( trim( $content ), chr( 0xC2 ) . chr( 0xA0 ) );
		$previous_value = libxml_use_internal_errors( true );

		$dom = new DOMDocument;
		$dom->loadXML( utf8_encode( $content ) );

		libxml_clear_errors();
		libxml_use_internal_errors( $previous_value );

		if ( ! $dom->documentElement ) {
			$element = $dom->createElement( $tag, utf8_encode( $content ) );
			$dom->appendChild( $element );
		}

		$dom->documentElement->setAttribute( 'class', $dom->documentElement->getAttribute( 'class' ) . ' ' . esc_attr( utf8_encode( $class ) ) );
		if ( $title ) {
			$dom->documentElement->setAttribute( 'title', $title );
		}
		if ( $data ) {
			$data = explode( '|', $data );
			foreach ( $data as $d ):
				$d = explode( ',', $d );
				$dom->documentElement->setAttribute( 'data-' . $d[0], trim( $d[1] ) );
			endforeach;
		}

		return utf8_decode( $dom->saveXML( $dom->documentElement ) );
	}

	/*--------------------------------------------------------------------------------------
		*
		* Scrape the shortcode's contents for a particular DOMDocument tag or tags, pull them out, apply attributes, and return just the tags.
		*
		*-------------------------------------------------------------------------------------*/
	function scrape_dom_element( $tag, $content, $class, $title = '', $data = null ) {

		$previous_value = libxml_use_internal_errors( true );

		$dom = new DOMDocument;
		$dom->loadHTML( mb_convert_encoding( $content, 'HTML-ENTITIES', 'UTF-8' ) );

		libxml_clear_errors();
		libxml_use_internal_errors( $previous_value );
		foreach ( $tag as $find ) {
			$tags = $dom->getElementsByTagName( $find );
			foreach ( $tags as $find_tag ) {
				$outputdom = new DOMDocument;
				$new_root  = $outputdom->importNode( $find_tag, true );
				$outputdom->appendChild( $new_root );

				if ( is_object( $outputdom->documentElement ) ) {
					$outputdom->documentElement->setAttribute( 'class', $outputdom->documentElement->getAttribute( 'class' ) . ' ' . esc_attr( $class ) );
					if ( $title ) {
						$outputdom->documentElement->setAttribute( 'title', $title );
					}
					if ( $data ) {
						$data = explode( '|', $data );
						foreach ( $data as $d ):
							$d = explode( ',', $d );
							$outputdom->documentElement->setAttribute( 'data-' . $d[0], trim( $d[1] ) );
						endforeach;
					}
				}

				return $outputdom->saveHTML( $outputdom->documentElement );

			}
		}
	}

	/*--------------------------------------------------------------------------------------
		*
		* Find if content contains a particular tag, if not, create it, either way wrap it in a wrapper tag
		*
		*       Example: Check if the contents of [page-header] include an h1, if not, add one, then wrap it all in a div so we can add classes to that.
		*
		*-------------------------------------------------------------------------------------*/
	function nest_dom_element( $find, $append, $content ) {

		$previous_value = libxml_use_internal_errors( true );

		$dom = new DOMDocument;
		$dom->loadXML( utf8_encode( $content ) );

		libxml_clear_errors();
		libxml_use_internal_errors( $previous_value );

		//Does $content include the tag we're looking for?
		$hasFind = $dom->getElementsByTagName( $find );

		//If not, add it and wrap it all in our append tag
		if ( $hasFind->length == 0 ) {
			$wrapper = $dom->createElement( $append );
			$dom->appendChild( $wrapper );

			$tag = $dom->createElement( $find, $content );
			$wrapper->appendChild( $tag );
		} //If so, just wrap everything in our append tag
		else {
			$new_root = $dom->createElement( $append );
			$new_root->appendChild( $dom->documentElement );
			$dom->appendChild( $new_root );
		}

		return $dom->saveXML( $dom->documentElement );
	}

	/*--------------------------------------------------------------------------------------
		   *
		   * Add dividers to data attributes content if needed
		   *
		   *-------------------------------------------------------------------------------------*/
	function check_for_data( $data ) {
		if ( $data ) {
			return "|";
		}
	}

	/*--------------------------------------------------------------------------------------
		   *
		   * If the user puts a return between the shortcode and its contents, sometimes we want to strip the resulting P tags out
		   *
		   *-------------------------------------------------------------------------------------*/
	function strip_paragraph( $content ) {
		$content = str_ireplace( '<p>', '', $content );
		$content = str_ireplace( '</p>', '', $content );

		return $content;
	}

}

new BoostrapShortcodes();
