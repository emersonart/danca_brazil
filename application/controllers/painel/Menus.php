<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menus extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->library("pagination");
		$this->load->model('Menus_model','menu');
	}

	public function index(){
		$params['select'] = "men_id, men_datetime,men_title_pt_br, men_title_en,men_show";
		$params['order'] = ["men_id"=>"desc"];
		$menus = $this->menu->get_all($params);
		if($menus){
			foreach ($menus as $ln => $menu) {
				$menus[$ln]['men_id'] = ['data'=>$menu['men_id'],'style'=>'width: 40px'];
				$menus[$ln]['men_datetime'] = ['data'=>date('d/m/Y \à\s H:i',strtotime($menu['men_datetime'])),'style'=>'width: 150px'];
				$menus[$ln]['men_show'] = $menu['men_show'] == 1 ? 'Sim' : 'Não';
				$eo = $menu['men_show'] == 1 ? "<i class='far fa-eye'></i>" : "<i class='far fa-eye-slash'></i>";
				$cl = $menu['men_show'] == 1 ? 'warning' : 'success';
				$menus[$ln]['botoes'] = "";
				$menus[$ln]['botoes'] .= "<a href='".base_url('painel/menus/edit/'.$menu['men_id'])."' class='btn btn-sm btn-primary'><i class='far fa-edit'></i></a> ";
				$menus[$ln]['botoes'] .= "<a href='".base_url('painel/menus/delete/'.$menu['men_id'])."' class='btn btn-sm btn-".$cl."'>".$eo."</a> ";
				$menus[$ln]['botoes'] .= "<a href='".base_url('painel/menus/remove/'.$menu['men_id'])."' class='btn btn-sm btn-danger'><i class='far fa-trash-alt'></i></a> ";
				$menus[$ln]['botoes'] = ['style'=>'width: 180px','data'=>$menus[$ln]['botoes']];
			}
		}
		

		$data = [
			'heading' => 'Posts',
			'menus' => $menus
		];
		load_template($data,'menus/index');
	}


}