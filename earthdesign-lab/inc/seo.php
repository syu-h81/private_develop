<?php
/**
 * Add a meta box of meta title and description
 */
global $post;

$seo_fields = array(
	array( 
		'id' => 'tcd-w_meta_title',
		'title' => __( 'Meta title', 'tcd-w' ),
		'type' => 'textarea',
		'description' => __( 'Enter meta title here.', 'tcd-w' ),
		'before_field' => '<dl class="ml_custom_fields">',
		'after_field' => '</dd></dl>',
		'before_title' => '<dt class="label">',
		'after_title' => '</dt><dd class="content">'
	),
	array( 
		'id' => 'tcd-w_meta_description',
		'title' => __( 'Meta description', 'tcd-w' ),
		'type' => 'textarea',
		'description' => __( 'Enter meta description here.', 'tcd-w' ),
		'before_field' => '<dl class="ml_custom_fields">',
		'after_field' => '</dd></dl>',
		'before_title' => '<dt class="label">',
		'after_title' => '</dt><dd class="content">'
	),
);

$seo_args = array(
	'id' => 'seo_meta_box',
	'title' => __( 'Meta title and description', 'tcd-w' ),
	'screen' => array( 'post', 'page', 'news', 'review' ),
	'fields' => $seo_fields
);
$seo_meta_box = new TCD_Meta_Box( $seo_args );

// titleタグの出力 --------------------------------------------------------------------------------
function seo_title( $title ) {

  global $post, $page, $paged;

  if ( is_single() && get_post_meta( $post->ID, 'tcd-w_meta_title', true ) or is_page() && get_post_meta( $post->ID, 'tcd-w_meta_title', true ) ) {
    $title['title'] = get_post_meta( $post->ID, 'tcd-w_meta_title', true );
  } elseif ( is_category() ) {
    $title['title'] = sprintf( __( 'Post list for %s', 'tcd-w' ), single_cat_title( '', false ) );
  } elseif ( is_tag() ) {
    $title['title'] = sprintf( __( 'Post list for %s', 'tcd-w' ), single_tag_title( '', false ) );
  } elseif ( is_search() ) {
    $title['title'] =  sprintf( __( 'Post list for %s', 'tcd-w' ), get_search_query() );
  } elseif ( is_day() ) {
    $title['title'] = sprintf( __( 'Archive for %s', 'tcd-w' ), get_the_time( __( 'F jS, Y', 'tcd-w' ) ) );
  } elseif ( is_month() ) {
    $title['title'] = sprintf( __( 'Archive for %s', 'tcd-w' ), get_the_time( __( 'F, Y', 'tcd-w') ) );
  } elseif ( is_year() ) {
    $title['title'] = sprintf( __( 'Archive for %s', 'tcd-w' ), get_the_time( __( 'Y', 'tcd-w') ) );
  } elseif ( is_author() ) {
    global $wp_query;
    $curauth = $wp_query->get_queried_object();
    $title['title'] = sprintf( __( 'Archive for %s', 'tcd-w'), $curauth->display_name );
  }
  return $title;
}
add_filter( 'document_title_parts', 'seo_title', 10 );


// meta descriptionタグの出力 --------------------------------------------------------------------------------
function seo_description() {
	global $post;

 	// カスタムフィールドがある場合
 	if ( is_single() && get_post_meta( $post->ID, 'tcd-w_meta_description', true ) or is_page() && get_post_meta( $post->ID, 'tcd-w_meta_description', true ) ) {
  	$trim_content = post_custom( 'tcd-w_meta_description' );
  	$trim_content = str_replace( array( "\r\n", "\r", "\n" ), '', $trim_content );
  	$trim_content = htmlspecialchars( $trim_content );
  	echo esc_html( $trim_content );

 	// 抜粋記事が登録されている場合は出力
 	} elseif ( is_single() && has_excerpt() or is_page() && has_excerpt() ) { 
  	$trim_content = get_the_excerpt();
  	$trim_content = str_replace( array( "\r\n", "\r", "\n" ), '', $trim_content );
  	echo esc_html( $trim_content );

	// トップページの場合
	} elseif ( is_front_page() ) {
		echo esc_html( get_bloginfo( 'description' ) );

 	// 上記が無い場合は本文から120文字を抜粋
 	} elseif ( is_single() or is_page() ) {
   	$base_content = $post->post_content;
   	$base_content = preg_replace( '!<style.*?>.*?</style.*?>!is', '', $base_content );
   	$base_content = preg_replace( '!<script.*?>.*?</script.*?>!is', '', $base_content );
   	$base_content = preg_replace( '/\[.+\]/','', $base_content );
   	$base_content = strip_tags( $base_content );
   	$trim_content = mb_substr( $base_content, 0, 120, 'utf-8' );
   	$trim_content = str_replace( ']]>', ']]&gt;', $trim_content );
   	$trim_content = str_replace( array( "\r\n", "\r", "\n" ), '', $trim_content );
   	$trim_content = htmlspecialchars( $trim_content );

   	if ( preg_match( '/。/', $trim_content ) ) { 
		// 指定した文字数内にある、最後の「。」以降をカットして表示
    	mb_regex_encoding( 'UTF-8' ); 
     	$trim_content = mb_ereg_replace( '。[^。]*$', '。', $trim_content );
  		echo esc_html( $trim_content );
   	} else { 
			// 指定した文字数内に「。」が無い場合は、指定した文字数の文章を表示し、末尾に「…」を表示
			if ( $trim_content == '' ) {
				echo esc_html( get_bloginfo( 'description' ) );
     	} else {
				echo esc_html( $trim_content ) . '...';
			}
   	}
 	} elseif ( is_day() ) {
    printf( __( 'Archive for %s', 'tcd-w' ), get_the_time( __( 'F jS, Y', 'tcd-w' ) ) );
 	} elseif ( is_month() ) {
    printf( __( 'Archive for %s', 'tcd-w' ), get_the_time( __( 'F, Y', 'tcd-w' ) ) );
 	} elseif ( is_year() ) {
    printf( __( 'Archive for %s', 'tcd-w' ), get_the_time( __( 'Y', 'tcd-w' ) ) );
 	} elseif ( is_author() ) {
    global $wp_query;
    $curauth = $wp_query->get_queried_object();
    printf( __( 'Archive for %s', 'tcd-w' ), esc_html( $curauth->display_name ) );
 	} elseif ( is_search() ) {
    printf( __( 'Post list for %s', 'tcd-w' ), get_search_query() );
 	} elseif ( is_category() ) {
  	$cat_id = get_query_var( 'cat' );
  	$cat_data = get_option( "cat_$cat_id" );
  	if ( category_description() ) {
    	$category_desc = strip_tags( category_description() );
    	$category_desc = str_replace( array( "\r\n", "\r", "\n" ), '', $category_desc );
    	echo esc_html( $category_desc );
  	} else {
    	return;
  	}
 	} else {
    echo esc_html( get_bloginfo( 'description' ) );
 	}
}
