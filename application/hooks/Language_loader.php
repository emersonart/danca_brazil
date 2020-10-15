<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Language_loader
{
  function iterar($val){
    return $val."/";
  }
  function initialize() {

    $lang ='pt-br';
    $ci =& get_instance();
    $ci->load->helper('language');
    $uri_server = substr($_SERVER['REQUEST_URI'],1);
    $ci->config->set_item('request_uri',$uri_server);
    if(ENVIRONMENT == 'development'){
      $uri_server = str_replace("hennekam/",'', $uri_server);
      $ci->config->set_item('request_uri',$uri_server);
                  //$_SERVER['REQUEST_URI'] = str_replace("/site_cliente-raissa_01/",'', $_SERVER['REQUEST_URI']);
    }else{
      $ip = $_SERVER['REMOTE_ADDR'];
      $details = json_decode(file_get_contents('http://ip-api.io/json/'.$ip));
      if(!$ci->session->userdata('lang_load')){
        ethernal_log('ETH',"País de acesso|IP",$details->country_code."|".$ip,__METHOD__);
      }
      
      if(in_array($details->country_code, ['PT','BR'])  || $details->country_code == ''){
        $lang = 'pt-br';
      }else{
       $lang = 'en'; 
      }
    }
    $uri_explode = explode('/',$uri_server);
    
    if(isset($uri_explode[0]) && ($uri_explode[0] == 'painel' || $uri_explode[0] == 'login' || $uri_explode[0] == 'assets')){

    }else{
      $uri_keys = array_keys($ci->config->config['languages']);
      $url_args = array_map(function($val){
        return $val."/";},$uri_keys);

      if($uri_server == ''){
         if(!$ci->session->userdata('lang_load')){
          ethernal_log('ETH',"Idioma carregado",$lang,__METHOD__);
         }
        
        redirect($lang."/");
      }else{
        $nothing = TRUE;
        foreach ($url_args as $linha => $value) {
                          //var_dump($value,$uri_server);
          $uri_server_no_dash = explode('/',$uri_server);
          if(isset($uri_server_no_dash[1])){
             if($uri_server_no_dash[0]."/" == $value){
              $nothing = FALSE;
              $lang = str_replace('/', '', $value);
                                             // ethernal_log('ETH',"Idioma carregado (explode)", explode('/',$value)[0],__METHOD__);
            }

          }else{
            if($uri_server."/" == $value){
              $lang = str_replace('/', '', $value);
              $nothing = FALSE;

                                               //ethernal_log('ETH',"Idioma carregado (string)", explode('/',$value)[0],__METHOD__);
            }
          }
          if(strpos($uri_server, $value) !== FALSE){
            $lang = str_replace('/', '', $value);
                                       // ethernal_log('ETH',"Idioma carregado", explode('/',$value)[0],__METHOD__);
            $nothing = FALSE;
          }
        }  

        if($nothing){
                                 // ethernal_log('ETH',"Idioma carregado (sem tratamento)",'pt-br',__METHOD__);
          if($ci->session->set_userdata('lang_load')){
            redirect($ci->config->config['base_url']. $ci->session->userdata('lang_load')."/".$uri_server);
          }else if($lang){
            redirect($ci->config->config['base_url']. $lang."/".$uri_server);
          }
          
        }else{
          $ci->session->set_userdata('lang_load',$lang);
        }
    }
    //ethernal_log('ETH',"Idioma carregado",$lang,__METHOD__);
  }
  
  $ci->lang->load('information',$ci->config->config['language']);
  }
}
