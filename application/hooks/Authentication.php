<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Authenticated_check 
{
	public function verify(){
		$ci =& get_instance();
		if((isset($ci->uri->segments[1]) && $ci->uri->segments[1] == 'painel')){
			if(ENVIRONMENT === 'development'){
				$infos = [
					'usu_id' => 1,
					'usu_per_id' => 1,
					'usu_nickname' => 'administrador',
					'usu_email' => 'emersonbruno_@hotmail.com',
					'usu_avatar' => 'avatar.png'
				];
				$ci->session->set_userdata('logged',$infos);
			}
			if(!is_authenticated()){
				if((isset($ci->uri->segments[2]) && $ci->uri->segments[2] == 'login') || (isset($ci->uri->segments[1]) && $ci->uri->segments[1] == 'login') ){
					
				}else{
					redirect('login');
				}
				
			}
        }
	}

}