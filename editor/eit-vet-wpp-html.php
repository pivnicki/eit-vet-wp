<div id="tabs-container">
    <ul class="tabs-menu">
        <li class="current"><a href="#tab-1">Ambulantni Protokol</a></li>
        <li><a href="#tab-2">Biohemija</a></li> 
    </ul>
    <div class="tab">
        <div id="tab-1" class="tab-content">

<p>
     <label>Datum</label>
</p>
<input id="date-meta" placeholder="Datum"  name="eit_meta_datum" type="text" value="<?php echo get_post_meta( get_the_ID(), 'eit_meta_datum', true ); ?>">
<p>
     <label>Vlasnik životinje</label>
</p>
<input id="owner-meta" placeholder="Vlasnik životinje"  name="eit_meta_owner" type="text" value="<?php echo get_post_meta( get_the_ID(), 'eit_meta_owner', true ); ?>">
<p>
     <label>Broj čipa</label>
</p>
<input id="owner-meta" placeholder="Broj čipa"  name="eit_meta_chipnumber" type="text" value="<?php echo get_post_meta( get_the_ID(), 'eit_meta_chipnumber', true ); ?>">
<p>
     <label>Opis životinje</label>
</p>
<input id="description-meta" placeholder="Opis životinje"  name="eit_meta_description" type="text"
 value="<?php echo get_post_meta( get_the_ID(), 'eit_meta_description', true ); ?>">
 <p>
     <label>Anamneza</label>
</p>
<input id="anamneza-meta" placeholder="Anamneza"  name="eit_meta_anamneza" type="text"
 value="<?php echo get_post_meta( get_the_ID(), 'eit_meta_anamneza', true ); ?>">
 <p>
 Klinički nalaz
</p>
<input id="clinical-value-meta" placeholder="Klinički nalaz"  name="eit_meta_clinical_value" type="text"
 value="<?php echo get_post_meta( get_the_ID(), 'eit_meta_clinical_value', true ); ?>">
<?php wp_nonce_field( 'ldwpd-post-notice-save', 'ldwpd-post-notice-nonce' ); ?>
 <p>
 Dijagnoza
</p>
<input id="diagnosys-value-meta" placeholder="Dijagnoza"  name="eit_meta_diagnosys_value" type="text"
 value="<?php echo get_post_meta( get_the_ID(), 'eit_meta_diagnosys_value', true ); ?>">
<?php wp_nonce_field( 'ldwpd-post-notice-save', 'ldwpd-post-notice-nonce' ); ?>
<p>
 Terapija / vrsta i količina utrošenih lekova
</p>
<input id="therapy-value-meta" placeholder="Terapija"  name="eit_meta_therapy_value" type="text"
 value="<?php echo get_post_meta( get_the_ID(), 'eit_meta_therapy_value', true ); ?>">
<?php wp_nonce_field( 'ldwpd-post-notice-save', 'ldwpd-post-notice-nonce' ); ?>
<p>
 Naplaćeno za rad
</p>
<input id="workpayment-value-meta" placeholder="Naplaćeno za rad"  name="eit_meta_workpayment_value"
 type="text" value="<?php echo get_post_meta( get_the_ID(), 'eit_meta_workpayment_value', true ); ?>">
<?php wp_nonce_field( 'ldwpd-post-notice-save', 'ldwpd-post-notice-nonce' ); ?>
<p>
 Naplaćeno za lekove
</p>
<input id="medicationpayment-value-meta" placeholder="Naplaćeno za lekove"  name="eit_meta_medicationpayment_value"
 type="text" value="<?php echo get_post_meta( get_the_ID(), 'eit_meta_medicationpayment_value', true ); ?>">
<?php wp_nonce_field( 'ldwpd-post-notice-save', 'ldwpd-post-notice-nonce' ); ?>
<p>
 Ostali troškovi
</p>
<input id="expencepayment-value-meta" placeholder="Ostali troškovi" 
name="eit_meta_expencepayment_value"
 type="text" value="<?php echo get_post_meta( get_the_ID(), 'eit_meta_expencepayment_value', true ); ?>">
<?php wp_nonce_field( 'ldwpd-post-notice-save', 'ldwpd-post-notice-nonce' ); ?>
<p>
 Broj priznanice
</p>
<input id="receipt-value-meta" placeholder="Broj priznanice" name="eit_meta_receipt_value"
 type="text" value="<?php echo get_post_meta( get_the_ID(), 'eit_meta_receipt_value', true ); ?>">
<?php wp_nonce_field( 'ldwpd-post-notice-save', 'ldwpd-post-notice-nonce' ); ?>
<p>
 Primedba
</p>
<input id="notice-value-meta" placeholder="Primedba" name="eit_meta_notice_value"
 type="text" value="<?php echo get_post_meta( get_the_ID(), 'eit_meta_notice_value', true ); ?>">
<?php wp_nonce_field( 'ldwpd-post-notice-save', 'ldwpd-post-notice-nonce' ); ?>

 </div>
<div id="tab-2" class="tab-content">
<p>
 Glukoza
</p>
<input id="notice-value-meta" placeholder="Glukoza" name="eit_meta_glukoz"
 type="text" value="<?php echo get_post_meta( get_the_ID(), 'eit_meta_glukoz', true ); ?>">
<?php wp_nonce_field( 'ldwpd-post-notice-save', 'ldwpd-post-notice-nonce' ); ?>
<p>
 Urea
</p>
<input id="notice-value-meta" placeholder="Urea" name="eit_meta_urea"
 type="text" value="<?php echo get_post_meta( get_the_ID(), 'eit_meta_urea', true ); ?>">
<?php wp_nonce_field( 'ldwpd-post-notice-save', 'ldwpd-post-notice-nonce' ); ?>
<p>
 Kreatinin
</p>
<input id="notice-value-meta" placeholder="Kreatinin" name="eit_meta_kreatinin"
 type="text" value="<?php echo get_post_meta( get_the_ID(), 'eit_meta_kreatinin', true ); ?>">
<?php wp_nonce_field( 'ldwpd-post-notice-save', 'ldwpd-post-notice-nonce' ); ?> 
<p>
 Holesterol
</p>
<input id="notice-value-meta" placeholder="Holesterol" name="eit_meta_holesterol"
 type="text" value="<?php echo get_post_meta( get_the_ID(), 'eit_meta_holesterol', true ); ?>">
<?php wp_nonce_field( 'ldwpd-post-notice-save', 'ldwpd-post-notice-nonce' ); ?>   
<p>
 HDL Holesterol
</p>
<input id="notice-value-meta" placeholder="HDL Holesterol" name="eit_meta_hdlholesterol"
 type="text" value="<?php echo get_post_meta( get_the_ID(), 'eit_meta_hdlholesterol', true ); ?>">
<?php wp_nonce_field( 'ldwpd-post-notice-save', 'ldwpd-post-notice-nonce' ); ?>    
</div>
</div>
</div>
        