<?php
/**
* Count Posts
* Count the number of posts in a taxonomy filter
*/

if ( !class_exists( 'count_posts' ) )
{
	class count_posts extends aviaShortcodeTemplate
	{
		/**
		* Create the config array for the shortcode button
		*/
		function shortcode_insert_button()
		{
			$this->config['name']		= __('Count Posts', 'avia_framework' );
			$this->config['icon']		= plugin_dir_url(__FILE__) . '../images/ic-template-icon.png';
			$this->config['target']		= 'avia-target-insert';
			$this->config['shortcode'] 	= 'count_posts';
			$this->config['tooltip'] 	= __('Count the number of posts in a given term of a taxonomy', 'avia_framework' );
			$this->config['tinyMCE']    = array('tiny_always'=>true);
			$this->config['preview'] 	= true;
		}

		/**
		* Popup Elements
		*
		* If this function is defined in a child class the element automatically turns into a social media icon list
		*
		* @return void
		*/
		function popup_elements()
		{
			$this->elements = array(
				array(
					"name" 	=> __("Taxonomy", 'avia_framework' ),
					"desc" 	=> __("What kind of group do you want.", 'avia_framework' ),
					"id" 	=> "taxonomy",
					"type" 	=> "input",
					"std" => 'category'
				),

				array(
					"name" 	=> __("Term", 'avia_framework' ),
					"desc" 	=> __("Term ID or Term Name", 'avia_framework' ),
					"id" 	=> "term",
					"type" 	=> "input"
				)
			);
		}

		/**
		* Editor Element - this function defines the visual appearance of an element on the AviaBuilder Canvas
		* Most common usage is to define some markup in the $params['innerHtml'] which is then inserted into the drag and drop container
		* Less often used: $params['data'] to add data attributes, $params['class'] to modify the className
		*
		*
		* @param array $params this array holds the default values for $content and $args.
		* @return $params the return array usually holds an innerHtml key that holds item specific markup.
		*/
		function editor_element($params)
		{
			return $params;
		}

		/**
		* Frontend Shortcode Handler
		*
		* @param array $atts array of attributes
		* @param string $content text within enclosing form of shortcode element
		* @param string $shortcodename the shortcode found, when == callback name
		* @return string $output returns the modified html string
		*/
		function shortcode_handler($atts, $content = "", $shortcodename = "", $meta = "")
		{
			$termId = intval($atts['term']);
			if($termId < 1) {
				$term = get_term_by('name', $atts['term'], $atts['taxonomy']);
			} else {
				$term = get_term($termId, $atts['taxonomy']);
			}

			if(is_wp_error($term)) {
				$sc_output = $term->get_error_message();
			} else if(!$term) {
				$sc_output = 'Term not found';
			} else {
				$sc_output = $term->count;
			}

			$output  = "<span class='count_posts_shortcode count_posts_shortcode_error'>";
			$output .= $errors . $sc_output . $content;
			$output .= "</span>";
			return $output;
		}
	}
}
