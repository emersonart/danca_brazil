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
                                    <input type="text" autocomplete="off" class="form-control form-round form-creser" name="use_name" id="use_name" value="<?=$user['use_name']?>" placeholder="Nome">
                                    <span for="use_name">Nome</span>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="has-float-label">
                                    <input type="text" autocomplete="off" class="form-control form-round form-creser" name="use_nickname" id="use_nickname" value="<?=$user['use_nickname']?>" placeholder="Nickname">
                                    <span for="use_nickname">Nickname</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="has-float-label">
                                    <input type="email" autocomplete="off" class="form-control form-round form-creser" name="use_email" id="use_email" value="<?=$user['use_email']?>" placeholder="E-mail">
                                    <span for="use_email">E-mail</span>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="has-float-label">
                                    <input type="password" autocomplete="off" class="form-control form-round form-creser" name="use_password" id="use_password"  placeholder="Senha">
                                    <span for="use_password">Senha</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <small>Permissão</small>
                                <?php
                                $attr_s = [
                                    'class' => 'select2 form-control',
                                    'data-placeholder' => "Permissão",
                                    'id'=>'permissoes'
                                ];
                                echo form_dropdown('use_per_id',$permissoes,$user['use_per_id'],$attr_s)?>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <small>Status</small>
                                <?php
                                $attr_s = [
                                    'class' => 'select2 form-control',
                                    'data-placeholder' => "Status",
                                    'id'=>'status'
                                ];
                                echo form_dropdown('use_stu_id',$status,$user['use_stu_id'],$attr_s)?>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mb-4">
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="inputGroupFile01" name="images[use_avatar]" aria-describedby="inputGroupFileAddon01">
                                        <label class="custom-file-label" for="inputGroupFile01" data-text="Procurar">Imagem</label>

                                    </div>
                                </div>
                                <small class="text-muted">Foto</small>
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
