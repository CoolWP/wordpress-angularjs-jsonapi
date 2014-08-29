		<footer id="page-footer" class="row">
			<div class="col-xs-12">
				<small>&copy; <?php echo date("Y"); ?> Eric W. Greene</small>
			</div>
		</footer>
	</div>
	<?php wp_footer(); ?>
	<script>

		var wpApp = angular.module('wpApp', ['ngSanitize','ngRoute']);

		wpApp.config(['$routeProvider','$locationProvider', function($routeProvider, $locationProvider) {

				$locationProvider.html5Mode(true);

				$routeProvider.
					when('/', {
						templateUrl: '<?php echo get_template_directory_uri(); ?>/partials/home.php',
						controller: 'HomeCtrl'
					}).
					when('/post/:postSlug', {
						templateUrl: '<?php echo get_template_directory_uri(); ?>/partials/post.php',
						controller: 'PostCtrl'
					}).
					otherwise({
						redirectTo: '/'
					});
			}]);

		wpApp.controller('HomeCtrl', ['$scope', '$http', function ($scope, $http) {
		
				$http.get('/api/get_posts').success(function(data) {

					$scope.posts = [];

					angular.forEach(data.posts, function(value, key) {

						var content = value.content;
						if (content.length > 150) {
							content = content.substr(0, 142) + "... <a href='post/" + value.slug + "'>more</a>"
						}

						$scope.posts.push({
							id: value.id,
							slug: value.slug,
							title: value.title,
							content: content,
							published_date: value.date,
							comment_count: value.comments.length

						});

					});

				});

		}]);

		wpApp.controller('PostCtrl',['$scope', '$http', '$routeParams',
			function ($scope, $http, $routeParams) {
				$http.get('/api/get_post/?slug=' + $routeParams.postSlug).success(function(data) {

					var post = {};
					post.id = data.post.id;
					post.title = data.post.title;
					post.content = data.post.content;
					post.published_date = moment(data.post.date).format("MMMM D, YYYY");
					post.comment_count = data.post.comment_count;

					$scope.post = post;
			});
		}]);		

	</script>

</body>

</html>