<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blog extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->library("pagination");
		$this->load->model('Blog_model','blog');
		$this->load->model('Tags_model','tags');
		$this->load->model('Newsletters_model','newsletter');
	}


	public function index(){
		$params['select'] = "blo_id, blo_datetime,blo_title_pt_br, blo_title_en,blo_show";
		$params['order'] = ["blo_id"=>"desc"];
		$params['no_tags'] =true;
		$news = $this->blog->get_all($params);
		if($news){
			foreach ($news as $ln => $new) {
				$news[$ln]['blo_datetime'] = date('d/m/Y \à\s H:i',strtotime($new['blo_datetime']));
				$news[$ln]['blo_show'] = $new['blo_show'] == 1 ? 'Sim' : 'Não';
				$eo = $new['blo_show'] == 1 ? "<i class='far fa-eye'></i>" : "<i class='far fa-eye-slash'></i>";
				$cl = $new['blo_show'] == 1 ? 'warning' : 'success';
				$news[$ln]['botoes'] = "";
				$news[$ln]['botoes'] .= "<a href='".base_url('painel/blog/update/'.$new['blo_id'])."' class='btn btn-sm btn-primary'><i class='far fa-edit'></i></a> ";
				$news[$ln]['botoes'] .= "<a href='".base_url('painel/blog/toggle/'.$new['blo_id'])."' class='btn btn-sm btn-".$cl."'>".$eo."</a> ";
				$news[$ln]['botoes'] .= "<a href='".base_url('painel/blog/remove/'.$new['blo_id'])."' class='btn btn-sm btn-danger'><i class='far fa-trash-alt'></i></a> ";
				$news[$ln]['botoes'] = ['style'=>'width: 180px','data'=>$news[$ln]['botoes']];
			}
		}
		

		$data = [
			'heading' => 'Posts',
			'news' => $news
		];
		load_template($data,'blog/index');
	}

	public function remove($id){
		if(!$this->blog->remove($id)){
			set_msg('Erro ao remover post','danger');
		}
		redirect('painel/blog');
	}

	public function insert(){
		$params['select'] = "tag_id,tag_title_pt_br, tag_title_en";
		$tgs = $this->tags->get_all($params);
		$tags = [];
		if($tgs){
			foreach ($tgs as $ln => $tag) {
				$tags[$tag['tag_id']] = $tag['tag_title_pt_br']." / ".$tag['tag_title_en'];
			}

		}
		
		$this->form_validation->set_rules('blo_title_pt_br','Título em Português','trim|required');
		$this->form_validation->set_rules('blo_title_en','Título em inglês','trim|required');
		$this->form_validation->set_rules('tags[]','Categorias','trim|required');
		$this->form_validation->set_rules('blo_news_pt_br','Corpo da notícia em português','trim|required');
		$this->form_validation->set_rules('blo_news_en','Corpo da notícia em Inglês','trim|required');
		$this->form_validation->set_rules('blo_link','Link personalizado','trim|is_unique[blog.blo_link]',['is_unique'=>'O link personalizado precisa ser único.']);
		$this->form_validation->set_rules('blo_send_to_email','Enviar para inscritos','trim');
		$this->form_validation->set_rules('blo_show','Exibir','trim');

		if($this->form_validation->run() == FALSE){
			if(validation_errors()){
				set_msg(validation_errors(),'warning');
			}
		}else{
			$send_data = $this->input->post();

			$send_data['blo_timezone'] = date_default_timezone_get();

			if(!isset($send_data['blo_link']) || $send_data['blo_link'] == ''){
				$send_data['blo_link'] = remove_especial_chars($send_data['blo_title_pt_br']);
			}
			if(!isset($send_data['blo_send_to_email']) || $send_data['blo_send_to_email'] == ''){
				$send_data['blo_send_to_email'] = 0;
			}else{
				$send_data['blo_send_to_email'] = 1;
			}
			$images = false;
			if(isset($_FILES['images']['name']) && count($_FILES['images']['name']) > 0){
				$images = upload_imagem($_FILES,'blog');
			}		
			if($images){
				if(isset($images['blo_image'])){
					$send_data['blo_image'] = $images['blo_image'];
				}

				if(isset($images['blo_cover'])){
					$send_data['blo_cover'] = $images['blo_cover'];
				}
				
				
			}


				//fazer o metodo para cadastrar!!!
			if($inserted = $this->blog->insert($send_data)){
				if($send_data['blo_send_to_email'] === 1){
					$this->load->model('Newsletters_model','newsletters');
					$params['select'] = "new_id,new_email,new_name,new_contact,new_country_code";
					$params['order'] = ["new_id"=>"asc"];
					$news = $this->newsletters->get_all($params);

					if($news){
						foreach ($news as $key => $sub) {
							$enviar_email = [
								'nome' => $sub['new_name'],
								'email' => $sub['new_email'],
								'lang' => ($sub['new_country_code'] == '' || strpos(strtolower($sub['new_country_code']),'br') ? 'pt-br' : 'en'),
								'url' => $send_data['blo_link'],
								'telefone' => '',
								'mensagem' => $send_data,
								'new_id' => $sub['new_id']
							];

							$enviar_email['url'] = $enviar_email['lang']."/blog"."/".date('m')."/".date('Y')."/".$enviar_email['url'];
							$enviar_email['titulo'] = $send_data['blo_title_'.str_replace('-','_',$enviar_email['lang'])];
							$send_email = enviar_email($enviar_email,'newsletters_news');
							if(!$send_email){
								if(!isset($erros_email)){
									$erros_email = 0;
								}
								$erros_email++;
								ethernal_log('ETH_ERROR','Erro ao enviar newsletter',implode(' | ',$send_data)." -- recebedor: ".implode(' | ',$enviar_email),__METHOD__);
								ethernal_log('ETH_ERROR','Retorno ao enviar email',(is_array($send_email) ? implode(' | ',$send_email) : $send_email),__METHOD__);
							}else{
								$this->newsletter->insert_send_new(['sne_new_id'=>$enviar_email['new_id'],'sne_blo_id'=>$inserted]);
							}
						}
						if(isset($erros_email)){
							set_msg('Notícia postada com sucesso, mas houve '.$erros_email.' e-mails não enviados','warning');
						}
					}
				}
				redirect('painel/blog');
			}else{
				ethernal_log('ETH_ERROR','Erro ao cadastrar nova notíca com imagem',implode(' | ',$send_data),__METHOD__);
			}
			
		}

		$data= [
			'title' => 'Nova notícia',
			'heading' => 'Nova notícia',
			'tags' => $tags,
		];
		
		load_template($data,'blog/insert');
	}

	public function update($id = false){
		if(!$id){
			redirect('painel/blog');
		}
		$news = $this->blog->get_by_pk($id);
		if(!$news){
			set_msg('Post não encontrado','warning');
			redirect('painel/blog');
		}


		$params['select'] = "tag_id,tag_title_pt_br, tag_title_en";
		$tgs = $this->tags->get_all($params);
		$tags = [];
		if($tgs){
			foreach ($tgs as $ln => $tag) {
				$tags[$tag['tag_id']] = $tag['tag_title_pt_br']." / ".$tag['tag_title_en'];
			}

		}
		
		$this->form_validation->set_rules('blo_title_pt_br','Título em Português','trim|required');
		$this->form_validation->set_rules('blo_title_en','Título em inglês','trim|required');
		$this->form_validation->set_rules('tags[]','Categorias','trim|required');
		$this->form_validation->set_rules('blo_news_pt_br','Corpo da notícia em português','trim|required');
		$this->form_validation->set_rules('blo_news_en','Corpo da notícia em Inglês','trim|required');
		$this->form_validation->set_rules('blo_link','Link personalizado','trim'.((isset($_POST) && isset($_POST['blo_link']) && $_POST['blo_link'] == $news['blo_link']) ? '':'|is_unique[blog.blo_link]'),['is_unique'=>'O link personalizado precisa ser único.']);
		$this->form_validation->set_rules('blo_show','Exibir','trim');

		if($this->form_validation->run() == FALSE){
			if(validation_errors()){
				set_msg(validation_errors(),'warning');
			}
		}else{
			$send_data = $this->input->post();

			if(!isset($send_data['blo_link']) || $send_data['blo_link'] == ''){
				$send_data['blo_link'] = $news['blo_link'];
			}

			$images = false;
			if(isset($_FILES['images']['name']) && count($_FILES['images']['name']) > 0){
				$images = upload_imagem($_FILES,'blog');
			}		
			if($images){
				if(isset($images['blo_image'])){
					$send_data['blo_image'] = $images['blo_image'];
					$image_old = $news['blo_image'];
				}

				if(isset($images['blo_cover'])){
					$send_data['blo_cover'] = $images['blo_cover'];
					$cover_old = $news['blo_cover'];
				}
				
				
			}
				
				
			//fazer o metodo para cadastrar!!!
			if($updated = $this->blog->update($id,$send_data)){
				if(isset($image_old)){
					remover_imagem($image_old,'blog');
				}
				if(isset($cover_old)){
					remover_imagem($cover_old,'blog');
				}
				set_msg('Post atualizado','success');
				redirect('painel/blog');
			}else{
				set_msg('Post não foi atualizado','warning');
				ethernal_log('ETH_ERROR','Erro ao cadastrar nova notíca com imagem',implode(' | ',$send_data),__METHOD__);
			}



			
		}
		
		

		$data= [
			'title' => 'Atualizar post',
			'heading' => 'Atualizar post',
			'tags' => $tags,
			'news' => $news
		];
		
		load_template($data,'blog/update');
	}

	public function toggle($blo_id){
		if(!$this->blog->toggle($blo_id)){
			set_msg('Postagem não encontrada','warning');
		}
		redirect('painel/blog');
	}

	public function delete($blo_id){
		if(!$this->blog->delete($blo_id)){
			set_msg('Postagem não encontrada','warning');
		}
		redirect('painel/blog');
	}
}