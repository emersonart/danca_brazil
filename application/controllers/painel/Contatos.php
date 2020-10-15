<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contatos extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model(['contacts_model'=>'contatos']);
	}
	public function fix(){
		redirect('painel/contatos');
	}

	public function index(){
		$params['select'] = "con_id,con_datetime,con_name,con_email,cot_type,con_extra";
		$params['order'] = ["con_id"=>"desc"];
		$news = $this->contatos->get_all($params);
		if($news){
			foreach ($news as $ln => $new) {
				$news[$ln]['con_datetime'] = date('d/m/Y \à\s H:i',strtotime($new['con_datetime']));
				$news[$ln]['botoes'] = "";
				$news[$ln]['botoes'] .= "<a href='".base_url('painel/contatos/view/'.$new['con_id'])."' class='btn btn-sm btn-info'><i class='far fa-eye'></i></a> ";
				$news[$ln]['botoes'] .= "<a href='".base_url('painel/contatos/delete/'.$new['con_id'])."' class='btn btn-sm btn-danger'><i class='far fa-trash-alt'></i></a> ";
				$news[$ln]['botoes'] = ['style'=>'width: 120px','data'=>$news[$ln]['botoes']];
			}
		}

		$data = [
			'heading' => "Contatos",
			'contatos' => $news
		];
		load_template($data,'contatos/index');
	}

	public function view($id){
		$contato = $this->contatos->get_by_pk($id);
		if(!$contato){
			set_msg('Contato não encontrado','info');
			redirect('painel/contatos');
		}

		$data = [
			'heading' => 'Contato',
			'title' => 'Contato',
			'contato' => $contato
		];

		load_template($data,'contatos/view');
	}

	public function toggle($con_id){
		if(!$this->contatos->toggle($con_id)){
			set_msg('Depoimento não encontrado','warning');
		}
		redirect('painel/contatos');
	}

	public function delete($con_id){
		if(!$this->contatos->delete($con_id)){
			set_msg('Contato não encontrado','warning');
		}
		redirect('painel/contatos');
	}
}