angular.module('wpApp.Config', ['ngRoute', 'wpApp.Constants'])
	.config(['$routeProvider','$locationProvider', 'templateBaseUrl', function($routeProvider, $locationProvider, templateBaseUrl) {

		$locationProvider.html5Mode(true);

		$routeProvider.
			when('/', {
				templateUrl: templateBaseUrl + '/partials/home.php',
				controller: 'HomeCtrl'
			}).
			when('/post/:postSlug', {
				templateUrl: templateBaseUrl + '/partials/post.php',
				controller: 'PostCtrl'
			}).
			otherwise({
				redirectTo: '/'
			});
			
	}]);