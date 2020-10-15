<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Newsletters extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->model('Newsletters_model','newsletter');
	}

	public function unsubscribe($new_id){
		$lang = str_replace('-','_', get_language());
		$new_id = explode('_',$new_id)[1];
		$this->newsletter->remove($new_id);
		$data = [
			'title' => lang('unsubscribe'),
			'heading' => lang('unsubscribe')
		];
		load_template($data,'newsletter/unsubscribe_'.$lang,'site');
	}
}