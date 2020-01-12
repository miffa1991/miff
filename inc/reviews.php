
<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}


// Register Custom Post Type
function custom_post_type_rew() {

	$labels = array(
		'name'                  => 'Отзывы',
		'singular_name'         => 'Отзывы',
		'menu_name'             => 'Отзывы',
		'add_new_item'          => 'Добавить отзыв',
		'add_new'               => 'Добавить отзыв',
		'new_item'              => 'Новый',
		'edit_item'             => 'Редактировать',
		'update_item'           => 'Обновить',
		'view_item'             => 'Просмотр',
		'view_items'            => 'Посмотреть все',
	);
	$rewrite = array(
		'slug'                  => 'reviews',
		'with_front'            => true,
		'pages'                 => false,
		'feeds'                 => true,
	);
	$args = array(
		'label'                 => 'Отзывы',
		'description'           => 'Post Type Description',
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-format-quote',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => false,
		'has_archive'           => false,
		'exclude_from_search'   => true,
		'publicly_queryable'    => true,
		'query_var'             => 'reviews',
		'rewrite'               => $rewrite,
		'capability_type'       => 'page',
	);
	register_post_type( 'rew_post_type', $args );

}
add_action( 'init', 'custom_post_type_rew', 0 );