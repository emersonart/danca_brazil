<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Enoturismo extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->library("pagination");

	}
	public function index($param = ''){
		$lang = str_replace('-','_', get_language());
		$data = [
			'heading'=> lang('enoturismo'),
			'title' => lang('enoturismo'),
			'data_bg' => 'enoturismo'
		];
		load_template($data,'enoturismo/index','site');
	}
}
