<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="<?=get_language()?>">
	<head>
		<meta charset="UTF-8">
		<title><?=$title?></title>
		<meta http-equiv="x-ua-compatible" content="ie=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
		<meta http-equiv="Pragma" content="no-cache" />
		<meta http-equiv="Expires" content="0" />
		<?=meta('Content-type', 'text/html; charset=utf-8', 'equiv');?>
		<?=isset($metatags) ? $metatags : ''?>
		<link rel="icon" type="image/png" sizes="16x16" href="<?=base_url('assets/images/fav3.png')?>">
		<link rel="icon" type="image/png" sizes="32x32" href="<?=base_url('assets/images/fav2.png')?>">
		<link rel="icon" type="image/png" sizes="64x64" href="<?=base_url('assets/images/fav1.png')?>">
		<?=link_tag('https://fonts.googleapis.com/css?family=Montserrat:400,700,200');?>
		<?=link_tag('assets/vendor/bootstrap/css/bootstrap.min.css')?>
		<?=link_tag('https://cdn.rawgit.com/tonystar/bootstrap-float-label/v4.0.2/bootstrap-float-label.min.css');?>
		<?=link_tag('assets/vendor/fontawesome/css/all.min.css')?>
		<?=link_tag('https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css');?>
		<?=link_tag('assets/vendor/swiper/swiper-bundle.css')?>
		<?=link_tag('assets/vendor/fancybox/jquery.fancybox.css')?>
		<?=link_tag('assets/css/style.css?t='.uniqid(rand(0,50).md5(strtotime(date('Y-m-d-H-i-s')))))?>
		<!-- Global site tag (gtag.js) - Google Analytics -->
		<!-- Global site tag (gtag.js) - Google Analytics -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=G-0CZHL1XNSG"></script>
		<script>
		  window.dataLayer = window.dataLayer || [];
		  function gtag(){dataLayer.push(arguments);}
		  gtag('js', new Date());

		  gtag('config', 'G-0CZHL1XNSG');
		</script>

	</head>
	<body data-baseurl="<?=base_url()?>" data-csrf="<?=$this->security->get_csrf_token_name()?>" data-lang="<?=get_language()?>" data-background="<?=isset($data_bg) ? $data_bg : 'site'?>" >
		<header class="masthead mb-auto container-fluid" <?=isset($data_bg_custom) ? 'style="background-image:url('."'".base_url($data_bg_custom)."'".')"' : ''?>>

		    <nav id="hennekam_menu" class="navbar navbar-expand-lg justify-content-center">
		    	<div class="container">
		    		<a href="<?=base_url(get_language()."/")?>" class="navbar-link-brand">
						<?=img('assets/images/logo.png',FALSE,['class'=>'navbar-brand w-50'])?>
					</a>
					<button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#hennekam_menu_toggle" aria-controls="navbarsExample07XL" aria-expanded="false" aria-label="Toggle navigation">
				      <i class="fa  fa-bars"></i>
				    </button>
				    <div class="collapse navbar-collapse w-100" id="hennekam_menu_toggle">
				    	<?=show_menu($menus);?>
				    </div>
		      		
		    	</div>
		    	
		    </nav>
		    <div class="container d-flex flex-columm align-items-center h-100">
		    	<?php if(!isset($nao_exibir_h1)){ ?>
		    	<h1 class="<?=isset($not_home) && !$not_home? 'sr-only' : ''?> text-purple-hennekam"><?=$heading?></h1>
		    	<?php } ?>
		    </div>

		</header>
		<main>
			<?php if(isset($show_blocks)){ ?>
			<section class="container-fluid">
				<?php $this->load->view('site/__snippets/blocks')?>
			</section>
			<?php }?>