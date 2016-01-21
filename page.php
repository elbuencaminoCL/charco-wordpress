<?php get_header(); ?>
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div id="content-block" class="cont-site common-site row col-lg-12 col-md-12 col-sm-12 col-xs-12 clearfix">
			<div class="header-int">
				<?php if( get_field('_agregar_imagen') ): ?>
					<img src="<?php the_field('_agregar_imagen'); ?>" class="img-responsive" />
				<?php endif; ?>
				<h1><? the_title();?></h1>
			</div>
			<div class="cont-common<?php if(is_page('about')) { ?> about-us<?php } ?>">

				<div class="content clearfix container">
					<?php if( get_field('_ingrese_subtitulo') ): ?>
						<h3><span><?php the_field('_ingrese_subtitulo'); ?></span></h3>
					<?php endif; ?>
					<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12 center-content">
						<?php 
                            if (has_post_thumbnail()) {
                                echo '<div class="cont-image">'.get_the_post_thumbnail($post->ID, 'full', array( 'class' => 'img-responsive' )).'</div>';
                            }
                        ?>
						<?php the_content();?>
					</div>
				</div>
			</div>
			<?php if(is_page('about')) { ?>
				<?php if(function_exists('about_pages')) about_pages("id=".$post->ID."&class=ap&childs=true"); ?>
				<div class="cont-team">
					<div class="container"><h2><span>Charco Team</span></h2></div>
					<?php 
	                    $args = array (
	                        'post_type'      => 'team',
	                        'posts_per_page' => '-1',
	                    );
	                    $query = new WP_Query( $args );
	                    if ( $query->have_posts() ) {
	                    	echo '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">';
		                        echo '<ul class="clearfix">';
		                        while ( $query->have_posts() ) {
		                            $query->the_post();
		                            echo '<li class="item-figure col-lg-3 col-md-3 col-sm-4 col-xs-12">';
		                                echo '<figure>';
		                                    echo '<a href="'.get_permalink().'" class="vertpan pic">';
		                                        echo get_the_post_thumbnail($page->ID, 'team', array('class' => 'img-responsive'));
		                                        if( get_field('_imagen_hover') ){
		                                        	echo '<figcaption><img src="'.get_field('_imagen_hover').'" class="img-responsive" /></figure>';
		                                        }
		                                        echo '<figcaption>';
		                                    echo '</a>';
		                                echo '</figure>';
		                            echo '</li>';
		                        }
		                        echo '</ul>';
		                     echo '</div>';
	                    } else {
	                        echo '<p>No se han encontrado posts para esta categoría.</p>';
	                    }
	                    wp_reset_postdata();
	                ?>
				</div>
			<?php } ?>
		</div>
	<?php endwhile; else: ?>
		<div class="col-xs-12">
			<p class="textos">Lo sentimos, el contenido que buscas no se encuentra disponible.</p>
		</div>
	<?php endif; ?>
<?php get_footer(); ?>