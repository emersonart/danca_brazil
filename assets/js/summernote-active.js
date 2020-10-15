$(document).ready(function() { 
  //$(".image-picker").imagepicker({}); 
  //bsCustomFileInput.init();

  $('#modal-image').on('hidden.bs.modal', function (e) {
    $(this).removeAttr('data-summer');
  })
  
  $('.summernote').summernote({
    tabsize: 2,
    height:300,
    lang: 'pt-BR',
    theme: 'default',
    shortcuts: false,
    dialogsInBody: true,
    disableDragAndDrop: true,
    codeviewFilter: false,
    codeviewIframeFilter: true,
    fontNames: ['Open Sans','Montserrat'],
    fontName:'Open Sans',
    toolbar: [
    ['insert', ['table', 'hr','image','videoAttributes','file','link']],
    ['font style', ['fontname', 'fontsize', 'color', 'bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear']],
    ['paragraph style', ['style', 'ol', 'ul', 'paragraph', 'height']],
    ['misc', ['fullscreen', 'codeview', 'undo', 'redo']]
    ],
    buttons: {

      image: function() {
        var ui = $.summernote.ui;
        var teste = $.summernote;
        var button = ui.button({
          contents: '<i class="fa fa-image" />',
          tooltip: "Inserir Imagem",
          click: function (context) {
          //$('#modal-image').remove();
          var id_summ = $(this).parent().parent().parent().parent().children('textarea');
          console.log(id_summ);
          $('#modal-image').attr('data-summer',id_summ.attr('id'));
          console.log($('#modal-image').attr('data-summer',id_summ.attr('id')))
          $.ajax({
            url: base_url + 'pt-br/api/summernote_manager',
            dataType: 'html',
            success: function(html) {
              $('#modal-image').html(html);
              $('#modal-image').modal('show');
            }
          });                    }
        });
        return button.render();
      }
    },
    callbacks :{
      onInit: function() {
        // $(this).data('image_dialog_images_html', '<div class="row"..');
        $(this).data('image_dialog_images_url', base_url + "pt-br/api/summernote_galeria");
        $(this).data('image_dialog_title', "Imagens");
        $(this).data('image_dialog_close_btn_text', "Cancelar");
        $(this).data('image_dialog_ok_btn_text', "Adicionar");
      },
      onFocus: function(e){
        //console.log("onFocus: " + $(this).attr('id'));
        $('#modal-image').attr('data-summer',$(this).attr('id'));
      },
      onBlur: function(e){
        //console.log("onBlur: " + $(this).attr('id'));
        $('#modal-image').attr('data-summer',$(this).attr('id'));
      },
      onMouseUp: function(e){
        //console.log("onMouseUp: " + $(this).attr('id'));
        $('#modal-image').attr('data-summer',$(this).attr('id'));
      },
      onFileUpload: function(file) {
        myOwnCallBack(file[0],$(this));
      },
      onFileLinkInsert: function(link){
        console.log($(this).attr('id'));
        $("#" + $(this).attr('id')).summernote('editor.saveRange');
        $("#" + $(this).attr('id')).summernote('editor.restoreRange');
        $("#" + $(this).attr('id')).summernote('editor.focus');
        $("#" + $(this).attr('id')).summernote('pasteHTML',"<p><a href='"+link+"' target='_blank'>Arquivo</a></p>");
        return "<a href='"+link+"' target='_blank'>Arquivo</a>";
      },
      onMediaDelete: function($target, editor, $editable){
        deleteFileCallBack($target,$(this));
      }
    }
});
  $('.summernote').summernote('fontName','Open Sans');
  $('.modal').each(function(i,el){
    $(el).find('label.form-check-label').each(function(i,ele){
      $(ele).append('<span class="form-check-sign"></span>');
      console.log(el);
    })
  })
  function deleteFileCallBack(src,instance) {
    update_csrf('promise').then(function(csrf_response){
      let srcs = $.map(src,function(el){
        return el.src;
      })
      var return_response = csrf_response.token_value;
      let dt = {
        [csrf_name]: return_response,
        'src': srcs
      };
      console.log(dt);

      $.ajax({
        data: dt,
        type: "POST",
        url: base_url+"pt-br/api/summernote_upload_delete_file", // replace with your url
        cache: false,
        dataType: 'JSON'
      }).then(function(r){
        console.log(r);
      });
    }).catch(function(ex){
      console.log('delete exc: ',ex);
    })
  }
  function myOwnCallBack(file,instance) {
    var dataForm = new FormData();

    dataForm.append('file', file);

    console.log(dataForm.entries());
    update_csrf('promise').then(function(csrf_response){

      var return_response = csrf_response.token_value;
      dataForm.append(csrf_name,return_response);
      dataForm.append('fix','fix');
      $('input[name="' + csrf_name  + '"]').each(function(i, el){
        $(el).val(return_response);
      });

      // for (var pair of dataForm.entries()) {
      //   console.log(pair[0]+ ', ' + pair[1]); 
      // }
      $.ajax({
        data: dataForm,
        url: base_url + "pt-br/api/summernote_manager_upload_file", //Your own back-end uploader
        cache: false,
        contentType: false,
        processData: false,
        method: 'POST',
        xhr: function() { //Handle progress upload
          let myXhr = $.ajaxSettings.xhr();
          if (myXhr.upload) myXhr.upload.addEventListener('progress', progressHandlingFunction, false);
          return myXhr;
        },
        success: function(reponse) {
          if(!reponse.error) {
            let listMimeImg = ['image/png', 'image/jpeg', 'image/webp', 'image/gif', 'image/svg'];
            let listMimeAudio = ['audio/mpeg', 'audio/ogg'];
            let listMimeVideo = ['video/mpeg', 'video/mp4', 'video/webm'];
            let elem;
            $("#" + $(instance).attr('id')).summernote('editor.saveRange');
            $("#" + $(instance).attr('id')).summernote('editor.restoreRange');
            $("#" + $(instance).attr('id')).summernote('editor.focus');
            if (listMimeImg.indexOf(file.type) > -1) {
              //Picture
              $("#" + $(instance).attr('id')).summernote('insertImage', reponse.filename,function($image){
                $image.addClass('img-fluid');
                $image.addClass('img-responsive');
              });
            } else if (listMimeAudio.indexOf(file.type) > -1) {
              //Audio
              elem = document.createElement("audio");
              elem.setAttribute("src", reponse.filename);
              elem.setAttribute("controls", "controls");
              elem.setAttribute("preload", "metadata");
              $("#" + $(instance).attr('id')).summernote('insertNode', elem);
            } else if (listMimeVideo.indexOf(file.type) > -1) {
              //Video
              elem = document.createElement("video");
              elem.setAttribute("src", reponse.filename);
              elem.setAttribute("controls", "controls");
              elem.setAttribute("preload", "metadata");
              $("#" + $(instance).attr('id')).summernote('insertNode', elem);
            } else {
              //Other file type
              elem = document.createElement("a");
              let linkText = document.createTextNode(file.name);
              elem.appendChild(linkText);
              elem.title = file.name;
              elem.href = reponse.filename;
              elem.className = 'btn btn-primary';
              //$("#" + instance.attr('id')).summernote('pasteHTML',"<p><a href='"+reponse.filename+"' target='_blank'>Arquivo</a></p>");
              $("#" + $(instance).attr('id')).summernote('insertNode', elem);
            }
          }else{
            console.log(reponse)
          }
        }
      });
    }).catch(function(ex){
      console.log(ex);
    })
    
  }

  function progressHandlingFunction(e) {
    if (e.lengthComputable) {
        //Log current progress
        console.log((e.loaded / e.total * 100) + '%');

        //Reset progress on complete
        if (e.loaded === e.total) {
          console.log("Upload finished.");
        }
      }
    }

            //$.fn.dataTable.moment( 'dddd, MMMM Do, YYYY' );
  $('#visualizar-arquivo').on('show.bs.modal', function (event) {
    var images = ['jpg','jpeg','gif','png','svg']
    var button = $(event.relatedTarget) // Button that triggered the modal
    var nome_arquivo = button.data('arquivo')
    var titulo = button.data('titulo')
    var id_arquivo = button.data('idarquivo')
    var extensao = button.data('extensao')  // Extract info from data-* attributes
    var youtube = button.data('youtube')
    // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
    // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
    var modal = $(this);
    modal.find('#pdf-type').hide();
    modal.find('#image-type').hide();
    modal.find('#other-type').hide();
    modal.find('#nome-arquivo').text(titulo)
    
    if(images.includes(extensao)){
      modal.find('#image-type img').attr('src', data_url +"assets/archives/"+nome_arquivo );
      modal.find('#image-type').show();
    }else if(extensao == 'pdf'){
      //carregar pdf
      console.log('pdf');
      // Loaded via <script> tag, create shortcut to access PDF.js exports.
      var pdfjsLib = window['pdfjs-dist/build/pdf'];

      // The workerSrc property shall be specified.
      pdfjsLib.GlobalWorkerOptions.workerSrc = '//mozilla.github.io/pdf.js/build/pdf.worker.js';
      var pdfDoc = null,
      pageNum = 1,
      pageRendering = false,
      pageNumPending = null,
      scale = 0.8,
      canvas = document.getElementById('arquivo-canvas'),
      ctx = canvas.getContext('2d');

      /**
       * Get page info from document, resize canvas accordingly, and render page.
       * @param num Page number.
       */
       function renderPage(num) {
        pageRendering = true;
        // Using promise to fetch the page
        pdfDoc.getPage(num).then(function(page) {
          var viewport = page.getViewport({scale: scale});
          canvas.height = viewport.height;
          canvas.width = viewport.width;

          // Render PDF page into canvas context
          var renderContext = {
            canvasContext: ctx,
            viewport: viewport
          };
          var renderTask = page.render(renderContext);

          // Wait for rendering to finish
          renderTask.promise.then(function() {
            pageRendering = false;
            if (pageNumPending !== null) {
              // New page rendering is pending
              renderPage(pageNumPending);
              pageNumPending = null;
            }
          });
        });

        // Update page counters
        document.getElementById('page_num').textContent = num;
      }

      /**
       * If another page rendering in progress, waits until the rendering is
       * finised. Otherwise, executes rendering immediately.
       */
       function queueRenderPage(num) {
        if (pageRendering) {
          pageNumPending = num;
        } else {
          renderPage(num);
        }
      }

      /**
       * Displays previous page.
       */
       function onPrevPage() {
        if (pageNum <= 1) {
          return;
        }
        pageNum--;
        queueRenderPage(pageNum);
      }
      document.getElementById('prev').addEventListener('click', onPrevPage);

      /**
       * Displays next page.
       */
       function onNextPage() {
        if (pageNum >= pdfDoc.numPages) {
          return;
        }
        pageNum++;
        queueRenderPage(pageNum);
      }
      document.getElementById('next').addEventListener('click', onNextPage);

      /**
       * Asynchronously downloads PDF.
       */
       pdfjsLib.getDocument( data_url +"assets/archives/"+nome_arquivo).promise.then(function(pdfDoc_) {
        pdfDoc = pdfDoc_;
        document.getElementById('page_count').textContent = pdfDoc.numPages;

        // Initial/first page rendering
        renderPage(pageNum);
      });
       modal.find('#pdf-type').show();
     }else{
      console.log('other');
      if(youtube){
        modal.find("#container-youtube").html('<iframe id="ytplayer" type="text/html" width="100%" height="auto"\
          src="http://www.youtube.com/embed/' + youtube + '?autoplay=1&origin='+data_url+'"\
          frameborder="0"/>').show();
        modal.find("#other-type a").hide();
        modal.find('#other-type').show()
      }else{
        modal.find("#other-type a").attr('href', data_url + "assets/archives/"+nome_arquivo);
        modal.find("#other-type a").show();
        modal.find('#other-type').show()
      }
      
    }
  })
$('#excluir-arquivo').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var id_arquivo = button.data('idarquivo');
    var nome_arquivo = button.data('arquivo');
    var modal = $(this);
    var link = modal.find('.modal-footer a').attr('href');
    modal.find('.modal-footer a').attr('href',link+id_arquivo);
    modal.find('#n-arquivo span').text(nome_arquivo);
  })
$("#visualizar-arquivo").on('hide.bs.modal',function(event){
  $('#container-youtube').html('').hide();
    canvas = document.getElementById('arquivo-canvas'); //because we are looping //each location has its own canvas ID
    context = canvas.getContext('2d');
      //context.beginPath();

      // Store the current transformation matrix
      context.save();

      // Use the identity matrix while clearing the canvas
      context.setTransform(1, 0, 0, 1, 0, 0);
      context.clearRect(0, 0, canvas.width, canvas.height);

      // Restore the transform
      context.restore(); //CLEARS THE SPECIFIC CANVAS COMPLETELY FOR NEW DRAWING
    });

});

