<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if(!function_exists('load_lang')){
	function load_lang(){
		$ci = & get_instance();

		if($ci->uri->segment(1) == 'en' || $ci->uri->segment(1) == 'pt-br'){
			$ci->session->set_userdata('eid_lang',$ci->uri->segment(1));
			$previous = $_SERVER["REQUEST_URI"];
			if(ENVIRONMENT == 'development'){
				$previous = explode('localhost/',base_url())[1];
				$previous = str_replace($ci->uri->segment(1)."/","",$previous);
			}else{
				$previous= str_replace($ci->uri->segment(1)."/","",$previous);
			}
			
			redirect(base_url($anterior));
		}
		$lang = 'portuguese_brazilian';
		$lang_abr = 'br';
		if ($ci->session->eid_lang == 'en') {
			$lang = 'english';
			$lang_abr = $ci->session->eid_lang;
		}else if($ci->session->eid_lang == 'pt-br'){
			$lang = 'portuguese_brazilian';
			$lang_abr = $ci->session->eid_lang;
		}

		$ci->config->set_item('language',$lang);
		$ci->session->set_userdata('eid_lang',$lang_abr);
	}
}
