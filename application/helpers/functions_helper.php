<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if(!function_exists('load_template')){
	function load_template($data, $template, $type = 'painel'){
		$ci =& get_instance();
		if(!isset($data['title'])){
			$data['title'] = SITE_NAME;
		}else{
			$data['title'] = $data['title']." - ".SITE_NAME;
		}
		if(!isset($data['heading'])){
			$data['heading'] = SITE_NAME;
		}
		switch ($type) {
			case 'site':
				$data['menus'] = $ci->menus->get_all_by_type('site');
				$data['social_medias'] = $ci->social->get();
				$data['language'] = get_language();
				$data['language_bd'] = str_replace('-','_',get_language());
				
				$metatag = '<meta http-equiv="Content-Language" content="'.get_language().'">'."\n";
				if(isset($data['metatags'])){
					$data['metatags'] = $metatag.set_metatags($data['metatags']);
				}else{
					$data['metatags'] = $metatag;
				}

				ethernal_log('ETH','Site Carregado','',__METHOD__);

				$ci->load->view('template/site/header',$data);
				$ci->load->view($template);
				$ci->load->view('template/site/footer');
				break;
			
			default:
				$data['auth_user'] = $ci->session->logged;
				$ci->load->view('template/painel/header',$data);
				$ci->load->view('painel/'.$template);
				$ci->load->view('template/painel/footer');
				break;
		}

	}
}

if(!function_exists('set_metatags')){
	function set_metatags($data){
		$tag = '';
		foreach ($data as $key => $value) {
			if(strpos($key, 'title') !== FALSE){
				$value = $value." - ".SITE_NAME;
			}
			if(strpos($key, 'twitter:') !== FALSE){
				if($key == 'twitter:card'){
					$tag .= '<meta name="'.$key.'" value="'.$value.'">'."\n"; 
				}else{
					$tag .= '<meta name="'.$key.'" content="'.$value.'">'."\n"; 
				}
				
			}else if(strpos($key,'og:') !== FALSE || strpos($key,'fb:') !== FALSE || strpos($key,'article:') !== FALSE){
				$tag .= '<meta property="'.$key.'" content="'.$value.'">'."\n"; 
			}else if($key == 'canonical'){
				$tag .= "<link rel='canonical' href='".$value."'";
			}else{
				$tag .= '<meta name="'.$key.'" content="'.$value.'">'."\n"; 
			}
			
		}

		return $tag;
	}
}

if (!function_exists('encodeUtf8')) {
	function encodeUtf8($val){
		if(is_array($val)){
			return array_map("encodeUtf8",$val);
		}
        return utf8_encode($val);
	}
}
if (!function_exists('decodeUtf8')) {
	function decodeUtf8($val){
		if(is_array($val)){
			return array_map("decodeUtf8",$val);
		}
        return utf8_decode($val);
	}
}

if (!function_exists('insert_reCaptcha_v3')) {
	function insert_reCaptcha_v3($action = "validate_captcha"){
		$txt = '<input type="hidden" id="g-recaptcha-response" class="g-recaptcha-response1" name="g-recaptcha-response">
            <input type="hidden" name="action" value="'.$action.'">';
        return (ENVIRONMENT === 'production' ? $txt :'');
	}
}

if(!function_exists('get_language')){
	function get_language(){
		$ci =& get_instance();
		foreach ($ci->config->config['languages'] as $key => $value) {
			if($ci->config->config['language'] == $value){
				return $key;
			}
		}

		return 'pt-br';
	}
}
if(!function_exists('is_authenticated')){
	function is_authenticated(){
		$ci =& get_instance();
		if($ci->session->logged){
			return TRUE;
		}
		return FALSE;
	}
}
if(!function_exists('ethernal_log')){
	function ethernal_log($tipo,$msg,$valor = NULL,$instance = NULL){
		if($valor){
			$msg = $msg.": ".$valor;
		}
		if($instance){
			$msg = $instance." --> ".$msg;
		}

		log_message($tipo,$msg);
	}
}

if(!function_exists('set_active')){
	function set_active($param,$bind = ''){
		$ci =& get_instance();

		if(strpos($ci->uri->uri_string(),$param) !== FALSE){
			return 'active';
		}else{
			if($bind && strpos($ci->uri->uri_string(),$bind) !== FALSE){
				return 'active';
			}
		}
		return $ci->uri->uri_string();
	}
}

//remove chars specials
if(!function_exists('remove_especial_chars')){
	function remove_especial_chars($string){
		$str = str_replace(" ",'-',preg_replace(
			array(
				"/(á|à|ã|â|ä)/",
				"/(Á|À|Ã|Â|Ä)/",
				"/(é|è|ê|ë)/",
				"/(É|È|Ê|Ë)/",
				"/(í|ì|î|ï)/",
				"/(Í|Ì|Î|Ï)/",
				"/(ó|ò|õ|ô|ö)/",
				"/(Ó|Ò|Õ|Ô|Ö)/",
				"/(ú|ù|û|ü)/",
				"/(Ú|Ù|Û|Ü)/",
				"/(ñ)/","/(Ñ)/",
				"/(ç)/","/(Ç)/",
				"/(?)/","/(!)/",
			),explode(" ","a A e E i I o O u U n N c C "),$string));
		$str = str_replace(',', '', $str);
		$str = str_replace(';', '', $str);
		$str = str_replace('?', '', $str);
		$str = str_replace('!', '', $str);
		$str = str_replace("'", '', $str);
		$str = str_replace('"', '', $str);
		$str = str_replace('#', '', $str);
		$str = str_replace('%', '', $str);
		$str = str_replace('&', '', $str);
		$str = str_replace('¨', '', $str);
		return strtolower($str);
	}
}

if(!function_exists('show_menu')){
	function show_menu($menus){
		$ci =& get_instance();
		$return = '';
		if(is_array($menus)){
			$return .= '<ul class="navbar-nav ml-auto">';
			foreach ($menus as $key => $menu) {
				$return .= '<li class="nav-item"><a href="';
				if(strpos($menu['men_link'],"://") !== FALSE){
					$return .= $menu['men_link'];
				}else{
					if(strpos($menu['men_link'],"#") === 0){
						$return .= $menu['men_link'];
					}else{
						$return .= base_url(get_language()."/".$menu['men_link']);
					}
					
				}

				if(strpos($menu['men_link'],"#") === 0){
					$return .= '" class="nav-link js-scroll-trigger" ';
				}else{
					$return .= '" class="nav-link" ';
				}
				
				if($menu['men_target']){
					$return .= 'target="'.$menu['men_target'].'"';
				}
				$return .= ' alt="'.$menu['men_title'].'">'.$menu['men_title'].'</a></li>';
			}
			$return .= '<div class="d-flex justify-content-center"><li class="nav-item flags">
			    			<a href="'.base_url('pt-br/'.implode('/',$ci->uri->segments)).'" class="nav-link">
			    	 			<img src="'.base_url('assets/images/countries/BR.png').'" alt="Mudar para o português" title="Mudar para o português" data-toggle="tooltip" data-placement="bottom">
			    			</a>
			    		</li>
			    		<li class="nav-item flags">
			    			<a href="'.base_url('en/'.implode('/',$ci->uri->segments)).'" class="nav-link">
			    	 			<img src="'.base_url('assets/images/countries/AU.png').'" alt="Change to English" title="Change to English" data-toggle="tooltip" data-placement="bottom">
			    			</a>
			    		</li></div>';
			$return .= '</ul>';

			return $return;
		}

		return FALSE;
		
	}
}

//set a message info-box
if(!function_exists('set_msg')){
	function set_msg($msg=NULL,$tipo='dark',$icon=FALSE,$dismiss = TRUE){
		$ci = & get_instance();
		$extra = $dis = '';
		if($msg == NULL){
			$ci->session->set_userdata('aviso',$msg);
		}else{
			if($dismiss){
				$extra = '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						    <span aria-hidden="true">&times;</span>
						  </button>';
				$dis = 'alert-dismissible';
			}
			if($icon){
				$icon = '<i class="aling-self-center fa '.$icon.'"></i>';
			}
			$msg = '<div class="d-flex align-itens-center justify-content-between text-center alert '.$dis.' alert-'.$tipo.'" role="alert">'.$icon."<div class='text-left'>".$msg."</div>".$extra.'</div>';
			$ci->session->set_userdata('alert-eth',$msg);
		}
		
	}
}

//display a message
if(!function_exists('get_msg')){
	function get_msg($destroy=TRUE){
		$ci = & get_instance();
		$retorno = $ci->session->userdata('alert-eth');
		if($destroy){
			$ci->session->unset_userdata('alert-eth');
		}
		return $retorno;
	}
}

if(!function_exists('encrypt_key')){
	function encrypt_key($key){
		$ci =& get_instance();
		return bin2hex($ci->encryption->hkdf($key,'sha512',$ci->config->config['encryption_key'],32,'eth_authentication'));
	}
}

if (!function_exists('get_option')) {
	function get_option($val){
		$CI =& get_instance();
		$CI->load->driver(['cache'=>'cch'],['adapter'=>'file','backup'=>'memcache']);
		//$CI->cch->clean();
		if(!$CI->cch->get('texts')){
			ethernal_log('ETH','carregou textos do banco','',__METHOD__);
			$CI->cch->file->save('texts',$CI->opts->get_all(),3600);
		}
		
		foreach ($CI->cch->get('texts') as $key => $value) {
			if($value['opt_option'] == $val){
				return $value['opt_value'];
			}
		}

		return false;
		
	}
}

if(!function_exists('clear_cch')){
	function clear_cch($key = false){
		$CI =& get_instance();
		$CI->load->driver(['cache'=>'cch'],['adapter'=>'file','backup'=>'memcache']);
		//$CI->cch->clean();
		if($key){
			$CI->cch->delete($key);
		}else{
			$CI->cch->clean();
		}

		return true;
		
	}
}

if(!function_exists('nl2br2')){
	function nl2br2($string) {
		$string = str_replace(array("\r\n", "\r", "\n"), "<br />", $string);
		return $string;
	}
}

if(!function_exists('br2nl')){
	function br2nl($string){
	    return preg_replace('/\<br(\s*)?\/?\>/i', "\n", $string);
	}
}