app.factory('Configuracion', ['$http', '$q', function($http, $q){

	var self = {

		config:{},
		cargar: function(){

			var d = $q.defer();

			$http.get('configuracion.json')
				.success(function(data){

					self.config = data;
					d.resolve();


				})
				.error(function(){

					d.reject();
					console.error("No se pudo cargar el archivo de configuración");

				});

			return d.promise;
		}

	};

	return self;

}]);


app.factory('Promociones', ['$resource', function($resource){

	return $resource('http://kia.com.pe/promociones/api/promociones/:id', {id: '@id'}, 
	{
		get: {method: 'GET', params: {}},
		delete: {method: 'DELETE', params: { id:'@id' }},
		update: {method: 'PUT'}
	});

}]);


app.factory('Banners', ['$resource', function($resource){
	
	return $resource('http://kia.com.pe/promociones/api/banners/:id', {id: '@id'},
	{
		get: {method: 'GET', params: {}},
		delete: {method:'DELETE', params: {id: '@id'}},
		update: {method: 'PUT'}
	})

}])



app.service('Upload', ["$http", "$q", function($http, $q){

	this.uploadFile = function(file){

		
		var deferred = $q.defer();
		var formData = new FormData();


		formData.append("file", file);


		return $http.post("php/promociones/upload.php", formData,{

			headers: {
				"Content-type": undefined
			},
			transformRequest: angular.identity

		})
		.success(function(res){

			deferred.resolve(res);
			

		})
		.error(function(msg, code){

			deferred.reject(msg);

		})

		return deferred.promise;

	}

}])