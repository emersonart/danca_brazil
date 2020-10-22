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
<body data-baseurl="<?=base_url()?>" data-csrf="<?=$this->security->get_csrf_token_name()?>" data-lang="<?=get_language()?>">
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
        <?php if(isset($testimonials) && is_array($testimonials)){ ?>
    	<section id="depoimentos" class="py-4">
    		<div class="container py-3">
    			<div id="slide_testimonials" class="swiper-container py-3">
                    <div class="swiper-wrapper">
                    <?php foreach ($testimonials as $key => $testimonial) { ?>
                        <div class="swiper-slide">
                            <div class="card border-0 bg-transparent">
                                <div class="card-body align-items-center">
                                    <div class="row align-items-center justify-content-center text-center">
                                        <?php /*
                                        <div class="col-md-4 col-4 text-center">
                                            <?php if($testimonial['tes_image'] && is_file(set_realpath('assets/images/testimonials/'.$testimonial['tes_image']))){ ?>
                                                <?=img(['src'=>'assets/images/testimonials/'.$testimonial['tes_image'],'class'=>'img-fluid rounded-circle','style'=>'width:150px;'])?>
                                            <?php }else{ ?>
                                                <?=img(['src'=>'assets/images/user.png','class'=>'img-fluid rounded-circle','style'=>'width:150px;'])?>
                                            <?php } ?>
                                            
                                        </div>
                                        */ ?>
                                        <div class="col-md-12 text-center">
                                            <?php if($language == 'en'){
                                                if(!empty($testimonial['tes_testimonial_en'])){
                                                    echo "<p class='text-center aspas'><span>".'“'."</span>".$testimonial['tes_testimonial_en']."<span>".'”'."</span></p>";
                                                }else{
                                                    echo "<p class='text-center aspas'><span>".'“'."</span>".$testimonial['tes_testimonial_pt_br']."<span>".'”'."</span></p>";
                                                }
                                                
                                            }else{
                                                if(!empty($testimonial['tes_testimonial_pt_br'])){
                                                    echo "<p class='text-center aspas'><span>".'“'."</span>".$testimonial['tes_testimonial_pt_br']."<span>".'”'."</span></p>";
                                                }else{
                                                    echo "<p class='text-center aspas'><span>".'“'."</span>".$testimonial['tes_testimonial_en']."<span>".'”'."</span></p>";
                                                }
                                            }
                                            ?>
                                            <p class="owner"><?=$testimonial['tes_name']?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>

                    </div>   
                    <div class="swiper-pagination"></div>      
                </div>
    		</div>
    	</section>
    <?php } ?>
    	<section id="aulas" class="py-4">
    		<div class="container py-3">
    			<div class="row justify-content-center">
    				<div class="col-12">
    					<div class="content-aulas text-center">
    						<h2 class="font-playfair font-weight-bold"><?=get_option('site_heading_videos_'.$lang_bd)?></h2>
    						<?=get_option('site_heading_videos_desc_'.$lang_bd)?>
    					</div>
    				</div>
    			</div>
    		</div>
    	</section>
        
        <section id="canal" class="py-4">
            <div class="container py-3">
                <div class="row justify-content-center">
                    <div class="col-12">
                        <div class="content-aulas text-center">
                            <h2 class="font-playfair font-weight-bold"><?=get_option('site_channel_'.$lang_bd)?></h2>
                            <?=get_option('site_channel_desc_'.$lang_bd)?>
                        </div>
                    </div>
                </div>
                <?php if(isset($videos) && is_array($videos)){ ?>
                    <div class="row justify-content-center">
                        <div class="col-10">
                            <div class="card-group justify-content-center">
                                <?php foreach ($videos as $key => $video) { ?>
                                    <div class="col-md-6">
                                        <div class="card border-0">
                                            <a href="<?=$video['vid_link']?>" data-fancybox="canal" class="play-button no-text">
                                                <div>
                                                    <?=img(['src'=>$video['vid_image'], 'class'=>'card-img-top'])?>
                                                </div>
                                                
                                            </a>
                                            <div class="card-body">
                                                <a href="<?=$video['vid_link']?>" target="_blank">
                                                    <h4><?=$video['vid_title_'.$lang_bd]?></h4>
                                                    <?php if($lang_bd == 'en'){ ?>
                                                    <p class="date"><?=strftime('%b %d, %Y')?></p>
                                                    <?php }else{ ?>
                                                    <p class="date"><?=strftime('%d de %b de %Y')?></p>
                                                    <?php } ?>
                                                    <p class="text-muted"><?=$video['vid_description_'.$lang_bd]?></p>
                                                </a>

                                            </div>

                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>       
                </div>
                <?php } ?>
            </div>
        </section>
        <?php if(isset($team) && is_array($team)){ ?>
        <section id="team" class="py-4">
            <div class="container pt-3 pb-1">
                <div id="slide_team" class="swiper-container py-3">
                    <div class="swiper-wrapper">
                    <?php foreach ($team as $key => $equipe) { ?>
                        <div class="swiper-slide">
                            <div class="content_team" style="background-image: url('/assets/images/team/<?=$equipe['tea_image'] ? $equipe['tea_image'] : 'user.png'?>')">
                                <div class="content_desc_team">
                                    <h5><?=$equipe['tea_name']?></h5>
                                    <?=$equipe['tea_description_'.$lang_bd]?>
                                </div>
                            </div>
                            
                        </div>
                    <?php } ?>

                    </div>   
                    <div class="swiper-pagination"></div>      
                </div>
            </div>
        </section>
    <?php } ?>
    <section id="contato" class="py-4">
        <div class="container py-3">
            <div class="row justify-content-between">
                <div class="col-md-5">
                    <h2><?=get_option('site_heading_contact_'.$lang_bd)?>:</h2>
                    <p class="text-muted">
                        <?=get_option('site_desc_contact_'.$lang_bd)?>
                    </p>
                    <address>
                    <?php if(get_option('site_address') != ''){ ?>
                        <p>
                            <strong><?=lang('address')?>:</strong> <span class="text-muted"><?=get_option('site_address')?></span>
                        </p>
                    <?php } ?>
                    <?php if(get_option('site_phone') != ''){ ?>
                        <p>
                            <strong><?=lang('phone')?>:</strong> <span class="text-muted"><?=get_option('site_phone')?></span>
                        </p>
                    <?php } ?>
                    <?php if(get_option('site_email') != ''){ ?>
                        <p>
                            <strong>E-mail:</strong> <span class="text-muted"><a class="text-muted" href="mailto:<?=get_option('site_email')?>"><?=get_option('site_email')?></a></span>
                        </p>
                    <?php } ?>
                    <?php if(get_option('site_fax') != ''){ ?>
                        <p>
                            <strong>Fax:</strong> <span class="text-muted"><?=get_option('site_fax')?></span>
                        </p>
                    <?php } ?>
                    </address>
                </div>
                <div class="col-md-7">
                    <?=form_open(get_language().'/api/contact',['id'=>"form_contact_all","autocomplete"=>"off","class"=>"ajax_request"]);?>
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="has-float-label">
                                        <input type="text" autocomplete="off" class="form-control" name="con_name" id="con_name" placeholder="<?=lang('name_input')?>" required>
                                        <span for="con_name"><?=lang('name_input')?></span>
                                    </label>
                                </div>      
                                
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="has-float-label">
                                        <input type="email" autocomplete="off" class="form-control" name="con_email" id="con_email" placeholder="E-mail" required>
                                        <span for="con_name">E-mail</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="has-float-label">
                                        <input type="text" autocomplete="off" class="form-control" name="con_subject" id="con_subject" placeholder="<?=lang('subject_input')?>" required>
                                        <span for="con_subject"><?=lang('subject_input')?></span>
                                    </label>
                                </div> 
                            </div>
                             
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <label class="has-float-label">
                                    <textarea autocomplete="off" class="form-control" name="con_message" id="con_message" placeholder="<?=lang('message_input')?>" rows="5" required></textarea> 
                                    <span for="con_message"><?=lang('message_input')?></span>
                                </label>
                            </div>
                            
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <button class="btn btn-dark btn-dark-dancabrazil" type="submit"><?=lang('send_button')?></button>
                            </div>
                        </div>
                    <?=form_close();?>

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
    <?php $this->load->view('site/__modals/send_ajax');?>

</body>
</html>