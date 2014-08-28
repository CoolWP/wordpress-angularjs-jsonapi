		<footer id="page-footer" class="row">
			<div class="col-xs-12">
				<small>&copy; <?php echo date("Y"); ?> Eric W. Greene</small>
			</div>
		</footer>
	</div>
<?php
		wp_print_footer_scripts(); ?>

	<script>

		var wpApp = angular.module('wpApp', ['ngSanitize','ngRoute']);

		wpApp.config(['$routeProvider',
			function($routeProvider) {
				$routeProvider.
					when('/', {
						templateUrl: '<?php echo get_template_directory_uri(); ?>/partials/home.php',
						controller: 'HomeCtrl'
					}).
					otherwise({
						redirectTo: '/'
					});
			}]);		

		wpApp.controller('HomeCtrl', function ($scope, $sce) {
			$scope.posts = [

<?php

	$args = array(
              'post_type' => 'post',
              'orderby'   => 'date',
              'order'     => 'DESC',
              'posts_per_page' => 10,
            );

	$my_query = new WP_Query($args);

	while ($my_query->have_posts()) : $my_query->the_post();

		$post = get_post();

		$post_content = str_replace(array("\r","\n","\t", chr(194).chr(160)), "", strip_tags(get_the_content()));

		if (strlen($post_content) > 150) {
			$post_content = substr($post_content, 0, 142)."... <a href='#/post/".$post->post_name."'>more</a>";
		}

		$args = array(
			'post_id' => get_the_ID(),
       'count' => true
		);
		$comment_count = get_comments($args);


		$my_post["id"] = get_the_ID();
		$my_post["slug"] = $post->post_name;
		$my_post["title"] = get_the_title();
		$my_post["content"] = $post_content;
		$my_post["published_date"] = get_the_date();
		$my_post["comment_count"] = get_comments($args);

		$encoded_posts[] = json_encode($my_post);

	endwhile;

	echo implode(",", $encoded_posts);

?>
			];
		});


	</script>

</body>

</html>