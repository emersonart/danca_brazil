<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="container" id="blocks">
	<div class="row">
		<div class="col-md-12">
			<div class="row">
				<div class="card-group w-100" id="cards_news">

			<?php 
			if(isset($news_blocks) && is_array($news_blocks)){
				foreach ($news_blocks as $ln => $new) { ?>
					<div class="col-md-4 col-sm-4 p-0 single-card">
						<a href="<?=base_url('blog/'.date('m/Y/',strtotime($new['blo_datetime'])).$new['blo_link'])?>">
						<div class="card h-100 m-0 pt-md-3 px-md-4 pb-md-4 pt-sm-1 px-sm-2 pb-sm-2">
							<div class="card-body">
								<h2 class="text-left"><?=$new['blo_title']?></h2>
							</div>
							<div class="card-footer">
								<?=lang('call_more_news');?> <i class="fa fa-long-arrow-alt-right"></i>
							</div>
						</div>
						</a>
					</div>
			<?php 
				}
			}
			?>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="row">
				<div class="card-group w-100" id="cards_extras">
						<div class="col-md-8 col-sm-8 p-0 single-card">
							<a href="<?=base_url($language.'/cursos')?>">
								<div class="h-100 card m-0 pt-3 px-4 pb-4">
									<div class="card-body">
										<h2><?=lang('courses')?></h2>
										<p class="w-75">
											<?=lang('small_description_courses');?>
										</p>
									</div>
									<div class="card-footer">
										<?=lang('know_more')?> <i class="fa fa-long-arrow-alt-right"></i>
									</div>
								</div>
							</a>
						</div>
						<div class="col-md-4  col-sm-4 p-0 single-card">
							<a href="<?=base_url($language.'/consultoria-e-palestras')?>">
								<div class="h-100 card m-0 pt-3 px-4 pb-4">
									<div class="card-body text-left">
										<h2><?=lang('consultoria_e_palestras')?></h2>
										
											<?=lang('small_description_lectures');?>
											
										
									</div>
									<div class="card-footer">
										<?=lang('schedule_now')?> <i class="fa fa-long-arrow-alt-right"></i>
									</div>
								</div>
							</a>
						</div>
				</div>
			</div>
		</div>
	</div>
</div>