var app = angular.module( 'facturacionApp',[
		'ngResource',
		'ngRoute', 
		'jcs-autoValidate',
		'ngFileUpload'
		]);

angular.module('jcs-autoValidate')
.run([
    'defaultErrorMessageResolver',
    function (defaultErrorMessageResolver) {
        // To change the root resource file path
       	defaultErrorMessageResolver.setI18nFileRootPath('angular/lib');
        defaultErrorMessageResolver.setCulture('es-co');
    }
]);




// ================================================
//   Rutas
// ================================================
app.config([ '$routeProvider', function($routeProvider){

	$routeProvider
		.when('/',{
			templateUrl: 'dashboard/dashboard.html',
			controller: 'dashboardCtrl'
		})
		.when('/promociones/:pag',{
			templateUrl: 'promociones/promociones.html',
			controller: 'promocionesCtrl'
		})
		.when('/banners/:pag',{
			templateUrl: 'banners/banners.html',
			controller: 'bannersCtrl'
		})
		.otherwise({
			redirectTo: '/'
		})

}]);


// ================================================
//   Filtros
// ================================================
app.filter( 'quitarletra', function(){

	return function(palabra){
		if( palabra ){
			if( palabra.length > 1)
				return palabra.substr(1);
			else
				return palabra;
		}
	}
})

.filter( 'mensajecorto', function(){

	return function(mensaje){
		if( mensaje ){
			if( mensaje.length > 35)
				return mensaje.substr(0,35) + "...";
			else
				return mensaje;
		}
	}
})

.filter("textoMaximo", function(){

	return function(text){
		if(text != null){
			if(text.length > 100){
				return text.substring(0, 100) + "...";
			}else{
				return text;
			}
		}
	}

});







