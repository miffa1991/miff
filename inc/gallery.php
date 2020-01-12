<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}




add_filter('post_gallery', 'filter_gallery', 10, 2);
function filter_gallery($output, $attr) 
{
    global $post;



    //GALLERY SETUP STARTS HERE----------------------------------------//
    if (isset($attr['orderby'])) {
        $attr['orderby'] = sanitize_sql_orderby($attr['orderby']);
        if (!$attr['orderby'])
            unset($attr['orderby']);
    }
    //print_r($attr);
    extract(shortcode_atts(array(
        'order' => 'ASC',
        'orderby' => 'menu_order ID',
        'id' => $post->ID,
        'itemtag' => 'dl',
        'icontag' => 'dt',
        'captiontag' => 'dd',
        'columns' => 3,
        'size' => 'thumbnail',
        'include' => '',
        'exclude' => ''
    ), $attr));

    $id = intval($id);
    if ('RAND' == $order) $orderby = 'none';

    if (!empty($include)) {
        $include = preg_replace('/[^0-9,]+/', '', $include);
        $_attachments = get_posts(array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby));

        $attachments = array();
        foreach ($_attachments as $key => $val) {
            $attachments[$val->ID] = $_attachments[$key];
        }
    }
    if (empty($attachments)) return '';
    //GALLERY SETUP END HERE------------------------------------------//


    //PAGINATION SETUP START HERE-------------------------------------//
    $current = (get_query_var('paged')) ? get_query_var( 'paged' ) : 1;
    $per_page = 16;
    //$offset = ($page-1) * $per_page;
    $offset = ($current-1) * $per_page;
    $big = 999999999; // need an unlikely integer


    $total = sizeof($attachments);
    $total_pages = round($total/$per_page);
    if($total_pages < ($total/$per_page))
    {   $total_pages = $total_pages+1;
    }
    //PAGINATION SETUP END HERE-------------------------------------//


    //GALLERY OUTPUT START HERE---------------------------------------//
    $output = "<div class=\"b_info4 carousel1\">\n";
    $counter = 0;
    $pos = 0;
    foreach ($attachments as $id => $attachment) 
    {   $pos++;
        //$img = wp_get_attachment_image_src($id, 'medium');
        //$img = wp_get_attachment_image_src($id, 'thumbnail');
        //$img = wp_get_attachment_image_src($id, 'full');  

        if(($counter < $per_page)&&($pos > $offset))
        {   $counter++;
            $largetitle = get_the_title($attachment->ID);
            $largeimg = wp_get_attachment_image_src($id, 'large');  
            $img = wp_get_attachment_image_src($id, array(254,261));        
            $output .= "<div class='thumb'> <a href=\"{$largeimg[0]}\" data-lightbox=\"example-set\" data-fancybox=\"gallery\" title=\"{$largetitle}\"><img src=\"{$img[0]}\" width=\"{$img[1]}\" height=\"{$img[2]}\" alt=\"\" /></a></div>\n";
        }

    }  
   
    $output .= "</div>\n";
    //GALLERY OUTPUT ENDS HERE---------------------------------------//


    //PAGINATION OUTPUT START HERE-------------------------------------//
    $output .= "<div class=\"pagination\">\n";
    
    $output .= paginate_links( array(
        'base' => str_replace($big,'%#%',esc_url(get_pagenum_link($big))),
        'format' => '?paged=%#%',
        'current' => $current,
        'total' => $total_pages,
        'prev_text'    => __('&laquo;'),
        'next_text'    => __('&raquo;')
    ) );
     $output .= "</div>\n";
    //PAGINATION OUTPUT ENDS HERE-------------------------------------//





    return $output;
}