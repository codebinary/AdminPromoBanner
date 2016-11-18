<?php session_start(); 

if($_SESSION['user'] == "jontiveros"){
    $nombre = "James Ontiveros";
  }else if($_SESSION['user'] == "gpizarro@vertice.pe"){
    $nombre = "Greta Pizarro";
  }else if($_SESSION['user'] == "esnider@vertice.pe"){
    $nombre = "Esnider Contreras";
  }else if($_SESSION['user'] == "jcarlos@vertice.pe"){
    $nombre = "Juan Carlos";
  }
?>

<!-- sidebar: style can be found in sidebar.less -->
<section class="sidebar">

  <!-- Sidebar user panel (optional) -->
  <div class="user-panel">
    <div class="pull-left image">
      <img src="dist/img/avatar5.png" class="img-circle" alt="User Image">
    </div>
    <div class="pull-lef info">
      <p><?php echo $nombre; ?></p>
      <!-- Status -->
      <a href=""><i class="fa fa-circle text-success"></i> Online</a>
      <!-- <a href=""><i class="fa fa-circle text-danger"></i> Offline</a> -->
    </div>
  </div>

  <!-- search form (Optional) -->
  <!--<form class="sidebar-form">
    <div class="input-group">
      <input type="text" name="q" class="form-control" placeholder="Buscar..." ng-model="busqueda">
      <span class="input-group-btn">
        <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
      </span>
    </div>
  </form>-->
  <!-- /.search form -->

  <!-- Sidebar Menu -->
  <ul class="sidebar-menu">
    <li class="header">Opciones</li>
    <!-- Optionally, you can add icons to the links -->
    <li ng-class="mDashboard"><a href="#/"><i class="fa fa-link"></i> <span>Dashboard</span></a></li>
    <li ng-class="mPromociones"><a href="#/promociones/1"><i class="fa fa-link"></i> <span>Promociones</span></a></li>
    <li ng-class="mBanners"><a href="#/banners/1"><i class="fa fa-link"></i> <span>Banners</span></a></li>
    <!--<li class="treeview">
      <a href=""><i class="fa fa-link"></i> <span>Multilevel</span> <i class="fa fa-angle-left pull-right"></i></a>
      <ul class="treeview-menu">
        <li><a href="">Link in level 2</a></li>
        <li><a href="">Link in level 2</a></li>
      </ul>
    </li>
  </ul><!-- /.sidebar-menu -->
</section>
<!-- /.sidebar -->
