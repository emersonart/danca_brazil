<?php defined('BASEPATH') OR exit('No direct script access allowed.');
class MY_Controller extends CI_Controller  {
	protected $langua;
	public function __construct(){
		parent::__construct();
		$this->langua = str_replace('-','_', get_language());
		if($this->langua == 'en'){
			setlocale( LC_ALL, 'AU', 'AU.utf-8', 'AU.utf-8', 'english' );
		}else{
			setlocale( LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese' );
		}
		
	}
}