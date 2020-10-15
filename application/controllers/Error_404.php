<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Error_404 extends CI_Controller {
	public function __construct() {
		parent::__construct();
	}

	public function index(){
		$data = [
			'metatags' => ['robots'=>'noindex']
		];
		$this->output->set_status_header(404);
		load_template($data,'errors/html/error_404_view','site');
	}
}