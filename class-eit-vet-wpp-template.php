<?php
 




// function stev314add_my_custom_page() {


//  $template = plugin_dir_path( __FILE__ ) . 'easyit-travel-list.php';

// //     // Create post object
//     $my_post = array(
//       'post_title'    => wp_strip_all_tags( 'Nesto drugo' ),
//       'post_name'     => 'nesto_drugo',
//       'post_content'  => '',
//       'post_status'   => 'publish',
//       'post_author'   => get_current_user_id(),
//       'post_type'     => 'page',
//       'page_template'  => 'easyit-travel-list.php'
//     );

//     // Insert the post into the database
     
//     wp_insert_post( $my_post );
// }

// register_activation_hook(__FILE__, 'stev314add_my_custom_page');

// add_filter( 'page_template', 'stev314wp_page_template' );
//     function stev314wp_page_template( $page_template )
//     {
//         if ( is_page( 'EasyIT Travel Page' ) ) {
//             $page_template = plugin_dir_path( __FILE__ ) . 'easyit-travel-list.php';
//         }
//         return $page_template;
//     }
//  