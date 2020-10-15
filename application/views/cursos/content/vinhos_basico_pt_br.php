<?php defined('BASEPATH') OR exit('No direct script access allowed.');
?>
<div class="line_course">
	<?php $extra = "Vinhos australianos";?>
	<h3 class="title_course"><?=$extra?></h3>
	<?php $nivel = "Nível Principiante";?>
	<h4 class="level_course"><?=$nivel?></h4>
	<div class="description_couse">
		<div class="row">
			<div class="col-md-6">
				<div class="list_item_course">
					<strong class="pb-3 pt-2 d-block">APRENDA COM UMA ESPECIALISTA EM VINHOS AUSTRALIANOS</strong>
					<ul>
						<li>Aulas disponíveis em inglês e português</li>
						<li>Carga horária: 2 horas</li>
						<li>Aulas individuais ou em grupos</li>
					</ul>
				</div>
			</div>
			<div class="col-md-6">
				<div class="desc_course">
					<ul>
						<li><strong>Conteúdo:</strong> 
							<ul>
								<li>A história dos vinhos australianos</li>
								<li>As principais regiões viticultoras da Austrália</li>
								<li>Terroir australiano</li>
								<li>As principais uvas e vinhos da Austrália</li>
								<li>Análise sensorial de 2 vinhos australianos</li>
							</ul>
						</li>
					</ul>
					
				</div>
			</div>
			<div class="col-md-12">
				<small class="obs_course">
						* O valor do curso não inclui o valor dos vinhos que serão usados na análise sensorial.<br>
						** Todos os cursos promovidos pela Hennekam disponibilizam certificados.
					</small>
			</div>
		</div>
	</div>
	<div class="text-center py-3">
		<a href="#" class="btn btn-purple px-3" data-toggle="modal" data-target="#full_contact_1" data-type="4" data-extra="<?=$extra." - ".$nivel?>" data-title="<?=$extra." - ".$nivel?>"><?=lang('enquire_now')?></a>
	</div>
</div>