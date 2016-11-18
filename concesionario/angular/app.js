var BASE_URL = window.location.pathname;
      console.log(BASE_URL);


var app = angular.module('promociones', ['ngRoute']);

/*app.config(['$routeProvider', function($routeProvider){
	$routeProvider
		.when('/:name', {
			templateUrl: 
		})
		
}])*/
app.filter('quitarEspacios', function(){

	return function(palabra){
		if(palabra){

			// Definimos los caracteres que queremos eliminar
			var specialChars = "!@#$^&%*()+=-[]\/{}|:<>?,.";
			
			// Los eliminamos todos
			for (var i = 0; i < specialChars.length; i++) {
				palabra = palabra.replace(new RegExp("\\" + specialChars[i], 'gi'), '');
			}

			palabra = palabra.toLowerCase();

			// Quitamos espacios y los sustituimos por -
			palabra = palabra.replace(/ /g, "-");

			// Quitamos acentos y "ñ". Fijate en que va sin comillas el primer parametro
			palabra = palabra.replace(/á/gi,"a");
		   	palabra = palabra.replace(/é/gi,"e");
		   	palabra = palabra.replace(/í/gi,"i");
		   	palabra = palabra.replace(/ó/gi,"o");
		   	palabra = palabra.replace(/ú/gi,"u");
		   	palabra = palabra.replace(/ñ/gi,"n");

			return palabra;

		}
	}
})

app.controller('mainCtrl', ['$scope','$location','$http','Promo', function($scope, $location,$http, Promo){
	
	$scope.promociones = {};

	var datos = [];

	//Obtenemos todas las promociones
	Promo.getAll().then(function(){

		for (var i = 0; i < Promo.promociones.length; i++) {
			console.log(Promo.promociones[i].estado);
			if(Promo.promociones[i].estado != 0){
				datos.push(Promo.promociones[i]);
			}
		}
		//Obtenemos las promociones filtradas
		$scope.promociones = datos;
		//Seleccionamos siempre la primera posicion del array
		$scope.currentPromocion = datos[0];
		console.log(datos);

		//$scope.currentPromocion = Promo.promociones[0];
				//console.log($scope.currentPromocion);
	})

	//Función que se ejecuta al dar click la lista de los nombres de cada promoción
	$scope.setCurrentPromocion = function(promocion){
		$scope.currentPromocion = promocion;
		$scope.currentPromocionName = promocion.nombre;
		$scope.currentPromocionImg = promocion.url;
		$scope.currentPromocionLegal = promocion.legal;
		
		var nombreModelo = quitarEspacios($scope.currentPromocionName);
		$scope.nombreModelo = asignarBotonesPdfPag(nombreModelo);


	}
	$scope.nombreConcesionario = function(nombre){
		console.log(nombre);
		$scope.nomConcesionario = nombre;
	}

	//Obtenemos la promocion actual 
	$scope.isCurrentPromocion = function(promocion){
		
		//limpiamos el nombre de la promocion
		var nombre = quitarEspacios(promocion.nombre)

		//Obtenemos el nombre del modelo y lo comparamos con la url
		var url = "/" + nombre;

		//obtenemos la url absoluta
		console.log('$location',$location.$$absUrl);
		if($location.$$absUrl != BASE_URL + "promocion.php"){
			//obtenemos la url actual y seteamos los valores si son iguales retornamos true para pintar de rojo
			if(url === $location.path()){
				$scope.currentPromocionName = promocion.nombre;
				$scope.currentPromocionImg = promocion.url;
				$scope.currentPromocionLegal = promocion.legal;

				var nombreModelo = quitarEspacios($scope.currentPromocionName);
				$scope.nombreModelo = asignarBotonesPdfPag(nombreModelo);
				return true;
			}
		}else{
			//si la pagina es promocion.php redireccionamos a promocion.php#/:primerovalordelarreglo
			var nombreModelo = quitarEspacios($scope.currentPromocion.nombre);
			console.log('$location',$location.$$absUrl + "#/" + nombreModelo);
			var redireccion = $location.$$absUrl + "#/" + nombreModelo;
			window.location = redireccion;
		}
	}

	$scope.nombreModelo = asignarBotonesPdfPag($scope.ruta);

}])

/*=============================================================
=            Servicio para obtener las promociones            =
=============================================================*/
app.factory('Promo', ['$http', '$q', function($http, $q){

	var self = {

		
		'promociones': {},
		
		getAll: function(){

			var d = $q.defer();

			$http.get('http://kia.com.pe/promociones/api/promociones')
				.success(function( data ){

					self.promociones = data.promociones;

					return d.resolve();
				});

			return d.promise;
		}

	};

	return self;

}]);



function quitarEspacios(palabra){
	//return function(palabra){
		if(palabra){

			// Definimos los caracteres que queremos eliminar
			var specialChars = "!@#$^&%*()+=-[]\/{}|:<>?,.";
			
			// Los eliminamos todos
			for (var i = 0; i < specialChars.length; i++) {
				palabra = palabra.replace(new RegExp("\\" + specialChars[i], 'gi'), '');
			}

			palabra = palabra.toLowerCase();

			// Quitamos espacios y los sustituimos por -
			palabra = palabra.replace(/ /g, "-");

			// Quitamos acentos y "ñ". Fijate en que va sin comillas el primer parametro
			palabra = palabra.replace(/á/gi,"a");
		   	palabra = palabra.replace(/é/gi,"e");
		   	palabra = palabra.replace(/í/gi,"i");
		   	palabra = palabra.replace(/ó/gi,"o");
		   	palabra = palabra.replace(/ú/gi,"u");
		   	palabra = palabra.replace(/ñ/gi,"n");

			return palabra;

		}
	//}
}

function asignarBotonesPdfPag(value){
	var nombreModelo;
	if(/sportage/.test(value) && /2017/.test(value)){
		return nombreModelo = "modelo-sportage2017";
	}else if(/sportage/.test(value)){
		return nombreModelo = "modelo-sportage";
	}else if(/picanto/.test(value)){
		return nombreModelo = "modelo-picanto";
	}else if(/cerato-hatchback/.test(value)){
		return nombreModelo = "modelo-cerato-hatchback";
	}else if(/rio-hatchback/.test(value)){
		return nombreModelo = "modelo-rio-hatchback";
	}else if(/cerato-sedan/.test(value)){
		return nombreModelo = "modelo-cerato-sedan";
	}else if(/rio-sedan/.test(value)){
		return nombreModelo = "modelo-rio-sedan";
	}else if(/soul/.test(value)){
		return nombreModelo = "modelo-soul";
	}else if(/sorento/.test(value)){
		return nombreModelo = "sorento2015";
	}else if(/k2700/.test(value)){
		return nombreModelo = "modelo-k2700";
	}
}