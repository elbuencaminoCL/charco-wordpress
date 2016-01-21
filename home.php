<?php
/*
Template Name: Home
*/
?>

<?php get_header(); ?>
    <div class="cont-site row col-lg-12 col-md-12 col-sm-12 col-xs-12 clearfix">
        <div id="slider">
            <div id="slider" class="slider-desktop clearfix">
                <div id="myCarousel" class="carousel slide" data-interval="5000">
                    <div class="cont-logo-header">
                        <div class="container">
                            <img src="<?php bloginfo('template_directory'); ?>/imag/logo/logo-charco.png" alt="Charco" title="Charco" class="img-responsive" />
                        </div>
                    </div>
                    <?php 
                        $args = array (
                            'category_name'          => 'slider',
                            'posts_per_archive_page' => '5',
                        );
                        $query = new WP_Query( $args );
                        if ( $query->have_posts() ) {
                            echo '<ol class="carousel-indicators">';
                            $i=0; while ( $query->have_posts() ) {
                                $query->the_post();
                                echo '<li data-target="#myCarousel" data-slide-to="'.$i.'"></li>';
                            }
                            echo '</ol>';
                            ++$i;
                        } else {
                            echo '<p>No se han encontrado posts para esta categoría.</p>';
                        }
                        wp_reset_postdata();
                    ?>
                    <?php 
                        $args = array (
                            'category_name'          => 'slider',
                            'posts_per_archive_page' => '5',
                        );
                        $query = new WP_Query( $args );
                        if ( $query->have_posts() ) {
                            echo '<div class="carousel-inner">';
                            while ( $query->have_posts() ) {
                                $query->the_post();
                                echo '<div class="item">';
                                    if( get_field('_agregar_enlace') ) {
                                        echo '<a href="'.get_field('_agregar_enlace').'">'.get_the_post_thumbnail($page->ID, 'slider-image', array('class' => 'img-responsive')).'</a>';
                                    } else {
                                        echo get_the_post_thumbnail($page->ID, 'slider-image', array('class' => 'img-responsive'));
                                    }
                                echo '</div>';
                            }
                            echo '</div>';
                        } else {
                            echo '<p>No se han encontrado posts para esta categoría.</p>';
                        }
                        wp_reset_postdata();
                    ?>
                </div>
            </div>
            <!-- SLIDER MOBILE -->
            <div id="slider" class="slider-mobile clearfix">
                <div id="myCarousel" class="carousel slide" data-interval="5000">
                    <div class="cont-logo-header">
                        <div class="container">
                            <img src="<?php bloginfo('template_directory'); ?>/imag/logo/logo-charco.png" alt="Charco" title="Charco" class="img-responsive" />
                        </div>
                    </div>
                    <?php 
                        $args = array (
                            'category_name'          => 'slider',
                            'posts_per_archive_page' => '5',
                        );
                        $query = new WP_Query( $args );
                        if ( $query->have_posts() ) {
                            echo '<ol class="carousel-indicators">';
                            $i=0; while ( $query->have_posts() ) {
                                $query->the_post();
                                echo '<li data-target="#myCarousel" data-slide-to="'.$i.'"></li>';
                            }
                            echo '</ol>';
                            ++$i;
                        } else {
                            echo '<p>No se han encontrado posts para esta categoría.</p>';
                        }
                        wp_reset_postdata();
                    ?>
                    <?php 
                        $args = array (
                            'category_name'          => 'slider',
                            'posts_per_archive_page' => '5',
                        );
                        $query = new WP_Query( $args );
                        if ( $query->have_posts() ) {
                            echo '<div class="carousel-inner">';
                            while ( $query->have_posts() ) {
                                $query->the_post();
                                echo '<div class="item">';
                                    if( get_field('_agregar_enlace') ) {
                                        echo '<a href="'.get_field('_agregar_enlace').'">'.get_the_post_thumbnail($page->ID, 'slider-image', array('class' => 'img-responsive')).'</a>';
                                    } else {
                                        echo get_the_post_thumbnail($page->ID, 'slider-mobile', array('class' => 'img-responsive'));
                                    }
                                echo '</div>';
                            }
                            echo '</div>';
                        } else {
                            echo '<p>No se han encontrado posts para esta categoría.</p>';
                        }
                        wp_reset_postdata();
                    ?>
                </div>
            </div>
        </div>
        <div id="roster" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearfix">
            <div class="container"><h2><span>Roster</span></h2></div>
            <div id="cont-roster" class="cont-roster grid clearfix">
                <?php 
                    $args = array (
                        'post_type'          => 'artistas',
                        'posts_per_page' => '-1',
                        'orderby' => 'rand'
                    );
                    $query = new WP_Query( $args );
                    if ( $query->have_posts() ) {
                        echo '<div class="clearfix">';
                        while ( $query->have_posts() ) {
                            $query->the_post();
                            if ( has_post_thumbnail()){
                                echo '<div class="item-figure mix">';
                                    echo '<figure>';
                                        echo '<a href="'.get_permalink().'">';
                                            echo get_the_post_thumbnail($page->ID, 'roster', array('class' => 'img-responsive desktop-image'));
                                            echo get_the_post_thumbnail($page->ID, 'prod-image', array('class' => 'img-responsive mobile-image'));
                                            echo '<figcaption>';
                                                    if( get_field('_subir_logo') ):
                                                        echo '<div class="logo"><img src="'.get_field('_subir_logo').'" class="img-responsive" /></div>';
                                                    endif;
                                            echo '</figcaption>';
                                        echo '</a>';
                                    echo '</figure>';
                                echo '</div>';
                            }
                        }
                        echo '</div>';
                    } else {
                        echo '<p>No se han encontrado posts para esta categoría.</p>';
                    }
                    wp_reset_postdata();
                ?>
                <div class="more-link clearfix"><a href="javascript:void(0)" id="show-more">+ Ver todos los Artistas</a></div>
            </div>
        </div>
        <div id="content-block" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearfix">
            <div class="container">
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                    <h3><span>News</span></h3>
                    <?php
                        $args = array(
                            'category__and' => array(6),
                            'posts_per_page' => 8,
                        );
                        $query = new WP_Query( $args );     
                        while ( $query->have_posts() ) : $query->the_post(); ?>
                            <div class="item clearfix">
                                <?php 
                                    if ( has_post_thumbnail() ) {
                                        echo '<div class="cont-image-item"><a href="'.get_permalink().'">'.get_the_post_thumbnail($post->ID, 'news-image', array( 'class' => 'img-responsive col-lg-4 col-md-4 col-sm-3 col-xs-12' )).'</a></div>';
                                    }
                                ?>
                                <div class="cont-item col-lg-8 col-md-8 col-sm-9 col-xs-12">
                                    <h4><a href="<? the_permalink();?>"><? echo short_title('...', 15); ?></a></h4>
                                    <?
                                        echo '<div class="date">'.get_the_time(get_option('date_format')).'</div>'; 
                                    ?>
                                    <div class="excerpt">
                                        <?php
                                            global $post;
                                            if ( has_excerpt( $post->ID ) ) {
                                                echo '<p>'.excerpt(40).' <a href="'.get_the_permalink().'">Leer más</a></p>';
                                            } else {
                                                echo '<p>'.content(40).' <a href="'.get_the_permalink().'">Leer más</a></p>';
                                            }
                                        ?>
                                    </div>
                                </div>
                            </div>
                    <?php endwhile;
                        wp_reset_postdata(); 
                    ?>
                    <div class="ver-mas clearfix">
                        <a href="<?php bloginfo('wpurl'); ?>/news/">Ver todas las noticias</a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <div class="cont-redes">
                        <h3><span>Social</span></h3>
                        <div class="redes-block redes-desktop">
                            <? echo do_shortcode('[dc_social_wall id="335"]');?>
                        </div>
                        <div class="redes-block redes-mobile">
                            <?php 
                                $options = get_option('charco_theme_options');
                                echo '<ul>';
                                if ($options['facebook']) {
                                    echo '<li><a href="'.$options['facebook'].'" title="Facebook" class="ico_redes ico_facebook" target="_blank">facebook</a></li>';
                                } 
                                if ($options['twitter']) {
                                    echo '<li><a href="'.$options['twitter'].'" title="twitter" class="ico_redes ico_twitter" target="_blank">twitter</a></li>';
                                } 
                                if ($options['youtube']) {
                                    echo '<li><a href="'.$options['youtube'].'" title="Youtube" class="ico_redes ico_youtube" target="_blank">youtube</a></li>';
                                }
                                if ($options['instagram']) {
                                    echo '<li><a href="'.$options['instagram'].'" title="Instagram" class="ico_redes ico_instagram" target="_blank">instagram</a></li>';
                                }
                                if ($options['spotify']) {
                                    echo '<li><a href="'.$options['spotify'].'" title="Facebook" class="ico_redes ico_spotify" target="_blank">spotify</a></li>';
                                } 
                                echo '</ul>';
                            ?>
                        </div>
                    </div>
                    <div class="cont-playlist">
                        <?php
                            $args = array(
                                'category__and' => array(8),
                                'posts_per_page' => 1,
                            );
                            $query = new WP_Query( $args );     
                            while ( $query->have_posts() ) : $query->the_post(); ?>
                                <h3><span>Playlist</span></h3>
                                <div class="item-play clearfix">
                                    <? the_content();?>
                                </div>
                        <?php endwhile;
                            wp_reset_postdata(); 
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div id="ontour" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearfix">
            <div class="desktop-eventos">
                <div class="container"><h2><span>Eventos</span></h2></div>
                <div class="cont-ontour">
                    <h5>Próximas Fechas en Chile</h5>
                    <div class="cont-fechas">
                        <?php 
                            $args = array (
                                'post_type'          => 'tribe_events',
                                'posts_per_archive_page' => '5',
                            );
                            $query = new WP_Query( $args );
                            if ( $query->have_posts() ) {
                                while ( $query->have_posts() ) {
                                    $query->the_post();
                                    echo '<div class="item-fechas"><div class="int-fechas">';
                                        echo '<div class="header-fechas clearfix">';
                                            echo '<div class="pull-left">';
                                                $terms = get_the_terms($post->ID , 'tribe_events_cat');
                                                if ($terms != null){
                                                foreach($terms as $term) {
                                                    echo '<span class="top">';
                                                        print $term->name;
                                                    echo '</span>';
                                                unset($term);
                                                } }
                                                echo '<p>';
                                                if (strlen($post->post_title) > 15) {
                                                    echo substr(the_title($before = '', $after = '', FALSE), 0, 15) . '...'; } else {
                                                    the_title();
                                                }
                                                echo '</p>';
                                            echo '</div>';
                                            echo '<div class="pull-right date">';
                                                echo '<span class="top">'.tribe_get_start_date(null, false, 'M').'</span>';
                                                echo '<p>'.tribe_get_start_date(null, false, 'j').'</p>';
                                            echo '</div>';
                                        echo '</div>';
                                        echo '<div class="clearfix calendar-img">';
                                            if ( has_post_thumbnail() ) {
                                                echo get_the_post_thumbnail($post->ID, 'calendar', array( 'class' => 'img-int' ));
                                            }
                                        echo '</div>';
                                        echo '<div class="tour-info clearfix">';
                                            echo '<div class="city clearfix">';
                                                echo '<span class="top">Ciudad</span>';
                                                echo '<p>'.tribe_get_city().'</p>';
                                            echo '</div>';
                                            echo '<div class="pull-left venue">';
                                                echo '<span class="top">Lugar</span>';
                                                echo '<p>'.tribe_get_venue().'</p>';
                                                echo '<div class="address">'.tribe_get_address().'</div>';
                                            echo '</div>';
                                            echo '<div class="pull-right time">';
                                                echo '<span class="top">Hora</span>';
                                                echo '<p>'.tribe_get_start_date( null, false, 'H:i' ).'</p>';
                                            echo '</div>';
                                        echo '</div>';
                                        echo '<div class="cost">';
                                            if ( tribe_get_cost()){
                                                echo '<div class="with-cost"><a href="">Comprar Entrada</a></div>';
                                            } else {
                                                echo '<div class="free">Evento Gratuito</div>';
                                            }
                                        echo '</div>';
                                    echo '</div></div>';
                                }
                            } else {
                                echo '<p>No se han encontrado posts para esta categoría.</p>';
                            }
                            wp_reset_postdata();
                        ?>
                    </div>
                    <div class="ver-mas"><a href="#">Ver todos los conciertos</a></div>
                </div>
            </div>
            <!-- ON TOUR MOBILE -->
            <div class="mobile-eventos">
                <h2><span>Eventos</span></h2>
                <div class="cont-fechas">
                    <div id="main-swipe" class="swipe">
                        <div class="swipe-wrap">
                            <?php 
                                $args = array (
                                    'post_type'          => 'tribe_events',
                                    'posts_per_archive_page' => '10',
                                );
                                $query = new WP_Query( $args );
                                if ( $query->have_posts() ) {
                                    while ( $query->have_posts() ) {
                                        $query->the_post();
                                        echo '<div class="swiper-slide"><div class="item-fechas"><div class="int-fechas">';
                                            echo '<div class="header-fechas clearfix">';
                                                echo '<div class="pull-left">';
                                                    $terms = get_the_terms($post->ID , 'tribe_events_cat');
                                                    if ($terms != null){
                                                    foreach($terms as $term) {
                                                        echo '<span class="top">';
                                                            print $term->name;
                                                        echo '</span>';
                                                    unset($term);
                                                    } }
                                                    echo '<p>'.get_the_title().'</p>';
                                                echo '</div>';
                                                echo '<div class="pull-right date">';
                                                    echo '<span class="top">'.tribe_get_start_date(null, false, 'M').'</span>';
                                                    echo '<p>'.tribe_get_start_date(null, false, 'j').'</p>';
                                                echo '</div>';
                                            echo '</div>';
                                            echo '<div class="clearfix">';
                                                if ( has_post_thumbnail() ) {
                                                    echo get_the_post_thumbnail($post->ID, 'calendar', array( 'class' => 'img-responsive' ));
                                                }
                                            echo '</div>';
                                            echo '<div class="tour-info clearfix">';
                                                echo '<div class="city clearfix">';
                                                    echo '<span class="top">Ciudad</span>';
                                                    echo '<p>'.tribe_get_city().'</p>';
                                                echo '</div>';
                                                echo '<div class="pull-left venue">';
                                                    echo '<span class="top">Lugar</span>';
                                                    echo '<p>'.tribe_get_venue().'</p>';
                                                    echo '<div class="address">'.tribe_get_address().'</div>';
                                                echo '</div>';
                                                echo '<div class="pull-right time">';
                                                    echo '<span class="top">Hora</span>';
                                                    echo '<p>'.tribe_get_start_date( null, false, 'H:i' ).'</p>';
                                                echo '</div>';
                                            echo '</div>';
                                            echo '<div class="cost">';
                                                if ( tribe_get_cost()){
                                                    echo '<div class="with-cost"><a href="">Comprar Entrada</a></div>';
                                                } else {
                                                    echo '<div class="free">Evento Gratuito</div>';
                                                }
                                            echo '</div>';
                                        echo '</div></div></div>';
                                    }
                                } else {
                                    echo '<p>No se han encontrado posts para esta categoría.</p>';
                                }
                                wp_reset_postdata();
                            ?>
                        </div>
                    </div>
                    <div class="cont-slider-nav" style="text-align:center;">
                        <button onclick="mySwipe.prev()" class="prev"></button> 
                        <button onclick="mySwipe.next()" class="next"></button>
                    </div>
                    <div class="ver-mas"><a href="#">Ver todos los conciertos</a></div>
                </div>
            <!--/ONTOUR MOBILE-->
            </div>
        </div>
    </div>
<?php get_footer(); ?>