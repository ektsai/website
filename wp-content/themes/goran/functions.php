<?php

/**
 * Goran functions and definitions
 *
 * @package Goran
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
$content_width = 700; /* pixels */

/**
 * Adjust the content width for Front Page, Full Width and Grid Page Template.
 */
function edin_content_width() {
	global $content_width;

	if ( is_page_template( 'page-templates/front-page.php' ) || is_page_template( 'page-templates/full-width-page.php' ) || is_page_template( 'page-templates/grid-page.php' ) ) {
		$content_width = 1086;
	}
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function goran_setup() {

	/*
	 * Declare textdomain for this child theme.
	 */
	load_child_theme_textdomain( 'goran', get_stylesheet_directory() . '/languages' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_image_size( 'edin-thumbnail-landscape', 314, 228, true );
	add_image_size( 'edin-thumbnail-square', 314, 314, true );
	add_image_size( 'edin-featured-image', 772, 9999 );
	add_image_size( 'edin-hero', 1230, 1230 );

	/*
	 * Unregister nav menu.
	 */
	unregister_nav_menu( 'secondary' );

	/*
	 * Editor styles.
	 */
	add_editor_style( array( 'editor-style.css', goran_noto_sans_font_url(), goran_noto_serif_font_url(), goran_droid_sans_mono_font_url() ) );

}
add_action( 'after_setup_theme', 'goran_setup', 11 );

/*
 * Setup the WordPress core custom background feature.
 */
function goran_custom_background_args( $args ) {
    return array( 'default-color' => 'e1dfdf' );
}
add_filter( 'edin_custom_background_args', 'goran_custom_background_args' );

/**
 * Register Noto Sans font.
 *
 * @return string
 */
function goran_noto_sans_font_url() {
	$noto_sans_font_url = '';

	/* translators: If there are characters in your language that are not supported
	 * by Noto Sans, translate this to 'off'. Do not translate into your own language.
	 */
	if ( 'off' !== _x( 'on', 'Noto Sans font: on or off', 'goran' ) ) {
		$subsets = 'latin,latin-ext';

		/* translators: To add an additional Noto Sans character subset specific to your language, translate this to 'cyrillic', 'greek', 'devanagari' or 'vietnamese'. Do not translate into your own language. */
		$subset = _x( 'no-subset', 'Noto Sans font: add new subset (cyrillic, greek, devanagari or vietnamese)', 'goran' );

		if ( 'cyrillic' == $subset ) {
			$subsets .= ',cyrillic-ext,cyrillic';
		} else if ( 'greek' == $subset ) {
			$subsets .= ',greek-ext,greek';
		} else if ( 'devanagari' == $subset ) {
			$subsets .= ',devanagari';
		} else if ( 'vietnamese' == $subset ) {
			$subsets .= ',vietnamese';
		}

		$query_args = array(
			'family' => urlencode( 'Noto Sans:400,700,400italic,700italic' ),
			'subset' => urlencode( $subsets ),
		);

		$noto_sans_font_url = add_query_arg( $query_args, '//fonts.googleapis.com/css' );
	}

	return $noto_sans_font_url;
}

/**
 * Register Noto Serif font.
 *
 * @return string
 */
function goran_noto_serif_font_url() {
	$noto_serif_font_url = '';

	/* translators: If there are characters in your language that are not supported
	 * by Noto Serif, translate this to 'off'. Do not translate into your own language.
	 */
	if ( 'off' !== _x( 'on', 'Noto Serif font: on or off', 'goran' ) ) {
		$subsets = 'latin,latin-ext';

		/* translators: To add an additional Noto Serif character subset specific to your language, translate this to 'cyrillic', 'greek' or 'vietnamese'. Do not translate into your own language. */
		$subset = _x( 'no-subset', 'Noto Serif font: add new subset (cyrillic, greek, vietnamese)', 'goran' );

		if ( 'cyrillic' == $subset ) {
			$subsets .= ',cyrillic-ext,cyrillic';
		} else if ( 'greek' == $subset ) {
			$subsets .= ',greek-ext,greek';
		} else if ( 'vietnamese' == $subset ) {
			$subsets .= ',vietnamese';
		}

		$query_args = array(
			'family' => urlencode( 'Noto Serif:400,700,400italic,700italic' ),
			'subset' => urlencode( $subsets ),
		);

		$noto_serif_font_url = add_query_arg( $query_args, '//fonts.googleapis.com/css' );
	}

	return $noto_serif_font_url;
}

/**
 * Register Droid Sans Mono font.
 *
 * @return string
 */
function goran_droid_sans_mono_font_url() {
	$droid_sans_mono_font_url = '';

	/* translators: If there are characters in your language that are not supported
	 * by Droid Mono Sans, translate this to 'off'. Do not translate into your own language.
	 */
	if ( 'off' !== _x( 'on', 'Droid Sans Mono font: on or off', 'goran' ) ) {
		$query_args = array(
			'family' => urlencode( 'Droid Sans Mono' ),
		);

		$droid_sans_mono_font_url = add_query_arg( $query_args, '//fonts.googleapis.com/css' );
	}

	return $droid_sans_mono_font_url;
}


/**
 * Enqueue scripts and styles.
 */
function goran_scripts() {
	wp_dequeue_style( 'edin-pt-sans' );

	wp_dequeue_style( 'edin-pt-serif' );

	wp_dequeue_style( 'edin-pt-mono' );

	wp_dequeue_style( 'edin-edincon' );

	wp_dequeue_script( 'edin-navigation' );

	wp_enqueue_style( 'goran-noto-sans', goran_noto_sans_font_url(), array(), null );

	wp_enqueue_style( 'goran-noto-serif', goran_noto_serif_font_url(), array(), null );

	wp_enqueue_style( 'goran-droid-sans-mono', goran_droid_sans_mono_font_url(), array(), null );

	wp_enqueue_script( 'goran-navigation', get_stylesheet_directory_uri() . '/js/navigation.js', array( 'jquery' ), '20140807', true );

	wp_enqueue_script( 'goran-script', get_stylesheet_directory_uri() . '/js/goran.js', array( 'jquery' ), '20140808', true );
}
add_action( 'wp_enqueue_scripts', 'goran_scripts', 11 );

/**
 * Enqueue Google fonts style to admin screen for custom header display.
 *
 * @return void
 */
function goran_admin_fonts() {
	wp_dequeue_style( 'edin-pt-sans' );

	wp_dequeue_style( 'edin-pt-serif' );

	wp_dequeue_style( 'edin-pt-mono' );

	wp_enqueue_style( 'goran-noto-sans', goran_noto_sans_font_url(), array(), null );

	wp_enqueue_style( 'goran-noto-serif', goran_noto_serif_font_url(), array(), null );

	wp_enqueue_style( 'goran-droid-sans-mono', goran_droid_sans_mono_font_url(), array(), null );
}
add_action( 'admin_print_scripts-appearance_page_custom-header', 'goran_admin_fonts', 11 );

/**
 * Implement the Custom Header feature.
 */
require get_stylesheet_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_stylesheet_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_stylesheet_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_stylesheet_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_stylesheet_directory() . '/inc/jetpack.php'; ?>

<?php
class WP_HTML_Compression
{
    // Settings
    protected $compress_css = true;
    protected $compress_js = true;
    protected $info_comment = true;
    protected $remove_comments = true;
 
    // Variables
    protected $html;
    public function __construct($html)
    {
   	 if (!empty($html))
   	 {
   		 $this->parseHTML($html);
   	 }
    }
    public function __toString()
    {
   	 return $this->html;
    }
    protected function bottomComment($raw, $compressed)
    {
   	 $raw = strlen($raw);
   	 $compressed = strlen($compressed);
   	 
   	 $savings = ($raw-$compressed) / $raw * 100;
   	 
   	 $savings = round($savings, 2);
   	 
   	 return '<!--HTML compressed, size saved '.$savings.'%. From '.$raw.' bytes, now '.$compressed.' bytes-->';
    }
    protected function minifyHTML($html)
    {
   	 $pattern = '/<(?<script>script).*?<\/script\s*>|<(?<style>style).*?<\/style\s*>|<!(?<comment>--).*?-->|<(?<tag>[\/\w.:-]*)(?:".*?"|\'.*?\'|[^\'">]+)*>|(?<text>((<[^!\/\w.:-])?[^<]*)+)|/si';
   	 preg_match_all($pattern, $html, $matches, PREG_SET_ORDER);
   	 $overriding = false;
   	 $raw_tag = false;
   	 // Variable reused for output
   	 $html = '';
   	 foreach ($matches as $token)
   	 {
   		 $tag = (isset($token['tag'])) ? strtolower($token['tag']) : null;
   		 
   		 $content = $token[0];
   		 
   		 if (is_null($tag))
   		 {
   			 if ( !empty($token['script']) )
   			 {
   				 $strip = $this->compress_js;
   			 }
   			 else if ( !empty($token['style']) )
   			 {
   				 $strip = $this->compress_css;
   			 }
   			 else if ($content == '<!--wp-html-compression no compression-->')
   			 {
   				 $overriding = !$overriding;
   				 
   				 // Don't print the comment
   				 continue;
   			 }
   			 else if ($this->remove_comments)
   			 {
   				 if (!$overriding && $raw_tag != 'textarea')
   				 {
   					 // Remove any HTML comments, except MSIE conditional comments
   					 $content = preg_replace('/<!--(?!\s*(?:\[if [^\]]+]|<!|>))(?:(?!-->).)*-->/s', '', $content);
   				 }
   			 }
   		 }
   		 else
   		 {
   			 if ($tag == 'pre' || $tag == 'textarea')
   			 {
   				 $raw_tag = $tag;
   			 }
   			 else if ($tag == '/pre' || $tag == '/textarea')
   			 {
   				 $raw_tag = false;
   			 }
   			 else
   			 {
   				 if ($raw_tag || $overriding)
   				 {
   					 $strip = false;
   				 }
   				 else
   				 {
   					 $strip = true;
   					 
   					 // Remove any empty attributes, except:
   					 // action, alt, content, src
   					 $content = preg_replace('/(\s+)(\w++(?<!\baction|\balt|\bcontent|\bsrc)="")/', '$1', $content);
   					 
   					 // Remove any space before the end of self-closing XHTML tags
   					 // JavaScript excluded
   					 $content = str_replace(' />', '/>', $content);
   				 }
   			 }
   		 }
   		 
   		 if ($strip)
   		 {
   			 $content = $this->removeWhiteSpace($content);
   		 }
   		 
   		 $html .= $content;
   	 }
   	 
   	 return $html;
    }
   	 
    public function parseHTML($html)
    {
   	 $this->html = $this->minifyHTML($html);
   	 
   	 if ($this->info_comment)
   	 {
   		 $this->html .= "\n" . $this->bottomComment($html, $this->html);
   	 }
    }
    
    protected function removeWhiteSpace($str)
    {
   	 $str = str_replace("\t", ' ', $str);
   	 $str = str_replace("\n",  '', $str);
   	 $str = str_replace("\r",  '', $str);
   	 
   	 while (stristr($str, '  '))
   	 {
   		 $str = str_replace('  ', ' ', $str);
   	 }
   	 
   	 return $str;
    }
}
 
function wp_html_compression_finish($html)
{
    return new WP_HTML_Compression($html);
}
 
function wp_html_compression_start()
{
    ob_start('wp_html_compression_finish');
}
add_action('get_header', 'wp_html_compression_start');


function pu_remove_script_version( $src ){
    return remove_query_arg( 'ver', $src );
}

add_filter( 'script_loader_src', 'pu_remove_script_version' );
add_filter( 'style_loader_src', 'pu_remove_script_version' );

?>

