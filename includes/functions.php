<?php
if ( !defined('ABSPATH')) exit;
/**
 * Theme's Functions and Definitions
 * @file           functions.php
 * @package        charco 
**/

add_post_type_support('page', 'excerpt');
add_filter('the_content', 'wpautop');
remove_filter('the_excerpt', 'wpautop');

//=================================================================== IMAGES//   
function wpse_setup_theme() {
    add_theme_support( 'post-thumbnails' );
    if ( function_exists( 'add_theme_support') ) {
        set_post_thumbnail_size( 200, 200, true ); 
    }
    if ( function_exists( 'add_image_size' ) ) { 
        add_image_size( 'main-image', 370, 180, true);
        add_image_size( 'news-image', 240, 220, true);
        add_image_size( 'int-image', 240, 160, true);
        add_image_size( 'cabecera', 2000, 275, array('center', 'center'));
        add_image_size( 'roster-logo', 170, 140, true);
        add_image_size( 'roster', 300, 250, array('center', 'center'));
        add_image_size( 'slider-image', 2000, 750, array('center', 'center'));
        add_image_size( 'slider-mobile', 400, 500, array('center', 'center'));
        add_image_size( 'ficha', 570, 470, true);
        add_image_size( 'calendar', 350, 150, array('center', 'center'));
        add_image_size( 'artista-logo', 580, 85, false);
        add_image_size( 'foot-logo', 150, 95, false);
        add_image_size( 'disco', 300, 300, true);
        add_image_size( 'det-disco', 500, 500, true);
        add_image_size( 'booker', 70, 70, true);
        add_image_size( 'menu', 150, 100, true);
        add_image_size( 'prod-image', 200, 200, true);
    }
} 
add_action( 'after_setup_theme', 'wpse_setup_theme' );

//=================================================================== CUT OFF// 
function short_title($after = '', $length) {
    $mytitle = explode(' ', get_the_title(), $length);
    if (count($mytitle)>=$length) {
        array_pop($mytitle);
        $mytitle = implode(" ",$mytitle). $after;
    } else {
        $mytitle = implode(" ",$mytitle);
    }
    return $mytitle;
}

function excerpt($limit) {
    $excerpt = explode(' ', get_the_excerpt(), $limit);
    if (count($excerpt)>=$limit) {
        array_pop($excerpt);
        $excerpt = implode(" ",$excerpt).'...';
    } else {
        $excerpt = implode(" ",$excerpt);
    } 
    $excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
    return $excerpt;
}

function content($limit) {
    $content = explode(' ', get_the_content(), $limit);
    if (count($content)>=$limit) {
        array_pop($content);
        $content = implode(" ",$content).'...';
    } else {
        $content = implode(" ",$content);
    } 
    $content = preg_replace('/\[.+\]/','', $content);
    $content = apply_filters('the_content', $content); 
    $content = str_replace(']]>', ']]&gt;', $content);
    return $content;
}

//=================================================================== CUSTOM ADMIN LOGO// 
function my_custom_login_logo() {
    echo '<style type="text/css">
        body.login {background:#000 !important;}
        .login form {background:#000 !important; border:1px solid #666;}
        h1 a { background-image:url('.get_bloginfo('template_directory').'/imag/logo/logo-charco-admin.png) !important; background-size:320px 67px !important; width:320px !important; height:67px !important;}
        .login #backtoblog a, .login #nav a {color:#ffffff;}
    </style>';
}

add_action('login_head', 'my_custom_login_logo');

//=================================================================== REMOVE LINK// 
function wpb_imagelink_setup() {
    $image_set = get_option( 'image_default_link_type' );
    
    if ($image_set !== 'none') {
        update_option('image_default_link_type', 'none');
    }
}
add_action('admin_init', 'wpb_imagelink_setup', 10);

//=================================================================== REMOVE ADMIN MENUS// 
function remove_menus () {
global $menu;
    $restricted = array(__('Links'),__('Comments'));
    end ($menu);
    while (prev($menu)){
        $value = explode(' ',$menu[key($menu)][0]);
        if(in_array($value[0] != NULL?$value[0]:"" , $restricted)){unset($menu[key($menu)]);}
    }
}
add_action('admin_menu', 'remove_menus');

//=================================================================== CUSTOM FUNCTIONS//
/**
 * Get active section from Request URI
 * @return string post_name of the active section
 */
function section_from_url(){
	global $wpdb;
	$url = $_SERVER['REQUEST_URI'];
	$first_level_pages = $wpdb->get_results("SELECT ID, post_name, post_title FROM $wpdb->posts WHERE post_type = 'page' AND post_parent = 0 AND post_status = 'publish'");
	foreach ( $first_level_pages as $section ) {
		if ( stristr($url, '/'.$section->post_name.'/') ) $out = $section;
	}
	$out->post_title = apply_filters('the_title', $out->post_title);
	return $out;
}

/**
 * Get post/page/attachment ID by post_name (sanitized title)
 * @param string $name The post_name of the object
 * @return integer Object ID in $wpdb->posts
 */
function get_id_by_postname($name){
global $wpdb;
    return $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_name = '$name' AND post_status = 'publish'");
}

/**
 * Get permalink by the post_name of the post/page
 * @param string post_name of the object
 * @return string Object permalink
 */
function get_permalink_by_postname($name){
global $wpdb;
	return get_permalink($wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE (post_name = '$name' AND post_status = 'publish') AND (post_type = 'page' OR post_type = 'post')"));
}

function get_attachment_id_from_src ($link) {
    global $wpdb;
        $link = preg_replace('/-\d+x\d+(?=\.(jpg|jpeg|png|gif)$)/i', '', $link);
        return $wpdb->get_var("SELECT ID FROM {$wpdb->posts} WHERE guid='$link'");
}

//=================================================================== PARENT PAGES//
function about_pages($args){
global $wpdb;
    // Defaults
    $defaults = array( 'id' => $apage->ID, 'class' => 'apage', 'excerpt' => true, 'content' => false, 'childs' => false, 'exclude' => true );
    $r = wp_parse_args( $args, $defaults );
    extract( $r, EXTR_SKIP );

    if($exclude != 'false') $about_pages = $wpdb->get_results("SELECT * FROM $wpdb->posts WHERE (post_type = 'page' AND post_parent = ".$id.") AND (post_status = 'publish' AND menu_order >= 0) ORDER BY menu_order ASC");
    else $about_pages = $wpdb->get_results("SELECT * FROM $wpdb->posts WHERE (post_type = 'page' AND post_parent = ".$id.") AND post_status = 'publish' ORDER BY menu_order ASC");
    if(!empty($about_pages)){
        $i = 0; $about_pages_size = count($about_pages) - 1;
        foreach($about_pages as $apages){
            if ( $i === 0 ) $pos = ''; elseif ( $i === $about_pages_size ) $pos = 'bloque'; else $pos = 'bloque';
            if($apages->menu_order >= 0){
                $texto = get_post_meta( $bpages->ID, '_nombre_boton', true);
                echo '<div id="bases">';
                    echo '<div class="container clearfix">';
                        echo '<div class="cont-descarga col-lg-10 col-md-10 col-sm-10 col-xs-12">';
                            echo '<h3>'.$apages->post_excerpt.'</h3>';
                            echo $apages->post_content;
                        echo '</div>';
                    echo '</div>';
                echo '</div>';
            $i++; }
        }
    }
}

//=================================================================== POST TYPE AND TAXONOMY // 
add_action( 'init', 'create_post_type_artistas' );
function create_post_type_artistas() {
    register_post_type( 'artistas',
        array(
            'labels' => array(
                'name' => __('Artistas'),
                'singular_name' => __('Artista'),
                'add_new' => __('Agregar nuevo'),
                'add_new_item' => __('Agregar nuevo artista'),
                'edit_item' => __('Editar artista'),
                'new_item' => __('Nuevo artista'),
                'all_items' => __('Todos los artistas'),
                'view_item' => __('Ver artistas'),
                'search_items' => __('Buscar artistas')
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'ver-artistas', 'hierarchical' => true),
            'hierarchical' => true,
            'show_ui' => true,
            'query_var' => true,
            'update_count_callback' => '_update_post_term_count',
            'supports' => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields' )
        )
    );
    flush_rewrite_rules();
}

add_action('init', 'create_taxonomy_artistas', 0);
function create_taxonomy_artistas() {
    $labels = array(
        'name'                => __( 'Clasificación Artistas', 'taxonomy general name' ),
        'singular_name'       => __( 'Clasificación Artistas', 'taxonomy singular name' ),
        'search_items'        => __( 'Buscar en Clasificación Artistas' ),
        'all_items'           => __( 'Todas las Clasificaciones de Artistas' ),
        'edit_item'           => __( 'Editar Clasificaciones de Artistas' ), 
        'update_item'         => __( 'Actualizar Clasificaciones de Artistas' ),
        'add_new_item'        => __( 'Agregar Clasificaciones de Artistas' ),
        'menu_name'           => __( 'Clasificación Artistas' )
    );  
    $args = array(
        'hierarchical'        => true,
        'labels'              => $labels,
        'show_ui'             => true,
        'show_admin_column'   => true,
        'query_var'           => true,
    );
    register_taxonomy('clasificacion-artistas', array('artistas'), $args);
}

//=================================================================== POST TYPE AND TAXONOMY // 
add_action( 'init', 'create_post_type_team' );
function create_post_type_team() {
    register_post_type( 'team',
        array(
            'labels' => array(
                'name' => __('Team'),
                'singular_name' => __('Team'),
                'add_new' => __('Agregar nuevo'),
                'add_new_item' => __('Agregar nuevo integrante'),
                'edit_item' => __('Editar integrante'),
                'new_item' => __('Nuevo integrante'),
                'all_items' => __('Todos los integrantes'),
                'view_item' => __('Ver integrantes'),
                'search_items' => __('Buscar integrantes')
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'ver-team', 'hierarchical' => true),
            'hierarchical' => true,
            'show_ui' => true,
            'query_var' => true,
            'update_count_callback' => '_update_post_term_count',
            'supports' => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields' )
        )
    );
    flush_rewrite_rules();
}

//=================================================================== POST TYPE AND TAXONOMY // 
add_action( 'init', 'create_post_type_partners' );
function create_post_type_partners() {
    register_post_type( 'partners',
        array(
            'labels' => array(
                'name' => __('Partners'),
                'singular_name' => __('Partner'),
                'add_new' => __('Agregar nuevo'),
                'add_new_item' => __('Agregar nuevo partner'),
                'edit_item' => __('Editar partner'),
                'new_item' => __('Nuevo partner'),
                'all_items' => __('Todos los partners'),
                'view_item' => __('Ver partners'),
                'search_items' => __('Buscar partners')
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'ver-partners', 'hierarchical' => true),
            'hierarchical' => true,
            'show_ui' => true,
            'query_var' => true,
            'update_count_callback' => '_update_post_term_count',
            'supports' => array( 'title', 'editor', 'thumbnail', 'excerpt' )
        )
    );
    flush_rewrite_rules();
}

//=================================================================== POST TYPE AND TAXONOMY // 
add_action( 'init', 'create_post_type_bookers' );
function create_post_type_bookers() {
    register_post_type( 'bookers',
        array(
            'labels' => array(
                'name' => __('Bookers'),
                'singular_name' => __('Booker'),
                'add_new' => __('Agregar nuevo'),
                'add_new_item' => __('Agregar nuevo booker'),
                'edit_item' => __('Editar booker'),
                'new_item' => __('Nuevo booker'),
                'all_items' => __('Todos los bookers'),
                'view_item' => __('Ver bookers'),
                'search_items' => __('Buscar bookers')
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'ver-bookers', 'hierarchical' => true),
            'hierarchical' => true,
            'show_ui' => true,
            'query_var' => true,
            'update_count_callback' => '_update_post_term_count',
            'supports' => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields' )
        )
    );
    flush_rewrite_rules();
}

//=================================================================== POST TYPE AND TAXONOMY // 
add_action( 'init', 'create_post_type_discografia' );
function create_post_type_discografia() {
    register_post_type( 'discografia',
        array(
            'labels' => array(
                'name' => __('Discografía'),
                'singular_name' => __('Discos'),
                'add_new' => __('Agregar nuevo'),
                'add_new_item' => __('Agregar nuevo disco'),
                'edit_item' => __('Editar disco'),
                'new_item' => __('Nuevo disco'),
                'all_items' => __('Todos los discos'),
                'view_item' => __('Ver discos'),
                'search_items' => __('Buscar discos')
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'ver-discografia', 'hierarchical' => true),
            'hierarchical' => true,
            'show_ui' => true,
            'query_var' => true,
            'update_count_callback' => '_update_post_term_count',
            'supports' => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields' )
        )
    );
    flush_rewrite_rules();
}

//=================================================================== IMAGES FUNCTIONS//
function get_gallery_images(){
    global $wpdb;
    $gallery_pict = $wpdb->get_results("SELECT ID, post_title, post_content, post_excerpt FROM $wpdb->posts WHERE post_type = 'attachment' AND post_mime_type LIKE 'image%' AND post_excerpt LIKE 'galeria%' AND post_parent = '".get_the_ID()."' ORDER BY menu_order");
    if ( $gallery_pict ) {
        foreach ( $gallery_pict as $gal ) {
            echo '<div class="col-xs-3">';
                echo '<a href="'.wp_get_attachment_url($gal->ID).'" class="img-responsive" rel="prettyPhoto[gallery1]" title="'.$gal->post_title.'">';
                    echo wp_get_attachment_image($gal->ID, 'gal-image',array('class' => 'img-responsive'));
                echo '</a>';
            echo '</div>';
        } 
    }
}

//=================================================================== CONNECTIONS //
function my_connection_types() {
    p2p_register_connection_type( array(
        'name' => 'tribe_events_to_artistas',
        'from' => 'tribe_events',
        'to' => 'artistas',
        'cardinality' => 'many-to-many',
        'prevent_duplicates' => true,
        'reciprocal' => true
    ) );
    p2p_register_connection_type( array(
        'name' => 'bookers_to_artistas',
        'from' => 'bookers',
        'to' => 'artistas',
        'cardinality' => 'many-to-many',
        'prevent_duplicates' => true,
        'reciprocal' => true
    ) );
    p2p_register_connection_type( array(
        'name' => 'discografia_to_artistas',
        'from' => 'discografia',
        'to' => 'artistas',
        'cardinality' => 'many-to-many',
        'prevent_duplicates' => true,
        'reciprocal' => true
    ) );
    p2p_register_connection_type( array(
        'name' => 'product_to_artistas',
        'from' => 'product',
        'to' => 'artistas',
        'cardinality' => 'many-to-many',
        'prevent_duplicates' => true,
        'reciprocal' => true
    ) );
}
add_action( 'p2p_init', 'my_connection_types' );

//=================================================================== WORDPRESS WIDGETS// 
function charco_widgets_init() {
	register_sidebar(array(
        'name' => __('Sidebar General', 'charco'),
        'description' => __('Sidebar general sitio web', 'charco'),
        'id' => 'sidebar-general',
        'before_title' => '<h2>',
        'after_title' => '</h2>',
        'before_widget' => '',
        'after_widget' => ''
    ));
}
add_action('widgets_init', 'charco_widgets_init');

//=================================================================== GET CUSTOM TAXONOMY TERMS //
function get_custom_terms($taxonomies, $args){
    $args = array('orderby'=>'asc','hide_empty'=>true,'parent' => 0);
    $custom_terms = get_terms(array($taxonomies), $args);
    foreach($custom_terms as $term){
        echo '<div class="filter" data-filter=".'.$term->slug.'">'.$term->name.'</div> <span class="sep">-</span>';
    }
}

//=================================================================== MONTH VIEW// 
/*Alters event's archive titles*/
function tribe_alter_event_archive_titles ( $original_recipe_title, $depth ) {

    // Modify the titles here
    // Some of these include %1$s and %2$s, these will be replaced with relevant dates
    $title_upcoming =   'Upcoming Events'; // List View: Upcoming events
    $title_past =       'Past Events'; // List view: Past events
    $title_range =      '%1$s - %2$s'; // List view: range of dates being viewed
    $title_month =      '%1$s'; // Month View, %1$s = the name of the month
    $title_day =        '%1$s'; // Day View, %1$s = the day
    $title_all =        'All events for %s'; // showing all recurrences of an event, %s = event title
    $title_week =       'Events for week of %s'; // Week view

    // Don't modify anything below this unless you know what it does
    global $wp_query;
    $tribe_ecp = Tribe__Events__Main::instance();
    $date_format = apply_filters( 'tribe_events_pro_page_title_date_format', tribe_get_date_format( true ) );

    // Default Title
    $title = $title_upcoming;

    // If there's a date selected in the tribe bar, show the date range of the currently showing events
    if ( isset( $_REQUEST['tribe-bar-date'] ) && $wp_query->have_posts() ) {

        if ( $wp_query->get( 'paged' ) > 1 ) {
            // if we're on page 1, show the selected tribe-bar-date as the first date in the range
            $first_event_date = tribe_get_start_date( $wp_query->posts[0], false );
        } else {
            //otherwise show the start date of the first event in the results
            $first_event_date = tribe_event_format_date( $_REQUEST['tribe-bar-date'], false );
        }

        $last_event_date = tribe_get_end_date( $wp_query->posts[ count( $wp_query->posts ) - 1 ], false );
        $title = sprintf( $title_range, $first_event_date, $last_event_date );
    } elseif ( tribe_is_past() ) {
        $title = $title_past;
    }

    // Month view title
    if ( tribe_is_month() ) {
        $title = sprintf(
            $title_month,
            date_i18n( tribe_get_option( 'monthAndYearFormat', 'F Y' ), strtotime( tribe_get_month_view_date() ) )
        );
    }

    // Day view title
    if ( tribe_is_day() ) {
        $title = sprintf(
            $title_day,
            date_i18n( tribe_get_date_format( true ), strtotime( $wp_query->get( 'start_date' ) ) )
        );
    }

    // All recurrences of an event
    if ( function_exists('tribe_is_showing_all') && tribe_is_showing_all() ) {
        $title = sprintf( $title_all, get_the_title() );
    }

    // Week view title
    if ( function_exists('tribe_is_week') && tribe_is_week() ) {
        $title = sprintf(
            $title_week,
            date_i18n( $date_format, strtotime( tribe_get_first_week_day( $wp_query->get( 'start_date' ) ) ) )
        );
    }

    if ( is_tax( $tribe_ecp->get_event_taxonomy() ) && $depth ) {
        $cat = get_queried_object();
        $title = '<a href="' . esc_url( tribe_get_events_link() ) . '">' . $title . '</a>';
        $title .= ' &#8250; ' . $cat->name;
    }

    return $title;
}
add_filter( 'tribe_get_events_title', 'tribe_alter_event_archive_titles', 11, 2 );
add_filter( 'tribe-events-bar-should-show', '__return_false' );

//=================================================================== TOP BUTTON//
function my_scripts_method() {
    wp_enqueue_script(
        'custom-script',
        get_stylesheet_directory_uri() . '/js/topbutton.js',
        array( 'jquery' )
    );
}
add_action( 'wp_enqueue_scripts', 'my_scripts_method' );

//
?>