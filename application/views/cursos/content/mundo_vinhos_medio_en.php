<?php defined('BASEPATH') OR exit('No direct script access allowed.');
?>
<div class="line_course">
	<?php $extra = "Wines of the World";?>
	<h3 class="title_course"><?=$extra?></h3>
	<?php $nivel = "Intermediate level";?>
	<h4 class="level_course"><?=$nivel?></h4>
	<div class="description_couse">
		<div class="row">
			<div class="col-md-6">
				<div class="list_item_course">
					<ul>
						<li> Classes available in English and Portuguese </li>
						<li> Duration: 6 hours (3hrs / day) </li>
						<li> Groups of at least 5 people </li>
					</ul>
				</div>
			</div>
			<div class="col-md-6">
				<div class="desc_course">
					<ul>
						<li> <strong> Content: </strong>
							<ul>
								<li>Major wine regions of the world</li>
								<li>Which wine to buy and where to buy it</li>
								<li>How to identify if a wine has cellaring potential</li>
								<li>How to evaluate the wine's cost to benefit ratio</li>
								<li>Pairing techniques</li>
								<li>Sensory analysis</li>
							</ul></li>
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