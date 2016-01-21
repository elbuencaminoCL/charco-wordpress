<?php get_header(); ?>
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div id="banner">
			<?php 
                $image = get_field('_agregar_imagen_artistas');
                $size = 'cabecera';
                if( $image ) {
                    echo wp_get_attachment_image( $image, $size );
                }
            ?>
			<? 
				if( get_field('_subir_logo') ):
                 	echo '<div class="logo"><img src="'.get_field('_subir_logo').'" class="img-responsive" /></div>';
                endif;
            ?>
		</div>
		<div id="cont-single" class="clearfix cont-news-detail">
			<div class="container clearfix">
				<div class="artist-info clearfix">
					<div class="main-image main-single-image col-lg-4 col-md-4 col-sm-5 col-xs-12">
						<?php 
							if( get_field('_subir_imagen_principal') ) {
								echo '<img src="'.get_field('_subir_imagen_principal').'" class="img-responsive" />';
							} else {
								echo get_the_post_thumbnail($post->ID, 'ficha', array('class' => 'img-responsive'));
							}
						?>
					</div>
					<div class="artist-content col-lg-8 col-md-8 col-sm-9 col-xs-12">
						<h3 class="single-title"><? the_title();?></h3>
						<div class="excerpt">
	                        <?php
	                            global $post;
	                            if ( has_excerpt( $post->ID ) ) {
	                                echo '<p>'.get_the_excerpt().'</p>';
	                            } 
	                        ?>
	                    </div>
						<? the_content();?>
					</div>
				</div>
			</div>

			<div class="merch-content clearfix">
				<div class="tour col-lg-12 col-md-12 col-sm-12 col-xs-12 clearfix">
					<h2><span>Otras Noticias</span></h2>
					<div class="relatedposts">
						<?php
	                        $args = array(
	                            'post_type'      => 'post',
	                            'category_name'  => 'noticias',
	                            'posts_per_page' => 3,
	                            'post__not_in' => array($post->ID)
	                        );

	                        $loop = new WP_Query( $args );
	                        if ( $loop->have_posts() ) {
	                            while ( $loop->have_posts() ) : $loop->the_post();
	                            echo '<div class="item-noticias">';
	                                    echo the_post_thumbnail('square-image', array("class" => "img-responsive"));
	                                    echo '<h4><a href="'.get_permalink().'">'.get_the_title().'</a></h4>';
	                                    echo '<div class="date-news">'.get_the_date().'</div>';
	                                    echo '<div class="excerpt">'.get_the_excerpt().'</div>';
	                            echo '</div>';
	                            endwhile;
	                        } else {
                            echo __( 'No se han encontrado Noticias' );
                        }
                        wp_reset_postdata();
                 	?>
					</div>
				</diV>
			</div>
		</div>
	<?php endwhile; else: ?>
		<div class="col-xs-12">
			<p class="textos">Lo sentimos, el contenido que buscas no se encuentra disponible.</p>
		</div>
	<?php endif; ?>
<?php get_footer(); ?>