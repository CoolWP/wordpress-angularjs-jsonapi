angular.module('wpApp.Controllers', ['ngSanitize'])
	.controller('HomeCtrl', ['$scope', '$http', '$sce',
		function ($scope, $http, $sce) {

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
						content: $sce.trustAsHtml(content),
						published_date: value.date,
						comment_count: value.comments.length
					});

				});

			});

		}])
	.controller('PostCtrl',['$scope', '$http', '$routeParams',
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