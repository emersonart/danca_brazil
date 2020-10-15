<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
		</main>
		<footer class="container-fluid py-4">
			<div class="container">
				<div class="row justify-content-between align-items-center">
					<div class="col-md-8">
						<div class="row h-100">
							<?php 
								if(is_array($social_medias)){
									foreach ($social_medias as $ln => $social_media) {
							?>
							<div class="col-md-2 col-2">
								<div class="social_item">
									<a href="<?=$social_media['soc_link']?>" target="_blank" title="<?=lang('follow_us')." ".$social_media['soc_name']?>!">
										<i  class="text-white fa-3x fab <?=$social_media['soc_icon']?>"></i>
									</a>
								</div>
							</div>
							<?php
										# code...
									}
								}
							?>
						</div>
						<div class="row my-3">
							<div class="col text-white">
								E-mail: <a href="mailto:info@hennekamwines.com" class="text-white">info@hennekamwines.com</a>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="newsletter h-100">
							<h4><?=lang('call_newsletter')?></h4>
							<div class="input-group">
								<input type="email" class="form-control" id="email_newsletter" placeholder="<?=lang('email_input')?>">
								<div class="input-group-append">
									<button class="btn btn-success btn-success-hennekam" data-target="#md_newsletter" data-toggle="modal">
										<i class="fa fa-check"></i>
									</button>
								</div>
							</div>
							<p class="small">
								<small><?=lang('small_newsletter')?></small>
							</p>
							
						</div>
					</div>
				</div>
			</div>
		</footer>
		<?php $this->load->view('site/__modals/newsletter');?>
		<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
		<script type="text/javascript" src="<?=base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')?>"></script>
		<script type="text/javascript" src="<?=base_url('assets/vendor/swiper/swiper-bundle.js')?>"></script>
		<script type="text/javascript" src="<?=base_url('assets/vendor/scrollUp/jquery.scrollUp.js')?>"></script>
		<script type="text/javascript" src="<?=base_url('assets/vendor/fancybox/jquery.fancybox.js')?>"></script>
		<script type="text/javascript" src="<?=base_url('assets/js/active.js')?>"></script>
		<?php $this->load->view('site/__modals/send_ajax');?>
		<?php $this->load->view('site/__modals/contact');?>
		<script>
			$(document).ready(function(){
				$('#form_search').on('submit',function(e){
					e.preventDefault();
					var data = $('#form_search input[name="search"]').val();
					if(data != ''){
						window.location.href = "<?=base_url($language."/".$this->uri->segment(2).'/search');?>/" + data;
					}
					

				});
				if($('.page-link[data-ci-pagination-page]').length){
					<?php if(isset($page)){ 
						if($page == 0 || $page == 1){
							$page = 1;
						}?>
						$('.page-link').each(function(i,el){
							$(el).parent().removeClass('active');
						})
						<?php if($page > 1){ ?>
							$(document).find('.page-link[data-ci-pagination-page="'+<?=$page?>+'"]').parent().addClass('active');
							$(document).find('.page-link').eq(0).attr('href',base_url + 'blog/p/1');
						<?php }else{ ?>
							$(document).find('.page-link').eq(0).attr('href',base_url + 'blog/p/1');
							$(document).find('.page-item[aria-current="page"]').addClass('active');
						<?php } ?>
						
					<?php } ?>
				}
			})
			
		</script>

	</body>
</html>
