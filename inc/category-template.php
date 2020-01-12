<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

//задаем шаблон для дочерних категорий "Полезная информация"
add_filter('template_include', 'my_template_information');
function my_template_information( $template ) {
	$main_cat_id = 39;
	if (cat_is_ancestor_of( $main_cat_id, get_query_var('cat') ) ) {
		$new_template = locate_template( array( 'category-39.php' ) );
		return $new_template ;
	}
	return $template;
}


//задаем шаблон для дочерних категорий "Видео уроки"
add_filter('template_include', 'my_template_portfolio');
function my_template_portfolio( $template ) {
	$main_cat_id = 34;
	if (cat_is_ancestor_of( $main_cat_id, get_query_var('cat') ) or is_category( $main_cat_id) ) {
		$new_template = locate_template( array( 'category-34.php' ) );
		return $new_template ;
	}
	return $template;
}

// Менеем количество постов на странице категории
add_action('pre_get_posts','custom_posts_per_page');
function custom_posts_per_page( $query ){
	if( is_category( 'Полезная информация' ) ){
		$query->set('posts_per_page', 6 );
	}

}