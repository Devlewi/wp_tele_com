<?php
/*
Plugin Name: JDC SENDER
Description: Ceci est une passerelle permettant d'envoyer des publications wordpress vers l'API de Nexah SMS (via methode POST) en vue d'envoyer des alertes SMS aux personnes ayant souscrit à une formule d'abonnement
Author: Léwi jean-marc Essoh
*/



//DEBUT DEVELOPPEMENT JEAN-MARC





function cynomedia_theme_save_status($post_id){

	$post = get_post($post_id);
	$content = $post->post_content;
	$content = apply_filters('the_content', $content);
	$content = str_replace(']]>', ']]&gt;', $content);
	$tab = implode(', ', get_all_category_ids());

	$newspaper_code = "jdc";
	$sub_type = $_POST['pourabonnes_sms'];
	$post_title = get_post_field('post_title', $post_id);
	$post_excerpt = get_post_field('post_excerpt', $post_id);
	
	$terms = join( ',', wp_list_pluck( wp_get_object_terms( $post_id, 'category' ), 'term_taxonomy_id' ) );
	$re = get_the_category($post_id);

	$post_content = get_post_field('post_content', $post_id);
	$url = get_permalink($post_id);

	
        //echo $post_title;
        //#1 TOKEN GENERE DEPUIS LE SITE B
		$token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0L3NpdGVCIiwiaWF0IjoxNjgyNDEyODA1LCJuYmYiOjE2ODI0MTI4MDUsImV4cCI6MTY4MzAxNzYwNSwiZGF0YSI6eyJ1c2VyIjp7ImlkIjoiMSJ9fX0.F2eD1pGlQyWX6TnI4Ln4VAiXOekYdleggTc0wlUVeBI'; 
		$response = wp_remote_get('http://localhost/siteB/wp-json/wp/v2/posts', array(
			'headers' => array(
				'Authorization' => 'Bearer ' . $token
			),
		));
		$data = json_decode( $response['body'], true );
		//var_dump($data);

		
	if (has_post_thumbnail( $post->ID ) ){
		//    
			  $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post_id), 'post'); 
			  $im_toshare = strval($thumb[0]);

			  //$new_im = "'".$im_toshare."'";
			  $imageurl =  strval($thumb[0]);
		  
			  //$imageurl = "http://localhost/siteA/wp-content/uploads/2023/03/fmiiiiiiiiiiiiii-780x440-1.jpeg";
			  //die(print_r($imageurl));
			  //$imageurl = "http://localhost/siteA/wp-content/uploads/2023/03/a6863f2fdba2d0ecd81675469e656c54d9ebee0faf887626552152b12717e488_200.jpeg";
			  //$imageurl = "http://localhost/siteA/wp-content/uploads/2023/03/141-1410777_pdf-file-icon-png.jpg";
			  //$imageurl = $im_toshare;
			  //$imageurl = $im_toshare;
		  
			  $request = wp_remote_post(
				  'http://localhost/siteB/wp-json/wp/v2/media',
				  array(
					  'headers' => array(
						  'Authorization' => 'Bearer ' . $token,
						  'Content-Disposition' => 'attachment; filename="' . basename( $imageurl ) . '"',
						  'Content-Type: ' . wp_get_image_mime( $imageurl ),
					  ),
					  'body' => file_get_contents( $imageurl )
				  )
			  );
			  $req = json_decode( $response['body'], true );

			  if( 'Created' === wp_remote_retrieve_response_message( $request ) ) {
				$body = json_decode( wp_remote_retrieve_body( $request ) );
				$featured_image_id = $body->id;
			}

		}
		



#2 UPLOAD IMAGE WITH API


//#3 SEND DATA
$rep = wp_remote_post(
    'http://localhost/siteB/wp-json/wp/v2/posts',
    array(
        'headers' => array(
            'Authorization' => 'Bearer ' . $token
        ),
        'body' => array(
            'title'   => $post_title ." - FROM SITE A",
            'content' => $post_content,
            'status'  => 'publish',
			"categories" => $terms,
			//"categories" => [2,3,4,5],
			//"categories" => $tab,
			//"categories" => [1,2,3,4],
			//'categories' => $terms,
			'featured_media' => $featured_image_id,
        )
    )
);
$dat = json_decode( $response['body'], true );




    }




//add_action('add_meta_boxes', 'cynomedia_theme_add_custom_box');
//add_action('save_post', 'cynomedia_theme_save_status');  principale
//add_action('save_post', 'cynomedia_theme_save_status');
//add_action('save_post', 'wpse120996_on_creation_not_update');
//add_action('publish_post', 'wpse120996_on_creation_not_update');
//add_action('publish_post', 'cynomedia_theme_save_status');
//add_action('post_updated', 'cynomedia_theme_save_status');
//add_action('save_post', 'cynomedia_theme_save_status');
//add_action('publish_post', 'cynomedia_theme_save_status');  //NE FAIT QU ENREGISTRER
add_action('publish_post', 'cynomedia_theme_save_status');


































