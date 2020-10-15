<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Consultoria_e_palestras extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->library("pagination");

	}
	public function index($param = ''){
		$lang = str_replace('-','_', get_language());
		$data = [
			'heading'=> lang('consultoria_e_palestras'),
			'title' => lang('consultoria_e_palestras'),
			'data_bg' => 'palestras'
		];
		load_template($data,'consultoria_e_palestras/index_'.$lang,'site');
	}
}
