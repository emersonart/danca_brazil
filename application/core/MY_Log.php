<?php defined('BASEPATH') OR exit('No direct script access allowed.');
class MY_Log extends CI_Log  {

	public function __construct(){
		parent::__construct();
		$this->_levels['ETH'] = 5;
		$this->_levels['ETH_ERROR'] = 6;
	}
}