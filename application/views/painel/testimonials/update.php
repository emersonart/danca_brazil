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
                                    <input type="text" autocomplete="off" class="form-control form-round form-creser" name="tes_name" id="tes_name" value="<?=$depoimento['tes_name']?>" placeholder="Título em Português">
                                    <span for="tes_name">Nome</span>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="custom-control custom-switch custom-switch-md">
                                <input type="checkbox" class="custom-control-input" name="tes_show" value="1" id="customSwitch1" <?=$depoimento['tes_show'] == 1 ? 'checked' : ''?>>
                                <label class="custom-control-label text-dark" style="font-size: 1.2em;cursor:pointer;" for="customSwitch1">Exibir</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mb-4">
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="inputGroupFile01" name="images[tes_image]" aria-describedby="inputGroupFileAddon01">
                                        <label class="custom-file-label" for="inputGroupFile01" data-text="Procurar">Imagem</label>

                                    </div>
                                </div>
                                <small class="text-muted">Foto <a href="#" data-target="#visualizar_imagem_tes" data-toggle="modal" data-imagem="<?=$depoimento['tes_image']?>">Visualizar</a></small>
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
                                        <textarea name="tes_testimonial_pt_br" id="tes_testimonial_pt_br" class="form-control" rows="10"><?=$depoimento['tes_testimonial_pt_br']?></textarea>
                                    </div>
                                </div>
                                <div class="tab-pane fade show" id="en" role="tabpanel" aria-labelledby="home-tab">
                                    <div class="form-group">
                                        <textarea name="tes_testimonial_en" id="tes_testimonial_en" class="form-control" rows="10"><?=$depoimento['tes_testimonial_en']?></textarea>
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
