<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				<h5 class="title d-inline-block"><?=$heading;?></h5>
			</div>
			<div class="card-body">
				<?=form_open()?>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="has-float-label">
								<input type="text" autocomplete="off" class="form-control form-round form-creser" name="sch_title_pt_br" id="title_to_pt_br" placeholder="Título em Português"  value="">
								<span for="title_to_pt_br">Título em Português</span>
								</label>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="has-float-label">
								<input type="text" autocomplete="off" class="form-control form-round form-creser" name="sch_title_en" id="title_to_en" placeholder="Título em Inglês" value="" >
								<span for="title_to_en">Título em Inglês</span>
								</label>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="has-float-label">
								<input type="text" autocomplete="off" class="form-control form-round form-creser" name="sch_day_pt_br" placeholder="Dia em português" value="" >
								<span for="no_caracter">Dia em português</span>
								</label>
								
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="has-float-label">
								<input type="text" autocomplete="off" class="form-control form-round form-creser" name="sch_day_en" placeholder="Dia em inglês" value="" >
								<span for="no_caracter">Dia em Inglês</span>
								</label>
								
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="has-float-label">
								<input type="text" autocomplete="off" readonly class="form-control form-round form-creser timepm" name="sch_hour" placeholder="Hora" value="" >
								<span for="no_caracter">Hora</span>
								</label>
								
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="has-float-label">
									<select name="sch_show" id="sch_show" class="form-control" style="padding-top: 5px;">
										<option value="0"  >Não</option>
										<option value="1" selected >Sim</option>
									</select>
								</label>
								<small class="text-muted">Exibição</small>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="has-float-label">
								<input type="text" autocomplete="off" class="form-control form-round form-creser" name="sch_link" id="no_caracter" placeholder="Link personalizado" value="" >
								<span for="no_caracter">Link personalizado</span>
								</label>
								<small class="text-muted">Se não preencher este campo, o sistema irá gerar automaticamente com base no idioma português</small>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">

								<?php
								

								$js = array(
										'id'       => 'curs',
										'multiple' => 'multiple',
										'data-curs' => "true",
										"class"=> "select2 form-control",
										"data-placeholder" => "Selecionar Cursos (separado por ' , ', 'espaço', ou ';'"
									);
								echo form_dropdown('cursos[]',$cursos,null,$js)?>

							
							</div>
						</div>
					</div>
					<div class="row justify-content-center">
						<div class="col-md-4">
							<button type="submit" class="btn btn-success btn-block">Salvar</button>
						</div>
					</div>
				<?=form_close()?>
			</div>
		</div>
	</div>
</div>
