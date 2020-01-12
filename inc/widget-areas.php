<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

add_action( 'widgets_init', 'dipri_widgets_init' );
function dipri_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Телефон в шапке', 'dipri' ),
		'id'            => 'sidebar-header-phone',
		'description'   => esc_html__( 'Add widgets here.', 'dipri' ),
		'before_widget' => '<div id="%1$s" class="h_phone %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="title">',
		'after_title'   => '</div>',

	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Описание школы на главной', 'dipri' ),
		'id'            => 'sidebar-curse-main',
		'description'   => esc_html__( 'Add widgets here.', 'dipri' ),
		'before_widget' => '<div id="%1$s" class="widget o-nas %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="title2">',
		'after_title'   => '</div>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Карта', 'dipri' ),
		'id'            => 'sidebar-map',
		'description'   => esc_html__( 'Add widgets here.', 'dipri' ),
		'before_widget' => '<section id="%1$s" class="item %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<div class="title">',
		'after_title'   => '</div>',

	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Приглашения для примерки в карточке товара', 'dipri' ),
		'id'            => 'sidebar-dress-descr',
		'description'   => esc_html__( 'Add widgets here.', 'dipri' ),
		'before_widget' => '<div id="%1$s" class="item %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="title3">',
		'after_title'   => '</div>',

	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Описание доставки в карточке товара', 'dipri' ),
		'id'            => 'sidebar-delivery-descr',
		'description'   => esc_html__( 'Add widgets here.', 'dipri' ),
		'before_widget' => '<div id="%1$s" class="item %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="title3">',
		'after_title'   => '</div>',

	) );
		register_sidebar( array(
		'name'          => esc_html__( 'Дополнительный блок в записях рубрики "Обучения"', 'dipri' ),
		'id'            => 'sidebar-training-descr',
		'description'   => esc_html__( 'Add widgets here.', 'dipri' ),
		'before_widget' => '<div id="%1$s" class="%2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="title3">',
		'after_title'   => '</div>',

	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Социалки в шапке и подвале', 'dipri' ),
		'id'            => 'sidebar-footer-social',
		'description'   => esc_html__( 'Add widgets here.', 'dipri' ),
		'before_widget' => '<div id="%1$s" class=" %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="title">',
		'after_title'   => '</div>',

	) );

		register_sidebar( array(
		'name'          => esc_html__( 'Контакты в подвале', 'dipri' ),
		'id'            => 'sidebar-footer-contact',
		'description'   => esc_html__( 'Add widgets here.', 'dipri' ),
		'before_widget' => '<div id="%1$s" class="f_contacts %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="title">',
		'after_title'   => '</div>',

	) );
}
