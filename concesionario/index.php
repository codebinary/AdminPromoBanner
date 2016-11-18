<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>.:: MULTIMARKAS SAC ::.</title>
    <meta name="description" content="Multimarkas Kia Concesionario Oficial Kia.">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="format-detection" content="telephone=no">
    <meta name="author" content="Multimarkas Kia">
    <link href="favicon.ico" rel="shortcut icon" type="image/x-icon">
    <link rel="stylesheet" href="css/home.min.css">
    <!--[if lt IE 9]><script src="js/vendor/html5-3.6-respond-1.1.0.min.js"></script><![endif]-->
    <meta name="google-site-verification" content="">
  </head>
  <body>
    <div class="OuterWrapper">
      <!--HEADER-->
      <?php include('includes/general/main-menu.php'); ?>
      <!--ENDOF HEADER-->
      <!--MAIN-->
      <div class="Main">
        <!--PRELOADER-->
        <div id="home-slide-preloader" class="HomeSlide-preloader"><img src="img/content/home/preloader.gif" alt=""></div>
        <!--SLIDES-->
        <section id="home-slide" class="HomeSlide">
          <ul id="home-main-slide" class="HomeSlide-mainSlide">
             <li data-slide="0" class="active first-child"><a href="promocion.php"><img src="img/content/home/slide/aniversario_kia.jpg"></a></li>
            <!--<li data-slide="1"><a href="promocion-camionetas-2017.php"><img src="img/content/home/slide/euro2016.jpg" alt="carens"></a></li>-->
            <li data-slide="2" ><a href="modelo-optima2017.php"><img src="img/content/home/slide/banner_optima.jpg" alt="carens"></a></li>
            <li data-slide="3"> <a href="modelo-sportage2017.php"><img src="img/content/home/slide/sportage2017.jpg" alt="inicio"></a></li>
            
          </ul>
          <div class="HomeSlide-thumbnailsSlideWrapper">
            <div id="prevThumbnail" class="prevThumbnail"></div>
            <div id="nextThumbnail" class="nextThumbnail"></div>
            <div class="HomeSlide-thumbnailsMask">
              <ul id="thumbnails-slide" class="HomeSlide-thumbnailsSlide">
                <li data-slide="0" class="HomeSlide-thumbnail active"><img src="img/content/home/slide/thumbnails/aniversario_kia.jpg"</li>
                <!--<li data-slide="1" class="HomeSlide-thumbnail"><img src="img/content/home/slide/thumbnails/euro2016.jpg" alt="picanto-10"></li>-->
                <li data-slide="2" class="HomeSlide-thumbnail"><img src="img/content/home/slide/thumbnails/banner_optima.jpg" alt="picanto-10"></li>
               <li data-slide="3" class="HomeSlide-thumbnail"><img src="img/content/home/slide/thumbnails/sportage2017.jpg" alt="inicio"></li>
              
              </ul>
            </div>
          </div>
        </section>
        <!--BANNERS-->
        <section class="HomeBanners">
          <div class="HomeBanners-nav">
            <div class="HomeBanners-prevButton"></div>
            <div class="HomeBanners-nextButton"></div>
          </div>
          <div class="HomeBanners-slideWrapper">
            <ul id="home-banner-slide" class="HomeBanner-slide">
              <li class="HomeBanners-slideItem"><a href="http://kia.com.pe/sobre-kia/noticias/" target="_blank"><img src="img/content/home/banners/banner-noticias.jpg" alt="Noticias"></a></li>
              <li class="HomeBanners-slideItem"><a id="home-banner-llamadorevision" href="llamado-revision.html" data-fancybox-type="iframe" class="fancybox.iframe"><img src="img/content/home/banners/banner-llamado-revision.jpg" alt="Llamado a revisión."></a></li>
              <li class="HomeBanners-slideItem"><a id="home-banner-llamadorevision" href="revision-llamado-cerato.php" data-fancybox-type="iframe" class="fancybox.iframe"><img src="img/content/home/banners/banner_preventa_cerato.jpg" alt="Llamado a revisión."></a></li>
              <li class="HomeBanners-slideItem"><a id="home-banner-llamadorevision" href="revision-llamado-soul.php" data-fancybox-type="iframe" class="fancybox.iframe"><img src="img/content/home/banners/banner_preventa_soul.jpg" alt="Llamado a revisión."></a></li>
              <li class="HomeBanners-slideItem"><a href="http://kia-buzz.com" target="_blank"><img src="img/content/home/banners/banner-kia-buzz.jpg" alt="Kia Buzz."></a></li>
              <li class="HomeBanners-slideItem"><a href="http://kia.com.pe/social-apps/" target="_blank"><img src="img/content/home/banners/banner-social-apps.jpg" alt="Social App."></a></li>
              <li class="HomeBanners-slideItem"><a href="post-venta.php"><img src="img/content/home/banners/banner-postventa.jpg" alt="PostVenta."></a></li>
            </ul>
          </div>
          <div style="clear:both"></div>
        </section>
      </div>
      <!--ENDOF MAIN-->
      <!--FOOTER-->
      <?php include('includes/general/main-footer.php'); ?>
      <!--ENDOF FOOTER-->
    </div>
    <!-- Segment Pixel - KIA - Home-->
    <!-- <script src="https://secure.adnxs.com/seg?add=1765016&t=1" type="text/javascript"></script> -->
    <!--Endof - Segment Pixel - KIA - Home-->
  </body>
  <script src="js/home.min.js"></script>
</html>
