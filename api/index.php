<?php
	
	 header("Access-Control-Allow-Origin: *");

    require_once "PromoAPI.php";    
    $promoAPI = new PromoAPI();
    $promoAPI->API();
?>