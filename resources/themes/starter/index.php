<?php get_header(); ?>

<div id="home_partial_view" class="row">

	<div class="col-sm-8 col-md-9">

<?php

$args = array(
              'post_type' => 'post',
              'orderby'   => 'date',
              'order'     => 'DESC',
              'posts_per_page' => 10,
            );

	$my_query = new WP_Query($args);

	while ($my_query->have_posts()) : $my_query->the_post();
?>

	<article>
		<header><h2><? echo get_the_title(); ?></h2></header>
		<section>
			<?php echo get_the_content(); ?>
		</section>
	</article>
<?php

	endwhile;
?>

	</div>

	<div class="col-sm-4 col-md-3">

		<?php get_sidebar(); ?>

	</div>

</div>

<?php get_footer(); ?>