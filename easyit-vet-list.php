<?php



/* Template Name: EasyIT Travel Page*/



?>



<?php get_header(); ?>



<div id="primary" class="content-area">

	<?php  

	 @$currentID =   sanitize_text_field($_GET['currentID']) ;

 
	$args = array(
	  'p'         => $currentID, // ID of a page, post, or custom type
	  'post_type' => 'animal'
	);
	$search_query = new WP_Query($args);
?>
				<h1 class="naslov-pretraga" style="padding-top: 2%;">
				Lekarski izveštaj
				 </h1>
			 

				<?php

				$search_query = new WP_Query( $args ); 
				if ( $search_query->have_posts() ): 

					while ( $search_query->have_posts() ) {   
						$search_query->the_post(); 
 					?>
					<table>
						<tr>
							<td>Vlasnik</td>
							<td>Datum prijema</td>
							<td>Broj priznanice</td>
							<td>Broj čipa</td>
						</tr>
						<tr>
							<td>
								<?php echo  get_post_meta( get_the_ID(), 'eit_meta_owner', true )?>
							</td>
							<td>
								<?php echo get_post_meta( get_the_ID(), 'eit_meta_datum', true ) ?>
							</td>
							<td>
								<?php echo get_post_meta( get_the_ID(), 'eit_meta_receipt_value',true) ?>
							</td>
							<td>
								<?php echo get_post_meta( get_the_ID(), 'eit_meta_chipnumber',true) ?>
							</td>
						</tr>
						 
					</table>
					<h2>Ambulantni protokol</h2>
					<table>
						<tr>
							<td>Opis životinje</td>
							<td>Anamneza</td>
							<td>Klinički nalaz</td>
							<td>Dijagnoza</td>
						</tr>
						<tr>
							<td>
								<?php  echo get_post_meta( get_the_ID(), 'eit_meta_description', true );?> 
							</td>
							<td>
								<?php  echo get_post_meta( get_the_ID(), 'eit_meta_anamneza', true );?> 
							</td>
							<td>
								<?php echo  get_post_meta( get_the_ID(), 'eit_meta_clinical_value', true );?>
							</td>
							<td>
								<?php echo  get_post_meta( get_the_ID(), 'eit_meta_diagnosys_value', true );?>
							</td>
						</tr>
						<tr>
							<td>Terapija - vrsta i količina lekova</td>
							<td>Naplaćeno za rad</td>
							<td>Naplaćeno za lekove</td>
							<td>Naplaćeno za ostale troškove</td>
						</tr>
						<tr>
							<td>
								<?php echo get_post_meta( get_the_ID(), 'eit_meta_therapy_value', true );?>
							</td>
							<td>
							<?php echo get_post_meta( get_the_ID(), 'eit_meta_workpayment_value', true );?>
							</td>
							<td>
							<?php echo get_post_meta( get_the_ID(), 'eit_meta_medicationpayment_value', true );?>
							</td>
							<td>
							<?php echo get_post_meta( get_the_ID(), 'eit_meta_expencepayment_value', true );?>	
							</td>
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
							<td>
								<?php echo get_post_meta( get_the_ID(), 'eit_meta_glukoz', true );?>
							</td>
							<td>
								<?php echo get_post_meta( get_the_ID(), 'eit_meta_urea', true );?>	
							</td>
							<td>
								<?php echo get_post_meta( get_the_ID(), 'eit_meta_kreatinin', true );?>
							</td>
							<td>
								<?php echo get_post_meta( get_the_ID(), 'eit_meta_holesterol', true );?>
							</td>
							<td>
								<?php echo get_post_meta( get_the_ID(), 'eit_meta_hdlholesterol', true );?>
							</td>
						</tr>

					</table>
 					<?php
						 
				 
					} 
				endif;	
					wp_reset_postdata();
 
 
			 
?>
 
		<?php get_sidebar(); ?>

		<?php get_footer(); ?>