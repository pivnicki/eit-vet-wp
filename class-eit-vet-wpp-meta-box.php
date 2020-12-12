<?php

class EIT_VET_WPP_Meta_Box
{
	public function register() {
		add_action( 'add_meta_boxes', array( $this, 'add_meta_box') );
		add_action( 'save_post', array( $this, 'save_post_notice') );
	}

	public function add_meta_box() {
		add_meta_box(
			'eitvetwpp-notice',
			'Ambulantni protokol',
			array( $this, 'post_notice_display'),
			'animal',
			'normal',
			'high'
		);
	}

	public function post_notice_display() {
		require_once( EIT_VET_WPP_PLUGIN_DIR . 'editor/eit-vet-wpp-html.php');
	}

	public function save_post_notice( $post_id ) {

		if ( ! $this->user_can_save( $post_id ) ) {
			return;
		}
		//PROTOKOL
		$meta_datum = $_POST[ 'eit_meta_datum'];
		$meta_datum = stripslashes( strip_tags( $meta_datum ) );

		$meta_owner = $_POST[ 'eit_meta_owner'];
		$meta_owner = stripslashes( strip_tags( $meta_owner ) );

		$eit_meta_chipnumber = $_POST[ 'eit_meta_chipnumber'];
		$eit_meta_chipnumber = stripslashes( strip_tags( $eit_meta_chipnumber ) );

		$meta_description = $_POST[ 'eit_meta_description'];
		$meta_description = stripslashes( strip_tags( $meta_description ) );

		$meta_anamneza = $_POST[ 'eit_meta_anamneza'];
		$meta_anamneza = stripslashes( strip_tags( $meta_anamneza ) );

		$meta_clinical_value = $_POST[ 'eit_meta_clinical_value'];
		$meta_clinical_value = stripslashes( strip_tags( $meta_clinical_value ) );

		$meta_diagnosys_value = $_POST[ 'eit_meta_diagnosys_value'];
		$meta_diagnosys_value = stripslashes( strip_tags( $meta_diagnosys_value ) );

		$meta_therapy_value = $_POST[ 'eit_meta_therapy_value'];
		$meta_therapy_value = stripslashes( strip_tags( $meta_therapy_value ) );

		$meta_workpayment_value = $_POST[ 'eit_meta_workpayment_value'];
		$meta_workpayment_value = stripslashes( strip_tags( $meta_workpayment_value ) );

		$meta_medicationpayment_value = $_POST[ 'eit_meta_medicationpayment_value'];
		$meta_medicationpayment_value = stripslashes( strip_tags( $meta_medicationpayment_value ) );

		$meta_expencepayment_value = $_POST[ 'eit_meta_expencepayment_value'];
		$meta_expencepayment_value = stripslashes( strip_tags( $meta_expencepayment_value ) );

		$meta_receipt_value = $_POST[ 'eit_meta_receipt_value'];
		$meta_receipt_value = stripslashes( strip_tags( $meta_receipt_value ) );

		$meta_notice_value = $_POST[ 'eit_meta_notice_value'];
		$meta_notice_value = stripslashes( strip_tags( $meta_notice_value ) );

		update_post_meta( $post_id, 'eit_meta_datum', $meta_datum );
		update_post_meta( $post_id, 'eit_meta_owner', $meta_owner );
		update_post_meta( $post_id, 'eit_meta_chipnumber', $eit_meta_chipnumber );
		update_post_meta( $post_id, 'eit_meta_description', $meta_description );
		update_post_meta( $post_id, 'eit_meta_anamneza', $meta_anamneza );
		update_post_meta( $post_id, 'eit_meta_clinical_value', $meta_clinical_value );
		update_post_meta( $post_id, 'eit_meta_diagnosys_value', $meta_diagnosys_value );
		update_post_meta( $post_id, 'eit_meta_therapy_value', $meta_therapy_value );
		update_post_meta( $post_id, 'eit_meta_workpayment_value', $meta_workpayment_value );
		update_post_meta( $post_id, 'eit_meta_medicationpayment_value', $meta_medicationpayment_value );
		update_post_meta( $post_id, 'eit_meta_expencepayment_value', $meta_expencepayment_value );
		update_post_meta( $post_id, 'eit_meta_receipt_value', $meta_receipt_value );
		update_post_meta( $post_id, 'eit_meta_notice_value', $meta_notice_value );

		//BIOHEMIJA

		$eit_meta_glukoz = $_POST[ 'eit_meta_glukoz'];
		$eit_meta_glukoz = stripslashes( strip_tags( $eit_meta_glukoz ) );

		$eit_meta_urea = $_POST[ 'eit_meta_urea'];
		$eit_meta_urea = stripslashes( strip_tags( $eit_meta_urea ) );

		$eit_meta_kreatinin = $_POST[ 'eit_meta_kreatinin'];
		$eit_meta_kreatinin = stripslashes( strip_tags( $eit_meta_kreatinin ) );

		$eit_meta_holesterol = $_POST[ 'eit_meta_holesterol'];
		$eit_meta_holesterol = stripslashes( strip_tags( $eit_meta_holesterol ) );

		$eit_meta_hdlholesterol = $_POST[ 'eit_meta_hdlholesterol'];
		$eit_meta_hdlholesterol = stripslashes( strip_tags( $eit_meta_hdlholesterol ) );

		update_post_meta( $post_id, 'eit_meta_glukoz', $eit_meta_glukoz );
		update_post_meta( $post_id, 'eit_meta_urea', $eit_meta_urea );
		update_post_meta( $post_id, 'eit_meta_kreatinin', $eit_meta_kreatinin );
		update_post_meta( $post_id, 'eit_meta_holesterol', $eit_meta_holesterol );
		update_post_meta( $post_id, 'eit_meta_hdlholesterol', $eit_meta_hdlholesterol );

	}

	public function user_can_save( $post_id ) {

		$is_valid_nonce = 
			( isset( $_POST[ 'ldwpd-post-notice-nonce' ] ) ) &&
			wp_verify_nonce(
				$_POST[ 'ldwpd-post-notice-nonce' ],
				'ldwpd-post-notice-save'
			);

		$is_autosave = wp_is_post_autosave( $post_id );
		$is_revision = wp_is_post_revision( $post_id );

		return ! ( $is_autosave || $is_revision ) && $is_valid_nonce;

	}
} 