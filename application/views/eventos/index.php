<?php defined('BASEPATH') OR exit('No direct script access allowed.');
?>
<section class="py-4 even_line_course">
	<div class="container">
		<div class="row py-3">
			<div class="col-md-12">
				<div class="content">
					<h2 class="line_down"><?=lang('have_sommelier');?></h2>
					<ul class="row mt-3 text-justify">
						<?php $this->load->view('eventos/content/list_'.str_replace('-', '_', $language)) ?>
						
					</ul>
					<div class="text-center my-4">
	<a href="#" data-toggle="modal" data-target="#full_contact_1" data-type="2" data-title="<?=lang('faca_reserva_wine')?>" class="btn btn-purple px-3"><?=lang('faca_reserva_wine')?></a>
</div>
				</div>
			</div>
		</div>
	</div>
</section>
<?php $this->load->view('quem_sou/__snippets/slide_hennekam')?>


<section id="organize_e">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-12">
				<div class="text-center">
					<h3 class="line_down_center text-center mt-4"><?=lang('title_organize_evento')?></h3>
				</div>
				
			</div>
		</div>

		<div class="row justify-content-center">
			<div class="col-md-6">
				<p class="text-center">
					<?=lang('desc_organize_evento')?>
				</p>
			</div>
		</div>
		<div class="row justify-content-center">
			<div class="col-md-6">
				<a href="https://www.youtube.com/watch?v=ZBDifgxNQUE" class="play-button" data-fancybox >
					<div>
						<picture>
							<?=img(['src'=>'https://i3.ytimg.com/vi/ZBDifgxNQUE/sddefault.jpg','class'=>'img-fluid rounded-lg w-100 my-3'])?>
						</picture>
						
					</div>
					
				</a>
			</div>
		</div>
		
		
	</div>
</section>
