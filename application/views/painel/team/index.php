<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				<a href="<?=base_url('painel/team/insert')?>" class="btn btn-sm btn-success float-right">Cadastrar</a>
				<h5 class="title d-inline-block"><?=$heading;?></h5>        
			</div>
			<div class="card-body">
			<?php 
			
				$template = array(
						'table_open' => '<div class="table-responsive"><table class="table data-table table-hover table-stripped" id="news">',
						'table_close' => '</table></div>',
						'thead_open' => '<thead style="background: #F2F2F2">'
				);
				$this->table->set_template($template);
				$this->table->set_heading(array('Id','Data','Nome','Exibir','Ações'));
				echo $this->table->generate($team);

			?>
			</div>
		</div>
	</div>
</div>


