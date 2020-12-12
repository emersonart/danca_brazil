<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Team extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->library("pagination");
		$this->load->model('Team_model','team');
	}


	public function index(){
		$params['select'] = "tea_id, tea_datetime,tea_name,tea_show";
		$params['order'] = ["tea_id"=>"desc"];
		$teams = $this->team->get_all($params);
		

		if($teams){
			foreach ($teams as $ln => $team) {
				$teams[$ln]['tea_datetime'] = date('d/m/Y \à\s H:i',strtotime($team['tea_datetime']));
				$teams[$ln]['tea_show'] = $team['tea_show'] == 1 ? 'Sim' : 'Não';
				$eo = $team['tea_show'] == 1 ? "<i class='far fa-eye'></i>" : "<i class='far fa-eye-slash'></i>";
				$cl = $team['tea_show'] == 1 ? 'warning' : 'success';
				$teams[$ln]['botoes'] = "";
				$teams[$ln]['botoes'] .= "<a href='".base_url('painel/team/update/'.$team['tea_id'])."' class='btn btn-sm btn-primary'><i class='far fa-edit'></i></a> ";
				$teams[$ln]['botoes'] .= "<a href='".base_url('painel/team/toggle/'.$team['tea_id'])."' class='btn btn-sm btn-".$cl."'>".$eo."</a> ";
				$teams[$ln]['botoes'] .= "<a href='".base_url('painel/team/remove/'.$team['tea_id'])."' class='btn btn-sm btn-danger'><i class='far fa-trash-alt'></i></a> ";
			}
		}


		

		$data = [
			'heading' => 'Equipe',
			'team' => $teams
		];
		load_template($data,'team/index');
	}

	public function remove($id){
		if(!$this->team->remove($id)){
			set_msg('Erro ao remover post','danger');
		}
		redirect('painel/teams');
	}

	public function insert(){
		
		$this->form_validation->set_rules('tea_name','Nome','trim|required');
		$this->form_validation->set_rules('tea_description_pt_br','Descrição em português','trim');
		$this->form_validation->set_rules('tea_description_en','Descrição em Inglês','trim');
		$this->form_validation->set_rules('tea_summary_pt_br','Resumo em português','trim');
		$this->form_validation->set_rules('tea_summary_en','Resumo em Inglês','trim');
		$this->form_validation->set_rules('tea_link','Link do vídeo','trim|is_unique[team.tea_link]|required',['is_unique'=>'Link de vídeo já adicionado']);
		$this->form_validation->set_rules('tea_show','Exibir','trim');

		if($this->form_validation->run() == FALSE){
			if(validation_errors()){
				set_msg(validation_errors(),'warning');
			}
		}else{
			$send_data = $this->input->post();

			$images = false;
			if(isset($_FILES['images']['name']) && count($_FILES['images']['name']) > 0){
				$images = upload_imagem($_FILES,'team');
			}		
			if($images){
				if(isset($images['tea_image'])){
					$send_data['tea_image'] = $images['tea_image'];
				}

				// if(isset($images['tea_cover'])){
				// 	$send_data['tea_cover'] = $images['tea_cover'];
				// }
				
				
			}

			$send_data['tea_summary_en'] = strip_tags(nl2br2($send_data['tea_summary_en']));
			$send_data['tea_summary_pt_br'] = strip_tags(nl2br2($send_data['tea_summary_pt_br']));

			if(!isset($send_data['tea_show']) || empty($send_data['tea_show'])){
				$send_data['tea_show'] = 0;
			}else{
				$send_data['tea_show'] = 1;
			}

				//fazer o metodo para cadastrar!!!
			if($inserted = $this->team->insert($send_data)){
				set_msg('Membro da equipe adicionado','success');
				redirect('painel/team');
			}else{
				ethernal_log('ETH_ERROR','Erro ao cadastrar nova notíca com imagem',implode(' | ',$send_data),__METHOD__);
			}
			
		}

		$data= [
			'title' => 'Novo membro',
			'heading' => 'Novo membro',
		];
		
		load_template($data,'team/insert');
	}

	public function update($id = false){
		if(!$id){
			redirect('painel/team');
		}
		$teams = $this->team->get_by_pk($id);
		if(!$teams){
			set_msg('Membro da equipe não encontrado','warning');
			redirect('painel/team');
		}

		
		$this->form_validation->set_rules('tea_name','Nome','trim|required');
		$this->form_validation->set_rules('tea_description_pt_br','Dia em português','trim');
		$this->form_validation->set_rules('tea_description_en','Dia em inglês','trim');
		$this->form_validation->set_rules('tea_summary_pt_br','Resumo em português','trim');
		$this->form_validation->set_rules('tea_summary_en','Resumo em Inglês','trim');
		$this->form_validation->set_rules('tea_link','Link personalizado','trim'.((isset($_POST) && isset($_POST['tea_link']) && $_POST['tea_link'] == $teams['tea_link']) ? '':'|is_unique[team.tea_link]'),['is_unique'=>'O link do vídeo precisa ser único.']);
		$this->form_validation->set_rules('tea_show','Exibir','trim');

		if($this->form_validation->run() == FALSE){
			if(validation_errors()){
				set_msg(validation_errors(),'warning');
			}
		}else{
			$send_data = $this->input->post();



			$images = false;
			if(isset($_FILES['images']['name']) && count($_FILES['images']['name']) > 0){
				$images = upload_imagem($_FILES,'team');
			}		
			if($images){
				if(isset($images['tea_image'])){
					$send_data['tea_image'] = $images['tea_image'];
					$image_old = $teams['tea_image'];
				}

				
			}

			if(!isset($send_data['tea_show']) || empty($send_data['tea_show'])){
				$send_data['tea_show'] = 0;
			}else{
				$send_data['tea_show'] = 1;
			}

			$send_data['tea_summary_en'] = strip_tags(nl2br2($send_data['tea_summary_en']));
			$send_data['tea_summary_pt_br'] = strip_tags(nl2br2($send_data['tea_summary_pt_br']));
				
				
			//fazer o metodo para cadastrar!!!
			if($updated = $this->team->update($id,$send_data)){
				if(isset($image_old)){
					remover_imagem($image_old,'team');
				}

				set_msg('Membro da equipe adicionado atualizado','success');
				redirect('painel/team');
			}else{
				set_msg('Membro da equipe não atualizado','warning');
				ethernal_log('ETH_ERROR','Erro ao atualizar team',implode(' | ',$send_data),__METHOD__);
			}



			
		}
		
		

		$data= [
			'title' => 'Atualizar membro',
			'heading' => 'Atualizar membro',
			'team' => $teams
		];
		
		load_template($data,'team/update');
	}

	public function toggle($tea_id){
		if(!$this->team->toggle($tea_id)){
			set_msg('Membro não encontrado','warning');
		}
		redirect('painel/team');
	}

	public function delete($tea_id){

		if(!$this->team->delete($tea_id)){
			set_msg('Membro não encontrada','warning');
		}
		redirect('painel/team');
	}
}
