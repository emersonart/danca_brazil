<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Videos extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->library("pagination");
		$this->load->model('Videos_model','video');
	}


	public function index(){
		$params['select'] = "vid_id, vid_datetime,vid_title_pt_br, vid_title_en,vid_show";
		$params['order'] = ["vid_id"=>"desc"];
		$videos = $this->video->get_all($params);
		

		if($videos){
			foreach ($videos as $ln => $video) {
				$videos[$ln]['vid_datetime'] = date('d/m/Y \à\s H:i',strtotime($video['vid_datetime']));
				$videos[$ln]['vid_show'] = $video['vid_show'] == 1 ? 'Sim' : 'Não';
				$eo = $video['vid_show'] == 1 ? "<i class='far fa-eye'></i>" : "<i class='far fa-eye-slash'></i>";
				$cl = $video['vid_show'] == 1 ? 'warning' : 'success';
				$videos[$ln]['botoes'] = "";
				$videos[$ln]['botoes'] .= "<a href='".base_url('painel/videos/update/'.$video['vid_id'])."' class='btn btn-sm btn-primary'><i class='far fa-edit'></i></a> ";
				$videos[$ln]['botoes'] .= "<a href='".base_url('painel/videos/toggle/'.$video['vid_id'])."' class='btn btn-sm btn-".$cl."'>".$eo."</a> ";
				$videos[$ln]['botoes'] .= "<a href='".base_url('painel/videos/remove/'.$video['vid_id'])."' class='btn btn-sm btn-danger'><i class='far fa-trash-alt'></i></a> ";
			}
		}


		

		$data = [
			'heading' => 'Posts',
			'videos' => $videos
		];
		load_template($data,'videos/index');
	}

	public function remove($id){
		if(!$this->video->remove($id)){
			set_msg('Erro ao remover post','danger');
		}
		redirect('painel/videos');
	}

	public function insert(){
		
		$this->form_validation->set_rules('vid_title_pt_br','Título em Português','trim|required');
		$this->form_validation->set_rules('vid_title_en','Título em inglês','trim|required');
		$this->form_validation->set_rules('vid_description_pt_br','Descrição em português','trim');
		$this->form_validation->set_rules('vid_description_en','Descrição em Inglês','trim');
		$this->form_validation->set_rules('vid_link','Link do vídeo','trim|is_unique[videos.vid_link]|required',['is_unique'=>'Link de vídeo já adicionado']);
		$this->form_validation->set_rules('vid_show','Exibir','trim');

		if($this->form_validation->run() == FALSE){
			if(validation_errors()){
				set_msg(validation_errors(),'warning');
			}
		}else{
			$send_data = $this->input->post();

			$images = false;
			if(isset($_FILES['images']['name']) && count($_FILES['images']['name']) > 0){
				$images = upload_imagem($_FILES,'videos');
			}		
			if($images){
				if(isset($images['vid_image'])){
					$send_data['vid_image'] = $images['vid_image'];
				}

				// if(isset($images['vid_cover'])){
				// 	$send_data['vid_cover'] = $images['vid_cover'];
				// }
				
				
			}

			$send_data['vid_description_en'] = nl2br2($send_data['vid_description_en']);
			$send_data['vid_description_pt_br'] = nl2br2($send_data['vid_description_pt_br']);

			if(!isset($send_data['vid_show']) || empty($send_data['vid_show'])){
				$send_data['vid_show'] = 0;
			}else{
				$send_data['vid_show'] = 1;
			}

				//fazer o metodo para cadastrar!!!
			if($inserted = $this->video->insert($send_data)){
				set_msg('video adicionada','success');
				redirect('painel/videos');
			}else{
				ethernal_log('ETH_ERROR','Erro ao cadastrar nova notíca com imagem',implode(' | ',$send_data),__METHOD__);
			}
			
		}

		$data= [
			'title' => 'Nova notícia',
			'heading' => 'Nova notícia',
		];
		
		load_template($data,'videos/insert');
	}

	public function update($id = false){
		if(!$id){
			redirect('painel/videos');
		}
		$videos = $this->video->get_by_pk($id);
		if(!$videos){
			set_msg('Video não encontrado','warning');
			redirect('painel/videos');
		}

		
		$this->form_validation->set_rules('vid_title_pt_br','Título em Português','trim|required');
		$this->form_validation->set_rules('vid_title_en','Título em inglês','trim|required');
		$this->form_validation->set_rules('vid_description_pt_br','Dia em português','trim');
		$this->form_validation->set_rules('vid_description_en','Dia em inglês','trim');
		$this->form_validation->set_rules('vid_link','Link personalizado','trim'.((isset($_POST) && isset($_POST['vid_link']) && $_POST['vid_link'] == $videos['vid_link']) ? '':'|is_unique[videos.vid_link]'),['is_unique'=>'O link do vídeo precisa ser único.']);
		$this->form_validation->set_rules('vid_show','Exibir','trim');

		if($this->form_validation->run() == FALSE){
			if(validation_errors()){
				set_msg(validation_errors(),'warning');
			}
		}else{
			$send_data = $this->input->post();

			if(!isset($send_data['vid_link']) || $send_data['vid_link'] == ''){
				$send_data['vid_link'] = $videos['vid_link'];
			}

			$images = false;
			if(isset($_FILES['images']['name']) && count($_FILES['images']['name']) > 0){
				$images = upload_imagem($_FILES,'videos');
			}		
			if($images){
				if(isset($images['vid_image'])){
					$send_data['vid_image'] = $images['vid_image'];
					$image_old = $videos['vid_image'];
				}

				
			}

			if(!isset($send_data['vid_show']) || empty($send_data['vid_show'])){
				$send_data['vid_show'] = 0;
			}else{
				$send_data['vid_show'] = 1;
			}
				
				
			//fazer o metodo para cadastrar!!!
			if($updated = $this->video->update($id,$send_data)){
				if(isset($image_old)){
					remover_imagem($image_old,'blog');
				}

				set_msg('video atualizado','success');
				redirect('painel/videos');
			}else{
				set_msg('Data na video não atualizada','warning');
				ethernal_log('ETH_ERROR','Erro ao atualizar video',implode(' | ',$send_data),__METHOD__);
			}



			
		}
		
		

		$data= [
			'title' => 'Atualizar video',
			'heading' => 'Atualizar video',
			'video' => $videos
		];
		
		load_template($data,'videos/update');
	}

	public function toggle($vid_id){
		if(!$this->video->toggle($vid_id)){
			set_msg('Postagem não encontrada','warning');
		}
		redirect('painel/videos');
	}

	public function delete($vid_id){
		if(!$this->video->delete($vid_id)){
			set_msg('Postagem não encontrada','warning');
		}
		redirect('painel/videos');
	}
}
