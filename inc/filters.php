<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
//удаляем слово рубрика в заголовках категорий 
add_filter( 'get_the_archive_title', 'artabr_remove_name_cat' );
function artabr_remove_name_cat( $title ){
	if ( is_category() ) {
		$title = single_cat_title( '', false );
	} elseif ( is_tag() ) {
		$title = single_tag_title( '', false );
	}
	return $title;
}

//устанавливаем количество символов в кратком описаниии
add_filter('excerpt_more', function($more) {
	return ' ';
});
add_filter( 'excerpt_length', function(){
	return 20;
} );
// Contact Form 7 remove auto added p tags
add_filter('wpcf7_autop_or_not', '__return_false');
//удаяем пустые теги p в кратком описании
remove_filter( 'the_content', 'wpautop' ); remove_filter( 'the_excerpt', 'wpautop' );
//включаем шорткоды для widgets
add_filter('widget_text','do_shortcode');



/* Убираем комментарий SEO Yoast в коде */
add_action('get_header', 'rmyoast_ob_start');
add_action('wp_head', 'rmyoast_ob_end_flush', 100);
 
function rmyoast_ob_start() {
    ob_start('remove_yoast');
}
function rmyoast_ob_end_flush() {
    ob_end_flush();
}
function remove_yoast($output) {
    if (defined('WPSEO_VERSION')) {
        $output = str_ireplace('<!-- This site is optimized with the Yoast SEO plugin v' . WPSEO_VERSION . ' - https://yoast.com/wordpress/plugins/seo/ -->', '', $output);
        $output = str_ireplace('<!-- / Yoast SEO plugin. -->', '', $output);
    }
    return $output;
}

//включаем шорткоды для текстового поля acf
//add_filter('acf/format_value/type=text', 'do_shortcode');


// Отключаем рекламные баннеры jetpack в админке
//add_filter( 'jetpack_just_in_time_msgs', '__return_false' );



// Удаляем URL из формы отправки комментариев
// add_filter('comment_form_default_fields', 'sheens_unset_url_field');
// function sheens_unset_url_field ( $fields ) {
//   if ( isset($fields['url'] ))
//   unset ( $fields['url'] );
//   return $fields;
// }


// отключаем скрипты вукомерс на не нужных страницах
add_action(
    'wp_enqueue_scripts',
    function() {
        // Если это НЕ страницы магазина.
        if ( ! is_woocommerce() && ! is_cart() && ! is_checkout() && ! is_front_page() ) {
            // Отключаем стили магазина.
            wp_dequeue_style( 'woocommerce_frontend_styles' );
            wp_dequeue_style( 'woocommerce-general');
            wp_dequeue_style( 'woocommerce-layout' );
            wp_dequeue_style( 'woocommerce-smallscreen' );
            wp_dequeue_style( 'woocommerce_fancybox_styles' );
            wp_dequeue_style( 'woocommerce_chosen_styles' );
            wp_dequeue_style( 'woocommerce_prettyPhoto_css' );
            wp_dequeue_style( 'select2' );
             
            // Отключаем скрипты магазина.
            wp_dequeue_script( 'wc-add-payment-method' );
            wp_dequeue_script( 'wc-lost-password' );
            wp_dequeue_script( 'wc_price_slider' );
            wp_dequeue_script( 'wc-single-product' );
            wp_dequeue_script( 'wc-add-to-cart' );
            wp_dequeue_script( 'wc-cart-fragments' );
            wp_dequeue_script( 'wc-credit-card-form' );
            wp_dequeue_script( 'wc-checkout' );
            wp_dequeue_script( 'wc-add-to-cart-variation' );
            wp_dequeue_script( 'wc-single-product' );
            wp_dequeue_script( 'wc-cart' ); 
            wp_dequeue_script( 'wc-chosen' );
            //wp_dequeue_script( 'woocommerce' );
            wp_dequeue_script( 'prettyPhoto' );
            wp_dequeue_script( 'prettyPhoto-init' );
            wp_dequeue_script( 'jquery-blockui' );
            wp_dequeue_script( 'jquery-placeholder' );
            wp_dequeue_script( 'jquery-payment' );
            wp_dequeue_script( 'jqueryui' );
            wp_dequeue_script( 'fancybox' );
            wp_dequeue_script( 'wcqi-js' );
        }
    },
    99
);

//contact form 7 - отключаем скрипты и стили. Потом нужно подключить на страницах перед хедером.
// add_filter( 'wpcf7_load_js', '__return_false' );
// add_filter( 'wpcf7_load_css', '__return_false' );

/**
 * Добавляет завершающий слэш в rel="canonical" в плагине Yoast SEO.
 *
 * @param string $canonical_url Канонический URL.
 */
function add_trailing_slash_to_canonical_yoast_seo( $canonical_url ) {
         return trailingslashit( $canonical_url );
}
add_filter( 'wpseo_canonical', 'add_trailing_slash_to_canonical_yoast_seo' );