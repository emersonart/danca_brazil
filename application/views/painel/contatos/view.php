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
                <div class="row">
                    <div class="col">
                        <p>
                            <strong>Nome</strong> : <?=$contato['con_name'];?>
                        </p>
                        
                    </div>
                    <div class="col">
                        <p>
                            <strong>Assunto</strong> : <?=$contato['con_subject'];?>
                        </p>
                        
                    </div>
                    <div class="col">
                        <p>
                            <strong>Email</strong> : <?=$contato['con_email'];?>
                        </p>
                        
                    </div>
                </div>
                <hr>
                <div class="row">
                     <div class="col">
                        <p>
                            <strong>Data</strong> : <?=date('d/m/Y \à\s H:i',strtotime($contato['con_datetime']));?>
                        </p>
                        
                    </div>
                    <div class="col">
                        <p>
                            <strong>Contato</strong> : <?=$contato['con_contact'];?>
                        </p>
                        
                    </div>
                    <div class="col">
                        <p>
                            <strong>Tipo</strong> : <?=$contato['cot_type'];?>
                        </p>
                        
                    </div>

                </div>
                <hr>
                <div class="row">
                    <div class="col">
                        <p>
                            <strong>Cidade*</strong> : <?=$contato['con_city'] ? $contato['con_city']: '--';?><br/>
                            <small>*Cidade aproximada capturada pelo ip</small>
                        </p>
                        
                    </div>
                    <div class="col">
                        <p>
                            <strong>Estado*</strong> : <?=$contato['con_region'] ? $contato['con_region']."/".$contato['con_region_code']: '--';?><br/>
                            <small>*Estado aproximado capturado pelo ip</small>
                        </p>
                        
                    </div>
                    <div class="col">
                        <p>
                            <strong>País*</strong> : <?=$contato['con_country'] ? $contato['con_country']."/".$contato['con_country_code'] : '--';?><br/>
                            <small>*País aproximado capturado pelo ip</small>
                        </p>
                        
                    </div>
                </div>
                <hr>
                <div class="row mt-3">
                    <div class="col">
                        <p>
                            <strong>Mensagem</strong>
                        </p>
                        <p>
                            <?=$contato['con_message']?>
                        </p>
                    </div>
                </div>
            </div>
		</div>
	</div>
</div>


