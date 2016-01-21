<?php
/*
Template Name: Roster
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

    		<div class="cont-common">
				<div class="clearfix">
					<div id="roster" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearfix">
						<div class="container"><h2><span>Roster</span></h2></div>
			            <div class="cont-roster grid clearfix" id="cont-roster">
			                <?php 
			                    $args = array (
			                        'post_type'          => 'artistas',
			                        'posts_per_page' => '-1',
			                        'orderby' => 'name'
			                    );
			                    $query = new WP_Query( $args );
			                    if ( $query->have_posts() ) {
			                    	echo '<div class="categories-list">';
	                                    echo '<div class="button-group filter-button-group">';
	                                    	echo '<div class="filter" data-filter="all">Todos</div> - ';
	                                        get_custom_terms('clasificacion-artistas');
	                                    echo '</div>';
	                                echo '</div>';
			                        while ( $query->have_posts() ) {
			                            $i = 1; $query->the_post();
			                            if ( has_post_thumbnail()){
			                            	$terms = get_the_terms( $post->ID, 'clasificacion-artistas' );
		                                    if ( !empty( $terms ) ){
		                                        echo  '<div class="mix item-figure';
		                                        $terms_size = count($terms_size) - 1;
		                                        foreach($terms as $term){
		                                            $term = array_shift( $terms );
		                                            echo ' '.$term->slug;
		                                            $i++; 
		                                    	}
		                                    }
		                                    echo '" data-myorder="'.$i.'">';
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