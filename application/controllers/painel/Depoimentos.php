<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Depoimentos extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->library("pagination");
		$this->load->model('Testimonials_model','dep');
	}


	public function index(){
		$params['select'] = "tes_id, tes_datetime, tes_name, tes_show";
		$params['order'] = ["tes_id"=>"desc"];
		$news = $this->dep->get($params);
		if($news){
			foreach ($news as $ln => $new) {
				$news[$ln]['tes_datetime'] = date('d/m/Y \à\s H:i',strtotime($new['tes_datetime']));
				$news[$ln]['tes_show'] = $new['tes_show'] == 1 ? 'Sim' : 'Não';
				$eo = $new['tes_show'] == 1 ? "<i class='far fa-eye'></i>" : "<i class='far fa-eye-slash'></i>";
				$cl = $new['tes_show'] == 1 ? 'warning' : 'success';
				$news[$ln]['botoes'] = "";
				$news[$ln]['botoes'] .= "<a href='".base_url('painel/depoimentos/update/'.$new['tes_id'])."' class='btn btn-sm btn-primary'><i class='far fa-edit'></i></a> ";
				$news[$ln]['botoes'] .= "<a href='".base_url('painel/depoimentos/toggle/'.$new['tes_id'])."' class='btn btn-sm btn-".$cl."'>".$eo."</a> ";
				$news[$ln]['botoes'] .= "<a href='".base_url('painel/depoimentos/delete/'.$new['tes_id'])."' class='btn btn-sm btn-danger'><i class='far fa-trash-alt'></i></a> ";
				$news[$ln]['botoes'] = ['style'=>'width: 180px','data'=>$news[$ln]['botoes']];
			}
		}
		

		$data = [
			'heading' => 'Depoimentos',
			'testimonials' => $news
		];
		load_template($data,'testimonials/index');
	}

	public function remove($id){
		if(!$this->dep->remove($id)){
			set_msg('Erro ao remover depoimento','danger');
		}
		redirect('painel/depoimentos');
	}

	public function insert(){
		
		$this->form_validation->set_rules('tes_name','Nome','trim|required');
		$this->form_validation->set_rules('tes_testimonial_pt_br','Depoimento em português','trim|required');
		$this->form_validation->set_rules('tes_testimonial_en','Depoimento em Inglês','trim|required');
		$this->form_validation->set_rules('tes_show','Exibir','trim');

		if($this->form_validation->run() == FALSE){
			if(validation_errors()){
				set_msg(validation_errors(),'warning');
			}
		}else{
			$send_data = $this->input->post();
			if(!isset($send_data['tes_show'])){
				$send_data['tes_show'] = 0;
			}

			$images = false;
			if(isset($_FILES['images']['name']) && count($_FILES['images']['name']) > 0){
				$images = upload_imagem($_FILES,'testimonials');
			}		
			if($images){
				if(isset($images['tes_image'])){
					$send_data['tes_image'] = $images['tes_image'];
				}
			}


				//fazer o metodo para cadastrar!!!
			if($inserted = $this->dep->insert($send_data)){
				redirect('painel/depoimentos');
			}else{
				ethernal_log('ETH_ERROR','Erro ao cadastrar nova notíca com imagem',implode(' | ',$send_data),__METHOD__);
			}
			
		}

		$data= [
			'title' => 'Novo depoimento',
			'heading' => 'Novo depoimento',
		];
		
		load_template($data,'testimonials/insert');
	}

	public function update($id = false){
		if(!$id){
			redirect('painel/depoimentos');
		}
		$depoimento = $this->dep->get_by_pk($id);
		if(!$depoimento){
			set_msg('Depoimento não encontrado','warning');
			redirect('painel/depoimentos');
		}

		$this->form_validation->set_rules('tes_name','Nome','trim|required');
		$this->form_validation->set_rules('tes_testimonial_pt_br','Depoimento em português','trim|required');
		$this->form_validation->set_rules('tes_testimonial_en','Depoimento em Inglês','trim|required');
		$this->form_validation->set_rules('tes_show','Exibir','trim');

		if($this->form_validation->run() == FALSE){
			if(validation_errors()){
				set_msg(validation_errors(),'warning');
			}
		}else{
			$send_data = $this->input->post();
			if(!isset($send_data['tes_show'])){
				$send_data['tes_show'] = 0;
			}
			$images = false;
			if(isset($_FILES['images']['name']) && count($_FILES['images']['name']) > 0){
				$images = upload_imagem($_FILES,'testimonials');
			}		
			if($images){
				if(isset($images['tes_image'])){
					$send_data['tes_image'] = $images['tes_image'];
					$image_old = $depoimento['tes_image'];
				}
			}
				
				
			//fazer o metodo para cadastrar!!!
			if($updated = $this->dep->update($id,$send_data)){
				if(isset($image_old)){
					remover_imagem($image_old,'testimonials');
				}
				set_msg('Depoimento atualizado','success');
				redirect('painel/depoimentos');
			}else{
				set_msg('Depoimento não foi atualizado','warning');
				ethernal_log('ETH_ERROR','Erro ao cadastrar nova notíca com imagem',implode(' | ',$send_data),__METHOD__);
			}



			
		}
		
		

		$data= [
			'title' => 'Atualizar depoimento',
			'heading' => 'Atualizar depoimento',
			'depoimento' => $depoimento
		];
		
		load_template($data,'testimonials/update');
	}

	public function toggle($tes_id){
		if(!$this->dep->toggle($tes_id)){
			set_msg('Depoimento não encontrado','warning');
		}
		redirect('painel/depoimentos');
	}

	public function delete($tes_id){
		if(!$this->dep->delete($tes_id)){
			set_msg('Depoimento não encontrado','warning');
		}
		redirect('painel/depoimentos');
	}
}