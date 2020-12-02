<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Newsletters extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model(['newsletters_model'=>'newsletters']);
	}
	public function fix(){
		redirect('painel/blog');
	}

	public function index(){
		$params['select'] = "new_id,new_datetime,new_name,new_email,new_contact,new_country_code";
		$params['order'] = ["new_id"=>"desc"];
		$params['no_tags'] =true;
		$news = $this->newsletters->get_all($params);
		if($news){
			foreach ($news as $ln => $new) {
				$news[$ln]['new_datetime'] = date('d/m/Y \à\s H:i',strtotime($new['new_datetime']));
				$news[$ln]['botoes'] = "";
				$news[$ln]['botoes'] .= "<a href='".base_url('painel/newsletters/remove/'.$new['new_id'])."' class='btn btn-sm btn-danger'><i class='far fa-trash-alt'></i></a> ";
				$news[$ln]['botoes'] = ['style'=>'max-width: 180px','data'=>$news[$ln]['botoes']];
			}
		}

		$data = [
			'heading' => "Cadastros de newsletters",
			'newsletters' => $news
		];
		load_template($data,'newsletters/index');
	}

	public function remove($id){
		if(!$this->newsletters->remove($id)){
			set_msg('Erro ao remover post','danger');
		}
		redirect('painel/newsletters');
	}
}