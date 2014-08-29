<?php

require_once("../../../../wp-blog-header.php");

?>
<div id="home_partial_view" class="row">

	<div class="col-sm-8 col-md-9">

		<section id="posts">

			<article ng-repeat="post in posts" class="row">

				<section class="col-md-12">

					<header>
						<a href="#/post/{{post.slug}}"><h3 ng-bind-html="post.title"></h3></a>
						<small>Published: {{post.published_date}} | Comments: {{post.comment_count}}</small>
					</header>

					<p ng-bind-html="post.content"></p>

				</section>

			</article>


		</section>

	</div>

	<div class="col-sm-4 col-md-3">

		<?php get_sidebar(); ?>

	</div>

</div>