<?php
/*
Template Name: Merch
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
					<div class="featured-merch container clearfix">
						<h2><span>Featured Merch</span></h2>
						<div id="myCarousel" class="carousel slide clearfix" data-ride="carousel"> 
							<?
								$args = array(
									'post_type' => 'product',
									'meta_key' => '_featured',
									'meta_value' => 'yes',
									'posts_per_page' => 5
								);
								$featured_query = new WP_Query( $args );
								if ($featured_query->have_posts()) : 
									while ($featured_query->have_posts()) : 
										$featured_query->the_post();
										$product = get_product( $featured_query->post->ID );
										echo '<div class="carousel-inner clearfix">';
											echo '<div class="item clearfix active">';
											  	echo '<div class="main-image col-lg-5 col-md-5 col-sm-5 col-xs-12">'.get_the_post_thumbnail($post->ID, 'disco', array('class' => 'img-responsive disco-img')).'</div>';
											    echo '<div class="carousel-caption col-lg-7 col-md-7 col-sm-7 col-xs-12">';
											        echo '<h2><a href="'.get_the_permalink().'">'.get_the_title().'</a></h2>';
											    echo '</div>';
											echo '</div>';
										echo '</div>';
									endwhile;
								endif;
								wp_reset_query();
							?>
							<a class="left carousel-control" href="#myCarousel" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a> <a class="right carousel-control" href="#myCarousel" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
						</div>
					</div>

					<div class="merch-content clearfix">
						<div class="container">
							<div class="tour col-lg-12 col-md-12 col-sm-12 col-xs-12 clearfix">
								<div class="disco-list col-lg-7 col-md-7 col-sm-7 col-xs-12 pull-left">
									<?php
			                            $args = array(
			                                'post_type'      => 'product',
			                                'tax_query' => array(
												array(
													'taxonomy' => 'product_cat',
													'field' => 'id',
													'terms' => array(17)
												)
											),
			                                'posts_per_page' => 6,
			                                'orderby' => 'rand'
			                            );
			                            $loop = new WP_Query( $args );
			                            echo '<h2><span>Música</span></h2>';
			                            if ( $loop->have_posts() ) : $i=1; while ( $loop->have_posts() ) : $loop->the_post();
			                        ?>
										<div class="item-disco merch-disco col-lg-4 col-md-4 col-sm-4 col-xs-12">
											<? echo get_the_post_thumbnail($post->ID, 'disco', array('class' => 'img-responsive disco-img'));?>
											<h4><a href="<? the_permalink();?>"><? the_title();?></a></h4>
											<? 
					                            echo '<div class="price">'.$product->get_price_html().'</div>';
				                                if ($product->is_on_sale()) {
				                                    $sale = get_post_meta( get_the_ID(), '_sale_price', true);
				                                    $oferta= $product->get_sale_price() ? wc_format_decimal( $product->get_sale_price(), $prices_precision ) : null;
				                                    echo '<div class="onsale">'.woocommerce_price($oferta).'</div>';
				                                }
				                            ?>
				                            <?
					                            $product = get_product( $post->ID );
					                            echo '<div class="cont-button">';
						                            echo '<form class="cart" method="post" enctype="multipart/form-data">';
						                                echo '<input type="hidden" name="add-to-cart" value="'.esc_attr( $product->id ).'" />';
						                                echo '<button type="submit">Comprar</button>';
						                            echo '</form>';
						                        echo '</div>';
					                        ?>
										</div>
									<?php $i++; endwhile; ?>
									<?php 
					                    wp_reset_postdata();
					                    endif;
					                ?>
								</div>
								<div class="merch-list col-lg-4 col-md-4 col-sm-4 col-xs-12 pull-right">
									<div class="cont-merch">
										<div class="products">
											<div class="main-product clearfix">
												<?php
						                            $args = array(
						                                'post_type'      => 'product',
						                                'tax_query' => array(
															array(
																'taxonomy' => 'product_cat',
																'field' => 'id',
																'terms' => array(17),
																'operator' => 'NOT IN',
															)
														),
						                                'posts_per_page' => 5,
						                                'orderby' => 'rand'
						                            );
						                            $loop = new WP_Query( $args );
						                            echo '<h2><span>Merch</span></h2>';
						                            if ( $loop->have_posts() ) : $i=1; while ( $loop->have_posts() ) : $loop->the_post();
						                        ?>
									            	<div class="item-prod clearfix">
									            		<div class="prod-image col-lg-4 col-md-4 col-sm-4 col-xs-12">
											            	<?
											            		if ( has_post_thumbnail() ) {
							                                        $image_title    = esc_attr( get_the_title( get_post_thumbnail_id() ) );
							                                        $image_caption  = get_post( get_post_thumbnail_id() )->post_excerpt;
							                                        $image_link     = wp_get_attachment_url( get_post_thumbnail_id() );
							                                        $image          = get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'disco' ), array(
							                                            'title' => $image_title,
							                                            'alt'   => $image_title
							                                        ) );
							                                        echo '<a href="'.get_permalink().'"><img src="'.$image_link.'" class="img-responsive" /></a>';
							                                    } else {
							                                        echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="%s" class="img-responsive" />', wc_placeholder_img_src(), __( 'Placeholder', 'woocommerce' ) ), $post->ID );
							                                    }
						                                    ?>
						                                </div>
					                                    <h5><a href="<? the_permalink();?>"><? the_title();?></a></h5>
					                                    <? 
					                                      	echo '<div class="price">'.$product->get_price_html().'</div>';
				                                            if ($product->is_on_sale()) {
				                                                $sale = get_post_meta( get_the_ID(), '_sale_price', true);
				                                                $oferta= $product->get_sale_price() ? wc_format_decimal( $product->get_sale_price(), $prices_precision ) : null;
				                                                echo '<div class="onsale">'.woocommerce_price($oferta).'</div>';
				                                          	}
				                                        ?>
					                                    <?
					                                        $product = get_product( $post->ID );
					                                        echo '<div class="cont-button">';
						                                        echo '<form class="cart" method="post" enctype="multipart/form-data">';
						                                            echo '<input type="hidden" name="add-to-cart" value="'.esc_attr( $product->id ).'" />';
						                                            echo '<button type="submit">Comprar</button>';
						                                        echo '</form>';
						                                    echo '</div>';
					                                    ?>
					                                </div>
									            <?php $i++; endwhile; ?>
												<?php 
									                wp_reset_postdata();
									                endif;
									            ?>
											</div>
										</div>
									</div>
								</div>
							</div>
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