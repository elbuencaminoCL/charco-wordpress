<?php
/*
Template Name: Eventos
*/
?>
<?php get_header(); ?>
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    	<div id="content-block" class="cont-site common-site row col-lg-12 col-md-12 col-sm-12 col-xs-12 clearfix">
            <div class="header-int">
                <?php if( get_field('_agregar_imagen') ): ?>
                    <img src="<?php the_field('_agregar_imagen'); ?>" class="img-responsive" />
                <?php endif; ?>
                <h1><? the_title();?></h1>
            </div>
    		<div class="content clearfix cont-news container">
                <h2><span>Próximas Fechas</span></h2>
                <div class="clearfix">
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 calendar">
        			    <?php the_content();?>
                    </div>
                    <div id="ontour" class="sidebar col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <h4>Eventos</h4>
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
                                        if ( tribe_get_cost()){
                                            echo '<div class="item-fechas"><div class="int-fechas with-cost-item">';
                                        } else {
                                            echo '<div class="item-fechas"><div class="int-fechas free-item">';
                                        }
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
                                        echo '</div></div>';
                                    }
                                } else {
                                    echo '<p>No se han encontrado posts para esta categoría.</p>';
                                }
                                wp_reset_postdata();
                            ?>
                        </div>
                    </div>
                </div>
    		</div>
    	</div>
    <?php endwhile; else: ?>
        <div class="col-xs-12">
            <p class="textos">Lo sentimos, el contenido que buscas no se encuentra disponible.</p>
        </div>
    <?php endif; ?>
<?php get_footer(); ?>