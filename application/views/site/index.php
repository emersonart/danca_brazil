<?php defined('BASEPATH') OR exit('No direct script access allowed.');
?>
<section id="some_news" class="container-fluid py-5">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-10">
				<div class="row">
					<?php $this->load->view('site/__snippets/cards_news')?>
				</div>
				
			</div>
		</div>

	</div>
</section>
<?php if(!isset($not_show_dinners)){ ?>
<?php $this->load->view('site/__snippets/dinners_and_launchs')?>
<?php }?>
<?php $this->load->view('site/__snippets/testimonials')?>