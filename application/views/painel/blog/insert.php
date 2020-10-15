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
            	<?=form_open_multipart()?>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="has-float-label">
                                <input type="text" autocomplete="off" class="form-control form-round form-creser" name="blo_title_pt_br" id="title_to_pt_br" value="<?=set_value('blo_title_pt_br')?>" placeholder="Título em Português">
                                <span for="title_to_pt_br">Título em Português</span>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="has-float-label">
                                <input type="text" autocomplete="off" class="form-control form-round form-creser" name="blo_title_en" id="title_to_en" value="<?=set_value('blo_title_en')?>" placeholder="Título em Inglês">
                                <span for="title_to_en">Título em Inglês</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="has-float-label">
                                <input type="text" autocomplete="off" class="form-control form-round form-creser" name="blo_link" id="no_caracter" placeholder="Link personalizado" value="<?=set_value('blo_link')?>">
                                <span for="no_caracter">Link personalizado</span>
                                </label>
                                <small class="text-muted">Se não preencher este campo, o sistema irá gerar automaticamente com base no idioma português</small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                 <?php
                                $attr_s = [
                                    'class' => 'select2 form-control',
                                    'multiple' => 'multiple',
                                    'data-tags'=> "true",
                                    'data-placeholder' => "Selecionar tags (separado por ' , ', 'espaço' ou ';'",
                                    'id'=>'tags'
                                ];
                                echo form_dropdown('tags[]',$tags,set_value('tags[]'),$attr_s)?>
                               <!-- 	<select name="tags[]" id="tags" multiple data-tags="true" class="select2 form-control" data-placeholder="Selecionar Tags (separado por ' , ', 'espaço' ou ';')">
                           		<?php foreach($tags as $id => $tag){?>
                           			<option value="<?=$id?>"><?=$tag?></option>
                           		<?php }?>
                               	</select> -->
                                <small class="text-muted">Ao inserir uma tag que ainda não existe, será criado uma nova tag com o mesmo nome para todos os idiomas, para alterar utilizar a seção <strong>tags</strong>.</small>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                    	<div class="col-md-6">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="inputGroupFile01" name="images[blo_image]" aria-describedby="inputGroupFileAddon01">
                                                <label class="custom-file-label" for="inputGroupFile01" data-text="Procurar">Imagem</label>

                                            </div>
                                        </div>
                                        <small class="text-muted">Imagem usada para compartilhamento em redes sociais</small>
                                    </div>
                                    
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="inputGroupFile02" name="images[blo_cover]" aria-describedby="inputGroupFileAddon02" >
                                                <label class="custom-file-label" for="inputGroupFile02" data-text="Procurar">Capa</label>
                                            </div>
                                        </div>
                                        <small class="text-muted">Imagem usada no cabeçalho do post</small>
                                    </div>
                                   
                                </div>
                            </div>
                    		
                    	</div>
                        <div class="col-md-6">
                            <div class="custom-control custom-switch custom-switch-md">
                                <input type="checkbox" class="custom-control-input" name="blo_send_to_email" value="1" id="customSwitch1" checked>
                                <label class="custom-control-label text-dark" style="font-size: 1.2em;cursor:pointer;" for="customSwitch1">Enviar para inscritos</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                    	<div class="col-md-12">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                              <li class="nav-item">
                                <a class="nav-link active" id="pt-br-tab" data-toggle="tab" href="#pt_br" role="tab" aria-controls="home" aria-selected="true">Português</a>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link" id="en-tab" data-toggle="tab" href="#en" role="tab" aria-controls="profile" aria-selected="false">Inglês</a>
                              </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="pt_br" role="tabpanel" aria-labelledby="home-tab">
                                    <div class="form-group">
                                        <textarea name="blo_news_pt_br" id="news_pt" class="summernote form-control" rows="10">
                                            <?=set_value('blo_news_pt_br')?>
                                                
                                            </textarea>
                                    </div>
                                </div>
                                <div class="tab-pane fade show" id="en" role="tabpanel" aria-labelledby="home-tab">
                                    <div class="form-group">
                                        <textarea name="blo_news_en" id="blo_news_en" class="summernote form-control" rows="10">
                                            <?=set_value('blo_news_en')?>
                                        </textarea>
                                    </div>
                                </div>
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
