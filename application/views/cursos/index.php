<?php defined('BASEPATH') OR exit('No direct script access allowed.');
?>
<section class="pt-4 even_line_course">
	<div class="container">
		<div class="row py-3">
			<div class="col-md-12">
				<?php $this->load->view('cursos/content/mundo_vinhos_basico_'.str_replace('-', '_', $language)) ?>
			</div>
		</div>
		<div class="row py-3">
			<div class="col-md-12">
				<?php $this->load->view('cursos/content/mundo_vinhos_medio_'.str_replace('-', '_', $language)) ?>
			</div>
		</div>
	</div>
</section>
<section class="pt-4 odd_line_course">
	<div class="container">
		<div class="row py-3">
			<div class="col-md-12">
				<?php $this->load->view('cursos/content/vinhos_basico_'.str_replace('-', '_', $language)) ?>
			</div>
		</div>
		<div class="row py-3">
			<div class="col-md-12">
				<?php $this->load->view('cursos/content/vinhos_profissional_'.str_replace('-', '_', $language)) ?>
			</div>
		</div>
	</div>
</section>
<section id="coaching_program" class="py-5">
	<div class="container py-3">
		<div class="row justify-content-center">
			<div class="col-md-6">
				<?=img(['src'=>'assets/images/wine5.jpg','class'=>'img-fluid'])?>
			</div>
			<div class="col-md-6">
				<h4>Coaching Program</h4>
				<p><?=lang('description_coaching_program')?></p>

				<h5 class="text-muted"><?=lang('trabalhar_vinhos')?></h5>

				<a href="#" class="btn btn-success btn-success-hennekam px-4 text-uppercase" data-toggle="modal" data-target="#full_contact_1" data-type="1" data-extra="Coaching program" data-title="Coaching program"><?=lang('tell_us')?></a>
			</div>
		</div>
	</div>
</section>
