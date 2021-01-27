<?php
/**
 * Sydney Mobile Header Image
 *
 * @package     Sydney Mobile Header Image
 * @author      kharisblank
 * @copyright   2021 kharisblank
 * @license     GPL-2.0+
 *
 * @sydney-mobile-header-image
 * Plugin Name: Sydney Mobile Header Image
 * Plugin URI:  https://easyfixwp.com/
 * Description: This plugin shows Sydney header image on mobile.
 * Version:     0.0.6
 * Author:      kharisblank
 * Author URI:  https://easyfixwp.com
 * Text Domain: sydney-mobile-header-image
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 *
 */


// Disallow direct access to file
defined( 'ABSPATH' ) or die( __('Not Authorized!', 'sydney-mobile-header-image') );

define( 'SYDNEY_MOBILE_HEADER_IMAGE_FILE', __FILE__ );
define( 'SYDNEY_MOBILE_HEADER_IMAGE_URL', plugins_url( null, SYDNEY_MOBILE_HEADER_IMAGE_FILE ) );


if ( ! function_exists( 'ignis_setup' ) ) :
  // return;
endif;


if ( !class_exists('Sydney_Mobile_Header_Image') ) :
  class Sydney_Mobile_Header_Image {

    public function __construct() {
      add_action( 'sydney_inside_hero', array($this, 'add_header_image' ), 9999);
      add_action( 'wp_enqueue_scripts', array($this, 'enqueue_scripts' ), 9999 );
    }

    /**
     * Check whether Sydney theme is active or not
     * @return boolean true if either Sydney or Sydney Pro is active
     */
    function is_sydney_active() {

      $theme  = wp_get_theme();
      $parent = wp_get_theme()->parent();

      if ( ($theme != 'Sydney' ) && ($theme != 'Sydney Pro' ) && ($parent != 'Sydney') && ($parent != 'Sydney Pro') ) {
        return false;
      }

      return true;

    }

    /**
     * Check whether Sydney header image is active or not
     * @return boolean
     */

    function is_header_image() {
      if ( get_header_image() && ( get_theme_mod('front_header_type') == 'image' && is_front_page() || get_theme_mod('site_header_type', 'image') == 'image' && !is_front_page() ) ) {
        return true;
      }
      return false;
    }

    /**
     * Header image
     * @return void
     */
    function header_image() {
      $image_url = get_header_image();
      ?>
      <div class="header-image2">
        <img src="<?php echo esc_attr($image_url); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>">
      </div>
      <?php
    }

    /**
     * Add header image
     * @return void
     */
    function add_header_image() {
      if( true == $this->is_sydney_active() ) {
        $this->header_image();
      }
    }

    function enqueue_scripts() {
      wp_register_style( 'sydney-mobile-header-image-style', SYDNEY_MOBILE_HEADER_IMAGE_URL . '/css/sydney-mobile-header-image-style998.css', array(), null );

      wp_enqueue_style( 'sydney-mobile-header-image-style' );
    }

  }
endif;

new Sydney_Mobile_Header_Image;
