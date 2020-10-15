<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cursos extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->library("pagination");

	}
	public function index($param = ''){
		$lang = str_replace('-','_', get_language());
		$data = [
			'heading'=> lang('courses'),
			'title' => lang('cursos'),
			'data_bg' => 'curso'
		];
		load_template($data,'cursos/index','site');
	}
}
