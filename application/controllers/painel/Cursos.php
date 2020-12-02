<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cursos extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->library("pagination");
		$this->load->model('Courses_model','dep');
	}


	public function index(){
		$params['select'] = "cur_id, cur_datetime, cur_title_en, cur_title_pt_br, cur_show";
		$params['order'] = ["cur_id"=>"desc"];
		$news = $this->dep->get($params);
		if($news){
			foreach ($news as $ln => $new) {
				$news[$ln]['cur_datetime'] = date('d/m/Y \à\s H:i',strtotime($new['cur_datetime']));
				$news[$ln]['cur_show'] = $new['cur_show'] == 1 ? 'Sim' : 'Não';
				$eo = $new['cur_show'] == 1 ? "<i class='far fa-eye'></i>" : "<i class='far fa-eye-slash'></i>";
				$cl = $new['cur_show'] == 1 ? 'warning' : 'success';
				$news[$ln]['botoes'] = "";
				$news[$ln]['botoes'] .= "<a href='".base_url('painel/cursos/update/'.$new['cur_id'])."' class='btn btn-sm btn-primary'><i class='far fa-edit'></i></a> ";
				$news[$ln]['botoes'] .= "<a href='".base_url('painel/cursos/toggle/'.$new['cur_id'])."' class='btn btn-sm btn-".$cl."'>".$eo."</a> ";
				$news[$ln]['botoes'] .= "<a href='".base_url('painel/cursos/delete/'.$new['cur_id'])."' class='btn btn-sm btn-danger'><i class='far fa-trash-alt'></i></a> ";
				$news[$ln]['botoes'] = ['style'=>'width: 180px','data'=>$news[$ln]['botoes']];
			}
		}
		

		$data = [
			'heading' => 'Cursos',
			'cursos' => $news
		];
		load_template($data,'cursos/index');
	}

	public function remove($id){
		if(!$this->dep->remove($id)){
			set_msg('Erro ao remover curso','danger');
		}
		redirect('painel/cursos');
	}

	public function insert(){
		
		$this->form_validation->set_rules('cur_title_pt_br','Nome do curso em português','trim|required');
		$this->form_validation->set_rules('cur_title_en','Nome do curso em Inglês','trim|required');
		$this->form_validation->set_rules('cur_description_pt_br','Descrição do curso em português','trim');
		$this->form_validation->set_rules('cur_description_en','Descrição do curso em Inglês','trim');
		$this->form_validation->set_rules('cur_show','Exibir','trim');

		if($this->form_validation->run() == FALSE){
			if(validation_errors()){
				set_msg(validation_errors(),'warning');
			}
		}else{
			$send_data = $this->input->post();
			$send_data['cur_description_en'] = nl2br2($send_data['cur_description_en']);
			$send_data['cur_description_pt_br'] = nl2br2($send_data['cur_description_pt_br']);
			if(!isset($send_data['cur_show'])){
				$send_data['cur_show'] = 0;
			}

			$images = false;
			if(isset($_FILES['images']['name']) && count($_FILES['images']['name']) > 0){
				$images = upload_imagem($_FILES,'courses');
			}		
			if($images){
				if(isset($images['cur_image'])){
					$send_data['cur_image'] = $images['cur_image'];
				}
			}


				//fazer o metodo para cadastrar!!!
			if($inserted = $this->dep->insert($send_data)){
				redirect('painel/cursos');
			}else{
				if($images){
					remover_imagem($images['cur_image'],'courses');
				}
				ethernal_log('ETH_ERROR','Erro ao cadastrar curso',implode(' | ',$send_data),__METHOD__);
			}
			
		}

		$data= [
			'title' => 'Novo curso',
			'heading' => 'Novo curso',
		];
		
		load_template($data,'cursos/insert');
	}

	public function update($id = false){
		if(!$id){
			redirect('painel/cursos');
		}
		$curso = $this->dep->get_by_pk($id);
		if(!$curso){
			set_msg('Curso não encontrado','warning');
			redirect('painel/cursos');
		}
		$curso['cur_description_en'] = br2nl($curso['cur_description_en']);
		$curso['cur_description_pt_br'] = br2nl($curso['cur_description_pt_br']);

		$this->form_validation->set_rules('cur_title_pt_br','Nome do curso em português','trim|required');
		$this->form_validation->set_rules('cur_title_en','Nome do curso em Inglês','trim|required');
		$this->form_validation->set_rules('cur_description_pt_br','Descrição do curso em português','trim|required');
		$this->form_validation->set_rules('cur_description_en','Descrição do curso em Inglês','trim|required');
		$this->form_validation->set_rules('cur_show','Exibir','trim');

		if($this->form_validation->run() == FALSE){
			if(validation_errors()){
				set_msg(validation_errors(),'warning');
			}
		}else{
			$send_data = $this->input->post();
			if(!isset($send_data['cur_show'])){
				$send_data['cur_show'] = 0;
			}
			$images = false;
			if(isset($_FILES['images']['name']) && count($_FILES['images']['name']) > 0){
				$images = upload_imagem($_FILES,'courses');
			}		
			if($images){
				if(isset($images['cur_image'])){
					$send_data['cur_image'] = $images['cur_image'];
					$image_old = $curso['cur_image'];
				}
			}
				
				
			//fazer o metodo para cadastrar!!!
			if($updated = $this->dep->update($id,$send_data)){
				if(isset($image_old)){
					remover_imagem($image_old,'courses');
				}
				set_msg('Curso atualizado','success');
				redirect('painel/cursos');
			}else{
				set_msg('Curso não foi atualizado','warning');
				ethernal_log('ETH_ERROR','Erro ao editar curso',implode(' | ',$send_data),__METHOD__);
			}



			
		}
		
		

		$data= [
			'title' => 'Atualizar curso',
			'heading' => 'Atualizar curso',
			'curso' => $curso
		];
		
		load_template($data,'cursos/update');
	}

	public function toggle($cur_id){
		if(!$this->dep->toggle($cur_id)){
			set_msg('Curso não encontrado','warning');
		}
		redirect('painel/cursos');
	}

	public function delete($cur_id){
		if(!$this->dep->delete($cur_id)){
			set_msg('Curso não encontrado','warning');
		}
		redirect('painel/cursos');
	}
}