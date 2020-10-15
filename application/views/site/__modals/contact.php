<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div id="full_contact_1"  class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content border-0">
      <div class="modal-header border-0">
        <h5 class="modal-title font-weight-bolder"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <i class="fa fa-times"></i>
        </button>
      </div>
      <div class="modal-body ">
        <?=form_open(get_language().'/api/contact',['id'=>"form_contact_all","autocomplete"=>"off","class"=>"ajax_request"]);?>
          <input type="hidden" name="con_cot_id">
          <input type="hidden" name="con_extra">
          <div class="form-group">
            <label class="has-float-label">
            <input type="text" autocomplete="off" class="form-control form-round form-creser" name="con_name" id="nome_to_plano" placeholder="<?=lang('name_input')?>" required>
            <span for="nome_to_plano"><?=lang('name_input')?></span>
            </label>
          </div>
          <div class="form-group">
            <label class="has-float-label">
            <input type="text" autocomplete="off" class="form-control form-round cellphone form-creser" name="con_contact" id="telefone_to_plano" placeholder="<?=lang('telephone_input')?>" required>
            <span for="telefone_to_plano"><?=lang('telephone_input')?></span>
            </label>
          </div>
          <div class="form-group">
            <label class="has-float-label">
            <input type="email" autocomplete="off" class="form-control form-round form-creser" name="con_email" id="email_to_plano" placeholder="<?=lang('email_input')?>" required>
            <span for="email_to_plano"><?=lang('email_input')?></span>
            </label>
          </div>
          <div class="form-group">
            <label class="has-float-label">
            <textarea autocomplete="off" class="form-control form-round form-creser" name="con_message" id="mensagem_to_plano" placeholder="<?=lang('message_input')?>" rows="5" required></textarea> 
            <span for="mensagem_to_plano"><?=lang('message_input')?></span>
            </label>
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-outline-success btn-creser-mensalidades btn-block"><?=lang('send_button')?></button>
          </div>
        <?=form_close();?>
      </div>
    </div>
  </div>
</div>