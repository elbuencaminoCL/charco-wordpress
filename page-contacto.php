<?php
/*
Template Name: Contacto
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
			<div class="content clearfix cont-form container">
				<?php the_content();?>
			</div>
			<div class="cont-map">
				<?php 
					$location = get_field('_ingresar_mapa');
					if( !empty($location) ):
				?>
				<div class="acf-map">
					<div class="marker" data-lat="<?php echo $location['lat']; ?>" data-lng="<?php echo $location['lng']; ?>"></div>
				</div>
				<?php endif; ?>
			</div>
		</div>
	<?php endwhile; else: ?>
		<div class="col-xs-12">
			<p class="textos">Lo sentimos, el contenido que buscas no se encuentra disponible.</p>
		</div>
	<?php endif; ?>
<?php get_footer(); ?>