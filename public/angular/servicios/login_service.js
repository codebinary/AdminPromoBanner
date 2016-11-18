var app = angular.module('login.loginService', []);

app.factory('LoginService', ['$http', '$q', function($http, $q){

	var self = {

		login: function( datos ){
			console.log(datos);
			var d = $q.defer();

			$http.post('php/login/post.verificar.php', datos)
				.success( function( data ){

					console.log(data);
					d.resolve(data);

				});


			return d.promise;

		}

	};

	return self;

}]);