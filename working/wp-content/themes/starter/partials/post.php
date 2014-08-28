<div id="post_partial_view" class="row">

	<div class="col-xs-12">

		<br><a href="#/">Home</a>

		<header>
			<h3 ng-bind-html="post.title"></h3>
			<small>Published: {{post.published_date}} | Comments: {{post.comment_count}}</small>
		</header>

		<p ng-bind-html="post.content"></p>

	</div>

</div>