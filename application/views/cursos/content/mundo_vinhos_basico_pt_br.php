<?php defined('BASEPATH') OR exit('No direct script access allowed.');
?>
<div class="line_course">
	<?php $extra = "O mundo dos vinhos";?>
	<h3 class="title_course"><?=$extra?></h3>
	<?php $nivel = "Nível básico";?>
	<h4 class="level_course"><?=$nivel?></h4>
	<div class="description_couse">
		<div class="row">
			<div class="col-md-6">
				<div class="list_item_course">
					<ul>
						<li>Aulas disponíveis em inglês e português</li>
						<li>Carga horária: 4 horas</li>
						<li>Grupos, de no mínimo, 5 pessoas</li>
					</ul>
				</div>
			</div>
			<div class="col-md-6">
				<div class="desc_course">
					<ul>
						<li><strong>Conteúdo:</strong> 
							<ul>
								<li>História do vinho</li>
								<li>Velho Mundo x Novo Mundo</li>
								<li>Tipos de uvas</li>
								<li>Elaboração de vinhos</li>
								<li>Influência do carvalho no vinho</li>
								<li>Harmonização de vinhos com comida</li>
								<li>Análise sensorial</li>
							</ul></li>
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