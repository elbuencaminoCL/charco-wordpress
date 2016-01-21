<?php get_header(); ?>
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div id="banner">
			<? 
				if( get_field('_subir_logo') ):
                 	echo '<div class="logo"><img src="'.get_field('_subir_logo').'" class="img-responsive" /></div>';
                endif;
            ?>
		</div>
		<div id="cont-single" class="clearfix">
			<div class="bio">
				<div class="container clearfix">
					<h2><span>Bio</span></h2>
					<div class="artist-info clearfix">
						<div class="main-image col-lg-6 col-md-6 col-sm-5 col-xs-12">
							<?php 
								if( get_field('_subir_imagen_principal') ) {
									echo '<img src="'.get_field('_subir_imagen_principal').'" class="img-responsive" />';
								} else {
									echo get_the_post_thumbnail($post->ID, 'ficha', array('class' => 'img-responsive'));
								}
							?>
							<div class="social clearfix">
								<? if( get_field('_facebook') ) {
									echo '<div class="social-item facebook">';
										echo '<a href="http://www.facebook.com'.get_field('_facebook').'" target="_blank"></a>';
									echo '</div>';
								} ?>
								<? if( get_field('_instagram') ) {
									echo '<div class="social-item instagram">';
										echo '<a href="http://www.instagram.com'.get_field('_instagram').'" target="_blank"></a>';
									echo '</div>';
								} ?>
								<? if( get_field('_web') ) {
									echo '<div class="social-item web">';
										echo '<a href="'.get_field('_web').'" target="_blank"></a>';
									echo '</div>';
								} ?>
								<? if( get_field('_youtube') ) {
									echo '<div class="social-item youtube">';
										echo '<a href="http://www.youtube.com'.get_field('_youtube').'" target="_blank"></a>';
									echo '</div>';
								} ?>
								<? if( get_field('_twitter') ) {
									echo '<div class="social-item twitter">';
										echo '<a href="http://www.twitter.com'.get_field('_twitter').'" target="_blank"></a>';
									echo '</div>';
								} ?>
								<? if( get_field('_soundcloud') ) {
									echo '<div class="social-item soundcloud">';
										echo '<a href="'.get_field('_soundcloud').'" target="_blank"></a>';
									echo '</div>';
								} ?>
								<? if( get_field('_spotify') ) {
									echo '<div class="social-item spotify">';
										echo '<a href="'.get_field('_youtube').'" target="_blank"></a>';
										echo '</div>';
								} ?>
							</div>
						</div>
						<div class="artist-content col-lg-6 col-md-6 col-sm-7 col-xs-12">
							<? the_content();?>
						</div>
					</div>
				</div>
			</div>

			<div class="merch-content clearfix">
			<?php
		        $connected = new WP_Query( array(
		            'connected_type' => 'tribe_events_to_artistas',
		            'connected_items' => get_queried_object(),
		            'nopaging' => true,
		        ) );
		        if ( $connected->have_posts() ) :
		    ?>
				<!--ONTOUR MOBILE -->
				<div class="mobile-eventos">
					<div class="tour col-lg-12 col-md-12 col-sm-12 col-xs-12 clearfix">
						<div class="container"><h2><span>Próximas fechas</span></h2></div>
						<div class="fechas-tour">
		                    <div id="main-swipe" class="swipe">
		                        <div class="swipe-wrap">
				                    <?php while ( $connected->have_posts() ) : $connected->the_post(); ?>
				                    <?
				                    	echo '<div class="swiper-slide"><div class="item-fechas"><div class="int-fechas">';
			                                echo '<div class="header-fechas clearfix">';
			                                	echo '<div class="clearfix">';
				                                    echo '<div class="pull-left venue">';
				                                        echo '<span class="top">Lugar</span>';
				                                        echo '<p>'.tribe_get_venue().'</p>';
				                                        echo '<div class="address">'.tribe_get_address().'</div>';
				                                    echo '</div>';
				                                    echo '<div class="pull-right date">';
				                                        echo '<span class="top">'.tribe_get_start_date(null, false, 'M').'</span>';
				                                        echo '<p>'.tribe_get_start_date(null, false, 'j').'</p>';
				                       	            echo '</div>';
				                                echo '</div>';
			                       	           	echo '<div class="clearfix next-data">';
				                                    echo '<div class="pull-left city clearfix">';
				                                        echo '<span class="top">Ciudad</span>';
				                                        echo '<p>'.tribe_get_city().'</p>';
				                                    echo '</div>';
				                                    echo '<div class="pull-right time">';
				                                        echo '<span class="top">Hora</span>';
				                                        echo '<p>'.tribe_get_start_date( null, false, 'H:i' ).'</p>';
				                                    echo '</div>';
				                                echo '</div>';
			                                echo '</div>';
			                            echo '</div></div></div>';
			                        ?>
				                    <?php endwhile; ?>
				                </div>
				            </div>
				            <div style='text-align:center;padding-top:20px;'>
		                        <button onclick='mySwipe.prev()'>prev</button> 
		                        <button onclick='mySwipe.next()'>next</button>
		                    </div>
		                </div>
					</div>
				</div>
			<?php 
		        wp_reset_postdata();
		        endif;
            ?>
			<!--/ONTOUR MOBILE-->

			<div class="cont-info-artist col-lg-12 col-md-12 col-sm-12 col-xs-12 clearfix">
				<div class="container clearfix">
					<div class="disco-list disco-desktop col-lg-7 col-md-7 col-sm-7 col-xs-12 pull-left">
							<?php
			                    $connected = new WP_Query( array(
			                      'connected_type' => 'discografia_to_artistas',
			                      'connected_items' => get_queried_object(),
			                      'nopaging' => true,
			                    ) );
			                    if ( $connected->have_posts() ) :
			                ?>
			            	<div id="disco">
			                    <div class="wrap">
									<h2><span>Discografía</span></h2>
									<?php $i=1; while ( $connected->have_posts() ) : $connected->the_post(); ?>
										<div class="item-disco col-lg-4 col-md-4 col-sm-4 col-xs-12 left">
											<? echo '<a href="'.get_the_permalink().'" class="iframe">'.get_the_post_thumbnail($post->ID, 'disco', array('class' => 'img-responsive')).'</a>';?>
											<h4><? the_title();?></h4>
											<? if( get_field('_publicacion') ) {
												echo '<div class="year">'.get_field('_publicacion').'</div>';
											} ?>
										</div>
									<?php $i++; endwhile; ?>
									<?php 
					                    wp_reset_postdata();
					                    endif;
					                ?>
					            </div>
					        </div>
						</div>
						<div class="disco-list disco-mobile col-lg-7 col-md-7 col-sm-7 col-xs-12 pull-left">
							<?php
			                    $connected = new WP_Query( array(
			                      'connected_type' => 'discografia_to_artistas',
			                      'connected_items' => get_queried_object(),
			                      'nopaging' => true,
			                    ) );
			                    if ( $connected->have_posts() ) :
			                ?>
			            	<div id="disco-swipe" class="swipe">
			                    <div class="swipe-wrap">
									<h2><span>Discografía</span></h2>
									<?php $i=1; while ( $connected->have_posts() ) : $connected->the_post(); ?>
									<?php if($i%2) {
										echo '<div class="swiper-slide item-disco col-lg-5 col-md-5 col-sm-6 col-xs-12 left">';
									} else {
										echo '<div class="swiper-slide item-disco col-lg-5 col-md-5 col-sm-6 col-xs-12 right">';
									}?>
											<? echo get_the_post_thumbnail($post->ID, 'disco', array('class' => 'img-responsive'));?>
											<h4><? the_title();?></h4>
											<? if( get_field('_publicacion') ) {
												echo '<div class="year">'.get_field('_publicacion').'</div>';
											} ?>
										</div>
									<?php $i++; endwhile; ?>
									<?php 
					                    wp_reset_postdata();
					                    endif;
					                ?>
					            </div>
					        </div>
					        <div style='text-align:center;padding-top:20px;'>
			                    <button onclick='mySwipe.prev()'>prev</button> 
			                    <button onclick='mySwipe.next()'>next</button>
			                </div>
						</div>
						<div class="merch-list col-lg-4 col-md-4 col-sm-4 col-xs-12 pull-right">
							<div class="cont-merch">
								<h2><span>Merch</span></h2>
								<div class="products">
									<div class="main-product clearfix">
										<?php
						                    $connected = new WP_Query( array(
						                    	'orderby' => 'rand',
						                      	'connected_type' => 'product_to_artistas',
						                      	'connected_items' => get_queried_object(),
						                      	'nopaging' => true,
						                    ) );
						                    if ( $connected->have_posts() ) :
						                ?>
						            	<?php $i=1; while ( $connected->have_posts() ) : $connected->the_post(); ?>
						            		<div class="item-prod clearfix">
						            			<div class="prod-image col-lg-4 col-md-4 col-sm-4 col-xs-12">
								            		<?
								            			if ( has_post_thumbnail() ) {
				                                            $image_title    = esc_attr( get_the_title( get_post_thumbnail_id() ) );
				                                            $image_caption  = get_post( get_post_thumbnail_id() )->post_excerpt;
				                                            $image_link     = wp_get_attachment_url( get_post_thumbnail_id() );
				                                            $image          = get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'prod-image' ), array(
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
							<div class="cont-playlist">
		                        <div class="item-play clearfix">
		                            <? if( get_field('_ingresar_playlist_01') ) {
										echo '<div class="play">'.get_field('_ingresar_playlist_01').'</div>';
									} ?>
									<? if( get_field('_ingresar_playlist_02') ) {
										echo '<div class="play">'.get_field('_ingresar_playlist_02').'</div>';
									} ?>
		                        </div>
		                    </div>
						</div>
					</div>
				</div>

				<div class="tour col-lg-12 col-md-12 col-sm-12 col-xs-12 clearfix desktop-eventos">
					<div class="container"><h2><span>Próximas fechas</span></h2></div>
					<?php
	                    $connected = new WP_Query( array(
	                      'connected_type' => 'tribe_events_to_artistas',
	                      'connected_items' => get_queried_object(),
	                      'nopaging' => true,
	                    ) );
	                    if ( $connected->have_posts() ) :
	                ?>
					<div class="fechas-tour">
	                    <?php while ( $connected->have_posts() ) : $connected->the_post(); ?>
	                    <?
	                    	echo '<div class="item-fechas"><div class="int-fechas">';
                                echo '<div class="header-fechas clearfix">';
                                	echo '<div class="clearfix">';
	                                    echo '<div class="pull-left venue">';
	                                        echo '<span class="top">Lugar</span>';
	                                        echo '<p>'.tribe_get_venue().'</p>';
	                                        echo '<div class="address">'.tribe_get_address().'</div>';
	                                    echo '</div>';
	                                    echo '<div class="pull-right date">';
	                                        echo '<span class="top">'.tribe_get_start_date(null, false, 'M').'</span>';
	                                        echo '<p>'.tribe_get_start_date(null, false, 'j').'</p>';
	                       	            echo '</div>';
	                                echo '</div>';
                       	           	echo '<div class="clearfix next-data">';
	                                    echo '<div class="pull-left city clearfix">';
	                                        echo '<span class="top">Ciudad</span>';
	                                        echo '<p>'.tribe_get_city().'</p>';
	                                    echo '</div>';
	                                    echo '<div class="pull-right time">';
	                                        echo '<span class="top">Hora</span>';
	                                        echo '<p>'.tribe_get_start_date( null, false, 'H:i' ).'</p>';
	                                    echo '</div>';
	                                echo '</div>';
                                echo '</div>';
                            echo '</div></div>';
                        ?>
	                    <?php endwhile; ?>
	                </div>
	                <?php 
	                    wp_reset_postdata();
	                    endif;
	                ?>
				</div>
			</div>

			<div class="cont-bookers clearfix">
				<?php
                    $connected = new WP_Query( array(
                      'connected_type' => 'bookers_to_artistas',
                      'connected_items' => get_queried_object(),
                      'nopaging' => true,
                    ) );
                    if ( $connected->have_posts() ) :
                ?>
				<div class="container">
					<h2><span>Contratación</span></h2>
                    <?php while ( $connected->have_posts() ) : $connected->the_post(); ?>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 space">
                            <article>
                                <?php 
                                    if(has_post_thumbnail()) {
                                        echo '<div class="book-image col-lg-3 col-md-3 col-sm-5 col-xs-12">'.get_the_post_thumbnail($post->ID, 'booker', array( 'class' => 'img-responsive' )).'</div>';
                                    }
                                ?>
                                <div class="col-lg-9 col-md-9 col-sm-7 col-xs-12">
	                                <? if( get_field('_cargo_booker') ) {
										echo '<div class="cargo">'.get_field('_cargo_booker').'</div>';
									} ?>
	                                <h4><? the_title();?></h4> 
	                                <? if( get_field('_email_booker') ) {
										echo '<div class="email">'.get_field('_email_booker').'</div>';
									} ?>
								</div>
                            </article>
                        </div>
                    <?php endwhile; ?>
                <?php 
                    wp_reset_postdata();
                    endif;
                ?>
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