<?php defined('BASEPATH') OR exit('No direct script access allowed.');
?>
<section class="py-4 even_line_course">
	<div class="container">
		<div class="row py-3">
			<div class="col-md-12">
				<div class="content">
					<?php 
						if($language == 'pt-br'){
							$publicado = date('d/m/Y',strtotime($new['blo_datetime']));
						}else{
							$publicado = date('m/d/Y',strtotime($new['blo_datetime']));
						}
					?>
					<h1 class="line_down"><?=$new['blo_title_'.$language_bd]?></h1>
					<h6 class="text-muted"><?=str_replace(['{data}','{autor}'],[$publicado,$new['autor']['use_name']],lang('publicado_em'))?></h6>
				</div>
			</div>
		</div>
		<div class="row py-3">
			<div class="col-md-12">
				<div class="content-blog">
						<?=$new['blo_news_'.$language_bd]?>
					</div>
			</div>
		</div>
		<div class="row py-3">
			<div class="col-md-12">
				<nav aria-label="Page navigation example">
					<ul class="pagination justify-content-between">

						<li class="page-item <?=!$previ ? 'disabled':''?>"><a class="page-link btn-purple <?=!$previ ? 'disabled':''?>" <?=!$previ ? 'disabled':''?> href="<?=$previ ? base_url($language."/blog/".date('m',strtotime($previ['blo_datetime']))."/".date('Y',strtotime($previ['blo_datetime']))."/".$previ['blo_link']) : ''?>"><i class="fa fa-chevron-left"></i> <?=lang('previous_page')?> </a></li>
						<li class="page-item <?=!$next ? 'disabled':''?>"><a class="page-link btn-purple <?=!$next ? 'disabled':''?>" <?=!$next ? 'disabled':''?> href="<?=$next ? base_url($language."/blog/".date('m',strtotime($next['blo_datetime']))."/".date('Y',strtotime($next['blo_datetime']))."/".$next['blo_link']) : ''?>"><?=lang('next_page')?> <i class="fa fa-chevron-right"></i> </a></li>

					</ul>
				</nav>
			</div>
		</div>
	</div>
</section>