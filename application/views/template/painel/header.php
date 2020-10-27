<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  	<meta charset="utf-8" />
  	<link rel="apple-touch-icon" sizes="76x76" href="<?=base_url('assets/vendor/paper-dashboard/img/apple-icon.png')?>">
  	<link rel="icon" type="image/png" sizes="16x16" href="<?=base_url('assets/images/fav3.png')?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?=base_url('assets/images/fav2.png')?>">
    <link rel="icon" type="image/png" sizes="64x64" href="<?=base_url('assets/images/fav1.png')?>">
  	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  	<title>
    	<?=$title?>
  	</title>
  	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  	<!--     Fonts and icons     -->
  	<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <?=link_tag('assets/vendor/fontawesome/css/all.min.css')?>

  	<?=link_tag('assets/vendor/bootstrap/css/bootstrap.min.css')?>
    <link rel="stylesheet" href="https://cdn.rawgit.com/tonystar/bootstrap-float-label/v4.0.2/bootstrap-float-label.min.css"/>
    <?=link_tag('assets/vendor/DataTables/datatables.min.css')?>
 	  <?=link_tag('assets/vendor/fontawesome/css/all.min.css')?>
    <?=link_tag('assets/vendor/select2/css/select2-with-bootstrap.css')?>
    <?=link_tag('assets/vendor/paper-dashboard/css/paper-dashboard.css?v=2.0.0')?>
    <?=link_tag('assets/vendor/summernote/summernote.css')?>
    <?=link_tag('assets/vendor/summernote/summernote-bs4.css')?>
    <?=link_tag('assets/vendor/summernote/plugin/summernote-audio/summernote-audio.css')?>

  	<!-- CSS Just for demo purpose, don't include it in your project -->
  	<?=link_tag('assets/css/painel.css')?>

</head>

<body class="" data-baseurl="<?=base_url()?>"  data-csrf="<?=$this->security->get_csrf_token_name()?>">
  <div class="wrapper ">
    <div class="sidebar" data-color="black" data-active-color="hennekam">
      <!--
        Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
    -->
      <div class="logo">
        <!-- <a href="http://www.creative-tim.com" class="simple-text logo-mini">
          <div class="logo-image-small">
            <img src="<?=base_url('assets/vendor/paper-dashboard/img/logo-small.png')?>">
          </div>
        </a> -->
        <a href="<?=base_url()?>" class="simple-text logo-normal pl-3" >
          <?=SITE_NAME?>
          <!-- <div class="logo-image-big">
            <img src="<?=base_url('assets/vendor/paper-dashboard/img/logo-big.png')?>">
          </div> -->
        </a>
      </div>
      <div class="sidebar-wrapper">
        <ul class="nav">
          <li class="<?=set_active('agenda')?>">
            <a href="<?=base_url('painel/agenda')?>">
              <i class="nc-icon nc-paper"></i>
              <p>Agenda</p>
            </a>
          </li>
          <li class="<?=set_active('cursos')?>">
            <a href="<?=base_url('painel/cursos')?>">
              <i class="nc-icon nc-bookmark-2"></i>
              <p>Cursos</p>
            </a>
          </li>
           <li class="<?=set_active('painel/videos')?>">
            <a href="<?=base_url('painel/videos')?>" >
              <i class="nc-icon nc-email-85"></i>
              <p>Vídeos</p>
            </a>
          </li>
          <li class="<?=set_active('painel/equipe')?>">
            <a href="<?=base_url('painel/equipe')?>" >
              <i class="nc-icon nc-email-85"></i>
              <p>Equipe</p>
            </a>
          </li>
          <li class="<?=set_active('depoimentos')?>">
            <a href="<?=base_url('painel/depoimentos')?>">
              <i class="nc-icon nc-bullet-list-67"></i>
              <p>Depoimentos</p>
            </a>
          </li>
          <li class="<?=set_active('contatos')?>">
            <a href="<?=base_url('painel/contatos')?>">
              <i class="nc-icon nc-chat-33"></i>
              <p>Contatos</p>
            </a>
          </li>
          <li class="<?=set_active('users')?>">
            <a href="<?=base_url('painel/users')?>">
              <i class="nc-icon nc-single-02"></i>
              <p>Usuários</p>
            </a>
          </li>
          <li class="">
            <a href="<?=base_url('sair')?>">
              <i class="nc-icon nc-simple-remove"></i>
              <p>Sair</p>
            </a>
          </li>
        </ul>
      </div>
    </div>
    <div class="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-absolute fixed-top navbar-transparent">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <div class="navbar-toggle">
              <button type="button" class="navbar-toggler">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </button>
            </div>
            <div>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb p-1 px-3">
                  <?php 
                  $address = '';
                  foreach ($this->uri->segments as $ln => $segment) { 
                    $link = '';
                    if($ln != count($this->uri->segments)){
                      $link = TRUE;
                      $address .= $this->uri->segments[$ln].($ln != count($this->uri->segments)-1 ? "/" : '');
                    }
                  ?>
                    <li class="breadcrumb-item <?=!$link ? 'active' : ''?>">
                      <?php if($link){ ?>
                        <a href="<?=base_url($address)?>">
                      <?php } 
                        echo ucfirst($segment);
                      if($link){ ?>
                        </a>
                      <?php } ?>
                    </li>
                   <?php } ?>
                </ol>
              </nav>
            </div>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end" id="navigation">
            <?php /*
            <form>
              <div class="input-group no-border">
                <input type="text" value="" class="form-control" placeholder="Search...">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <i class="nc-icon nc-zoom-split"></i>
                  </div>
                </div>
              </div>
            </form>
            */ ?>
            <ul class="navbar-nav">
              <?php /*
              <li class="nav-item">
                <a class="nav-link btn-magnify" href="#pablo">
                  <i class="nc-icon nc-layout-11"></i>
                  <p>
                    <span class="d-lg-none d-md-block">Stats</span>
                  </p>
                </a>
              </li>
              */?>
              <?php /*
              <li class="nav-item btn-rotate dropdown">
                <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="nc-icon nc-bell-55"></i>
                  <p>
                    <span class="d-lg-none d-md-block">Some Actions</span>
                  </p>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" href="#">Action</a>
                  <a class="dropdown-item" href="#">Another action</a>
                  <a class="dropdown-item" href="#">Something else here</a>
                </div>
              </li>
              <li class="nav-item">
                <a class="nav-link btn-rotate" href="#pablo">
                  <i class="nc-icon nc-settings-gear-65"></i>
                  <p>
                    <span class="d-lg-none d-md-block">Account</span>
                  </p>
                </a>
              </li>
              */?>
            </ul>
          </div>
        </div>
      </nav>
      <!-- End Navbar -->
      <!-- <div class="panel-header panel-header-sm">


</div> -->
      <div class="content">
        <div class="row justify-content-center">
          <div class="col-md-6">
            <?=get_msg();?>
          </div>
        </div>