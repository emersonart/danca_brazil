<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div id="modal_team"  class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content border-0">
      <div class="modal-body">
        <div class="loader text-center">
          <i class="fa fa-spin fa-spinner fa-4x"></i>
        </div>
        <div class="content-error text-danger" style="display: none">
          <h3 class="text-center font-weight-bold"><?=get_option('site_generic_error_'.$lang_bd)?></h3>
        </div>
        <div class="content-success" style="display: none">
          <div class="row">
            <div class="col-md-3">
              <div class="avatar text-center">
                <img src="" class="img-fluid rounded-circle" alt="">
              </div>
            </div>
            <div class="col-md-8">
              <div class="col-12">
                <h2 class="font-weight-bold name">
                
                </h2>
                <p class="social">
                  Social 
                  <a href="" target="_blank"><?=get_option('site_text_team_social_'.$lang_bd)?></a>
                </p>
              </div>
              <div class="col-12">
                <div class="about_member"></div>
              </div>
              
            </div>
          </div>
          <div class="row">
            
          </div>
        </div>
      </div>
    </div>
  </div>
</div>