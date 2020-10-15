<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php if($testimonials) { ?>
<section id="depoimentos" class="py-4" >
	<div class="container-fluid">
		<div class="container">
			<h3><?=lang('talk_about');?></h3>
			<div id="slide_testimonials" class="swiper-container py-3">
			    <!-- Additional required wrapper -->
			    <div class="swiper-wrapper">
			        <!-- Slides -->
			        <?php foreach ($testimonials as $key => $testimonial) { ?>
			        	
			        <div class="swiper-slide">
				        <div class="card border-0">
				        	<div class="card-body align-items-center">
					        	<div class="row align-items-center justify-content-center">
					        		<div class="col-md-4 col-4 text-center">
					        			<?php if($testimonial['tes_image'] && is_file(set_realpath('assets/images/testimonials/'.$testimonial['tes_image']))){ ?>
					        				<?=img(['src'=>'assets/images/testimonials/'.$testimonial['tes_image'],'class'=>'img-fluid rounded-circle','style'=>'width:150px;'])?>
					        			<?php }else{ ?>
					        				<?=img(['src'=>'assets/images/user.png','class'=>'img-fluid rounded-circle','style'=>'width:150px;'])?>
					        			<?php } ?>
					        			
					        		</div>
					        		<div class="col-md-8 col-12">
					        			<?php if($language == 'en'){
					        				if(!empty($testimonial['tes_testimonial_en'])){
					        					echo "<p class='text-left'>".$testimonial['tes_testimonial_en']."</p>";
					        				}else{
					        					echo "<p class='text-left'>".$testimonial['tes_testimonial_pt_br']."</p>";
					        				}
					        				
					        			}else{
					        				if(!empty($testimonial['tes_testimonial_pt_br'])){
					        					echo "<p class='text-left'>".$testimonial['tes_testimonial_pt_br']."</p>";
					        				}else{
					        					echo "<p class='text-left'>".$testimonial['tes_testimonial_en']."</p>";
					        				}
					        			}
					        			?>
					        		</div>
					        	</div>
					        </div>
				        </div>
				    </div>
				<?php } ?>
				</div>
				<div class="swiper-button-prev"></div>
	    		<div class="swiper-button-next"></div>
			</div>
					
		</div>
	</div>
</section>
<?php }?>
