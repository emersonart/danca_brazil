<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Eventos extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->library("pagination");

	}
	public function index($param = ''){
		$lang = str_replace('-','_', get_language());
		$data = [
			'heading'=> lang('title_events'),
			'title' => lang('eventos'),
			'data_bg' => 'eventos'
		];
		load_template($data,'eventos/index','site');
	}
}
