<?php
/*
Plugin Name: CynoSendPlugin
Description: Ceci est une passerelle permettant d'envoyer des publications wordpress vers l'API de Nexah SMS (via methode POST) en vue d'envoyer des alertes SMS aux personnes ayant souscrit à une formule d'abonnement
Author: Léwi jean-marc Essoh
*/
//https://plugins.miniorange.com/wordpress-single-sign-on-using-jwt-token
//https://wordpress.org/plugins/jwt-authentication-for-wp-rest-api/
//https://zetcode.com/php/getpostrequest/
//https://wordpress.stackexchange.com/questions/318854/sending-post-request-from-server


//DEBUT DEVELOPPEMENT JEAN-MARC
function cynomedia_theme_save_status($post_id){


		#STEP OF LOGIN
		$req_login = wp_remote_post(
			'http://localhost/siteB/wp-json/jwt-auth/v1/token',
			array(
				'headers' => array(
					//'Authorization' => 'Bearer ' . $token
					//'Content-Type' => 'application/json'
				),
				'body' => array(
					'username'   => "admin",
					'password' => "admin",
				)
			)
		);
		$resp_req = json_decode( $req_login['body'], true );
		//wp_die($resp_req);
		//die(print_r($req_login ));
		//die(print_r($resp_req["token"]));
	


	$post_categories = wp_get_post_categories( $post_id );
	$cats = array();
	
foreach($post_categories as $c){
	$cat = get_category( $c );
	$cats[] = array( 'name' => $cat->name, 'slug' => $cat->slug );
}

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

	function get_taxonomy_hierarchy( $taxonomy, $parent=0) {
		// only 1 taxonomy
		$taxonomy=is_array( $taxonomy) ? array_shift( $taxonomy): $taxonomy;
		// get all direct decendants of the $parent
		$terms=get_terms( $taxonomy, array( 'parent'=> $parent, 'hide_empty'=> 0));
		// prepare a new array.  these are the children of $parent
		// we'll ultimately copy all the $terms into this new array, but only after they
		// find their own children
		$children=array();
		// go through all the direct decendants of $parent, and gather their children
		foreach ( $terms as $term) {
			// recurse to get the direct decendants of "this" term
			$term->children=get_taxonomy_hierarchy( $taxonomy, $term->term_id);
			// add the term to our new array
			$children[ $term->term_id]=$term;
		}
		// send the results back to the caller
		return $children;
	}
	
	
	function get_taxonomy_hierarchy_multiple( $taxonomies, $parent = 0 ) {
		if ( ! is_array( $taxonomies )  ) {
			$taxonomies = array( $taxonomies );
		}
		$results = array();
		foreach( $taxonomies as $taxonomy ){
			$terms = get_taxonomy_hierarchy( $taxonomy, $parent );
			if ( $terms ) {
				$results[ $taxonomy ] = $terms;
			}
		}
		return $results;
	}
	// Example below
	$hierarchies = get_taxonomy_hierarchy_multiple( array( 'category', 'post_tag' ) );

	//die(print_r($hierarchies));





	//$categories = get_the_terms( $post_id, 'taxonomy' );
	/*foreach( $categories as $category ) {
		echo $category->term_id . ', ' . $category->slug . ', ' . $category->name . '<br />';
	}*/

	$cats = array();
foreach (get_the_category($post_id) as $c) {
$cat = get_category($c);
array_push($cats, $cat->name);
}

if (sizeOf($cats) > 0) {
$post_categories = implode(', ', $cats);
} else {
$post_categories = 'Not Assigned';
}


	$re = get_the_category($post_id);
	$post_content = get_post_field('post_content', $post_id);
	$url = get_permalink($post_id);



	//$username = 'admin';
	//$passwd = 'admin';




	//#1 TOKEN GENERE DEPUIS LE SITE B

	//$token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0L3NpdGVCIiwiaWF0IjoxNjgyNDEyODA1LCJuYmYiOjE2ODI0MTI4MDUsImV4cCI6MTY4MzAxNzYwNSwiZGF0YSI6eyJ1c2VyIjp7ImlkIjoiMSJ9fX0.F2eD1pGlQyWX6TnI4Ln4VAiXOekYdleggTc0wlUVeBI'; 
	$token = $resp_req["token"]; 
	$response = wp_remote_get('http://localhost/siteB/wp-json/wp/v2/posts', array(
		'headers' => array(
			'Authorization' => 'Bearer ' . $token
		),
	));
	$data = json_decode( $response['body'], true );
	//var_dump($data);

	#2 UPLOAD IMAGE WITH API
	if (has_post_thumbnail( $post->ID ) ){
			  $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post_id), 'post'); 
			  $im_toshare = strval($thumb[0]);
			  $imageurl =  strval($thumb[0]);				  
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
			'featured_media' => $featured_image_id,
        )
    )
);
$dat = json_decode( $response['body'], true );

}



/*
function my_save_post_function( $post_ID, $post, $update ) {
  $msg = 'Is this un update? ';
  $msg .= $update ? 'Yes.' : 'No.';
  wp_die( $msg );
}
*/


//add_action('add_meta_boxes', 'cynomedia_theme_add_custom_box');
//add_action('save_post', 'cynomedia_theme_save_status');  principale
//add_action('save_post', 'cynomedia_theme_save_status');
//add_action('save_post', 'wpse120996_on_creation_not_update');
//add_action('publish_post', 'wpse120996_on_creation_not_update');
//add_action('publish_post', 'cynomedia_theme_save_status');
//add_action('post_updated', 'cynomedia_theme_save_status');
//add_action('save_post', 'cynomedia_theme_save_status');
//add_action('publish_post', 'cynomedia_theme_save_status');  //NE FAIT QU ENREGISTRER




//add_action( 'save_post', 'my_save_post_function', 10, 3 );
add_action('publish_post', 'cynomedia_theme_save_status');
//do_action( 'post_updated', $post_id, $post_after, $post_before );

//PRINCIPALE ELEMENT
//add_action('publish_post', 'cynomedia_theme_save_status');


































