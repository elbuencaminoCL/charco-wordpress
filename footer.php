    <?php if (is_singular('discografia')) { ?>
        <div style="display:none;"></div>
    <?php } else { ?>
    <div class="cont-newsletter">
        <h2><span>Charco Newsletter</span></h2>
        <div class="container">
            <div class="cont-suscribe clearfix">
                <nav id="lg-nav">
                    <?php dynamic_sidebar( 'sidebar-general' ); ?>
                </nav>
            </div>
        </div>
    </div>
    <?php } ?>

    <?php if (is_singular('discografia')) { ?>
        <footer class="no-footer"></footer>
    <?php } else { ?>
        <?php if (is_single()) { ?>
            <footer id="footer" class="top-margin col-lg-12 col-md-12 col-sm-12 col-xs-12 clearfix">
        <?php } else { ?>
            <footer id="footer" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearfix">
        <?php } ?>
                <div class="container">
                    <div class="top-foot">
                        <h3>"El mundo necesita gente que ame lo que hace"</h3>
                    </div>
                    <div class="middle-foot">
                        <img src="<?php bloginfo('template_directory'); ?>/imag/logo/logo-charco.png" alt="CHARCO" class="img-responsive" />
                    </div>
                    <div class="partners-foot">
                        <h3>Partners</h3>
                        <?php
                            $args = array (
                                'post_type' => 'partners',
                                'posts_per_archive_page' => '-1',
                            );
                            $query = new WP_Query( $args );
                            if ( $query->have_posts() ) {
                                echo '<ul class="col-lg-6 col-md-6 col-sm-6 col-xs-12 clearfix">';
                                while ( $query->have_posts() ) {
                                    $query->the_post();
                                        echo '<li class="item-partners col-lg-4 col-md-4 col-sm-4 col-xs-12">';
                                            echo '<figure>';
                                                echo '<a href="'.get_permalink().'">';
                                                    echo get_the_post_thumbnail($page->ID, 'foot-logo', array('class' => 'img-responsive'));
                                                echo '</a>';
                                            echo '</figure>';
                                        echo '</li>';
                                    }
                                echo '</ul>';
                                }
                            wp_reset_postdata();
                        ?>
                    </div>
                    <div class="bottom-foot clearfix">
                        <address class="col-lg-8 col-md-8 col-sm-12 col-xs-12">Las Violetas #2267 . Providencia . Santiago - Chile <span>&copy; 2015 Charco Booking SpA</span></address>
                        <div class="social col-lg-4 col-md-4 col-sm-12 col-xs-12">
                            <ul class="social">
                                <li>Síguenos en</li>
                                <?php 
                                    $options = get_option('charco_theme_options');
                                    if ($options['facebook']) {
                                        echo '<li><a href="'.$options['facebook'].'" title="Facebook" class="ico_redes ico_facebook" target="_blank">Facebook</a></li>';
                                    } 
                                    if ($options['twitter']) {
                                        echo '<li><a href="'.$options['twitter'].'" title="Twitter" class="ico_redes ico_twitter" target="_blank">twitter</a></li>';
                                    }
                                    if ($options['instagram']) {
                                        echo '<li><a href="'.$options['instagram'].'" title="Instagram" class="ico_redes ico_instagram" target="_blank">Instagram</a></li>';
                                    } 
                                    if ($options['youtube']) {
                                        echo '<li><a href="'.$options['youtube'].'" title="Youtube" class="ico_redes ico_youtube" target="_blank">youtube</a></li>';
                                    }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </footer>
            <a href="#" class="topbutton"></a>
        <?php } ?>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="<?php bloginfo('template_directory'); ?>/js/swipe.js" type="text/javascript"></script>
    <script>        
        window.mySwipe = $('#main-swipe').Swipe().data('Swipe');
        window.mySwipe = $('#disco-swipe').Swipe().data('Swipe');
    </script>
    <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery-ui.min.js"></script>
    <script src="<?php bloginfo('template_directory'); ?>/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="<?php bloginfo('template_directory'); ?>/js/topbutton.js" type="text/javascript"></script>
    <script>
        $(document).ready(function() {
            $('.carousel').carousel();
            $('.carousel-inner .item:first-child').addClass('active');
        });
    </script>
    <?php if(is_page('inicio') || is_front_page() || is_page('home') || is_page('artistas') || is_page('artists')) { ?>
        <script type="text/javascript">
            $(document).ready(function(){
                $('#main-nav').affix({
                    offset: {top: 600}
                }); 
                $('#main-nav.affix li.home').show(1000);
                $('#cont-roster').mixItUp();
            })
        </script>
        <script src="<?php bloginfo('template_directory'); ?>/js/jquery.mixitup.js"></script>
        <script src="<?php bloginfo('template_directory'); ?>/js/jquery.mixitup-pagination.min.js"></script>
        <script>
            $(document).ready(function(){
                var $showMore = $('#show-more'); // or whatever your show more button is called
                $container = $('#cont-roster .clearfix');
                // Instantiate MixItup with a limit of 10 items
                $container.mixItUp({
                    pagination: {
                        limit: 8
                    },
                    callbacks: {
                        onMixLoad: function(state) {
                            // On load, check if there are at least 10 targets
                            var total = state.$targets.length;
                            if (total > 8) {
                                // If so, show the button (button is 
                                // hidden by default in CSS):
                                $showMore.addClass('visible');
                            }
                        }
                    }
                });

                // Bind a click handler to the show more button

                $showMore.on('click', function() {
                    if (!$showMore.hasClass('show-more')) {
                        // If the button does not have the class 'show-more', 
                        // add it, remove pagination limit, and set button text
                        $showMore.addClass('show-more').text('- Ver menos Artistas');
                        $container.mixItUp('paginate', {
                            limit: 0
                        });
                    } else {
                        // Else, remove show-more class, reset pagination 
                        // limit, and set button text
                        $showMore.removeClass('show-more').text('+ Ver todos los Artistas');
                        $container.mixItUp('paginate', {
                            limit: 8
                        });
                    }
                });
            });
        </script>
    <?php } ?>
    <?php if(is_single() || !is_page('inicio')) { ?>
        <script type="text/javascript">
            $(document).ready(function(){
                $('#main-nav').addClass('nav-interior');    
            })
        </script>
    <?php } ?>
    <?php if(is_singular('artistas')) { ?>
        <link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/colorbox.css" />
        <script src="<?php bloginfo('template_directory'); ?>/js/jquery.colorbox.js"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                $(".iframe").colorbox({iframe:true, width:"80%", height:"80%"});    
            })
        </script>
    <?php } ?>
    <?php if(is_page('contact')) { ?>
        <style type="text/css">
            .acf-map {width:100%; height:400px; border:none; margin:0;}
            /* fixes potential theme css conflict */
            .acf-map img {max-width: inherit !important;}       
        </style>
        <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
        <script type="text/javascript">
            (function($) {
            /*
            *  new_map
            *
            *  This function will render a Google Map onto the selected jQuery element
            *
            *  @type    function
            *  @date    8/11/2013
            *  @since   4.3.0
            *
            *  @param   $el (jQuery element)
            *  @return  n/a
            */

                function new_map( $el ) {
                    // var
                    var $markers = $el.find('.marker');
                    // vars
                    var args = {
                        zoom        : 16,
                        center      : new google.maps.LatLng(0, 0),
                        mapTypeId   : google.maps.MapTypeId.ROADMAP
                    };
                    // create map               
                    var map = new google.maps.Map( $el[0], args);

                    // add a markers reference
                    map.markers = [];                    
                    
                    // add markers
                    $markers.each(function(){
                        add_marker( $(this), map );
                    });
                    
                    // center map
                    center_map( map );
                    
                    // return
                    return map;
                }

            /*
            *  add_marker
            *
            *  This function will add a marker to the selected Google Map
            *
            *  @type    function
            *  @date    8/11/2013
            *  @since   4.3.0
            *
            *  @param   $marker (jQuery element)
            *  @param   map (Google Map object)
            *  @return  n/a
            */

                function add_marker( $marker, map ) {

                    // var
                    var latlng = new google.maps.LatLng( $marker.attr('data-lat'), $marker.attr('data-lng') );

                    // create marker
                    var marker = new google.maps.Marker({
                        position    : latlng,
                        map         : map
                    });

                    // add to array
                    map.markers.push( marker );

                    // if marker contains HTML, add it to an infoWindow
                    if( $marker.html() )
                    {
                        // create info window
                        var infowindow = new google.maps.InfoWindow({
                            content     : $marker.html()
                        });

                        // show info window when marker is clicked
                        google.maps.event.addListener(marker, 'click', function() {

                            infowindow.open( map, marker );

                        });
                    }

                }

            /*
            *  center_map
            *
            *  This function will center the map, showing all markers attached to this map
            *
            *  @type    function
            *  @date    8/11/2013
            *  @since   4.3.0
            *
            *  @param   map (Google Map object)
            *  @return  n/a
            */

                function center_map( map ) {

                    // vars
                    var bounds = new google.maps.LatLngBounds();

                    // loop through all markers and create bounds
                    $.each( map.markers, function( i, marker ){

                        var latlng = new google.maps.LatLng( marker.position.lat(), marker.position.lng() );

                        bounds.extend( latlng );

                    });

                    // only 1 marker?
                    if( map.markers.length == 1 )
                    {
                        // set center of map
                        map.setCenter( bounds.getCenter() );
                        map.setZoom( 16 );
                    }
                    else
                    {
                        // fit to bounds
                        map.fitBounds( bounds );
                    }

                }

            /*
            *  document ready
            *
            *  This function will render each map when the document is ready (page has loaded)
            *
            *  @type    function
            *  @date    8/11/2013
            *  @since   5.0.0
            *
            *  @param   n/a
            *  @return  n/a
            */

                // global var
                var map = null;

                $(document).ready(function(){

                    $('.acf-map').each(function(){

                        // create map
                        map = new_map( $(this) );

                    });
                });
            })(jQuery);
        </script>
    <?php } ?>
</body>

</html>