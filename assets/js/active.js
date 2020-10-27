var base_url = document.querySelector('body').dataset.baseurl + document.querySelector('body').dataset.lang + '/';
var base_url_no = document.querySelector('body').dataset.baseurl;
var csrf_name = document.querySelector('body').dataset.csrf;

$(window).scroll(function() { 
    var scroll = $(window).scrollTop();
    if (scroll > 10) {
        $('#mainNav').addClass('nav-active');
    } else {
        $('#mainNav').removeClass('nav-active');
    }
});

$('.js-scroll-trigger[href^="#"]').on('click', function(e) {
	e.preventDefault();
	var id = $(this).attr('href'),
	targetOffset = $(id).offset().top;

	window.history.replaceState("object or string", "Title", id);

	$('html, body').animate({ 
		scrollTop: targetOffset - 40
	}, 600);
});
if($('[data-fancybox]').length){
	$('[data-fancybox]').fancybox({
	    youtube : {
	        controls : 0,
	        showinfo : 0
	    },
	    vimeo : {
	        color : '5e8046'
	    },
	    iframe: {
	    	preload: false,
	    	css : {
	            'max-width' : '80%'
	        }
	    }
	});
}


function show_ajax_modal(message,cl){
	let send_modal = $("#send_ajax");
	send_modal.find('h2 i').removeClass('fa-check text-success text-danger fa-times');
	send_modal.find('h4').text('');
	send_modal.find('h2 i').addClass(cl);
	send_modal.find('h4').html(message);
	send_modal.modal('show');
	console.log('asd');
	return true;
}

function get_error_message(cod){
	return $.ajax({
		method: 'get',
		dataType: 'json',
		url: base_url + "api/get_error_message?code="+cod,
		cache: false
	});
}
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

// var SPMaskBehavior = function (val) {
//   return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
// },
// spOptions = {
//   onKeyPress: function(val, e, field, options) {
//       field.mask(SPMaskBehavior.apply({}, arguments), options);
//     }
// };

// $('.cellphone').mask(SPMaskBehavior, spOptions);

$(function () {
	$.scrollUp({
		scrollName: 'scrollUp',
		topDistance: '150',
		topSpeed: 300,
		animation: 'fade',
		easingTYpe: 'linear',
		animationInSpeed: 200, // Animation in speed (ms)
    	animationOutSpeed: 200, // Animation out speed (ms)
    	scrollText: '<i class="fa fa-chevron-up" style="right: 25px;bottom: 15px;"></i>'
	});
	let scroll = $(document).find('#scrollUp');
	scroll.attr('data-toggle','tooltip');
	scroll.attr('title','Return to top');
    $('[data-toggle="tooltip"]').tooltip();
    $("#full_contact_1").on('hide.bs.modal',function(e){
    	let $modal = $(this);
    	$modal.find('.modal-title').html('Entre em contato');
		$modal.find('input[name="con_cot_id"]').val(1);
		$modal.find('input[name="con_extra"]').val('');
		$modal.find('input[name="con_subject"]').parent().parent().remove();
		$modal.find('textarea').text('');
		$modal.find('textarea').val('');
		$modal.find('input').each(function(i, el){
			$(el).val('');
		});
    });
  	$("#full_contact_1").on('show.bs.modal',function(e){
		let trigger = e.relatedTarget;
		let title,type;
		if(trigger.dataset.title){
			title = trigger.dataset.title;
		}else{
			title = 'Entre em contato';
			type = 1;
		}
		let extra = '';
		if(trigger.dataset.extra){
			extra = trigger.dataset.extra;
		}
		if(trigger.dataset.type){
			type = trigger.dataset.type;
		}

		let $modal = $(this);
		$modal.find('.modal-title').html(title);
		$modal.find('input[name="con_cot_id"]').val(type);
		$modal.find('input[name="con_extra"]').val(extra);
		$el = $modal.find('input[name="con_email"]').parent().parent();

		if(type == 1 || type==2){
			$(`<div class="form-group">
            <label class="has-float-label">
            <input type="text" autocomplete="off" class="form-control form-round form-creser" name="con_subject" id="nome_to_plano" placeholder="Metas/Goals" required>
            <span for="nome_to_plano">`+(type == 1 ? 'Assunto/Subject' : 'Metas/Goals')+`</span>
            </label>
          </div>`).insertAfter($el);
		}

		//modal.find('input[type="email"]').val(input.val());
	});
	$("#md_newsletter").on('show.bs.modal',function(e){
		let trigger = $(e.relatedTarget);
		let input = $("#email_newsletter");
		let modal = $(this);
		modal.find('input[type="email"]').val(input.val());
	});
	$("#md_newsletter").on('hide.bs.modal',function(e){
		let trigger = $(e.relatedTarget);
		let input = $("#email_newsletter");
		let modal = $(this);
		modal.find('input').each(function(i, el){
			$(el).val('');
		});
		input.val('');
	});

	$("#send_ajax").on('show.bs.modal',function(e){
		update_csrf();
	});

	$("#send_ajax").on('hide.bs.modal',function(e){
		let modal = $(this);
		update_csrf();
		modal.find('h2 i').removeClass('fa-check text-success text-danger fa-times');
		modal.find('h4').text('');
	});

});









$(document).on('submit','.ajax_request',function(related){

	related.preventDefault();
	var button = $(this).find('[type="submit"]');
	button.prop('disabled',true);
	var err_msg;
	var modal = $($(this).closest('.modal'));
	console.log(modal);
	update_csrf();
	var form = $(this);
	var action = form.attr('action');
	var data = form.serializeArray();
	var method = form.attr('method');
	update_csrf('promisse').then(function(csrf_response){

		return_response = csrf_response.token_value;
		$('input[name="' + csrf_name  + '"]').each(function(i, el){
			$(el).val(return_response);
		});

		$.ajax({
			url: action,
			data: data,
			method: method,
			dataType: 'json'
		}).then(function(response){
			let classToUse = 'fa-times text-danger';
			let message = response.msg;
			if(!response.error){
				modal.modal('hide');
				classToUse = 'fa-check text-success';
			}
			show_ajax_modal(message,classToUse);
		}).catch(function(ex){
			var classTo = 'fa-times text-danger';
			get_error_message('asd').then(function(r){
				if(!r.error){
					err_msg = r.msg;
				}else{
					err_msg = "Unknow Error";
				}
				show_ajax_modal(err_msg,classTo);
			}).catch(function(ex){
				err_msg = "Unknow Error";
				show_ajax_modal(err_msg,classTo);
			})
			modal.modal('hide');
		}).always(function(al){
			update_csrf();
			button.prop('disabled',false);
		})
	}).catch(function(ex){
		show_ajax_modal("Security Error","fa-times text-danger");
		console.log('ex csrf');
	})
	
})

var Util;

function load_instagram(){
	$.ajax({
		url: base_url_no + 'api/instagram_feed',
		method: 'GET',
		cache: false,
		dataType: 'json'
	}).then(function(response){
	    
	    let ids = response.data.data;
	    let posts = [];
	    ids.map((res,index)=>{

	            posts.push({
	                'link': res.permalink,
	                'caption': res.caption,
	                'image_url': res.media_url,
	                'user': res.username
	            })
	            let media;
	            if(res.thumbnail_url){
	                media = res.thumbnail_url
	            }else{
	                media = res.media_url
	            }
	            $("#slide_hennekam .swiper-wrapper").append(`
	            	<div class='swiper-slide'>
	            		<a href='${res.permalink}' target='_blank' style="background-image: url('${media}')" class="instagram-images d-block">
		            		<img class="img-fluid" style="height:auto" src="${base_url_no}assets/images/lens.png"/>

	            		</a>
	            	</div>`);
	        
	    });
	    var igSwiper = new Swiper('#slide_hennekam',{
	    	speed: 400,
	    	lazy: true,
	    	slidesPerView: 5,
	    	spaceBetween: 0,
	    	pagination: {
		        el: '.swiper-pagination',
		        clickable: true,
		    },
		    loop: true,
		    navigation: {
		        nextEl: '.swiper-button-next',
		        prevEl: '.swiper-button-prev',
		    },
		    breakpoints: {
		        100: {
		          	slidesPerView: 2,
		        },
		        560: {
		          	slidesPerView: 3,
		        },
		        768: {
		          	slidesPerView: 4,
		        },
		        1024: {
		          	slidesPerView: 5,
		        },
		    }
	    })
	});
}
if($("#slide_hennekam").length){
	load_instagram();
}
if($("#slide_enoturismo").length){
	var enSwiper = new Swiper('#slide_enoturismo',{
	    	speed: 400,
	    	lazy: true,
	    	slidesPerView: 5,
	    	spaceBetween: 0,
	    	pagination: {
		        el: '.swiper-pagination',
		        clickable: true,
		    },
		    loop: false,
		    navigation: {
		        nextEl: '.swiper-button-next',
		        prevEl: '.swiper-button-prev',
		    },
		    breakpoints: {
		        100: {
		          	slidesPerView: 2,
		        },
		        560: {
		          	slidesPerView: 3,
		        },
		        768: {
		          	slidesPerView: 4,
		        },
		        1024: {
		          	slidesPerView: 5,
		        },
		    }
	    })
}
if($("#slide_testimonials").length){
	var tesSwiper = new Swiper('#slide_testimonials',{
	    	speed: 400,
	    	slidesPerView: 1,
	    	spaceBetween: 0,
	    	pagination: {
		        el: '.swiper-pagination',
		        clickable: true,
		    },
		    navigation: {
		        nextEl: '.swiper-button-next',
		        prevEl: '.swiper-button-prev',
		    },
	    })
}

if($("#slide_team").length){
	var teamSwiper = new Swiper('#slide_team',{
			loop: true,
	    	speed: 400,
	    	autoplay:true,
	    	slidesPerView: 3,
	    	spaceBetween: 5,
	    	pagination: {
		        el: '.swiper-pagination',
		        clickable: true,
		    },
		    navigation: {
		        nextEl: '.swiper-button-next',
		        prevEl: '.swiper-button-prev',
		    },
		    centeredSlides: true,
		    breakpoints: {
		        100: {
		          	slidesPerView: 1,
		        },
		        560: {
		          	slidesPerView: 2,
		        },
		        768: {
		          	slidesPerView: 3,
		        }
		    },
	    })
}



