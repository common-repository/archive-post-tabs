<?php 
/*
  Plugin Name: Archive Post Tabs
  Description: Displays Archive Posts
  Author: iKhodal Team
  Plugin URI: http://www.ikhodal.com/archive-post-tabs/
  Author URI: http://www.ikhodal.com/archive-post-tabs/
  Version: 1.0
  License: GNU General Public License v2.0
  License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/ 
  
  
//////////////////////////////////////////////////////
// Defines the constants for use within the plugin. //
////////////////////////////////////////////////////// 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly  
/**
* Widget/Block Title
*/
define( 'avptab_widget_title', __( 'Archives', 'archivesposttab') );

/**
* Default date format
*/
define( 'avptab_date_format', 'year' ); 

/**
* Number of posts per next loading result
*/
define( 'avptab_number_of_post_display', '2' );
 
/**
* Post title text color
*/
define( 'avptab_title_text_color', '#000' );

/**
* Price text color for panel
*/
define( 'avptab_panel_text_color', '#000' );

/**
* Price text background color for panel
*/
define( 'avptab_panel_background_color', '#f7f7f7' );

/**
* Widget/block header text color
*/
define( 'avptab_header_text_color', '#fff' );

/**
* Widget/block header text background color
*/
define( 'avptab_header_background_color', '#00bc65' );

/**
* Display post title and text over post image
*/
define( 'avptab_display_title_over_image', 'no' );

/**
* Widget/block width
*/
define( 'avptab_widget_width', '100%' );  

/**
* Hide/Show widget title
*/
define( 'avptab_hide_widget_title', 'no' );
 
/**
* Template for widget/block
*/
define( 'avptab_template', 'pane_style_1' ); 
 
/**
* Hide/Show post title
*/
define( 'avptab_hide_post_title', 'no' );  
  
/**
* Security key for block id
*/
define( 'avptab_security_key', 'avpts_#@s@R$@ASI#TA(!@@21M3' );
 
/**
*  Assets of the plugin
*/
$avptab_plugins_url = plugins_url( "/assets/", __FILE__ );

define( 'AVPTAB_MEDIA', $avptab_plugins_url ); 

/**
*  Plugin DIR
*/
$avptab_plugin_DIR = plugin_basename(dirname(__FILE__));

define( 'AVPTAB_Plugin_DIR', $avptab_plugin_DIR ); 
 
/**
 * Include abstract class for common methods
 */
require_once 'include/abstract.php';


///////////////////////////////////////////////////////
// Include files for widget and shortcode management //
///////////////////////////////////////////////////////

/**
 * Admin panel widget configuration
 */ 
require_once 'include/admin.php';
 
/**
 * Load Archive Posts Tab on frontent pages
 */
require_once 'include/archivesposttab.php';  
 