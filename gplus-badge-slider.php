<?php
/*
Plugin Name: GPLUS Badge Slider
Plugin URI: https://wordpress.org/plugins/gplus-badge-slider/
Description: Google Plus Badge - is the common way to display your google plus profile or business on your website. With our GPLUS Badge Slider you can do more.
Version: 1.1
Author: twidgets
Author URI: http://www.highschooldiploma.us/extensions
License: GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/

class RealGooglebadgeSlider{

    

    public $options;

    public function __construct() {

        //you can run delete_option method to reset all data

        //delete_option('real_google_plugin_options');

        $this->options = get_option('real_google_plugin_options');

        $this->real_google_register_settings_and_fields();

    }

    

    public function add_real_fb_tools_options_page(){

        add_options_page('GPLUS Badge Slider', 'GPLUS Badge Slider', 'administrator', __FILE__, array('RealGooglebadgeSlider','real_google_tools_options'));

    }

    

    public function real_google_tools_options(){

?>

<div class="wrap">
  <h2>Google Plus Badge Slider</h2>
  <form method="post" action="options.php" enctype="multipart/form-data">
    <?php settings_fields('real_google_plugin_options'); ?>
    <?php do_settings_sections(__FILE__); ?>
    <p class="submit">
      <input name="submit" type="submit" class="button-primary" value="Save Changes"/>
    </p>
  </form>
</div>
<?php

    }

    public function real_google_register_settings_and_fields(){

        register_setting('real_google_plugin_options', 'real_google_plugin_options',array($this,'real_google_validate_settings'));

        add_settings_section('real_google_main_section', 'Settings', array($this,'real_google_main_section_cb'), __FILE__);

        //Start Creating Fields and Options

        //marginTop

        add_settings_field('marginTop', 'Margin Top', array($this,'marginTop_settings'), __FILE__,'real_google_main_section');

        //pageURL

        add_settings_field('pageURL', 'Google Pofile ID', array($this,'pageURL_settings'), __FILE__,'real_google_main_section');

        //width

        add_settings_field('width', 'Width', array($this,'width_settings'), __FILE__,'real_google_main_section');

        //height

        add_settings_field('height', 'Height', array($this,'height_settings'), __FILE__,'real_google_main_section');

        //streams options

        add_settings_field('layout', 'Layout', array($this,'streams_settings'),__FILE__,'real_google_main_section');

        //color_scheme options

        add_settings_field('color_scheme', 'Cover Theme', array($this,'color_scheme_settings'),__FILE__,'real_google_main_section');

        //show_faces options

        add_settings_field('showcover', 'Cover Photo', array($this,'show_faces_settings'),__FILE__,'real_google_main_section');

        //alignment option

         add_settings_field('alignment', 'Alignment Position', array($this,'position_settings'),__FILE__,'real_google_main_section');

        //jQuery options

        

    }

    public function real_google_validate_settings($plugin_options){

        return($plugin_options);

    }

    public function real_google_main_section_cb(){

        //optional

    }



    //marginTop_settings

    public function marginTop_settings() {

        if(empty($this->options['marginTop'])) $this->options['marginTop'] = "100";

        echo "<input name='real_google_plugin_options[marginTop]' type='text' value='{$this->options['marginTop']}' />";

    }

    //pageURL_settings

    public function pageURL_settings() {

        if(empty($this->options['pageURL'])) $this->options['pageURL'] = "";

        echo "<input name='real_google_plugin_options[pageURL]' type='text' value='{$this->options['pageURL']}' />";

    }

   

    //width_settings

    public function width_settings() {

        if(empty($this->options['width'])) $this->options['width'] = "300";

        echo "<input name='real_google_plugin_options[width]' type='text' value='{$this->options['width']}' />";

    }

    //height_settings

    public function height_settings() {

        if(empty($this->options['height'])) $this->options['height'] = "345";

        echo "<input name='real_google_plugin_options[height]' type='text' value='{$this->options['height']}' />";

    }

    //layout_settings

    public function streams_settings(){

        if(empty($this->options['layout'])) $this->options['layout'] = "portrait";

        $items = array('portrait','landscape');

        echo "<select name='real_google_plugin_options[layout]'>";

        foreach($items as $item){

            $selected = ($this->options['layout'] === $item) ? 'selected = "selected"' : '';

            echo "<option value='$item' $selected>$item</option>";

        }

        echo "</select>";

    }

    //color_scheme_settings

    public function color_scheme_settings(){

        if(empty($this->options['color_scheme'])) $this->options['color_scheme'] = "light";

        $items = array('light','dark');

        echo "<select name='real_google_plugin_options[color_scheme]'>";

        foreach($items as $item){

            $selected = ($this->options['color_scheme'] === $item) ? 'selected = "selected"' : '';

            echo "<option value='$item' $selected>$item</option>";

        }

        echo "</select>";

    }

    //showcover_settings

    public function show_faces_settings(){

        if(empty($this->options['showcover'])) $this->options['showcover'] = "true";

        $items = array('true','false');

        echo "<select name='real_google_plugin_options[showcover]'>";

        foreach($items as $item){

            $selected = ($this->options['showcover'] === $item) ? 'selected = "selected"' : '';

            echo "<option value='$item' $selected>$item</option>";

        }

        echo "</select>";

    }

    //header_settings

    public function header_settings(){

        if(empty($this->options['header'])) $this->options['header'] = "true";

        $items = array('true','false');

        echo "<select name='real_google_plugin_options[header]'>";

        foreach($items as $item){

            $selected = ($this->options['header'] === $item) ? 'selected = "selected"' : '';

            echo "<option value='$item' $selected>$item</option>";

        }

        echo "</select>";

    }

    //alignment_settings

    public function position_settings(){

        if(empty($this->options['alignment'])) $this->options['alignment'] = "left";

        $items = array('left','right');

        echo "<select name='real_google_plugin_options[alignment]'>";

        foreach($items as $item){

            $selected = ($this->options['alignment'] === $item) ? 'selected = "selected"' : '';

            echo "<option value='$item' $selected>$item</option>";

        }

        echo "</select>";

    }

    // put jQuery settings before here

}

add_action('admin_menu', 'real_google_trigger_options_function');



function real_google_trigger_options_function(){

    RealGooglebadgeSlider::add_real_fb_tools_options_page();

}



add_action('admin_init','real_google_trigger_create_object');

function real_google_trigger_create_object(){

    new RealGooglebadgeSlider();

}

add_action('wp_footer','real_google_add_content_in_footer');

function real_google_add_content_in_footer(){

    

    $o = get_option('real_google_plugin_options');
	//print_r($o);

    extract($o);
	

$print_google = '';
if($pageURL == ''){
$print_google.='<div class="error_kudos">Please Fill Out The Google Plus Badge Slider Configuration First</div>';	
} else {
$print_google .= '<div class="g-person" data-href="//plus.google.com/u/0/'.$pageURL.'" 

data-theme="'.$color_scheme.'" data-showcoverphoto="'.$showcover.'" data-layout="'.$streams.'"  data-rel="author"></div>';
}
$sidebarImgURL = plugins_url('assets/google-icon.png', __FILE__);

?>
<script src="https://apis.google.com/js/platform.js" async defer></script>
<?php if($alignment=='left'){?>
<div id="real_google_display">
  <div id="gbox1" style="left: -<?php echo trim($width+10);?>px; top: <?php echo $marginTop;?>px; z-index: 10000; height:<?php echo trim($height+20);?>px;">
    <div id="gbox2" style="text-align: left;width:<?php echo trim($width);?>px;height:<?php echo trim($height);?>;"> <a class="open" id="fblink" href="#"></a><img style="top: 0px;right:-50px;" src="<?php echo $sidebarImgURL;?>" alt=""> <?php echo $print_google; ?> </div>
  </div>
</div>
<script type="text/javascript">
jQuery(document).ready(function(){
jQuery("#gbox1").hover(function(){ 
jQuery('#gbox1').css('z-index',101009);
jQuery(this).stop(true,false).animate({left:  0}, 500); },
function(){ 
    jQuery('#gbox1').css('z-index',10000);
    jQuery("#gbox1").stop(true,false).animate({left: -<?php echo trim($width+10); ?>}, 500); });
});
</script>
<?php } else { ?>
<div id="real_google_display">
  <div id="gbox1" style="right: -<?php echo trim($width+10);?>px; top: <?php echo $marginTop;?>px; z-index: 10000; height:<?php echo trim($height+20);?>px;">
    <div id="gbox2" style="text-align: left;width:<?php echo trim($width);?>px;height:<?php echo trim($height);?>;"> <a class="open" id="fblink" href="#"></a><img style="top: 0px;left:-50px;" src="<?php echo $sidebarImgURL;?>" alt=""> <?php echo $print_google; ?> </div>
  </div>
</div>
<script type="text/javascript">
jQuery(document).ready(function(){
jQuery("#gbox1").hover(function(){ 
jQuery('#gbox1').css('z-index',101009);
jQuery(this).stop(true,false).animate({right:  0}, 500); },
function(){ 
    jQuery('#gbox1').css('z-index',10000);
    jQuery("#gbox1").stop(true,false).animate({right: -<?php echo trim($width+10); ?>}, 500); });
});
</script>
<?php } ?>
<?php
} 

add_action( 'wp_enqueue_scripts', 'register_real_google_badge_slider_styles' );

 function register_real_google_badge_slider_styles() {

    wp_register_style( 'real_google_badge_slider_style', plugins_url( 'assets/style.css' , __FILE__ ) );

    wp_enqueue_style( 'real_google_badge_slider_style' );

        wp_enqueue_script('jquery');

 }
 $real_google_default_values = array(

  

     'marginTop' => 100,

     'GoogleID' => '',

     'width' => '292',

     'height' => '345',

     'layout' => 'portrait',

     'cover_theme' => 'light',

     'cover_photo' => 'true',

     'alignment' => 'left'

  

 );

 add_option('real_google_plugin_options', $real_google_default_values);