<?php
/*
Template Name: News
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
    			<?php
                    $args = array(
                        'category__and' => array(6),
                        'posts_per_page' => 5,
                    );
                    $query = new WP_Query( $args );     
                    while ( $query->have_posts() ) : $query->the_post(); ?>
                        <div class="item clearfix">
                        	<?php 
                                if ( has_post_thumbnail() ) {
                                    echo '<a href="'.get_permalink().'">'.get_the_post_thumbnail($post->ID, 'int-image', array( 'class' => 'img-responsive col-lg-3 col-md-3 col-sm-2 col-xs-12' )).'</a>';
                                }
                            ?>
    						<div class="cont-item col-lg-9 col-md-9 col-sm-10 col-xs-12">
    							<h4><a href="<? the_permalink();?>"><? the_title();?></a></h4>
    							<?
                                    echo '<div class="date">'.the_time(get_option('date_format')).'</div>'; 
                                ?>
    							<div class="excerpt">
    								<?php
                                        global $post;
                                        if ( has_excerpt( $post->ID ) ) {
                                            echo '<p>'.excerpt(45).' <a href="'.get_the_permalink().'">Leer más</a></p>';
                                        } else {
                                            echo '<p>'.content(45).' <a href="'.get_the_permalink().'">Leer más</a></p>';
                                        }
                                    ?>
    							</div>
    						</div>
                        </div>
                <?php endwhile;
                    wp_reset_postdata(); 
                ?>
    			<div class="pagination clearfix">
    			</div>
    		</div>
    	</div>
    <?php endwhile; else: ?>
        <div class="col-xs-12">
            <p class="textos">Lo sentimos, el contenido que buscas no se encuentra disponible.</p>
        </div>
    <?php endif; ?>
<?php get_footer(); ?>