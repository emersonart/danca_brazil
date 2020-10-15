<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<?php
$site_url = 'http://localhost/summernote/upload/'; //edit path
$this->load->helper('path');
$directory = set_realpath('assets/images/manager'); //edit path
$images = glob($directory.'*.{jpg,jpeg,png,gif,JPG,JPEG,PNG,GIF}', GLOB_BRACE);

?>
<div data-get="manager" class="modal-dialog modal-lg modal-dialog-centered "  style="overflow:initial">
	<div class="modal-content">
		<div class="modal-header d-block">
			<h4 class="modal-title mt-0 d-block"><i class="fa fa-image"></i>&nbsp;&nbsp;Galeria
			<button type="button" data-toggle="tooltip" title="Carregar nova foto" id="button-upload" class="btn btn-primary float-right"><i class="fa fa-upload"></i> Carregar foto</button>
			</h4>
			
		</div>
		<div class="modal-body gallery-mod"  style="height:400px;overflow-y:auto">
			<div class="row">
        <?php
		$i=0;		
		foreach ($images as $image) { 
		$imagem = basename($image);
		$image = base_url('assets/images/manager/'.$imagem);
		?>
		<div class="col-md-3 mb-3">
			<div id="image_<?php echo $i ?>" class="card h-100 bg-white text-white border" style="min-height: 110px;">
				<span class="my-auto" >
				  	<img src="<?php echo $image; ?>" class="card-img thumbnail" alt="...">
				</span>
			  	<div class="card-img-overlay align-base-line" style="height: 100%">
				  	<div class="card-text align-middle " style="position:relative; height: 100%" data-image="<?php echo $image; ?>">
				  		<div class="row justify-content-center" style="position: absolute;bottom:0px;right: 0;left:0px;border-radius: 5px;background: rgba(0,0,0,0.7);padding: 5px 0;">
				  			<div class="col-md-4 align-middle">
				  				<a data-toggle="tooltip" data-image="<?php echo $image ?>" href="javascript:;" title="Ver imagem" class="ver-imagem ">
						    		<i class="fa fa-eye fa-lg text-white"></i>
						    	</a>
				  			</div>
				  			<div class="col-md-4 align-middle">
				  				<a data-toggle="tooltip" class="delete-image " data-image_id="<?php echo $i ?>" data-image="<?php echo $imagem ?>" href="javascript:;" title="Excluir imagem"><i class="fa fa-trash-alt fa-lg text-white"></i></a>
				  			</div>
				  			<div class="col-md-4 align-middle">
				  				<a data-toggle="tooltip" class="insert-image " data-image="<?php echo $image ?>" title="inserir imagem" href="javascript:;"><i class="fa fa-sign-in-alt fa-lg text-white"></i></a>
							</a>
				  			</div>
				  		</div>

					</div>
			  	</div>
			  
			</div>
		</div>
		<!--div id="image_<?php echo $i ?>" style="margin:5px;float:left;width:155px;height:145px;">
        <div class="thumb" data-image="<?php echo $image; ?>"><span><img class="pop thumbnail" style="" src="<?php echo $image; ?>" /></span></div>
		<div style="margin:-10px 0 10px 0" class="pull-right">
		<a data-toggle="tooltip" class="delete-image" data-image_id="<?php echo $i ?>" data-image="<?php echo basename($image) ?>" href="javascript:;" title="Delete image"><i class="fa fa-trash-alt fa-lg"></i></a>
		&nbsp;&nbsp;<a data-toggle="tooltip" class="insert-image" data-image="<?php echo $image ?>" title="insert image" href="javascript:;"><i class="fa fa-sign-in-alt fa-lg"></i></a>
		</div>
		</div-->
		<?php
		$i++;
		} ?>
	</div>
		</div>
		<div class="modal-footer"><button type="button" class="btn btn-secondary" data-dismiss="modal" aria-hidden="true">Fechar</button></div>
	</div>
</div>

<!-- show image popup -->
<div class="modal fade" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-body text-center">
        <img src="" id="imagepreview" class="img-fluid border border-secondary" style="max-height:400px;" >
      </div>
      <p style="text-align:right;padding-right:20px">
        <button type="button" class="btn btn-secondary close-modal">Fechar</button>
      </p>
    </div>
  </div>
</div>

<!-- delete image popup -->
<div class="modal fade" id="imagemodaldelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md modal-dialog-centered">
    <div class="modal-content">
	<div class="bg-danger modal-header">
		<h4 class="modal-title mt-0 class="fa fa-trash-o"></i>&nbsp;&nbsp;Excluir Imagem</h4>
		</div>
      <div class="modal-body">
        Tem certeza que deseja remover esta imagem?
        <div class="alert alert-danger">A imagem será removida definitivamente, todos os locais onde essa imagem aparece irá apresentar erro.</div>
      </div>
      <p style="text-align:right;padding-right:20px">
        <button type="button" id="delete_image" class="btn btn-danger close-modal">Sim</button>&nbsp;<button type="button" class="btn btn-secondary close-modal">Não</button>
      </p>
    </div>
  </div>
</div>
<script>
$(function(){
	$('[data-toggle="tooltip"]').tooltip();
	
})
var id_s = $('div[data-get="manager"]').parent().attr('data-summer');

$('.insert-image').on('click', function() {
	var id_s = $('div[data-get="manager"]').parent().attr('data-summer');
	var image = $(this).data('image');
	$('#'+id_s).summernote('insertImage', image,function ($image) {
	  	$image.addClass('img-fluid');
	  	$image.addClass('img-responsive');
	});
	$('#modal-image').modal('hide');
})

$(".ver-imagem").on("click", function() {
   $('#imagepreview').attr('src', $(this).data('image')); 
   $('#imagemodal').modal('show'); 
});

$(".close-modal").on("click", function() {
   $('#imagepreview').attr('src', ''); 
   $('#imagemodal').modal('hide'); 
   $('#imagemodaldelete').modal('hide');
});

var image_to_delete;
var image_id;

$(".delete-image").on("click",function() {
	$('#imagemodaldelete').modal('show');
	image_to_delete = $(this).data('image');
	image_id = $(this).data('image_id');
})

$('#delete_image').on('click', function() {
	update_csrf('promise').then(function(csrf_response){
		let send = {[csrf_name]:csrf_response.token_value,'image':image_to_delete,'hash_site':'<?=HASH_SITE?>'};
		console.log(send);
		$.ajax({  
			type: "POST", 
			data:send,
			url: "<?=base_url('pt-br/api/summernote_manager_delete')?>",
			success: function(result){
				//var result = $.parseJSON(data);
				if(!result.error){
					$("#image_"+image_id).fadeOut()
					$('#imagemodaldelete').modal('hide');
					timers = setInterval(function() {
						clearInterval(timers);
						$("#image_"+image_id).parent().remove();
					},500);
				}
				
	        }
		})	
	}).catch(function(ex){
		console.log('upload_manager_ex',ex);
	})

})	

$('#button-upload').on('click', function() {
	var id_atual = $('div[data-get="manager"]').parent().attr('data-summer');
	$('#form-upload').remove();

	$('body').prepend('<form enctype="multipart/form-data" id="form-upload" style="display: none;"><input type="file" name="images[0]" value="" accept="image/*"/></form>');

	$('#form-upload input[name="images[0]"]').trigger('click');

	if (typeof timer != 'undefined') {
    	clearInterval(timer);
	}

	timer = setInterval(function() {
		if ($('#form-upload input[name="images[0]"]').val() != '') {
			clearInterval(timer);
			update_csrf('promise').then(function(csrf_response){
				let formData = new FormData($('#form-upload')[0]);
				formData.append(csrf_name,csrf_response.token_value);
				formData.append('hash_site','<?=HASH_SITE?>');

			      for (var pair of formData.entries()) {
			        console.log(pair[0]+ ', ' + pair[1]); 
			      }
				$.ajax({
					url: '<?=base_url("pt-br/api/summernote_manager_upload")?>',
					type: 'POST',
					data: formData,
					cache: false,
					contentType: false,
					processData: false,
					beforeSend: function() {
						$('#button-upload').html('<i class="fa fa-circle-o-notch fa-spin"></i>&nbsp;&nbsp;CARREGANDO...');
						$('#button-upload').prop('disabled', true);
					},
					complete: function() {
						$('#button-upload').html('<i class="fa fa-upload"></i>&nbsp;&nbsp;CARREGAR FOTO');
						$('#button-upload').prop('disabled', false);
						update_csrf();
					},
					success: function(json) {
						//json = JSON.parse(json);
						$('#'+id_atual).summernote('editor.saveRange');
						$('#'+id_atual).summernote('editor.restoreRange');
						$('#'+id_atual).summernote('editor.focus');
						//$('#'+id_atual).summernote('editor.insertImage', json.image);
						$('#'+id_atual).summernote('editor.insertImage',json.image,function ($image) {
							$image.addClass('img-fluid');
							$image.addClass('img-responsive');
						})
						$('#modal-image').modal('hide');
						console.log(json);
					},

					error: function(xhr, ajaxOptions, thrownError) {
						alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
					}
				});
			}).catch(function(ex){
				console.log('image_upload_manager_ex',ex);
			})
		}
	}, 500);
});


</script>
