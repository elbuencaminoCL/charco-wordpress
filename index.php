<?php get_header(); ?>
        <div class="main">
            <div class="container">
                <div class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="carousel slide" id="carousel-example-generic">
                                <!-- Indicators -->
                                <ol class="carousel-indicators">
                                    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                                    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                                    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                                    <li data-target="#carousel-example-generic" data-slide-to="3"></li>
                                </ol>
                                <!-- Wrapper for slides -->
                                <div class="carousel-inner">
                                    <!-- Slides -->
                                    <?php $args = array( 'category__and' => array(4), 'posts_per_page' => 2 );
                                        $loop = new WP_Query( $args );
                                        while ( $loop->have_posts() ) : $loop->the_post();
                                            echo '<div class="item">';                                                
                                                echo '<div class="row">';
                                                    echo '<div class="col-xs-12">';
                                                        echo '<div class="foto-slide">';
                                                            echo get_the_post_thumbnail($post->ID, 'slider-image', array('class' => 'img-responsive'));
                                                        echo '</div>';
                                                        echo '<div class="carousel-caption">';
                                                            echo '<div class="content">';
                                                                echo '<span></span>';
                                                                echo '<h3>'.$post->post_title.'</h3>';
                                                            echo '</div>';
                                                        echo '</div>';
                                                    echo '</div>';
                                                echo '</div>';
                                            echo '</div>';
                                        endwhile;
                                    ?>
                                    <!-- /Slides -->
                                </div>
                                <!-- Controls -->
                                <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                                    <span class="icon-prev"></span>
                                </a>
                                <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                                    <span class="icon-next"></span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="home-destacado">
                                <h3> Destacados del Mes</h3>
                                <div class="row">
                                    <?php
                                        $featured_posts = new WP_Query( array(
                                            'post_type' => array('page','post','marcas'),
                                            'posts_per_page' => 4,
                                            'meta_query' => array(
                                                array(
                                                    'key' => '_pts_featured_post'
                                                )
                                            )
                                        ) );
                                        if ( $featured_posts->have_posts() ) : while ( $featured_posts->have_posts() ) : $featured_posts->the_post();
                                            echo '<div class="col-xs-3">';
                                                echo '<a href="'.get_the_permalink($post->ID).'">'.get_the_post_thumbnail($post->ID, 'destacado-image', array('class' => 'img-responsive')).'</a>';
                                            echo '</div>';
                                        endwhile; endif;
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="home-novedades">
                                <h3>Novedades que vienen</h3>
                                <?php $args = array( 'post_type' => 'post', 'posts_per_page' => 2, 'cat' => 2 );
                                    $loop = new WP_Query( $args );
                                    echo '<div class="row">';
                                    while ( $loop->have_posts() ) : $loop->the_post();
                                        echo '<div class="col-xs-6">';
                                            if( get_field('_ingrese_url_video') ) {
                                                echo get_field('_ingrese_url_video');
                                            } else {
                                                echo '<a href="'.get_the_permalink().'">'.get_the_post_thumbnail($post->ID, 'novedades-image').'</a>';
                                            }
                                        echo '</div>';
                                    endwhile;
                                    echo '</div>';
                                ?>
                                <?php $args = array( 'post_type' => 'post', 'posts_per_page' => 2, 'cat' => 2, 'offset' => 2 );
                                    $loop = new WP_Query( $args );
                                    echo '<div class="row">';
                                    while ( $loop->have_posts() ) : $loop->the_post();
                                        echo '<div class="col-xs-6">';
                                            if( get_field('_ingrese_url_video') ) {
                                                echo get_field('_ingrese_url_video');
                                            } else {
                                                echo '<a href="'.get_the_permalink().'">'.get_the_post_thumbnail($post->ID, 'novedades-image').'</a>';
                                            }
                                        echo '</div>';
                                    endwhile;
                                    echo '</div>';
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="home-imperdibles">
                                <h3>Imperdibles</h3>
                                <div class="row">
                                    <?php $args = array( 'category__and' => array(3), 'posts_per_page' => 2 );
                                        $loop = new WP_Query( $args );
                                        while ( $loop->have_posts() ) : $loop->the_post();
                                            echo '<div class="col-xs-6">';
                                                echo '<a href="'.get_the_permalink($post->ID).'">'.get_the_post_thumbnail($post->ID, 'imperdibles-image',array('class' => 'img-responsive')).'</a>';
                                            echo '</div>';
                                        endwhile;
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php get_footer(); ?>