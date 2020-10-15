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
                                <input type="text" autocomplete="off" value="<?=$tag['tag_title_pt_br']?>" class="form-control form-round form-creser" name="tag_title_pt_br" id="name_to_newsletter" placeholder="Título em Português">
                                <span for="nome_to_plano">Título em Português</span>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="has-float-label">
                                <input type="text" autocomplete="off" value="<?=$tag['tag_title_en']?>" class="form-control form-round form-creser" name="tag_title_en" id="name_to_newsletter1" placeholder="Título em Português">
                                <span for="nome_to_plano">Título em Inglês</span>
                                </label>
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
