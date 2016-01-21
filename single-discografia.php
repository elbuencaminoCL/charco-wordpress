<?php get_header(); ?>
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div id="cont-single" class="clearfix">
			<div class="disc">
				<div class="container clearfix">
					<h2><span><? the_title();?></span></h2>
					<div class="main-disc clearfix">
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
							<? echo get_the_post_thumbnail($post->ID, 'det-disco', array('class' => 'img-responsive'));?>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

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