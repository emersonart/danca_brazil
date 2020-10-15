<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->output->set_content_type('application/json');
	}

	protected function output_json($retorno){
		$this->output->set_output(json_encode($retorno));
	}

	public function update_csrf(){
		$json_return = [
			'error' => FALSE,
			'msg' => lang('updated_csrf'),
			'token_value' => $this->security->get_csrf_hash()
		];

		$this->output_json($json_return);
	}

	public function get_error_message(){
		if($this->input->get('code')){
			if(!empty(lang($this->input->get('code')))){
				$json_return = [
					'error' => false,
					'msg' => lang($this->input->get('code'))
				];
			}else{
				$json_return = [
					'error' => 'invalid_code_error',
					'msg' => lang('invalid_code_error')
				];
			}
		}else{
			$json_return = [
				'error' => 'request_error',
				'msg' => lang('invalid_request')
			];
		}
		$this->output_json($json_return);
	}

	public function contact(){
		$json_return = [];

		if($this->input->is_ajax_request() && $this->input->post()){
			$this->load->model('Contacts_model','contact');
			$this->form_validation->set_rules('con_name','E-mail','trim|required');
			$this->form_validation->set_rules('con_email','E-mail','trim|required|valid_email');
			$this->form_validation->set_rules('con_contact','Contact','trim|required');
			$this->form_validation->set_rules('con_message','Mensagem','trim|required');
			$this->form_validation->set_rules('con_subject','Mensagem','trim');
			$this->form_validation->set_rules('con_cot_id','Corpo da notícia em português','trim|required|is_numeric');
			if($this->form_validation->run() == FALSE){
				if(validation_errors()){
					$json_return = [
						'error' => 'error_param',
						'msg' => validation_errors(),
					];
				}
			}else{
				$dados = $this->input->post();
				$accept = [
					'con_email',
					'con_contact',
					'con_message',
					'con_cot_id',
					'con_name',
					'con_extra',
					'con_subject'
				];
				foreach ($dados as $key => $value) {
					if(!in_array($key,$accept)){
						unset($dados[$key]);
					}
				}
				$dados['con_message'] = nl2br($dados['con_message']);
				if(!isset($dados['con_subject']) || $dados['con_subject'] == ''){
					$dados['con_subject'] = $this->contact->get_type($dados['con_cot_id']);
					$dados['con_subject'] = $dados['con_subject']['cot_type'];

				}
				
				$dados['con_ip_address'] = $this->input->ip_address();
				$ip_info = $this->ipdetails->init(['ip'=>$this->input->ip_address()])->scan();

				if($ip_info->get_status() == 200){
					$dados['con_city'] = $ip_info->get_city();
					$dados['con_region'] = $ip_info->get_region();
					$dados['con_country'] = $ip_info->get_country();
					$dados['con_region_code'] = $ip_info->get_regioncode();
					$dados['con_country_code'] = $ip_info->get_countrycode();
				}

				$dados['con_browser'] = $this->ua->browser();
				$dados['con_browser_version'] = $this->ua->version();
				$dados['con_mobile'] = ($this->ua->is_mobile() ? 1 : 0);
				$dados['con_os'] = $this->ua->platform();

				if($this->contact->insert($dados)){
					$enviar_email = [
						'nome' => $dados['con_name'],
						'email_send' => $dados['con_email'],
						'assunto' => $dados['con_subject'],
						'mensagem' => $dados['con_message'],
						'ip' => $dados['con_ip_address'],
						'telefone' => $dados['con_contact']
					];
					if($ip_info->get_status() == 200){
						$enviar_email['cidade'] = $ip_info->get_city();
						$enviar_email['estado'] = $ip_info->get_region();
						$enviar_email['pais'] = $ip_info->get_country();
					}

					if(!enviar_email($enviar_email,'fale_conosco')){
						ethernal_log('ETH_ERROR','Retorno ao enviar email',(is_array($enviar_email) ? implode(' | ',$enviar_email) : $enviar_email),__METHOD__);
					}


					$json_return = [
						'error' => false,
						'msg' => lang('send_contact')
					];
				}else{
					$json_return = [
						'error' => 'error_cadastrar',
						'msg' => lang('not_send_contact'),
					];
				}
			}
			
			
		}else{
			$json_return = [
				'error' => 'request_error',
				'msg' => lang('invalid_request')
			];
		}

		$this->output_json($json_return);
	}

	public function newsletter(){
		$json_return = [];

		if($this->input->is_ajax_request() && $this->input->post()){
			$this->load->model('Newsletters_model','newsletter');
			
			$this->form_validation->set_rules('new_email','E-mail','trim|required|valid_email|is_unique[newsletters.new_email]');
			$this->form_validation->set_rules('new_name',lang('name_input'),'trim|required');
			$this->form_validation->set_rules('new_contact',lang('cellphone_input'),'trim');
			if($this->form_validation->run() == FALSE){
				if(validation_errors()){
					$json_return = [
						'error' => 'validation_error',
						'msg' => validation_errors()
					];
				}
			}else{
				$dados = $this->input->post();
				foreach ($dados as $key => $value) {
					if(!in_array($key, ['new_name','new_email','new_contact'])){
						unset($dados_enviados[$key]);
					}
				}
				$dados['new_ip_address'] = $this->input->ip_address();
				$ip_info = $this->ipdetails->init(['ip'=>$this->input->ip_address()])->scan();

				if($ip_info->get_status() == 200){
					$dados['new_city'] = $ip_info->get_city();
					$dados['new_region'] = $ip_info->get_region();
					$dados['new_country'] = $ip_info->get_country();
					$dados['new_region_code'] = $ip_info->get_regioncode();
					$dados['new_country_code'] = $ip_info->get_countrycode();
				}

				$dados['new_browser'] = $this->ua->browser();
				$dados['new_browser_version'] = $this->ua->version();
				$dados['new_mobile'] = ($this->ua->is_mobile() ? 1 : 0);
				$dados['new_os'] = $this->ua->platform();

				if($this->newsletter->insert($dados)){
					$json_return = [
						'error' => false,
						'msg' => lang('inserted_newsletter')
					];
				}else{
					$json_return = [
						'error' => 'insert_error',
						'msg' => lang('not_inserted_newsletter'),
					];
				}
			}
			
			
		}else{
			$json_return = [
				'error' => 'request_error',
				'msg' => lang('invalid_request')
			];
		}

		$this->output_json($json_return);
	}
	//Insert Tag API

	public function insert_tag(){
		$json_return = [];
		if($this->input->is_ajax_request() && $this->input->post()){
			$this->load->model('Tags_model','tags');
			$dados = $this->input->post();
			if($id = $this->tags->insert($dados)){
				$json_return = [
					'error' => false,
					'msg' => lang('inserted_tag'),
					'tag_id' => $id
				];
			}else{
				$json_return = [
					'error' => 'insert_error',
					'msg' => lang('not_inserted_tag'),
				];
			}
			
		}else{
			$json_return = [
				'error' => 'request_error',
				'msg' => lang('invalid_request')
			];
		}

		$this->output_json($json_return);
	}

	//summernote API

	public function summernote_manager_delete(){
		$json_return = array();

		if($this->input->is_ajax_request() && $this->input->post()){

			extract($_POST, strtoupper(EXTR_OVERWRITE));

			if(!isset($image) || empty($image)){
				$json_return = array(
					'error' => 'error_param',
					'msg' => 'Preencha todos os campos, por favor'
				);
			}else{
				$this->load->helper('path');
				if (file_exists( set_realpath('assets/images/manager/'.$image))){
					unlink(set_realpath('assets/images/manager/'.$image));
					//$this->painel->deletar_imagem($image);
					$json_return = array(
						'error' => false,
						'msg' => "Imagem excluída"
					);
				}else{
					$json_return = array(
						'error' => 'error_image_not_found',
						'msg' => 'Imagem não encontrada'
					);
				}
			}
		}else{
			$json_return = array(
				'error' => 'error_post',
				'msg' => lang('invalid_request')
			);
		}
		$this->output_json($json_return);
	}

	public function summernote_upload_delete_file(){
		 $json_return = array();

		if($this->input->is_ajax_request() && $this->input->post()){
			extract($this->input->post(), strtoupper(EXTR_OVERWRITE));
			if(!isset($src) || empty($src)){
				$json_return = array(
					'error' => 'error_param',
					'msg' => 'Preencha todos os campos, por favor'
				);
			}else{
				$this->load->helper('path');
				if(is_array($src)){
					$sucesso = $erro = [];
					foreach ($src as $key => $value) {
						$image = str_replace(base_url(),'',$value);
						if (file_exists( set_realpath($image))){
							unlink(set_realpath($image));
							//$this->painel->deletar_imagem($image);
							$sucesso[] = $value;
						}else{
							$erro[] = $value; 
						}
					}
					if(count($sucesso) == count($src)){
						$json_return = array(
							'error' => false,
							'msg' => "Imagem(s) excluída(s)"
						);
					}else{
						$json_return = array(
							'error' => 'error_images_not_found',
							'msg' => 'Imagem(s) não encontrada(s)',
							'images_erros' => $erro
						);
					}
				}else{
					$image = str_replace(base_url(),'',$src);
					if (file_exists( set_realpath($image))){
						unlink(set_realpath($image));
						//$this->painel->deletar_imagem($image);
						$json_return = array(
							'error' => false,
							'msg' => "Imagem excluída"
						);
					}else{
						$json_return = array(
							'error' => 'error_image_not_found',
							'msg' => 'Imagem não encontrada',
							'images_erros' => $image
						);
					}
				}
				
			}
		}else{
			$json_return = array(
				'error' => 'error_post',
				'msg' => lang('invalid_request')
			);
		}
		$this->output_json($json_return);
	}

	public function summernote_manager(){
		$this->load->view('painel/summernote/manager');
	}

	public function summernote_manager_upload(){
		$json_return = array();
		if($this->input->is_ajax_request() && $this->input->post()) {
			extract($_POST, strtoupper(EXTR_OVERWRITE));
			if(empty($_FILES['images'])){
				$json_return = array(
					'error' => 'error_post_image',
					'msg' => 'Imagem não enviada'
				);
			}else{
				if($image = upload_imagem($_FILES,'manager')){
					$json_return = array(
						'error' => false,
						'msg' => 'Upload realizado com sucesso',
						'image' => base_url('assets/images/manager/'.$image[0])
					);
				}else{
					$json_return = array(
						'error' => 'error_upload',
						'msg' => 'Erro Upload ' 
					);
				}
			}
		}else{

			$json_return = array(
				'error' => 'error_post',
				'msg' => 'Parâmetros incorretos de envio'
			);

			
		}
		$this->output_json($json_return);
	}

	public function summernote_manager_upload_file(){
		$json_return = array();
		if($this->input->is_ajax_request() && $this->input->post()) {
			extract($_POST, strtoupper(EXTR_OVERWRITE));
			if(!empty($_FILES['name'])){
				$json_return = array(
					'error' => 'error_post_file',
					'msg' => 'Arquivo não enviado' 
				);
			}else{
				$image = $_FILES;
				reset ($image);
				$temp = current($image);
				$var= explode('.', $temp['name']);
			    $extension = strtolower(end($var));
			    $archive_name = encrypt_key(date('Y-m-d-H-i-s')).".".$extension;
				$this->load->helper('path');
				$path = set_realpath('assets/archives');
				if(!is_dir($path)){
					mkdir($path,0755);
				}
				$configuracao = array(
			        'upload_path'   => $path,
			        'allowed_types' => 'pdf|txt|jpg|jpeg|png|gif|doc|docx|xls|xlsx|mp4|avi|mp3|wav|pptx|ppt',
			        'file_name'     => $archive_name
			    );      
			    $this->load->library('upload');
			    $this->upload->initialize($configuracao);
			    if($this->upload->do_upload('file')){
			    	$json_return = array(
						'error' => false,
						'msg' => 'Upload correto',
						'filename' => base_url('assets/archives/'.$archive_name)
					);
			    }else{
			    	$json_return = array(
						'error' => 'upload_error',
						'msg' => $this->upload->display_errors()
					);
			    }
			}
		}else{

			$json_return = array(
				'error' => 'error_post',
				'msg' => 'Parâmetros incorretos de envio'
			);

			
		}
		echo json_encode($json_return);
	}

	public function instagram_feed($token = false){
		if(!$token){
			$token = TOKEN_INSTAGRAM;
		}

		$url = "https://graph.instagram.com/me/media?fields=id,media_type,media_url,username,timestamp,permalink,thumbnail_url,caption&access_token=".$token;
		$ch = curl_init();

		$ch_opt = [
			CURLOPT_URL => $url,
			CURLOPT_RETURNTRANSFER => true
		];

		curl_setopt_array($ch, $ch_opt);

		$result = json_decode(curl_exec($ch),true);
		$errors = curl_error($ch);
		$response = curl_getinfo($ch,CURLINFO_HTTP_CODE);

		curl_close($ch);
		if($errors){
			$json_return = array(
				'error' => 'error_get',
				'msg' => 'Não foi possível carregar feed do instagram'
			);
		}else{
			$json_return = array(
				'error' => false,
				'msg' => 'Feed carregado com sucesso',
				'code' => $response,
				'data' => $result
			);
		}

		$this->output_json($json_return);
	}

}