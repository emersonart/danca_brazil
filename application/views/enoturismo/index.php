<?php defined('BASEPATH') OR exit('No direct script access allowed.');
?>
<section class="py-4 even_line_course">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-10">
				<h4 class="text-center mb-5 mt-2">
					<?php if($language == 'pt-br'){ ?>
						Todos os passeios são personalizados de acordo com os desejos do cliente. Fale conosco para determinar sua experiência perfeita na Austrália. Desfrute os melhores vinhos australianos com uma especialista no assunto.
					<?php }else{ ?>
						All tours are personalized according to the wishes of the client. Speak with us to determine your perfect Australian Wine experience, then relax and enjoy some Australian wines with your personal expert.
					<?php } ?>
				</h4>
			</div>
		</div>
		<div class="row py-3">
			<div class="col-md-12">
				<div class="content">
					<h2 class="line_down"><?=lang('escolha_roteiro')?></h2>
					<ul class="row mt-3">
						<?php $this->load->view('enoturismo/content/list_'.str_replace('-', '_', $language)) ?>
					</ul>

				</div>
			</div>
		</div>
		<div class="row py-3">
			<div class="col-md-12">
				<div class="content">
					<h2 class="line_down"><?=lang('outras_regioes')?></h2>
					<ul class="row mt-3">
						<?php $this->load->view('enoturismo/content/list2_'.str_replace('-', '_', $language)) ?>
					</ul>
					<div class="text-center">
						<a href="#" class="btn btn-purple px-3" data-toggle="modal" data-target="#full_contact_1" data-type="5"  data-title="<?=$heading?>"><?=lang('faca_tour')?></a>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<?php 

	$this->load->helper('path');
	$directory = set_realpath('assets/images/enoturismo'); //edit path
	$images = glob($directory.'*.{jpg,png}', GLOB_BRACE);
?>
<section id="fotos_hennekam" class="">
	<div id="slide_enoturismo" class="swiper-container">
	    <!-- Additional required wrapper -->
	    <div class="swiper-wrapper">
	        <!-- Slides -->
	        <?php 
	        if($images){

	        	foreach ($images as $image) { 
	        		$imagem = basename($image);
					$image = base_url('assets/images/enoturismo/'.$imagem);
	        ?>
	        	<div class='swiper-slide'>
            		<a href='<?php echo $image; ?>' data-fancybox="enoturismo" target='_blank' style="background-image: url('<?php echo $image; ?>')" class="instagram-images d-block">
	            		<img class="img-fluid" style="height:auto" src="<?=base_url('assets/images/lens.png');?>"/>

            		</a>
            	</div>
	        <?php
	        	}
	        }
	        ?>
		</div>
	    <!-- If we need navigation buttons -->
	    <div class="swiper-button-prev"></div>
	    <div class="swiper-button-next"></div>

	</div>
</section>
