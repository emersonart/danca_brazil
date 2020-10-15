<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Quem_sou extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->library("pagination");

	}
	public function index($param = ''){
		$lang = str_replace('-','_', get_language());
		$data = [
			'heading'=> lang('quem_sou'),
			'title' => lang('quem_sou'),
			'data_bg' => 'sobre'
		];
		load_template($data,'quem_sou/index_'.$lang,'site');
	}
}
