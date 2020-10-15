<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if(!function_exists('enviar_email')){
	function enviar_email($values,$template = 'fale_conosco'){
		$ci = &get_instance();
		$ci->load->library('email');
		if($template != 'fale_conosco'){
			$ci->lang->load('information',$ci->config->config['languages'][$values['lang']]);
		}
		
		if(isset($values['assunto'])){
			$subject = $values['assunto'];
		}else{
			if($template == 'newsletters_news'){
				$subject = lang('new_post_blog');
			}else{
				$subject = 'Contato via site';
			}
			
		}
		$values['assunto'] = $subject;
		if(!isset($values['dataehora'])){
			$values['dataehora'] = date('d/m/Y \à\s H:i');
		}
		$values['endereco_empresa'] = "---";
		
		$body = $ci->load->view('emails/' . $template, $values, true);
		$ci->email->from(EMAIL_SITE, SITE_NAME);
		if($template == 'fale_conosco'){
			$ci->email->to('info@hennekamwines.com', 'Hennekam Wines');
			$ci->email->reply_to($values['email_send'],$values['nome']);
		}else{
			$ci->email->to((isset($values['email']) ? $values['email'] : 'info@hennekamwines.com'), $values['nome']);
		}
		
		$ci->email->subject($subject);
		$ci->email->message($body);
		$ci->email->charset = 'UTF-8';
		return $ci->email->send();
	}
}

if(!function_exists('mailer_log')){
		function mailer_log($msg,$tipo,$valor = NULL,$instance = NULL){
			if($valor){
				$msg = $msg.": ".$valor;
			}
			if($instance){
				$msg = $instance." -> ".$msg;
			}
			$msg = utf8_encode($msg);

			log_message('ETH',$msg);
		}
	}

