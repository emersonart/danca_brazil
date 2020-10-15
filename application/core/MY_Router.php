<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Router extends CI_Router {

    protected function _parse_routes()
    {
      if($this->uri->segments[1] != 'painel' &&  $this->uri->segments[1] != 'painel/' && $this->uri->segments[1] != 'login' &&  $this->uri->segments[1] != 'login/' && $this->uri->segments[1] != 'sair' &&  $this->uri->segments[1] != 'sair/'){
        // Language detection over URL
        if(in_array($this->uri->segments[1], array_keys($this->config->config['languages']))) {
          //$this->config->config['language'] = $this->uri->segments[1];
          $this->config->set_item('language', $this->config->config['languages'][$this->uri->segments[1]]);
          unset($this->uri->segments[1]);
        }else if($this->uri->segments[1] == $this->config->config['language']) {

          unset($this->uri->segments[1]);
        }else{
          $uri_server = substr($_SERVER['REQUEST_URI'],1);
          $this->config->set_item('request_uri',$uri_server);
          if(ENVIRONMENT == 'development'){
            $uri_server = str_replace("hennekam/",'', $uri_server);
            $this->config->set_item('request_uri',$uri_server);
            //$_SERVER['REQUEST_URI'] = str_replace("/site_cliente-raissa_01/",'', $_SERVER['REQUEST_URI']);
          }
          $uri_keys = array_keys($this->config->config['languages']);
          $url_args = array_map(function($val){return $val."/";},$uri_keys);
            foreach ($url_args as $linha => $value) {
              if(strpos($uri_server, $value) !== 0){
                    header("Location: ".$this->config->config['base_url'].'pt-br/'.$uri_server);
                    
              }
            }  
        }

      }
    


    
    // Return default function
    return parent::_parse_routes();
    }  

}