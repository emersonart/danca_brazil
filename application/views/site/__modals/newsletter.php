<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div id="md_newsletter"  class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content border-0">
      <div class="modal-header border-0">
        <h5 class="modal-title font-weight-bolder"><?=lang('subscribe_newsletter')?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <i class="fa fa-times"></i>
        </button>
      </div>
      <div class="modal-body ">
        <?=form_open(get_language().'/api/newsletter',['id'=>"form_escolher_plano","autocomplete"=>"off","class"=>"ajax_request"]);?>
          <div class="form-group">
            <label class="has-float-label">
            <input type="text" autocomplete="off" class="form-control form-round form-creser" name="new_name" id="name_to_newsletter" placeholder="<?=lang('name_input')?>" required>
            <span for="nome_to_plano"><?=lang('name_input')?></span>
            </label>
          </div>
          <div class="form-group">
            <label class="has-float-label">
            <input type="text" autocomplete="off" class="form-control form-round cellphone form-creser" name="new_contact" id="telefone_to_plano" placeholder="<?=lang('cellphone_input')?>" required>
            <span for="contact_to_newsletter"><?=lang('cellphone_input')?></span>
            </label>
          </div>
          <div class="form-group">
            <label class="has-float-label">
            <input type="email" autocomplete="off" class="form-control form-round form-creser" name="new_email" id="email_to_newsletter" placeholder="<?=lang('email_input')?>" required>
            <span for="email_to_plano"><?=lang('email_input')?></span>
            </label>
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-success btn-block"><?=lang('send_button')?></button>
          </div>
        <?=form_close();?>
      </div>
    </div>
  </div>
</div>