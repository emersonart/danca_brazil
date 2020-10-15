<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php if(isset($search) && $search){ ?>
			<div class="col-md-12">
				<div class="row justify-content-center">
					<div class="col-md-8">
						<?=form_open('blog',['class'=>'form','method'=>'get','id'=>'form_search']);?>
					<div class="input-group mb-3">
					  	<input type="text" name="search" placeholder="<?=lang('button_search')?>..." class="form-control" aria-label="Recipient's username" aria-describedby="button-addon2">
					  	<div class="input-group-append">
					    	<button class="btn btn-light border" type="submit" id="button-addon2"><i class="fa fa-search"></i></button>
					  	</div>
					</div>
				<?=form_close();?>
					</div>
				</div>
				
			</div>
	<?php }?>
<?php if(isset($news) && is_array($news)){
?>
	
	<div class="card-group w-100" id="card_some_news">
		<?php foreach ($news as $ln => $new) { 
			if(!isset($not_home)){
				if($ln > 1){
					break;
				}
			}
		?>

		<div class="col-md-6 single_some_new mb-3">
			<div class="card h-100">
				<?php if(is_file(set_realpath('assets/images/blog/'.$new['blo_image']))){

					$img = $new['blo_image'];
				}else{
					$img = 'default.jpg';
				}
				?>
				<img src="<?=base_url('assets/images/blog/'.$img)?>" alt="" class="card-img-top">
				<div class="card-body pl-0">
					<h2><?=$new['blo_title']?></h2>
					<p>
						<?=word_limiter(strip_tags($new['blo_news']),18,'...')?>
					</p>
				</div>
				<div class="card-footer pl-0">
					<a href="<?=base_url($language."/blog/".date('m',strtotime($new['blo_datetime']))."/".date('Y',strtotime($new['blo_datetime']))."/".$new['blo_link'])?>" class="btn btn-success btn-success-hennekam px-4"><?=lang('read_more')?></a>
				</div>
			</div>
		</div>
	<?php } ?>
	</div>	
	<?php if(isset($news) && is_array($news) && isset($total_news)){ ?>
		<div class="col-md-12 mt-3">
			<div class="row justify-content-center">
				<div class="col-md-8">
					<?php  $pages = round($total_news / $page_news); 
						if($pages > 1){
							$pages = (int)$pages - 1;
						}?>
					<nav aria-label="Page navigation example">
						<ul class="pagination justify-content-between">
							<?php if($p == 0){
								$p = 1;
							}?>
    						<li class="page-item <?=$p <= 1 ? 'disabled':''?>"><a class="page-link btn-purple <?=$p <= 1 ? 'disabled':''?>" <?=$p <= 1 ? 'disabled':''?> href="<?=$p >= 1? base_url($language."/blog".($search ? "/search/".$search : '')."/p/".($p-1)) : '#';?>"><i class="fa fa-chevron-left"></i> <?=lang('previous_page')?> </a></li>

    						<li class="page-item <?=$p >= $pages ? 'disabled':''?>"><a class="page-link btn-purple <?=$p >= $pages ? 'disabled':''?>" <?=$p >= $pages ? 'disabled':''?> href="<?=$p <= $pages ? base_url($language."/blog".($search ? "/search/".$search : '')."/p/".($p+1)) : '#';?>"><?=lang('next_page')?> <i class="fa fa-chevron-right"></i></a></li>
    					</ul>
					</nav>
				</div>
			</div>
		</div>
		
		
	<?php }?>

<?php 
}else{ ?>
	<div class="col-md-12">
		<div class="row justify-content-center">
			<div class="col-md-8 my-4">
				<h2 class="text-center"><?=lang('news_not_found')?></h2>
			</div>
		</div>
	</div>
<?php }
?>