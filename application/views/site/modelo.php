<?php ?>


<!DOCTYPE html>
<html>
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
		<script async src="https://www.googletagmanager.com/gtag/js?id=UA-177863655-1"></script>
		<script>
		  window.dataLayer = window.dataLayer || [];
		  function gtag(){dataLayer.push(arguments);}
		  gtag('js', new Date());

		  gtag('config', 'UA-177863655-1');
		</script>

	</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
        <div class="container">
            <a class="navbar-brand js-scroll-trigger" href="#page-top"><?=img('assets/images/logo.png',FALSE,['class'=>'navbar-brand img-fluid'])?></a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
               <?=show_menu($menus);?>
            </div>
        </div>
    </nav>
    <header class="masthead">
        <div class="container d-flex h-100 align-items-center">
            <div class="mx-auto text-center">
            	<small><?=get_option('site_pre_heading_'.$lang_bd)?></small>
                <h1 class="mx-auto "><?=get_option('site_heading_'.$lang_bd)?></h1>
                <a class="btn btn-success js-scroll-trigger btn-success-dancabrazil" href="#about"><?=get_option('button_pre_matricula_'.$lang_bd)?></a>
                <div class="position-absolute container-scroll-down">
	            	<a class="js-scroll-trigger btn-scroll-down" href="#compartilhando-amor"><i class="fa fa-chevron-down"></i></a>
	            </div>

            </div>
            
        </div>
    </header>
    <main>
    	<section id="compartilhando-amor" class="py-4">
    		<div class="container py-3">
    			<div class="row justify-content-center">
    				<div class="col-12">
    					<div class="content-compartilhando text-center">
    						<h2 class="font-playfair font-weight-bold"><?=get_option('site_sharing_love_'.$lang_bd)?></h2>
    						<?=get_option('site_sharing_love_desc_'.$lang_bd)?>
    						<p><?=img(['src'=>'assets/images/signature.png','class'=>'img-fluid','style'=>'max-width:200px'])?></p>
    					</div>
    				</div>
    			</div>
    		</div>
    	</section>
    	<section id="horarios" class="py-4 text-white">
    		<div class="container py-3">
    			<div class="card-group justify-content-center">
    				<div class="col-md-4 mb-4">
    					<div class="card h-100 border-0 bg-transparent">
    						<div class="card-body">
    							<h4>texto</h4>
    							<ul class="list-unstyled">
    								<li>asdas</li>
    							</ul>
    						</div>
    						<div class="card-footer border-0 bg-transparent">
	    						<a href="#" class="btn btn-danger btn-danger-dancabrazil text-uppercase"><?=lang('know_more')?></a>
	    					</div>
    					</div>
    					
    				</div>
    				<div class="col-md-4 mb-4">
    					<div class="card h-100 border-0 bg-transparent">
    						<div class="card-body">
    							<h4>texto</h4>
    							<ul class="list-unstyled">
    								<li>asdas</li>
    							</ul>
    						</div>
    						<div class="card-footer border-0 bg-transparent">
	    						<a href="#" class="btn btn-danger btn-danger-dancabrazil text-uppercase"><?=lang('know_more')?></a>
	    					</div>
    					</div>
    					
    				</div>
    				<div class="col-md-4 mb-4">
    					<div class="card h-100 border-0 bg-transparent">
    						<div class="card-body">
    							<h4>texto</h4>
    							<ul class="list-unstyled">
    								<li>asdas</li>
    							</ul>
    						</div>
    						<div class="card-footer border-0 bg-transparent">
	    						<a href="#" class="btn btn-danger btn-danger-dancabrazil text-uppercase"><?=lang('know_more')?></a>
	    					</div>
    					</div>
    					
    				</div>
    			</div>
    		</div>
    	</section>
    	<section id="fotos" class="py-4">
    		<div class="container py-3">
    			<div class="row justify-content-center">
    				<div class="col-12">
    					<div class="card-columns text-white">
	   						<!-- image 1 -->
							<div class="card p-0 bg-transparent border-0">
						    	<?=img(['src'=>'assets/images/cards/image_1.png','class'=>'card-img-top'])?>
						    
							</div>
							<!--middle-->
							
							
							<div class="card p-0 bg-transparent border-0">
						    	<?=img(['src'=>'assets/images/cards/image_2.png','class'=>'card-img-top'])?>
						    
							</div>
							
							
							<div class="card p-0 bg-transparent border-0">
						    	<?=img(['src'=>'assets/images/cards/image_6.png','class'=>'card-img-top'])?>
						    
							</div>

							<div class="card p-0 bg-transparent border-0 ">
								<?=img(['src'=>'assets/images/cards/image_3.png','class'=>'card-img'])?>
						    	<div class="card-img-overlay">
						    		asd
						    	</div>
						    
							</div>
							<div class="card p-0 bg-transparent border-0">
						    	<?=img(['src'=>'assets/images/cards/image_7.png','class'=>'card-img'])?>
						    	<div class="card-img-overlay bg-overlay">
						    		asd
						    	</div>
							</div>
							<div class="card p-0 bg-transparent border-0">
						    	<?=img(['src'=>'assets/images/cards/image_8.png','class'=>'card-img-top'])?>
						    
							</div>

							<div class="card p-0 bg-transparent border-0">
						    	<?=img(['src'=>'assets/images/cards/image_4.png','class'=>'card-img-top'])?>
						    
							</div>

							<div class="card p-0 bg-transparent border-0">
						    	<?=img(['src'=>'assets/images/cards/image_5.png','class'=>'card-img-top'])?>
						    
							</div>
							<div class="card p-0 bg-transparent border-0">
						    	<?=img(['src'=>'assets/images/cards/image_9.png','class'=>'card-img-top'])?>
						    
							</div>
							<!-- image 2 -->
							
 
   							
    					</div>
    				</div>
    			</div>
    		</div>
    	</section>
    	<section id="depoimentos" class="py-4">
    		<div class="container py-3">
    			<div class="row justify-content-center">

    			</div>
    		</div>
    	</section>
    	<section id="aulas" class="py-4">
    		<div class="container py-3">
    			<div class="row justify-content-center">
    				<div class="col-12">
    					<div class="content-aulas text-center">
    						<h2 class="font-playfair font-weight-bold"><?=get_option('site_online_classes_'.$lang_bd)?></h2>
    						<?=get_option('site_online_classes_desc_'.$lang_bd)?>
    						<div class="text-center">
    							 <a class="btn btn-success js-scroll-trigger btn-success-dancabrazil" href="#about"><?=get_option('button_see_classes_'.$lang_bd)?></a>
    						</div>
    					</div>
    				</div>
    			</div>
    		</div>
    	</section>
	</main>

	<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
		<script type="text/javascript" src="<?=base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')?>"></script>
		<script type="text/javascript" src="<?=base_url('assets/vendor/swiper/swiper-bundle.js')?>"></script>
		<script type="text/javascript" src="<?=base_url('assets/vendor/scrollUp/jquery.scrollUp.js')?>"></script>
		<script type="text/javascript" src="<?=base_url('assets/vendor/fancybox/jquery.fancybox.js')?>"></script>
		<script type="text/javascript" src="<?=base_url('assets/js/active.js')?>"></script>
</body>
</html>