app.controller('mainCtrl', ['$scope', 'Configuracion', function($scope, Configuracion){
	
	$scope.config = {};

	$scope.titulo    = "";
	$scope.subtitulo = "";

	$scope.currentDate = new Date();

	$scope.usuario = {
		nombre:"James Ontiveros"
	}

	Configuracion.cargar().then( function(){
		$scope.config = Configuracion.config;
	});


	// ================================================
	//   Funciones Globales del Scope
	// ================================================
	$scope.activar = function( menu, submenu, titulo, subtitulo ){

		$scope.titulo    = titulo;
		$scope.subtitulo = subtitulo;

		$scope.mDashboard = "";
		$scope.mPromociones  = "";
		$scope.mBanners  = "";

		$scope[menu] = 'active';
	};
}]);

app.controller('promocionesCtrl', ['$scope', 'Promociones', 'Upload' ,'$timeout', function($scope, Promociones, Upload, $timeout){

	$scope.activar('mPromociones','','Promociones', '');
	$scope.promociones = {};
	$scope.promocionSel = {};


	Promociones.get(function(data){
		$scope.promociones = data;
		console.log($scope.promociones.promociones);
	});


	$scope.mostrarModal = function(promocion){
	
		promocion = promocion || {category:$scope.currentCategory,url:''};
		$scope.promocionSel = promocion;
		console.log($scope.promocionSel);

		//angular.copy(promocion, $scope.promocionSel);

		//Limpiamos el campo file
		var files = $('#files');
		files.val('');
		$("#modal_promocion").modal();
	}


	$scope.eliminarPromo = function( promocion ){
		if(confirm("Estas seguro que deseas eliminar") == true){
			Promociones.delete({ id: promocion.id }, function(data){
				for(var i=0,len=$scope.promociones.promociones.length;i<len;i++){
					console.log($scope.promociones.length);
	                if($scope.promociones.promociones[i].id === promocion.id){
	                    $scope.promociones.promociones.splice(i,1);
	                    break;
	                }
	            }
			});
		}
	}

}]);


app.controller('dashboardCtrl', ['$scope', function($scope){

	$scope.activar('mDashboard','','Dashboard','información');

}]);


app.controller('uploadCtrl', ['$scope', 'Upload', 'Promociones', function($scope, Upload, Promociones){
	
	/*=====================================================
	=            Funcion para subir una imagen            =
	=====================================================*/
	$scope.uploadFile = function(promocion, frmPromocion){
		
		var file = $scope.file;
		$scope.uploads = {};
		//$scope.promocionSel = {};
		$scope.mensajeFile = false;
		$scope.mensajeData = false;
		$scope.mensajeError = false;

		console.log(frmPromocion);
		console.log(promocion);
		console.log(file);

		if(promocion.id == null && file == undefined){
			$scope.mensajeError = true;
			setTimeout(function(){
					$scope.mensajeError = false;
					$scope.$apply();
				}, 1500);

		}else{
			Upload.uploadFile( file ).then(function(res){
				//$scope.mensajeFile = true;
				$scope.file = null;
				var data;
				console.log(res.data.url);
				
				var promo = new Promociones();
				if(res.data.url == null){
					console.log("Entro");
					$scope.mensajeData = true;
					promo.id = promocion.id;
					promo.url = promocion.url;
					promo.nombre = promocion.nombre;
					promo.estado = promocion.estado;
					promo.legal = promocion.legal;
					promo.concesionario = promocion.concesionario;
				}else{
					$scope.mensajeFile = true;
					promo.id = promocion.id;
					promo.url = res.data.url;
					promo.nombre = promocion.nombre;
					promo.estado = promocion.estado;
					promo.legal = promocion.legal;
					promo.concesionario = promocion.concesionario;
				}
				
				if(promocion.id){
					promo.$update(function(response){
						console.log(response);
						for(var i=0,len=$scope.promociones.promociones.length;i<len;i++){
			                if($scope.promociones.promociones[i].id === promocion.id){
			                    $scope.promociones.promociones[i] = response[0];
			                    console.log($scope.promociones.promociones);
			                    break;
			                }
			            }
					});
					
				}else{
					promo.$save(function(response){
						console.log(promo);
						data = response[0];
						console.log(data);
						$scope.promociones.promociones.push(data);
						console.log($scope.promociones.promociones);		
					});
					
				}
				setTimeout(function(){
					$scope.mostrarMensaje = false;
					$scope.mensajeFile = false;
					$scope.mensajeData = false;
					$scope.file = null;
					//$scope.promocionSel = {};
					frmPromocion.autoValidateFormOptions.resetForm();
					$("#modal_promocion").modal('hide');
					$scope.$apply();
				}, 3000);
				//
				$scope.uploads = res.data;
			})
		}
	};
}])
.directive('uploaderModel', ["$parse", function ($parse) {
	return {
		restrict: 'A',
		link: function (scope, iElement, iAttrs) 
		{
			iElement.on("change", function(e)
			{
				$parse(iAttrs.uploaderModel).assign(scope, iElement[0].files[0]);
			});
		}
	};
}])

app.controller('bannersCtrl', ['$scope', 'Upload', 'Banners', '$timeout', function($scope, Upload, Banners, $timeout){

	$scope.activar('mBanners', '', 'Banners', '');
	$scope.banners = {};
	$scope.bannerSel = {};

	Banners.get(function(data){
		$scope.banners = data;
		console.log($scope.banners);
	})


	$scope.mostrarModal = function(banner){
		//angular.copy(banner,$scope.bannerSel);
		$scope.bannerSel = banner;
		$("#modal_banner").modal();
		console.log($scope.bannerSel);
	}

	$scope.deleteBanner = function(banner){
		console.log(banner);
		if(confirm("Estas seguro que deseas eliminar el banner") == true){
			Banners.delete({id:banner.id}, function(data){
				console.log(data);
				Banners.get(function(data){
					$scope.banners = data;
					console.log($scope.banners);
				})
			})
		}
	}
}]);


app.controller('bannerUploadCtrl', ['$scope', 'Upload', 'Banners', '$timeout', function($scope, Upload, Banners, $timeout){
	

	$scope.uploadBanner = function(banner, frmBanner){
		var file = $scope.file;
		console.log(file);
		console.log(banner);

		$timeout(function(){
			Upload.uploadFile(file).then(function(res){
				console.log(res.data.url);

				//Guardamos el banner
				var ban = new Banners();
				ban.id = banner.id;
				ban.concesionario = banner.concesionario;
				ban.enlace = banner.enlace;
				ban.posicion = banner.posicion;
				
				if(res.data.url == undefined){
					ban.imagen = banner.imagen;
				}else{
					ban.imagen = res.data.url;
				}
				console.log(banner.id);
				if(banner.id){
					ban.$update(function(response){
						console.log($scope.banners.banners);
							Banners.get(function(data){
								$scope.banners = data;
								console.log($scope.banners);
							})
							$("#modal_banner").modal('hide');
							$scope.banners = {};
							$scope.file = {};
					});
				}else{
					ban.$save(function(response){
						console.log(response[0]);
						
						$scope.banners.banners.push(response[0]);
						console.log($scope.banners);
						$("#modal_banner").modal('hide');
						$scope.banners = {};
						$scope.file = {};
					});
				}
			});
		}, 1500)	
	}
}])
.directive('uploaderModel1', ["$parse", function ($parse) {
	return {
		restrict: 'A',
		link: function (scope, iElement, iAttrs) 
		{
			iElement.on("change", function(e)
			{
				$parse(iAttrs.uploaderModel1).assign(scope, iElement[0].files[0]);
			});
		}
	};
}])