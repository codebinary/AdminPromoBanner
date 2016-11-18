<!DOCTYPE html>
<html lang="es" ng-app="promociones" ng-controller="mainCtrl">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>.:: MULTIMARKAS SAC ::.</title>
    <meta name="description" content="Promoción Camionetas 2016.">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="format-detection" content="telephone=no">
    <meta name="author" content="nombre del autor">
    <link href="favicon.ico" rel="shortcut icon" type="image/x-icon">
    <link rel="stylesheet" href="css/promociones.min.css"><!--[if lt IE 9]>
    <script src="js/vendor/html5-3.6-respond-1.1.0.min.js"></script><![endif]-->
    <meta name="google-site-verification" content="">
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.5.8/angular.min.js"></script>
    
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.5.8/angular-route.min.js"></script>
    <!-- Angularjs -->
    <script src="angular/app.js"></script>
    <script type="text/javascript">
      
    </script>
    <style type="text/css">
      .active{
        background-color: #bb162b;
        color: #fff;
        font-weight: bold;
      }
    </style>

    <meta name="google-site-verification" content="">
  </head>
  <body>
      <!-- Analytics -->
    
    <div ng-include="'modulos/analytics.php'">
      
    </div>
    <!--// Analytics -->
    <div class="OuterWrapper">
      <!--HEADER-->
      <?php include('includes/general/main-menu.php'); ?>
      <!--ENDOF HEADER-->
      <!--CONTENEDOR PRINCIPAL-->
      <div class="Main">
        <!--CONTENEDOR PARA LAS PÁGINAS INTERNAS-->
        <div class="Main-internasWrapper">
          <!--MENÚ A LA IZQUIERDA-->
          <div class="Main-sidebar">
            <h1 class="Main-title">Promociones Kia</h1>
            <nav class="Main-sidebarMenu">
              <ul class="Main-sidebarMenu-list">
                <li class="Main-sidebarMenu-item" ng-repeat="promocion in promociones" ng-click="nombreConcesionario(promocion.concesionario)"
                    ng-hide="promocion.concesionario == 'interamericananorte' ||
                            promocion.concesionario == 'motorsurkia' ||
                            promocion.concesionario == 'autodisakia' ||
                            promocion.concesionario == 'interamericanatrujillo'">
                  <a id="picanto" href="#/{{promocion.nombre | quitarEspacios}}" class="Main-sidebarMenu-link" ng-class="{active: isCurrentPromocion(promocion)}" ng-click="setCurrentPromocion(promocion)" >{{promocion.nombre }}</a>
                </li>            
              </ul>
            </nav>
          </div>
          <!--CONTENIDO LANDING-->
          <section class="ContentInterna Promociones">
            <h2 class="ContentInterna-title">Promoción {{currentPromocionName}}</h2>

            <div class="Promociones-main-buttons" ng-hide="nomConcesionario == 'kiamultimarkas'">
              <a href="cotizar.php" class="Promociones-button-cotizar"><img src="img/content/promociones/button-cotizar.png" alt="Cotizar."></a><a href="pdf/modelos/ficha-tecnica-{{nombreModelo}}.pdf" class="Promociones-button-ficha"><img src="img/content/promociones/button-ficha-tecnica.png" alt="Ficha técnica."></a><a href="{{nombreModelo}}.php" class="Promociones-button-conocelo"><img src="img/content/promociones/button-conocelo.png" alt="Conócelo."></a>
            </div>

            <div class="Promociones-imgPromocion-wrapper"><a href="cotizar.php">
            <img src="{{currentPromocionImg}}"></a></div>
            <div class="Promociones-legales-wrapper"><p>{{currentPromocionLegal}}</p></div>
          </section>
        </div>
      </div>
      <!--FOOTER-->
    
      <div ng-include="'includes/general/main-footer.php'"></div>
      <!--ENDOF FOOTER-->
    </div>
  </body>
  <script src="js/main.min.js"></script>
  <script src="js/menu_promo.js"></script>
</html>