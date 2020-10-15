
var base_url = document.querySelector('body').dataset.baseurl;
var csrf_name = document.querySelector('body').dataset.csrf;

function update_csrf(promisse = false){
  let ret = $.ajax({
    type: "GET",
    url: base_url + "api/update_csrf",
    dataType: 'json'
  });
  if(promisse){
    return ret
  }
  ret.then(function(response){
    return_response = response.token_value;
    $('input[name="' + csrf_name  + '"]').each(function(i, el){
      $(el).val(return_response);
    });
    return true;
  }).catch(function(exception){
    return false;
  })

  return false;

}

$(document).ready(function(){
  $("#visualizar_imagem_blo").on('show.bs.modal',function(e){
  let modal = $(this);
  let trigger = $(e.relatedTarget);
  let imagem = e.relatedTarget.dataset.imagem;
  if(imagem == ''){
    imagem = 'sem_imagem.png';
  }
  modal.find('img').attr('src',base_url + 'assets/images/blog/' + imagem);
});
$("#visualizar_imagem_blo").on('hide.bs.modal',function(e){
  let modal = $(this);
  modal.find('img').attr('src',base_url + 'assets/images/blog/sem_imagem.png');
});


$("#visualizar_imagem_tes").on('show.bs.modal',function(e){
  let modal = $(this);
  let trigger = $(e.relatedTarget);
  let imagem = e.relatedTarget.dataset.imagem;
  console.log(imagem);
  if(imagem == ''){
    imagem = 'user.png';
    modal.find('img').attr('src',base_url + 'assets/images/' + imagem);
  }else{
    modal.find('img').attr('src',base_url + 'assets/images/testimonials/' + imagem);
  }
});
$("#visualizar_imagem_blo").on('hide.bs.modal',function(e){
  let modal = $(this);
  modal.find('img').attr('src',base_url + 'assets/images/user.png');
});


  $.fn.dataTable.moment( 'DD/MM/YYYY [às] HH:mm' );
  $.fn.dataTable.moment( 'DD/MM/YYYY' );
  const dataTableOptions = function($dataTable) {
    let dataTablePadrao = {
      language: {
        url: base_url + 'assets/vendor/DataTables/translation/Portuguese-Brasil.json'
      },
      "pageLenght": -1,
      lenghtMenu: [[-1],['All']],
      order: []
    }

    if ($dataTable.hasClass('datatable-export')) {
      var ti = 'Exported data';
      if($dataTable.data('title')){
        ti = $dataTable.data('title');
      }else{
        ti = document.title + ' - Exported data';
      }
      dataTablePadrao = Object.assign(dataTablePadrao, {
        dom: 'Bfrtip',
        buttons: [
        {
          extend: 'excel',
          title: ti,
          text: 'Gerar planilha',
          className: 'btn btn-info',
        },
        {
          extend: 'pdf',
          title: ti,
          text: 'Gerar PDF',
          className: 'btn btn-info',
        },
        {
         extend: 'print',
         title: ti,
         text: 'Imprimir',
         className: 'btn btn-info'
       },

       ] 
     })
    }

    if($dataTable.data('order') && $dataTable.data('col')){
      const coluna = $dataTable.data('col'),
      ordenacao = $dataTable.data('order');
      dataTablePadrao = Object.assign(dataTablePadrao, {
        order: [coluna,ordernacao],
      })
    }

    if ($dataTable.hasClass('no-pagination')) {
      console.log('entrou');
      dataTablePadrao = Object.assign(dataTablePadrao, {
        paging: false,
      })
    }

    if ($dataTable.hasClass('no-info')) {
      dataTablePadrao = Object.assign(dataTablePadrao, {
        info: false
      })
    }

    if ($dataTable.hasClass('datatable-export') && $dataTable.hasClass('print-footer')) {

      const buttonsComFooter = dataTablePadrao.buttons.map(function(button){
        button.footer = true;
        return button;
      })

      console.log(buttonsComFooter);
      dataTablePadrao = Object.assign(dataTablePadrao, {
        buttons: buttonsComFooter
      })
    }

    return dataTablePadrao;
  }
  $('.data-table').DataTable(dataTableOptions($('.data-table')));
});

function no_caracter(v1){
  var find = ["ã","à","á","ä","â","è","é","ë","ê","ì","í","ï","î","ò","ó","ö","ô","ù","ú","ü","û","ñ","ç"];
  var replace = ["a","a","a","a","a","e","e","e","e","i","i","i","i","o","o","o","o","u","u","u","u","n","c"];

  for (var i = 0; i < find.length; i++) {
      v1 = v1.replace(new RegExp(find[i], 'gi'), replace[i]);
  }

  var desired = v1.replace(/\s+/g, '-').replace(/[_\s]/g, '-').replace(/[+=*%$#()@"'ªº´`!?^~;:,.<>\{\}\\[\]\\\/\s]/g,'');
  desired = desired.toLowerCase();

  return desired;
}

$(document).ready(function() {

  $('#no_caracter').on('keyup change', function() {
   
    var v1 = document.getElementById("no_caracter").value;
    $(this).val(no_caracter(v1));
      
  });   
});
$.fn.select2.defaults.set( "theme", "bootstrap" );
$('.select2').select2({
  language: 'pt-BR',
  tags:($(this).data('tags') ? $(this).data('tags') : false),
  tokenSeparators: [',', ' ',';'],
  placeholder: $(this).data('placeholder'),
  createTag: function (params) {
    var term = $.trim(params.term);
    if (term === '') {
      return null;
    }

    return {
      id: term,
      text: term,
      newTag: true // add additional parameters
    }
  },
  insertTag: function(data, tag){
    console.log(data, tag)
  },
}).on("change",function(e){
  var isNew = $(this).find('[data-select2-tag="true"]');
    if(isNew.length && $.inArray(isNew.val(), $(this).val()) !== -1){
      console.log('entrou');

        $.ajax({
          url: base_url + 'painel/api/insert_tag',
          method: 'POST',
          data:  {
            tag_title_pt_br : isNew.val(),
            tag_title_en: isNew.val(),
            tag_link: no_caracter(isNew.val())
          },
          dataType: 'json'
        }).then(function(response){
          isNew.replaceWith('<option selected value="'+response.tag_id+'">'+isNew.val()+' / '+isNew.val()+'</option>');
          console.log(response);
        })
        
    }
});

