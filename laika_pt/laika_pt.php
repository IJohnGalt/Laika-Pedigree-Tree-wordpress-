<?php
/*
Plugin Name: Laika
Plugin URI: burria.com
Description: Creates a pedigree tree
Version: 0.1
Author: Burria
License: GPLv2
*/
function laika_pt_create_post_type() {
 register_post_type( 'laika_pt_type',
 array(
 'labels' => array(
 'name' => 'Laika',
 'singular_name' => 'Laika',
 'add_new' => 'Add New',
 'add_new_item' => 'Add New Pet',
 'edit' => 'Edit',
 'edit_item' => 'Edit Pet',
 'new_item' => 'New Pet',
 'view' => 'View',
 'view_item' => 'View Pet',
 'search_items' => 'Search Pets',
 'not_found' => 'No Pets found',
 'not_found_in_trash' =>
 'No Pets found in Trash',
 'parent' => 'Parent Pet'
 ),
 'rewrite' => array( 'slug' => 'pet' ),
 'public' => true,
 'menu_position' => 20,
 'supports' =>
 array( 'title', 'editor', 'thumbnail'),
 'taxonomies' => array( '' ),
 'menu_icon' => plugins_url( 'laika.png', __FILE__ ),
 'has_archive' => true
 )
 );}

 function custom_flush_rules(){
 	//defines the post type so the rules can be flushed.
 	laika_pt_create_post_type();

 	//and flush the rules.
 	flush_rewrite_rules();
 }

register_activation_hook(__FILE__, 'custom_flush_rules');
register_activation_hook( __FILE__, 'laika_pt_admin_menu' );
add_action( 'init', 'laika_pt_create_post_type' );
add_action( 'admin_init', 'laika_pt_create_meta_type' );

function laika_pt_create_meta_type(){
  add_meta_box( 'laika_pt_code_meta_box',
 'laika Code',
 'laika_pt_code_display_details_meta_box',
 'laika_pt_type', 'normal', 'high' );
}
function laika_pt_code_display_details_meta_box( $pets_type ) {
  // Retrieve mum and dad based on pets ID
   $pets_code =
   esc_html(trim( get_post_meta( $pets_type->ID,
   'laika_pt_code', true )) );
   $pets_mum =
   esc_html(trim ( get_post_meta( $pets_type->ID,
   'laika_pt_mum', true ) ));
   $pets_dad =
   esc_html(trim( get_post_meta( $pets_type->ID,
   'laika_pt_dad', true )) );

   echo 'Give a unique identifier to this pet'; ?>
   <p> ID: <input type='text' name='laika_pt_code' value='<?php echo esc_attr( $pets_code ); ?> '/> </p><?php
   echo 'Identifier of the mum'; ?>
   <p> ID: <input type='text' name='laika_pt_mum' value='<?php echo esc_attr( $pets_mum ); ?> '/> </p><?php
   echo 'Identifier of the dad'; ?>
   <p> ID: <input type='text' name='laika_pt_dad' value='<?php echo esc_attr( $pets_dad ); ?> '/> </p> <?php
}
add_action( 'save_post', 'laika_pt_code_meta_box_func', 10, 1 );

function laika_pt_code_meta_box_func($pets_type){



  //verify the metadata is set
 if ( isset( $_POST['laika_pt_code'] ) ) {
   update_post_meta( $pets_type, 'laika_pt_code',
  trim(strip_tags($_POST['laika_pt_code'] )));
}
if ( isset( $_POST['laika_pt_mum'] ) ) {
  update_post_meta( $pets_type, 'laika_pt_mum',
 trim(strip_tags($_POST['laika_pt_mum'] )));
}
if ( isset( $_POST['laika_pt_dad'] ) ) {
  update_post_meta( $pets_type, 'laika_pt_dad',
 trim(strip_tags($_POST['laika_pt_dad'] )));
}


}

add_filter( 'template_include', 'laika_pt_template_include', 1 );
function laika_pt_template_include( $template_path ) {
  if ( get_post_type() == 'laika_pt_type' ) {
 if ( is_single() ) {
 // checks if the file exists in the theme first,
 // otherwise serve the file from the plugin
 if ( $theme_file = locate_template( array
 ( 'laika_pt_theme.php' ) ) ) {
 $template_path = $theme_file;
 } else {
 $template_path = plugin_dir_path( __FILE__ ) .
 '/laika_pt_theme.php';
 }
 }
 }
 return $template_path;
}


add_action( 'admin_menu', 'laika_pt_menu' );
function laika_pt_menu() {
 add_options_page( 'Laika Configuration',
 'Laika Configuration', 'manage_options',
 'laika-options', 'laika_pt_config_page' );
}
function laika_pt_config_page() {

if (isset($_POST['generations'])) {
         update_option('laika_pt_generations', $_POST['generations']);
         $value = $_POST['generations'];
     }
     
if (isset($_POST['empty'])) {
         update_option('laika_pt_empty', $_POST['empty']);
         $valueb = $_POST['empty'];
     }
     
     
if (isset($_POST['default'])) {
         update_option('laika_pt_default', $_POST['default']);
         $valued = $_POST['default'];
     }

     $value = get_option('laika_pt_generations', 3);
	 $valueb = get_option('laika_pt_empty', '-');
	 $valued = get_option('laika_pt_default', 1);
	 
	 $checkedc = '';
	 $checkedd = '';
	 
	 if ($valuec == '1'){
		$checkedc = 'checked'; 
	 }
	 
	 if ($valued == '1'){
		$checkedd = 'checked'; 
	 }
	 
		 
	 if ($valued !== '1'){
		$checkedd = ''; 
	 }
     //include 'form-file.php';?>
     <h1>Laika Settings</h1>
     <?php if ($value==1){  ?>
<form method="POST">
    <label for="laika_pt_generations">Number of Generations: </label>
    <select name="generations">
    <option  selected value=1 >1</option>
    <option  value=2>2</option>
    <option value=3>3</option>

  </select>

<?php
 }
?>

<?php if ($value==2){  ?>
<form method="POST">
<label for="laika_pt_generations">Number of Generations: </label>
<select name="generations">
<option  value=1 >1</option>
<option selected value=2>2</option>
<option value=3>3</option>

</select>

<?php
}
?>

<?php if ($value==3){  ?>
<form method="POST">
<label for="laika_pt_generations">Number of Generations: </label>
<select name="generations">
<option  value=1 >1</option>
<option  value=2>2</option>
<option selected value=3>3</option>

</select>

<?php
}
?>
</br></br>
<label for="laika_pt_empty">Empty text: </label>
<input type="text" name="empty" value="<?php echo $valueb;  ?>">
</br></br>

<input type="hidden" name="default" value="0" />
<input type="checkbox" name="default" value="1" <?php echo $checkedd;  ?>>
<label for="laika_pt_empty">Use default CSS </label>
</br></br></br>
  <input type="submit" value="Save" class="button button-primary button-large">
</form>
<?php
 }

	
	

    

?>


