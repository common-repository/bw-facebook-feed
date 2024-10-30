<?php
/*
Plugin Name: BW Facebook Feed
Plugin URI: http://bluwebz.com
Description: A simple way to show facebook feed in your website.
Version: 1.0.5 
Author: Jahur Ahmed
Author URI: http://bluwebz.com
Text Domain: bw-facebook-feed
Domain Path: /languages
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
  exit;
}

if ( ! defined( 'BWFBFEED_PLUGIN_URL' ) ) {
  define( 'BWFBFEED_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
}

/*------------Main Jquery and Style for ABS Accordion Plugin------------*/

function bwfbfeed_all_script_style() {
  wp_enqueue_style ( 'bwfbfeed-template-css-style', BWFBFEED_PLUGIN_URL . 'css/style.css' );
  wp_enqueue_style ( 'bwfbfeed-core-css-style', BWFBFEED_PLUGIN_URL . 'css/jquery.socialfeed.css' );
  wp_enqueue_script ( 'bwfbfeed-dot-js',  BWFBFEED_PLUGIN_URL . 'js/doT.min.js', '', '1.0.0', true );
  wp_enqueue_script ( 'bwfbfeed-moment-js',  BWFBFEED_PLUGIN_URL . 'js/moment.min.js', '', '1.0.0', true );
   wp_enqueue_script ( 'bwfbfeed-js',  BWFBFEED_PLUGIN_URL . 'js/jquery.socialfeed.js', array('jquery'), '1.0.0', true );
  
}
add_action( 'init', 'bwfbfeed_all_script_style' );
 // $value = get_option('awesome_text'); 
 // $value1 = get_option('awesome_text1');

function init_bwfbfeed() {
?>
<script type="text/javascript">
  jQuery(document).ready(function(){

    <?php 

      $options = get_option('my_option_name', false);
      $f_page_id = $options['bwfbfeed_page_id']; 
      $f_app_id = $options['bwfbfeed_app_id'];
      // if(empty($f_app_id) || $f_app_id=='') {
      //   $f_app_id ='1719442274956038';
      // } 
      $f_app_secret = $options['bwfbfeed_app_secret'];
      // if(empty($f_app_secret) || $f_app_secret=='') {
      //   $f_app_secret ='d514c64c417ca557e2fb1c30338bc895';
      // }
      $f_post_limit = $options['bwfbfeed_post_limit'];
      if(empty($f_post_limit) || $f_post_limit=='') {
        $f_post_limit ='5';
      }
      $f_post_excerpt = $options['bwfbfeed_post_excerpt'];
      if(empty($f_post_excerpt) || $f_post_excerpt=='') {
        $f_post_excerpt ='100';
      }
      if ( (empty($f_app_id) || $f_app_id=='' || empty($f_app_secret) || $f_app_secret=='') ) {

        $access_token_array = array(
        '1079621122120375|c0d02b21b15b290cabe13f13f56a9bd8',
        '1719442274956038|d514c64c417ca557e2fb1c30338bc895',
        '1851314935096786|0de2a9ec77d745d6941850696ce166f9',
        '1795317140689602|e25d547c4f12164254f85eead086b0a7',
        '181607922248075|d0787a2cfff89efd23b9fe1ffafa45db',
        '1416491381713001|d394e60bf309be5f5bddd6ea207e7ef4',
        '1599527947014940|5da5c64dded6c0f030a777bf80ba0eca'
    );
        $access_token = $access_token_array[rand(0, 6)];

      }
      else {
        $access_token = $f_app_id.'|'.$f_app_secret;
      }

     ?>

        jQuery('.social-feed-container').socialfeed({
            // FACEBOOK
            facebook:{
        accounts: ['@<?php echo $f_page_id ?>'],  //Array: Specify a list of accounts from which to pull wall posts
        limit: <?php echo $f_post_limit; ?>,                                   //Integer: max number of posts to load
        access_token: '<?php echo $access_token; ?>'  //String: "APP_ID|APP_SECRET"
    },

            // GENERAL SETTINGS
            length:<?php echo $f_post_excerpt; ?>,      //Integer: For posts with text longer than this length, show an ellipsis. post_limit
            show_media: true,
            template_html:                                  //String: HTML used for each post. This overrides the 'template' filename option
    '<div class="bw-fb-feed-element {{? !it.moderation_passed}}hidden{{?}}" dt-create="{{=it.dt_create}}" social-feed-id = "{{=it.id}}"> \
    <div class="bwfbfeedcontent"> \
    <div class="bw-media-container"><a class="pull-left profilepic" href="{{=it.author_link}}" target="_blank"> \
    <img class="media-object" src="{{=it.author_picture}}"> \
    </a><ul><li>{{=it.author_name}}</li><li>{{=it.time_ago}}</li></ul>  \
    </div><div class="text-wrapper"><p class="feed-text">{{=it.text}} <a href="{{=it.link}}" target="_blank" class="read-button">read more</a></p> \
    </div>{{=it.attachment}} \
    </div></div>',
           
        });

        
    });
</script>
<?php
}
add_action( 'wp_footer', 'init_bwfbfeed' );




function bwfbfeed_shortcode( $atts ) {

  $smaccwrapper .= '<div class="bwfbfeed-container"><div class="social-feed-container"></div></div>';
  
  return $smaccwrapper;
}
add_shortcode( 'bwfbfeed', 'bwfbfeed_shortcode' );

// admin settings

/**
 * The base registry information.
 * 
 * @since       3.5.0
 */
class BWFBFeedSettings
{
    /**
     * Holds the values to be used in the fields callbacks
     */
    private $options;

    /**
     * Start up
     */
    public function __construct()
    {
        add_action( 'admin_menu', array( $this, 'add_plugin_page' ) );
        add_action( 'admin_init', array( $this, 'page_init' ) );
    }

    /**
     * Add options page
     */
    public function add_plugin_page()
    {
        // This page will be under "Settings"
        add_options_page(
            'BW Facebook Feed Settings', 
            'BW Facebook Feed', 
            'manage_options', 
            'bw-facebook-feed', 
            array( $this, 'create_admin_page' )
        );
    }

    /**
     * Options page callback
     */
    public function create_admin_page()
    {
        // Set class property
        $this->options = get_option( 'my_option_name' );
        ?>
        <div class="wrap">
            <h1>BW Facebook Feed Settings</h1>
            <form method="post" action="options.php">
            <?php
                // This prints out all hidden setting fields
                settings_fields( 'my_option_group' );
                do_settings_sections( 'my-setting-admin' );
                submit_button();
            ?>
            </form>
        </div>
        <?php
    }

    /**
     * Register and add settings
     */
    public function page_init()
    {        
        register_setting(
            'my_option_group', // Option group
            'my_option_name', // Option name
            array( $this, 'sanitize' ) // Sanitize
        );

        add_settings_section(
            'setting_section_id', // ID
            '', // Title
            array( $this, 'print_section_info' ), // Callback
            'my-setting-admin' // Page
        );        

        add_settings_field(
            'bwfbfeed_page_id', 
            'Facebook Page ID', 
            array( $this, 'bwfbfeed_page_id_callback' ), 
            'my-setting-admin', 
            'setting_section_id'
        );

        add_settings_field(
            'bwfbfeed_app_id', // ID 
            'Facebook App ID', // Title 
            array( $this, 'bwfbfeed_app_id_callback' ), // Callback
            'my-setting-admin', // Page
            'setting_section_id' // Section           
        );  

        add_settings_field(
            'bwfbfeed_app_secret', // ID 
            'Facebook App Secret', // Title 
            array( $this, 'bwfbfeed_app_secret_callback' ), // Callback
            'my-setting-admin', // Page
            'setting_section_id' // Section           
        );    

        add_settings_field(
            'bwfbfeed_post_limit', // ID
            'Number of Posts', // Title 
            array( $this, 'bwfbfeed_post_limit_callback' ), // Callback
            'my-setting-admin', // Page
            'setting_section_id' // Section           
        ); 

        add_settings_field(
            'bwfbfeed_post_excerpt', // ID
            'Each Post Length', // Title 
            array( $this, 'bwfbfeed_post_excerpt_callback' ), // Callback
            'my-setting-admin', // Page
            'setting_section_id' // Section           
        ); 

        add_settings_field(
            'bwfbfeed_shortcode', // ID
            'Shortcode', // Title 
            array( $this, 'bwfbfeed_shortcode_callback' ), // Callback
            'my-setting-admin', // Page
            'setting_section_id' // Section           
        ); 
    }

    /**
     * Sanitize each setting field as needed
     *
     * @param array $input Contains all settings fields as array keys
     */
    public function sanitize( $input )
    {
        $new_input = array();
        
        if( isset( $input['bwfbfeed_page_id'] ) )
            $new_input['bwfbfeed_page_id'] = sanitize_text_field( $input['bwfbfeed_page_id'] );

        if( isset( $input['bwfbfeed_app_id'] ) )
            $new_input['bwfbfeed_app_id'] = sanitize_text_field( $input['bwfbfeed_app_id'] );

        if( isset( $input['bwfbfeed_app_secret'] ) )
            $new_input['bwfbfeed_app_secret'] = sanitize_text_field( $input['bwfbfeed_app_secret'] );
          //

        if( isset( $input['bwfbfeed_post_limit'] ) )
            $new_input['bwfbfeed_post_limit'] = sanitize_text_field( $input['bwfbfeed_post_limit'] );

        if( isset( $input['bwfbfeed_post_excerpt'] ) )
            $new_input['bwfbfeed_post_excerpt'] = sanitize_text_field( $input['bwfbfeed_post_excerpt'] );


        return $new_input;
    }

    /** 
     * Print the Section text
     */
    public function print_section_info()
    {
        print '';
    }

    /** 
     * Get the settings option array and print one of its values
     */
    public function bwfbfeed_page_id_callback()
    {
        printf(
            '<input class="regular-text" type="text" id="bwfbfeed_page_id" name="my_option_name[bwfbfeed_page_id]" value="%s" /><p class="description">Eg. 1234567890123 or bluwebz</p>',
            isset( $this->options['bwfbfeed_page_id'] ) ? esc_attr( $this->options['bwfbfeed_page_id']) : ''
        );
    }

    /** 
     * Get the settings option array and print one of its values
     */
    public function bwfbfeed_app_id_callback()
    {
        printf(
            '<input class="regular-text" type="text" id="bwfbfeed_app_id" name="my_option_name[bwfbfeed_app_id]" value="%s" /> <small><em>( Optional )</em></small><p class="description"><a href="https://developers.facebook.com/docs/apps/register#step-by-step-guide" target="_blank">Create facebook app id</a></p>',
            isset( $this->options['bwfbfeed_app_id'] ) ? esc_attr( $this->options['bwfbfeed_app_id']) : ''
        );
    }

    /** 
     * Get the settings option array and print one of its values
     */
    public function bwfbfeed_app_secret_callback()
    {
        printf(
            '<input class="regular-text" type="text" id="bwfbfeed_app_secret" name="my_option_name[bwfbfeed_app_secret]" value="%s" /> <small><em>( Optional )</em></small><p class="description">App secret can be found in facebook app dashboard</p>',
            isset( $this->options['bwfbfeed_app_secret'] ) ? esc_attr( $this->options['bwfbfeed_app_secret']) : ''
        );
    }

     /** 
     * Get the settings option array and print one of its values
     */
    public function bwfbfeed_post_limit_callback()
    {
        printf(
            '<input type="text" id="bwfbfeed_post_limit" name="my_option_name[bwfbfeed_post_limit]" value="%s" /><small><em> ( Optional )</em></small><p class="description">(eg. 10) Default value : 5</p>',
            isset( $this->options['bwfbfeed_post_limit'] ) ? esc_attr( $this->options['bwfbfeed_post_limit']) : ''
        );
    }

     /** 
     * Get the settings option array and print one of its values
     */
    public function bwfbfeed_post_excerpt_callback()
    {
        printf(
            '<input type="text" id="bwfbfeed_post_excerpt" name="my_option_name[bwfbfeed_post_excerpt]" value="%s" /><small><em> ( Optional )</em></small><p class="description">(eg. 50) Default value : 100</p>',
            isset( $this->options['bwfbfeed_post_excerpt'] ) ? esc_attr( $this->options['bwfbfeed_post_excerpt']) : ''
        );
    }

    public function bwfbfeed_shortcode_callback()
    {
        printf(
            '<input type="text" value="[bwfbfeed]" size="22" readonly="readonly" onclick="this.focus();this.select()" title="To copy, click the field then press Ctrl + C (PC) or Cmd + C (Mac)."><p class="description">Copy and paste this shortcode into the page, post or widget wherever you want to show the facebook feed.</p>'
        );
    }
}

if( is_admin() )
    $bw_fb_feed_settings = new BWFBFeedSettings();



// WIDGET

/**
 * Adds Bw_Fb_Feed_Widget widget.
 */
class Bw_Fb_Feed_Widget extends WP_Widget {

  /**
   * Register widget with WordPress.
   */
  function __construct() {
    parent::__construct(
      'bwfbfeed_widget', // Base ID
      __( 'BW Facebook Feed', 'bw-facebook-feed' ), // Name
      array( 'description' => __( 'Display your facebook feed', 'bw-facebook-feed' ), ) // Args
    );
  }

  /**
   * Front-end display of widget.
   *
   * @see WP_Widget::widget()
   *
   * @param array $args     Widget arguments.
   * @param array $instance Saved values from database.
   */
  public function widget( $args, $instance ) {
    echo $args['before_widget'];
    if ( ! empty( $instance['title'] ) ) {
      echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
    }
    echo '<div class="bwfbfeed-container"><div class="social-feed-container"></div></div>';
    echo $args['after_widget'];
  }

  /**
   * Back-end widget form.
   *
   * @see WP_Widget::form()
   *
   * @param array $instance Previously saved values from database.
   */
  public function form( $instance ) {
    $title = ! empty( $instance['title'] ) ? $instance['title'] : __( '', 'bw-facebook-feed' );
    ?>
    <p>
    <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( esc_attr( 'Title:' ) ); ?></label> 
    <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
    </p>
    <?php 
  }

  /**
   * Sanitize widget form values as they are saved.
   *
   * @see WP_Widget::update()
   *
   * @param array $new_instance Values just sent to be saved.
   * @param array $old_instance Previously saved values from database.
   *
   * @return array Updated safe values to be saved.
   */
  public function update( $new_instance, $old_instance ) {
    $instance = array();
    $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';

    return $instance;
  }

} // class Bw_Fb_Feed_Widget


// register Bw_Fb_Feed_Widget widget
function register_bwfbfeed_widget() {
    register_widget( 'Bw_Fb_Feed_Widget' );
}
add_action( 'widgets_init', 'register_bwfbfeed_widget' );
