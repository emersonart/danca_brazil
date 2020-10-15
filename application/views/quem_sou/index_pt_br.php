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
						<a href="#" data-toggle="modal" data-target="#full_contact_1" data-type="1" data-title="<?=lang('contact_specialist')?>" class="btn btn-success btn-block btn-success-hennekam px-4 text-uppercase mb-3"><?=lang('contact_specialist')?></a>
						<a href="https://www.linkedin.com/in/priscilla-hennekam-bb3243123/" target="_blank" class="btn btn-primary btn-block btn-primary-hennekam px-4 text-uppercase mb-4"><?=lang('check_linkedin')?></a>
					</div>
				</aside>
			</div>
			<div class="col">
				<div class="quem_sou">
					<h2 class="mb-1">Priscilla Hennekam</h2>
					<h3 class="mb-3">Especialista em vinhos</h3>
					<p>Tudo começou na Faculdade de Turismo, na Universidade do Estado do Rio Grande do Norte (UERN), durante uma matéria sobre vinho e gastronomia... Foi lá que um sonho nasceu! Fiquei tão fascinada por esse novo mundo que eu estava descobrindo, que decidi fazer minha monografia sobre 'Enogastronomia' (a arte de combinar comida e vinho), e comecei a sonhar ainda mais alto!</p>

					<p>Depois que eu me formei, fui direto viver algo completamente desconhecido para uma garota de 22 anos do Nordeste do Brasil, que nunca tinha ido nem para São Paulo, imagine morar em outro país. Sem conhecer ninguém, sem emprego, na verdade eu não sabia muito bem o que eu ia fazer, mas me arrisquei, renunciei o meu emprego estável e fui morar em outro país. Adivinha onde? Onde mais eu poderia ir?  Claro que meu destino era Mendoza, Argentina!</p>

					<p>Morei na Argentina por 4 anos, onde trabalhei com enoturismo, eventos, vendas e promoções de vinhos e por último como sommelier em um hotel 5 estrelas. Desde então visitei mais de 30 regiões vinícolas ao redor do mundo - só na Europa visitei nove países, entrevistando viticultores e participando de degustações privadas exclusivas para profissionais do vinho. Participei da vindima 2018 em Mosel, Alemanha e trabalhei durante a vindima 2019 em Barossa Valley, Austrália. Hoje estou morando na Austrália, onde trabalho com o enoturismo, educação e vendas de vinhos, além de trabalhar promovendo vinhos australianos no mercado brasileiro no Hennekam Wines.</p>
					
					<h5 class="mt-5"><strong>Formação Acadêmica</strong></h5>
					<p class="">
						<strong>Diploma de Vinho [Nível 4]</strong> – Cursando<br/>
						Wine & Spirits Education Trust [WSET] (Londres, Reino Unido)<br/>
						WSET Nível 3 - Distinção<br/>
						<strong>Sommelier Certificado [Nível 2]</strong><br/>
						Court of Master Sommelier (Estados Unidos)<br/>
						<strong>Diploma de Sommelier Internacional</strong><br/>
						Escuela Argentina de Sommelier (Mendoza, Argentina)<br/>
						CETT-UB (Barcelona, Spain)<br/>
						<strong>Bacharelado em Turismo</strong><br/>
						UERN (Natal, Brasil)
					</p>
					

				</div>
			</div>
		</div>
	</div>
</section>
<?php $this->load->view('quem_sou/__snippets/slide_hennekam'); ?>