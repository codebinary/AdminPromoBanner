<?php 
	
	header("Access-Control-Allow-Origin: *");
	header ("Expires: Fri, 14 Mar 1980 20:53:00 GMT"); //la pagina expira en fecha pasada 
	header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); //ultima actualizacion ahora cuando la cargamos 
	header ("Cache-Control: no-cache, must-revalidate"); //no guardar en CACHE 
	header ("Pragma: no-cache"); //PARANOIA, NO GUARDAR EN CACHE 

	include_once('lib/ezsql/ezsql.php');

	/*=========================================================
	=            Nos conectamos a la base de datos            =
	=========================================================*/
	function conn(){
		return $db = conexion('kiacom_useradmin', 'l0Ze%~%mXtVr', 'kiacom_conce_promodb', 'localhost');
	}

	class PromoAPI {    

	    public function API(){
	        $method = $_SERVER['REQUEST_METHOD'];

	        switch ($method) {
		        case 'GET'://consulta
		        	clearstatcache();
		            $this->getData();
		            break;     
		        case 'POST'://inserta
		            $this->saveData();
		            break;                
		        case 'PUT'://actualiza
		            $this->updateData();
		            break;      
		        case 'DELETE'://elimina
		            $this->deleteData();
		            break;
		        default://metodo NO soportado
		            echo 'METODO NO SOPORTADO';
		            break;
	        }
	    }

	    /*===========================================
	    =            Obtener promociones            =
	    ===========================================*/
	    function getData(){

	    	$action = htmlspecialchars($_GET['action']);
			if( $action == 'promociones'){
				$db = conn();
				if(isset($_GET['id'])){
					$idPromo = htmlspecialchars($_GET['id']);
					$sql = "SELECT * FROM promocion WHERE id = ". $idPromo;
					$response = $db->get_results( $sql );
					clearstatcache();
					echo '{"promocion":'. json_encode($response) .'}';
				}else{
					//Muestra todos los registros
					$sql = "SELECT * FROM promocion ORDER BY id DESC";
					$response = $db->get_results($sql);
					echo '{"promociones":'. json_encode($response) .'}';
				}
			}else if($action == 'banners'){
				$db = conn();
				if(isset($_GET['id'])){
					$idBanner = htmlspecialchars($_GET['id']);
					$sql = "SELECT * FROM banners WHERE id = " . $idBanner;
					$response = $db->get_results($sql);
					clearstatcache();
					echo '{"banner":'. json_encode($response) .'}';
				}else{
					$sql = "SELECT * FROM banners ORDER BY posicion ASC";
					$response = $db->get_results($sql);
					echo '{"banners":'. json_encode($response) .'}';
				}
			}

			else{
				echo "Error";
			}

		}

		/*=============================================================
		=            Guardar promociones pasandole los dos            =
		=============================================================*/
		function saveData(){

			$action = htmlspecialchars($_GET['action']);
			if( $action == 'promociones' ){
				$db = conn();
				//Decodifica un string de json
				$obj = json_decode(file_get_contents('php://input'));
				$request = (array)$obj;
				if( empty($request) ){
					$this->response(422,"error","Nothing to add. Check json");
				}else if( isset($request) ){
					//Obtenemos los datos limpios, y lo gaurdarmos en un array
					$data = $this->getRequestParams($request);
					$sql = "INSERT INTO promocion(nombre, estado, url, legal, concesionario)
							VALUES ('". $data["nombre"] ."',
									'". $data["estado"] ."',
									'". $data["url"] ."',
									'". $data["legal"] ."',
									'". $data["concesionario"] ."')";

					$response = $db->query($sql);
					if (is_numeric($response) OR $response == true) {
						$sql = "SELECT * FROM promocion ORDER BY id DESC LIMIT 1";
						$response = $db->get_results( $sql );
						echo json_encode($response, JSON_FORCE_OBJECT);
						exit();
					}else{
						$respuesta = array('err' => true, 'Mensaje' => "eRROR");
					}
				}
			}
			else if( $action == 'banners' ){
				$db = conn();
				//Decodificamos la data
				$obj = json_decode(file_get_contents('php://input'));
				$request = (array)$obj;

				if(empty($request)){
					$this->response(422, "error", "Nothing to add. check json");
				}else if(isset($request)){
					$data = $this->getRequestParams($request);

					$sql = "INSERT INTO banners(imagen, concesionario, enlace, posicion)
							VALUES ('". $data["imagen"] ."',
									'". $data["concesionario"] ."',
									'". $data["enlace"] ."',
									'". $data["posicion"] ."')";
					$response = $db->query($sql);
					if(is_numeric($response) || $response == true){
						$sql = "SELECT * FROM banners ORDER BY id DESC LIMIT 1";
						$response = $db->get_results($sql);
						echo json_encode($response, JSON_FORCE_OBJECT);
						exit();
					}else{
						$respuesta = array("err" => true, "Mensaje"=>'ERROR');
					}
				}
			}

		}

		/*=============================================
		=            Actulizar promociones            =
		=============================================*/
		function updateData(){

			if( isset( $_GET['action'] ) && isset( $_GET['id'] ) ){
				$db = conn();
				if( $_GET['action'] == 'promociones' ){
					$request = json_decode(file_get_contents('php://input'));
					$request = (array) $request;
					if( empty($request) ){
						$this->response(422,"error","Nothing to add. Check json");                        
					}else if( isset($request['id']) ){
						//Obtenemos los datos limpios, y lo gaurdarmos en un array
						$data = $this->getRequestParams($request);
						$sql = "UPDATE promocion
									SET 
										nombre			= '". $data["nombre"] ."',
										estado			= '". $data["estado"] ."',
										url				= '". $data["url"] ."',
										legal			= '". $data["legal"] ."',
										concesionario	= '". $data["concesionario"] ."'

								WHERE id=".$request['id'];

						$response = $db->query( $sql );
						if (is_numeric($response) OR $response == true) {	
							$sql = "SELECT * FROM promocion WHERE id = ".$request['id'];
							$response = $db->get_results( $sql );
							echo json_encode($response, JSON_FORCE_OBJECT);
							exit();
						}else{
							echo $respuesta = array('err' => true, 'Mensaje' => "eRROR");
						}
					}else{
						$this->response(422,"error","The property is not defined");                        
					}
					exit;
				}else if($_GET['action'] == 'banners'){
					$request = json_decode(file_get_contents('php://input'));
					$request =  (array)$request;
					
					if(empty($request)){
						$this->response(422, "error", "Nothing to add. Check json");
					}else if(isset($request['id'])){
						//obtenemos los datos limpios del arreglo
						$data = $this->getRequestParams($request);
						$sql = "UPDATE banners
								SET 
								imagen 			= '".$data["imagen"] ."',
								concesionario   = '".$data["concesionario"]. "',
								enlace          = '".$data["enlace"]."',
								posicion        = '".$data["posicion"]."'

								WHERE id=".$request['id'];
						$response = $db->query($sql);
						if(is_numeric($response) || $response == true){
							$sql = "SELECT * FROM banners WHERE id=".$request['id'];
							$response = $db->get_results($sql);
							echo json_encode($response, JSON_FORCE_OBJECT);
							exit();
						}else{
							echo $respuesta = array('err' => true, 'Mensaje' => "eRROR");

						}
					}else{
						$this->response(422,"error","The property is not defined");
					}
				}
			}
		}


		/*======================================================
		=            Función para elminar Promoción            =
		======================================================*/
		function deleteData(){

			$db = conn();
			if( isset($_GET['action']) && isset($_GET['id'] )){
				if($_GET['action'] == 'promociones'){
					$sql = "DELETE FROM promocion WHERE id=".$_GET['id'];
					$response = $db->get_results( $sql );
					if (is_numeric($response) OR $response == true) {	
						echo $respuesta = array('err' => false, 'Mensaje' => 'Registro Actualizado'); 
						$this->response(204);
						exit;
					}else{
						echo $respuesta = array('err' => true, 'Mensaje' => "eRROR");
					}
				}else if($_GET['action'] == "banners"){
					$sql = "DELETE FROM banners WHERE id=".$_GET['id'];
					$response = $db->get_results($sql);
					if(is_numeric($response) || $response == true){
						echo $respuesta = array("err" => false, "Mensaje" => "Registro eliminado");
						$this->response(204);
						exit;
					}
 				}
			}else{
				$this->response(400);
			}

		}

		/*=========================================================================
		=            Obtenemos los parametros recibidos y lo limpiamos            =
		=========================================================================*/
		function getRequestParams($request){
			$params = array();

			//Parámetros para las promociones
			$params['nombre'] 			= ucwords($this->cleanData($request['nombre']));
			$params['estado'] 			= $this->cleanData($request['estado']);
			$params['url']				= $this->cleanData($request['url']);
			$params['legal']			= $this->cleanData($request['legal']);
			$params['concesionario'] 	= $this->cleanData($request['concesionario']);

			//Parámetros para los banners
			$params['imagen']			= $this->cleanData($request['imagen']);
			$params['enlace']			= $this->cleanData($request['enlace']);
			$params['posicion']			= $this->cleanData($request['posicion']);
			return $params;
		}
		
		/*==================================================
		=            Función que limpia la data            =
		==================================================*/
		function cleanData($data) {
		  $data = trim($data);
		  $data = addslashes($data);
		  $data = htmlspecialchars($data);
		  return $data;
		}
		
		/**
		 * Respuesta al cliente
		 * @param int $code Codigo de respuesta HTTP
		 * @param String $status indica el estado de la respuesta puede ser "success" o "error"
		 * @param String $message Descripcion de lo ocurrido
		 */
		 function response($code=200, $status="", $message="") {
		    http_response_code($code);
		    if( !empty($status) && !empty($message) ){
		        $response = array("status" => $status ,"message"=>$message);  
		        echo json_encode($response,JSON_PRETTY_PRINT);    
		    }            
		 }   

	    
	}//end class

 ?>