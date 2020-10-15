<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
	</div>
     <footer class="footer footer-black  footer-white ">
        <div class="container-fluid">
	          <div class="row">
	            <nav class="footer-nav">
	              <ul>
	                <li>
	                  <a href="https://www.facebook.com/ethernalcreativeid/" target="_blank">Ethernal Creative Identities</a>
	                </li>
	                <li>
	                  <a href="https://azevedoestudio.com.br" target="_blank">Azevedo Estudio</a>
	                </li>
	              </ul>
	            </nav>
	            <div class="credits ml-auto">
	              <span class="copyright">
	                ©
	                <script>
	                  document.write(new Date().getFullYear())
	                </script>, desenvolvido por Ethernal Creative Identities para Hennekam Wines
	              </span>
	            </div>
	          </div>
	        </div>
      	</footer>
    </div>
</div>
	<!--   Core JS Files   -->
	<script src="<?=base_url('assets/vendor/paper-dashboard/js/core/jquery.min.js');?>"></script>
	<script src="<?=base_url('assets/vendor/paper-dashboard/js/core/popper.min.js');?>"></script>
	<script type="text/javascript" src="<?=base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')?>"></script>
	<?php /*
	<script src="<?=base_url('assets/vendor/paper-dashboard/js/core/bootstrap.min.js');?>"></script>
	  */ ?>
	<script src="<?=base_url('assets/vendor/paper-dashboard/js/plugins/perfect-scrollbar.jquery.min.js');?>"></script>
	<!-- Chart JS -->
	<script src="<?=base_url('assets/vendor/paper-dashboard/js/plugins/chartjs.min.js');?>"></script>
	<!--  Notifications Plugin    -->
 	<script src="<?=base_url('assets/vendor/paper-dashboard/js/plugins/bootstrap-notify.js');?>"></script>
	<!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
	<script src="<?=base_url('assets/vendor/paper-dashboard/js/paper-dashboard.js?v=2.0.0')?>" type="text/javascript"></script>
 	<!-- Paper Dashboard DEMO methods, don't include it in your project! -->
 	<script src="<?=base_url('assets/vendor/DataTables/datatables.min.js')?>" type="text/javascript"></script>
 	<script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.8.4/moment.min.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/plug-ins/1.10.10/sorting/datetime-moment.js"></script>
	<script type="text/javascript" src="<?=base_url('assets/vendor/summernote/summernote-bs4.min.js')?>"></script>
	<script type="text/javascript" src="<?=base_url('assets/vendor/summernote/lang/summernote-pt-BR.js')?>"></script>
	<script type="text/javascript" src="<?=base_url('assets/vendor/summernote/plugin/videoattributes/summernote-video-attributes.js')?>"></script>
	<script type="text/javascript" src="<?=base_url('assets/vendor/summernote/plugin/summernote-file/summernote-file.js')?>"></script>
	<script type="text/javascript" src="<?=base_url('assets/vendor/summernote/plugin/add-class/add-class.js')?>"></script>
	<script type="text/javascript" src="<?=base_url('assets/vendor/summernote/plugin/ext-elfinder/summernote-ext-elfinder.js')?>"></script>
	<script type="text/javascript" src="<?=base_url('assets/vendor/summernote/plugin/summernote-audio/summernote-audio.js');?>"></script>
	<!--script type="text/javascript" src="<?=base_url('assets/vendor/imagePicker/image-picker.min.js')?>"></script-->
	<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.min.js"></script>
	<script type="text/javascript" src="<?=base_url('assets/vendor/select2/js/select2.full.js')?>"></script>
    <script type="text/javascript" src="<?=base_url('assets/vendor/select2/i18n/pt-BR.js')?>"></script>
	
	<script type="text/javascript" charset="utf-8" src="<?=base_url('assets/js/painel.js')?>"></script>
	<script type="text/javascript" src="<?=base_url('assets/js/summernote-active.js')?>"></script>
	
	<div id="modal-image" class="modal">
	  
	</div>
	<div id="visualizar_imagem_blo" class="modal" tabindex="-1">
	  	<div class="modal-dialog modal-dialog-centered">
	    	<div class="modal-content">
	      		<div class="modal-header">
	        		<h5 class="modal-title">Imagem</h5>
	        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          			<span aria-hidden="true">&times;</span>
	        		</button>
	      		</div>
		      	<div class="modal-body">
		        	<?=img(['src'=>base_url('assets/images/blog/sem_imagem.png'),'class'=>'img-fluid w-100'])?>
		      	</div>
	    	</div>
	  	</div>
	</div>
	<div id="visualizar_imagem_tes" class="modal" tabindex="-1">
	  	<div class="modal-dialog modal-dialog-centered">
	    	<div class="modal-content">
	      		<div class="modal-header">
	        		<h5 class="modal-title">Foto</h5>
	        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          			<span aria-hidden="true">&times;</span>
	        		</button>
	      		</div>
		      	<div class="modal-body">
		        	<?=img(['src'=>base_url('assets/images/testimonials/user.png'),'class'=>'img-fluid w-100'])?>
		      	</div>
	    	</div>
	  	</div>
	</div>

</body>

</html>
