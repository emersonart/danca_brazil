<?php defined('BASEPATH') OR exit('No direct script access allowed.');
?>
<section id="profile" class="pt-5">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-4">
				<aside class="px-5">
					<div class="profile text-center mb-3">
						<?=img(['src'=>'assets/images/perfil_hennekam.jpg','class'=>'img-fluid'])?>
					</div>
					<div class="socials_media text-center">
						<a href="#" data-toggle="modal" data-target="#full_contact_1" data-type="1" data-title="<?=lang('contact_specialist2')?>" class="btn btn-success btn-block btn-success-hennekam px-4 text-uppercase mb-3"><?=lang('contact_specialist2')?></a>
						<a href="https://www.linkedin.com/in/priscilla-hennekam-bb3243123/"  target="_blank" class="btn btn-primary btn-block btn-primary-hennekam px-4 text-uppercase mb-4"><?=lang('check_linkedin')?></a>
					</div>
				</aside>
			</div>
			<div class="col">
				<div class="quem_sou mb-5">
					<h2 class="mb-1">Priscilla Hennekam</h2>
					<h3 class="mb-3">Wine Specialist</h3>
					<p>It all started at the Faculty of Tourism, at the Universidade do Estado do Rio Grande do Norte (UERN) in my home city of Natal, during a subject on wine and gastronomy… it was there that a dream was born! I was so fascinated by this new world I was discovering, that I decided to do my thesis on ‘Enogastronomy’ (the art of combining food and wine), and I started to dream even bigger.</p>

					<p>After I graduated, I did something completely unknown for a young, 22-year old girl from the north-east of Brazil, who had never even been to São Paulo. Without knowing anyone, without a job, and even without really having a proper plan, I took a huge risk, resigned from my stable job, and moved to another country. Where, you ask? Where else, but Mendoza, Argentina?</p>

					<p>I lived in Argentina for 4 years, where I worked with wine tourism, wine sales, wine events & promotions and finally as a sommelier in a 5-star hotel. Since then I have visited more than 30 wine regions around the world - in Europe alone I visited nine countries, interviewing winemakers and joining in private tastings exclusively for wine professionals. I participated in the 2018 vintage in Mosel, Germany and worked during the 2019 vintage in Barossa Valley, Australia. Today I am living in Australia, where I work with wine tourism, education and wine sales, as well as working to promote Australian wines in the Brazilian market at Hennekam Wines both online and through regular trips to Brazil.</p>
					
					<h5 class="mt-5"><strong>Academic Education</strong></h5>
					<p class="">
						<strong>Diploma of Wine [Level 4] </strong> – currently studying<br/>
						Wine & Spirits Education Trust [WSET] (London, UK)<br/>
						WSET Level 3 passed with Distinction<br/>

						<strong>Certified Sommelier [Level 2]</strong><br/>
						Court of Master Sommelier (USA)<br/>
						<strong>Diploma of International Sommelier</strong><br/>
						Escuela Argentina de Sommelier (Mendoza, Argentina)<br/>
						CETT-UB (Barcelona, Spain)<br/>

						<strong>Bachelor of Tourism</strong><br/>
						UERN (Natal, Brazil)
					</p>
					

				</div>
			</div>
		</div>
	</div>
</section>
<?php $this->load->view('quem_sou/__snippets/slide_hennekam'); ?>
