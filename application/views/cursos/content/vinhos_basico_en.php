<?php defined('BASEPATH') OR exit('No direct script access allowed.');
?>
<div class="line_course">
	<?php $extra = "Australian Wines";?>
	<h3 class="title_course"><?=$extra?></h3>
	<?php $nivel = "Beginner level";?>
	<h4 class="level_course"><?=$nivel?></h4>
	<div class="description_couse">
		<div class="row">
			<div class="col-md-6">
				<div class="list_item_course">
					<strong class = "pb-3 en-2 d-block"> LEARN FROM AN AUSTRALIAN WINE SPECIALIST </strong>
					<ul>
						<li> Classes available in English and Portuguese </li>
						<li> Duration: 2 hours </li>
						<li> Individual or groups classes </li>
					</ul>
				</div>
			</div>
			<div class="col-md-6">
				<div class="desc_course">
					<ul>
						<li> <strong> Content: </strong> 
							<ul>
								<li>History of Australian wines</li>
								<li>Principal growing regions</li>
								<li>The Australian terroir</li>
								<li>Australia's main grapes and wines</li>
								<li>Sensory analysis of 2 Australian wines</li>
							</ul>
						</li>
					</ul>
					
				</div>
			</div>
			<div class="col-md-12">
				<small class="obs_course">
					* The value of the course does not include the value of the wines that will be used in sensory analysis.<br>
					** All courses offered by Hennekam include a certificate upon completion.
				</small>
			</div>
		</div>
	</div>
	<div class="text-center py-3">
		<a href="#" class="btn btn-purple px-3" data-toggle="modal" data-target="#full_contact_1" data-type="4" data-extra="<?=$extra." - ".$nivel?>" data-title="<?=$extra." - ".$nivel?>"><?=lang('enquire_now')?></a>
	</div>
</div>