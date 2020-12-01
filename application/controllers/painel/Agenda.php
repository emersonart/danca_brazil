<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Agenda extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->library("pagination");
		$this->load->model('Schedules_model','agenda');
		$this->load->model('Courses_model','cursos');
	}


	public function index(){
		$params['select'] = "sch_id, sch_datetime,sch_title_pt_br, sch_title_en,sch_show";
		$params['order'] = ["sch_id"=>"desc"];
		$params['no_schedules_courses'] =true;
		$agendas = $this->agenda->get_all($params);
		

		if($agendas){
			foreach ($agendas as $ln => $agenda) {
				$agendas[$ln]['sch_datetime'] = date('d/m/Y \à\s H:i',strtotime($agenda['sch_datetime']));
				$agendas[$ln]['sch_show'] = $agenda['sch_show'] == 1 ? 'Sim' : 'Não';
				$eo = $agenda['sch_show'] == 1 ? "<i class='far fa-eye'></i>" : "<i class='far fa-eye-slash'></i>";
				$cl = $agenda['sch_show'] == 1 ? 'warning' : 'success';
				$agendas[$ln]['botoes'] = "";
				$agendas[$ln]['botoes'] .= "<a href='".base_url('painel/agenda/update/'.$agenda['sch_id'])."' class='btn btn-sm btn-primary'><i class='far fa-edit'></i></a> ";
				$agendas[$ln]['botoes'] .= "<a href='".base_url('painel/agenda/toggle/'.$agenda['sch_id'])."' class='btn btn-sm btn-".$cl."'>".$eo."</a> ";
				$agendas[$ln]['botoes'] .= "<a href='".base_url('painel/agenda/remove/'.$agenda['sch_id'])."' class='btn btn-sm btn-danger'><i class='far fa-trash-alt'></i></a> ";
			}
		}


		

		$data = [
			'heading' => 'Agenda',
			'agenda' => $agendas
		];
		load_template($data,'agenda/index');
	}

	public function remove($id){
		if(!$this->agenda->remove($id)){
			set_msg('Erro ao remover post','danger');
		}
		redirect('painel/agenda');
	}

	public function insert(){
		$params['select'] = "cur_id,cur_title_pt_br, cur_title_en";
		$tgs = $this->cursos->get_all($params);
		$cursos = [];
		if($tgs){
			foreach ($tgs as $ln => $tag) {
				$cursos[$tag['cur_id']] = $tag['cur_title_pt_br']." / ".$tag['cur_title_en'];
			}

		}
		
		$this->form_validation->set_rules('sch_title_pt_br','Título em Português','trim|required');
		$this->form_validation->set_rules('sch_title_en','Título em inglês','trim|required');
		$this->form_validation->set_rules('cursos[]','Categorias','trim|required');
		$this->form_validation->set_rules('sch_day_pt_br','Dia em português','trim|required');
		$this->form_validation->set_rules('sch_day_en','Dia em Inglês','trim|required');
		$this->form_validation->set_rules('sch_link','Link personalizado','trim|is_unique[schedules.sch_link]',['is_unique'=>'O link personalizado precisa ser único.']);
		$this->form_validation->set_rules('sch_show','Exibir','trim');

		if($this->form_validation->run() == FALSE){
			if(validation_errors()){
				set_msg(validation_errors(),'warning');
			}
		}else{
			$send_data = $this->input->post();

			if(!isset($send_data['sch_link']) || $send_data['sch_link'] == ''){
				$send_data['sch_link'] = remove_especial_chars($send_data['sch_title_pt_br']);
			}

			/*$images = false;
			if(isset($_FILES['images']['name']) && count($_FILES['images']['name']) > 0){
				$images = upload_imagem($_FILES,'blog');
			}		
			if($images){
				if(isset($images['sch_image'])){
					$send_data['sch_image'] = $images['sch_image'];
				}

				if(isset($images['sch_cover'])){
					$send_data['sch_cover'] = $images['sch_cover'];
				}
				
				
			}*/


				//fazer o metodo para cadastrar!!!
			if($inserted = $this->agenda->insert($send_data)){
				set_msg('Agenda adicionada','success');
				redirect('painel/agenda');
			}else{
				ethernal_log('ETH_ERROR','Erro ao cadastrar nova notíca com imagem',implode(' | ',$send_data),__METHOD__);
			}
			
		}

		$data= [
			'title' => 'Nova agenda',
			'heading' => 'Nova agenda',
			'cursos' => $cursos,
		];
		
		load_template($data,'agenda/insert');
	}

	public function update($id = false){
		if(!$id){
			redirect('painel/agenda');
		}
		$agendas = $this->agenda->get_by_pk($id);
		if(!$agendas){
			set_msg('Post não encontrado','warning');
			redirect('painel/agenda');
		}


		$params['select'] = "cur_id,cur_title_pt_br, cur_title_en";
		$tgs = $this->cursos->get_all($params);
		$cursos = [];
		if($tgs){
			foreach ($tgs as $ln => $tag) {
				$cursos[$tag['cur_id']] = $tag['cur_title_pt_br']." / ".$tag['cur_title_en'];
			}

		}
		
		$this->form_validation->set_rules('sch_title_pt_br','Título em Português','trim|required');
		$this->form_validation->set_rules('sch_title_en','Título em inglês','trim|required');
		$this->form_validation->set_rules('cursos[]','Cursos','trim|required');
		$this->form_validation->set_rules('sch_day_pt_br','Dia em português','trim|required');
		$this->form_validation->set_rules('sch_day_en','Dia em inglês','trim|required');
		$this->form_validation->set_rules('sch_link','Link personalizado','trim'.((isset($_POST) && isset($_POST['sch_link']) && $_POST['sch_link'] == $agendas['sch_link']) ? '':'|is_unique[schedules.sch_link]'),['is_unique'=>'O link personalizado precisa ser único.']);
		$this->form_validation->set_rules('sch_show','Exibir','trim');

		if($this->form_validation->run() == FALSE){
			if(validation_errors()){
				set_msg(validation_errors(),'warning');
			}
		}else{
			$send_data = $this->input->post();

			if(!isset($send_data['sch_link']) || $send_data['sch_link'] == ''){
				$send_data['sch_link'] = $agendas['sch_link'];
			}

			/*$images = false;
			if(isset($_FILES['images']['name']) && count($_FILES['images']['name']) > 0){
				$images = upload_imagem($_FILES,'agenda');
			}		
			if($images){
				if(isset($images['sch_image'])){
					$send_data['sch_image'] = $images['sch_image'];
					$image_old = $agendas['sch_image'];
				}

				if(isset($images['sch_cover'])){
					$send_data['sch_cover'] = $images['sch_cover'];
					$cover_old = $agendas['sch_cover'];
				}
				
				
			}*/
				
				
			//fazer o metodo para cadastrar!!!
			if($updated = $this->agenda->update($id,$send_data)){
				if(isset($image_old)){
					remover_imagem($image_old,'blog');
				}
				if(isset($cover_old)){
					remover_imagem($cover_old,'blog');
				}
				set_msg('Agenda atualizada','success');
				redirect('painel/agenda');
			}else{
				set_msg('Data na agenda não atualizada','warning');
				ethernal_log('ETH_ERROR','Erro ao atualizar agenda',implode(' | ',$send_data),__METHOD__);
			}



			
		}
		
		

		$data= [
			'title' => 'Atualizar Agenda',
			'heading' => 'Atualizar Agenda',
			'cursos' => $cursos,
			'agenda' => $agendas
		];
		
		load_template($data,'agenda/update');
	}

	public function toggle($sch_id){
		if(!$this->agenda->toggle($sch_id)){
			set_msg('Postagem não encontrada','warning');
		}
		redirect('painel/agenda');
	}

	public function delete($sch_id){
		if(!$this->agenda->delete($sch_id)){
			set_msg('Postagem não encontrada','warning');
		}
		redirect('painel/agenda');
	}
}
