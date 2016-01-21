<!doctype html>
<!--[if lt IE 7 ]> <html> <![endif]-->
<!--[if IE 7 ]>    <html> <![endif]-->
<!--[if IE 8 ]>    <html class="no-js ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>
<meta charset="<?php bloginfo('charset'); ?>" />
<meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0, width=device-width">
<title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' | '; } ?><?php bloginfo('name'); if(is_home()||is_page('inicio')) { echo ' | '; bloginfo('description'); } ?></title>
<?php if (is_single() || is_page() ) : if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<?php endwhile; endif; elseif(is_home()) : ?>
<meta name="description" content="" />
<?php else: ?>
<meta name="description" content=""> 
<?php endif; ?>
<meta name="keywords" content="" />	
<?php if(is_home() || is_single() || is_page()) { echo '<meta name="robots" content="index,follow" />'; } else { echo '<meta name="robots" content="noindex,follow" />'; } ?>
<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php if ( get_option('woo_feedburner_url') <> "" ) { echo get_option('woo_feedburner_url'); } else { echo get_bloginfo_rss('rss2_url'); } ?>" />
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<link rel="shortcut icon" href="<?php bloginfo('template_directory'); ?>/favicon.ico" />
<!-- styles / fonts -->
<link href='https://fonts.googleapis.com/css?family=Nunito:400,300,700' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Lato:400,100,300,700,900' rel='stylesheet' type='text/css'>
<!-- styles / fonts -->
<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/bootstrap.css" />
<link href="<?php bloginfo('template_directory'); ?>/style.css" rel="stylesheet" media="screen" />
<!--[if lt IE 9]>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7/html5shiv.js"></script>
<![endif]-->
<?php wp_head();?>
</head>

<body <?php body_class(); ?>>
	<script>
		window.fbAsyncInit = function() {
		    FB.init({
		      appId      : '1081471725209222',
		      xfbml      : true,
		      version    : 'v2.5'
		    });
		};

		(function(d, s, id){
		    var js, fjs = d.getElementsByTagName(s)[0];
		    if (d.getElementById(id)) {return;}
		    js = d.createElement(s); js.id = id;
		    js.src = "//connect.facebook.net/en_US/sdk.js";
		    fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));
	</script>
	<div id="wrapper">
		<?php if (is_singular('discografia')) { ?>
            <header class="no-header"></header>
        <? } else { ?>
		<header id="header" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearfix">
			<button type="button" class="btn btn-navbar navbar-toggle" data-toggle="collapse" data-target="#main-nav" aria-expanded="false" aria-controls="navbar">
			    <span class="sr-only">Toggle navigation</span>
			    <span class="icon-bar"></span>
			    <span class="icon-bar"></span>
			    <span class="icon-bar"></span>
			</button>

			<!-- NAV DESKTOP -->
			<nav id="main-nav" class="navbar navbar-default nav-collapse collapse" role="navigation">
				<div class="container">
					<ul class="nav navbar-nav">
						<li class="home"><a href="<?php bloginfo('wpurl');?>">Inicio</a></li>
						<?php
						    $featured_posts = new WP_Query( array(
						        'post_type' => 'page',
						        'posts_per_page' => 10,
						        'tax_query' => array(
						            array(
						                'taxonomy' => 'pts_feature_tax',
						                'field' => 'slug',
						                'terms' => array('featured'),
						            )
						        )
						    ) );
						    if ( $featured_posts->have_posts() ) : $i=0 ; while ( $featured_posts->have_posts() ) : $featured_posts->the_post();
						    	$featured_title = get_the_title();
						    	echo '<li class="child-'.$i.'"><a href="'.get_the_permalink().'">'.get_the_title().'</a></li>';
						    ++$i; endwhile; endif;
						?>
					</ul>
				</div>
			</nav>
		</header>
		<? } ?>