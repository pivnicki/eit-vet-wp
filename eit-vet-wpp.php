<?php
/*
Plugin Name: Veterinarska evidencija za WordPress
Plugin URI:  https://easyit.rs
Description: Evidencija zdravlja za domaće životinje
Version:     1.0.0
Author:      Stevan Pivnički
Author URI:  https://easyit.rs
Text Domain: eit-vet-wpp
License:     GPLv2
*/

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA

https://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html

*/
 

defined( 'ABSPATH' ) or die ( 'Bye, bye!' );

if ( ! defined( 'EIT_VET_WPP_PLUGIN_DIR' ) ) {
	define( 'EIT_VET_WPP_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
} elseif ( EIT_VET_WPP_PLUGIN_DIR !== plugin_dir_path( __FILE__ ) ) {
	 
	return;
}

//require_once( plugin_dir_path( __FILE__ ) . 'class-ldwpd-custom-post.php');
// require_once( EIT_VET_WPP_PLUGIN_DIR . 'class-ldwpd-post-notice-frontend.php');
require_once( EIT_VET_WPP_PLUGIN_DIR . 'class-eit-vet-wpp-meta-box.php');
require_once( EIT_VET_WPP_PLUGIN_DIR . 'class-eit-vet-wpp-custom-post.php');
require_once( EIT_VET_WPP_PLUGIN_DIR . 'class-eit-vet-wpp-main.php');
require_once( EIT_VET_WPP_PLUGIN_DIR . 'class-eit-vet-wpp-template.php');

function eit_vet_wpp_start() {

  function eit_vet_wpp_add_my_custom_page() {
    // Create post object
    $my_post = array(
      'post_title'    => wp_strip_all_tags( 'Laboratorijski nalaz' ),
      'post_content'  => '',
      'post_name'     => 'laboratorijski-nalaz',
      'post_status'   => 'publish',
      'post_author'   => 1,
      'post_type'     => 'page',
      'page_template'  => 'easyit-vet-list.php'
    );

    // Insert the post into the database
    wp_insert_post( $my_post );
}

register_activation_hook(__FILE__, 'eit_vet_wpp_add_my_custom_page');

add_filter( 'page_template', 'eit_vet_wpp_wp_page_template' );
    function eit_vet_wpp_wp_page_template( $page_template )
    {
        if ( is_page( 'Laboratorijski nalaz' ) ) {
            $page_template = plugin_dir_path( __FILE__ ) . 'easyit-vet-list.php';
        }
        return $page_template;
    }

	$custom_post = new EIT_VET_WPP_Custom_Post(); 
	$metaBoxClass = new EIT_VET_WPP_Meta_Box(); 
	$main_class = new EIT_VET_WPP_Main( $custom_post, $metaBoxClass );
	$main_class->register();

function eit_plugin_options_panel(){
  add_menu_page('Pretraga životinja', 'Pretraga životinja', 'manage_options', 'theme-options', 'animal_list_dashboard');
  add_submenu_page( 'theme-options', 'Rezultati pretrage životinja', 'Rezultati pretrage životinja', 'manage_options', 'theme-op-settings', 'eit_search_result');
 
}
add_action('admin_menu', 'eit_plugin_options_panel');

function eit_search_result(){

        process_form_data();
}
 
function animal_list_dashboard() {
	$args=['post_type'=>'animal','meta_key'=>'eit_meta_owner'];
	$the_query = new WP_Query( $args ); 
	$args=['post_type'=>'animal','meta_key'=>'eit_meta_datum'];

	$eit_meta_owner_arr=[];
	$eit_meta_datum_arr=[];

	$the_query = new WP_Query( $args );

	 if ( $the_query->have_posts() ) { 

  	  while ( $the_query->have_posts() ) {
      $the_query->the_post();
     
       $eit_meta_owner_arr[]= get_post_meta( get_the_ID(), 'eit_meta_owner', TRUE );
       $eit_meta_datum_arr[]= get_post_meta( get_the_ID(), 'eit_meta_datum', TRUE ); 
     
  }   }
 ?>
 <div class="wrap"><div id="icon-options-general" class="icon32"><br></div>
        <h2>Kriterijumi za odabir</h2></div>
    <div style="display: flex;">    
	<form method="post" action="?page=theme-op-settings&noheaders=true">
	<input type="hidden" name="action" value="process_form">
	<select name="postID" id="postID">

	   <?php
	   $eit_meta_owner_arr=array_unique($eit_meta_owner_arr);
	    foreach($eit_meta_owner_arr as $owner_arr) {?>

		 <option  value="<?php echo esc_attr($owner_arr); ?>"> 

			 <?php echo esc_attr($owner_arr); ?>	

		 <?php }?> 

		 </option>

	 </select>
  <input type="submit" name="searchByOwner" value="Pretraga">
</form>

<form method="post" action="?page=theme-op-settings&noheaders=true">
	<input type="hidden" name="action" value="process_form">
	<select name="date">
    <option value="">--Odaberi Datum--</option>
<?php
	   $eit_meta_datum_arr=array_unique($eit_meta_datum_arr);
	    foreach($eit_meta_datum_arr as $owner_arr) {?>

		 <option  value="<?php echo esc_attr($owner_arr); ?>"> 

			 <?php echo esc_attr($owner_arr); ?>	

		 <?php }
?> 

		 </option>
 </select>
  <input type="submit" name="searchByDate" value="Pretraga">
</form>
<form method="post" action="?page=theme-op-settings&noheaders=true">
	<input type="hidden" name="action" value="process_form">
	<input type="text" name="chipNo" placeholder="Broj čipa">
	<input type="submit" name="searchByChipNo" value="Pretraga po čipu">
</form>
</div>
  <?php 
}

add_action( 'admin_post_nopriv_process_form', 'process_form_data' );
add_action( 'admin_post_process_form', 'process_form_data' );
function process_form_data() {

  $postID=isset($_POST['postID']) ? $_POST['postID'] : '' ; 
  $date=isset($_POST['date']) ? $_POST['date'] : '' ; 
  $chipNo=isset($_POST['chipNo']) ? $_POST['chipNo'] : '' ;
  $argument='';
  $dateMetaValue='';
  $chipNoMetaValue='';

  $argsOwner=array('posts_per_page' => 5,'post_type'=>'animal','meta_query' => array(
    array(
      'key'   => 'eit_meta_owner',
      'compare' => '=',
      'value' => $postID
    )));
  $argsDate=array('posts_per_page' => 5,'post_type'=>'animal','meta_query' => array(
    array(
      'key'   => 'eit_meta_datum',
      'compare' => '=',
      'value' => $date
    )));
  $argsChipNo=array('posts_per_page' => 5,'post_type'=>'animal','meta_query' => array(
    array(
      'key'   => 'eit_meta_chipnumber',
      'compare' => '=',
      'value' => $chipNo
    )));

  if(array_key_exists('searchByOwner',$_POST)){
   $argument=$argsOwner;
 }else if(array_key_exists('searchByDate',$_POST)){
 	$argument=$argsDate;
 }elseif (array_key_exists('searchByChipNo',$_POST)) {
 	$argument=$argsChipNo;
 }

  $the_query = new WP_Query( $argument );


	if ( $the_query->have_posts() ) { ?>
	<h2>Ambulantni protokol</h2>
  	<?php while ( $the_query->have_posts() ) {
    $the_query->the_post();
        $dateMetaValue=get_post_meta( get_the_ID(), 'eit_meta_datum', TRUE ); 
       $chipNoMetaValue=get_post_meta( get_the_ID(), 'eit_meta_chipnumber', TRUE ); 
      global $post;
	  $currentID= $post->ID;
    ?>
    
    <table>
    	<tr>
    		<td><b>Datum</b></td>
    		<td><b>Broj čipa</b></td>
    		<td><b>Vlasnik</b></td>
    		<td><b>Opis životinje</b></td>
    		<td><b>Anamneza</b></td>
    		<td><b>Klinički nalaz</b></td>
    		<td><b>Dijagnoza</b></td>
    	</tr>
    	
    	<tr>
    		<td><?php echo get_post_meta( get_the_ID(), 'eit_meta_datum', TRUE ); ?></td>
    		<td><?php echo get_post_meta( get_the_ID(), 'eit_meta_chipnumber', TRUE ); ?></td>
    		<td><?php echo get_post_meta( get_the_ID(), 'eit_meta_owner', TRUE ); ?></td>
    		<td><?php echo get_post_meta( get_the_ID(), 'eit_meta_description', TRUE ); ?></td>
    		<td><?php echo get_post_meta( get_the_ID(), 'eit_meta_anamneza', TRUE ); ?></td>
    		<td><?php echo get_post_meta( get_the_ID(), 'eit_meta_clinical_value', TRUE ); ?></td>
    		<td><?php echo get_post_meta( get_the_ID(), 'eit_meta_diagnosys_value', TRUE ); ?></td>
    	</tr>

    	<tr>	
    		<td><b>Terapija - vrsta i količina utrošenih lekova</b></td>
    		<td><b>Naplaćeno za rad</b></td>
    		<td><b>Naplaćeno za lekove</b></td>
    		<td><b>Ostali troškovi</b></td>
    		<td><b>Broj priznanice</b></td>
    		<td><b>Primedba</b></td>
    	</tr>
    	<tr>	
    		<td><?php echo get_post_meta( get_the_ID(), 'eit_meta_therapy_value', TRUE ); ?></td>
    		<td><?php echo get_post_meta( get_the_ID(), 'eit_meta_workpayment_value', TRUE ); ?></td>
    		<td><?php echo get_post_meta( get_the_ID(), 'eit_meta_medicationpayment_value',TRUE);?></td>
    		<td><?php echo get_post_meta( get_the_ID(), 'eit_meta_expencepayment_value',TRUE);?></td>
    		<td><?php echo get_post_meta( get_the_ID(), 'eit_meta_receipt_value',TRUE);?></td>
    		<td><?php echo get_post_meta( get_the_ID(), 'eit_meta_notice_value',TRUE);?></td>
    		<td><a target="_blank" href="<?php the_permalink(); ?>">Strana</a></td>
    	</tr>
    </table>
    <h2>Biohemija</h2>
    <table>
    	<tr>
    		<td>Glukoza</td>
    		<td>Urea</td>
    		<td>Kreatinin</td>
    		<td>Holesterol</td>
    		<td>HDL Holesterol</td>
    	</tr>
    	<tr>
    		<td><?php echo get_post_meta( get_the_ID(), 'eit_meta_glukoz', TRUE ); ?></td>
    		<td><?php echo get_post_meta( get_the_ID(), 'eit_meta_urea', TRUE ); ?></td>
    		<td><?php echo get_post_meta( get_the_ID(), 'eit_meta_kreatinin',TRUE);?></td>
    		<td><?php echo get_post_meta( get_the_ID(), 'eit_meta_holesterol',TRUE);?></td>
    		<td><?php echo get_post_meta( get_the_ID(), 'eit_meta_hdlholesterol',TRUE);?></td>
    	</tr>
    </table>
	====================================================================================================
<?php
getReportPage($currentID);  
	} 
} 
	
}

	function getReportPage($currentID){
		?>
	<form method="get" id="advanced-searchform"
   action="<?php echo esc_url(home_url( '/laboratorijski-nalaz' ) ); ?>">
		<input type="hidden" name="currentID" value="<?php echo $currentID;?>">
		<input type="submit" target="_blank"  value="Izveštaj">
	</form>			  	
		<?php
	}
 
}
eit_vet_wpp_start();
 

			 