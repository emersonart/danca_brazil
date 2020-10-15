<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->library("pagination");
		$this->load->model('users_model','users');
	}

	public function index(){
		$params['select'] = "use_id, use_datetime,use_name, use_email,use_nickname,use_stu_id";
		$params['order'] = ["use_id"=>"desc"];
		$users = $this->users->get_all($params);
		if($users){
			foreach ($users as $ln => $user) {
				$users[$ln]['use_id'] = ['data'=>$user['use_id'],'style'=>'width: 40px'];
				$users[$ln]['use_datetime'] = ['data'=>date('d/m/Y \à\s H:i',strtotime($user['use_datetime'])),'style'=>'width: 150px'];
				$users[$ln]['use_stu_id'] = $user['use_stu_id'] == 1 ? 'Sim' : 'Não';
				$eo = $user['use_stu_id'] == 1 ? "<i class='far fa-eye'></i>" : "<i class='far fa-eye-slash'></i>";
				$cl = $user['use_stu_id'] == 1 ? 'warning' : 'success';
				$users[$ln]['botoes'] = "";
				$users[$ln]['botoes'] .= "<a href='".base_url('painel/users/update/'.$user['use_id'])."' class='btn btn-sm btn-primary'><i class='far fa-edit'></i></a> ";
				$users[$ln]['botoes'] .= "<a href='".base_url('painel/users/toggle/'.$user['use_id'])."' class='btn btn-sm btn-".$cl."'>".$eo."</a> ";
				$users[$ln]['botoes'] = ['style'=>'width: 180px','data'=>$users[$ln]['botoes']];
				unset($users[$ln]['use_stu_id']);
			}
		}
		$data = [
			'heading' => 'Usuários',
			'title' => 'Usuários',
			'users' => $users
		];

		load_template($data,'users/index');
	}

	public function insert(){
		$permss = $this->users->get_permissions();
		$perms = [];
		if($permss){
			foreach ($permss as $ln => $perm) {
				$perms[$perm['per_id']] = $perm['per_permission'];
			}

		}
		$sts = $this->users->get_status();
		$status = [];
		if($sts){
			foreach ($sts as $ln => $st) {
				$status[$st['stu_id']] = $st['stu_status'];
			}

		}
		$this->form_validation->set_rules('use_nickname','Usuário','trim|required|is_unique[users.use_nickname]',['required'=>'Insira o nome de  usuário']);
		$this->form_validation->set_rules('use_email','E-mail','trim|required|valid_email|is_unique[users.use_nickname]',['required'=>'Insira o e-mail']);
		$this->form_validation->set_rules('use_password','Senha','trim|required|min_length[6]',['required'=>'Insira a senha']);
		$this->form_validation->set_rules('use_per_id','Permissão','trim|required|is_numeric',['required'=>'Selecione um nível de permissão']);
		$this->form_validation->set_rules('use_per_id','Status','trim|required|is_numeric',['required'=>'Selecione um status']);
		if($this->form_validation->run() == FALSE){
			if(validation_errors()){
				set_msg(validation_errors(),'warning');
			}
		}else{
			$send_data = $this->input->post();
			$images = false;
			if(isset($_FILES['images']['name']) && count($_FILES['images']['name']) > 0){
				$images = upload_imagem($_FILES,'users');
			}		
			if($images){
				if(isset($images['use_avatar'])){
					$send_data['use_avatar'] = $images['use_avatar'];
				}
			}
			if($cadastrado = $this->users->insert($send_data)){
				set_msg('Usuário cadastrado com sucesso','success');

				redirect('painel/users');
			}else{
				if($images){
					if(isset($images['use_avatar'])){
						remover_imagem($images['use_avatar'],'users');
					}
				}
			}
		}
		$data= [
			'title' => 'Cadastrar usuário',
			'heading' => 'Cadastrar usuário',
			'permissoes' => $perms,
			'status' => $status
		];
		load_template($data,'users/insert');
		
	}

	public function update($id){
		$user = $this->users->get_by_pk($id,true);
		if(!$user){
			set_msg('Usuário não encontrado');
			redirect('painel/users');
		}
		$permss = $this->users->get_permissions();
		$perms = [];
		if($permss){
			foreach ($permss as $ln => $perm) {
				$perms[$perm['per_id']] = $perm['per_permission'];
			}

		}
		$sts = $this->users->get_status();
		$status = [];
		if($sts){
			foreach ($sts as $ln => $st) {
				$status[$st['stu_id']] = $st['stu_status'];
			}

		}
		if($this->input->post() && $this->input->post()['use_nickname'] != $user['use_nickname']){
			$this->form_validation->set_rules('use_nickname','Usuário','trim|required|is_unique[users.use_nickname]',['required'=>'Insira o nome de  usuário']);
		}
		
		if($this->input->post() && $this->input->post()['use_email'] != $user['use_email']){
			$this->form_validation->set_rules('use_email','E-mail','trim|required|valid_email|is_unique[users.use_nickname]',['required'=>'Insira o e-mail']);
		}else{
			$this->form_validation->set_rules('use_email','E-mail','trim|required|valid_email',['required'=>'Insira o e-mail']);
		}
		
		$this->form_validation->set_rules('use_password','Senha','trim|min_length[6]',['required'=>'Insira a senha']);
		$this->form_validation->set_rules('use_per_id','Permissão','trim|required|is_numeric',['required'=>'Selecione um nível de permissão']);
		$this->form_validation->set_rules('use_per_id','Status','trim|required|is_numeric',['required'=>'Selecione um status']);
		if($this->form_validation->run() == FALSE){
			if(validation_errors()){
				set_msg(validation_errors(),'warning');
			}
		}else{
			$send_data = $this->input->post();
			if($send_data['use_password'] == ''){
				unset($send_data['use_password']);
			}
			$images = false;
			if(isset($_FILES['images']['name']) && count($_FILES['images']['name']) > 0){
				$images = upload_imagem($_FILES,'users');
			}		
			if($images){
				if(isset($images['use_avatar'])){
					$send_data['use_avatar'] = $images['use_avatar'];
					$image_old = $user['use_avatar'];
				}
			}
			if($atualizado = $this->users->update($id,$send_data)){
				set_msg('Usuário atualizado com sucesso','success');
				if(isset($image_old)){
					remover_imagem($image_old,'users');
				}
				redirect('painel/users');
			}else{
				if($images){
					if(isset($images['use_avatar'])){
						remover_imagem($images['use_avatar'],'users');
					}
				}
			}
		}
		$data= [
			'title' => 'Editar usuário',
			'heading' => 'Editar usuário',
			'permissoes' => $perms,
			'status' => $status,
			'user' => $user
		];
		load_template($data,'users/update');
		
	}

	public function login(){
		$data = [
			'password' => 'emerson23',
			'login' => 'adminemerson'
		];
		$this->form_validation->set_rules('login','Usuário','trim|required',['required'=>'Insira seu nome de usuário']);
		$this->form_validation->set_rules('password','Senha','trim|required',['required'=>'Insira sua senha']);
		if($this->form_validation->run() == FALSE){
			if(validation_errors()){
				set_msg(validation_errors(),'warning');
			}
		}else{
			$send_data = $this->input->post();

			if($logged= $this->users->login($send_data)){
				$this->session->set_userdata('logged',$logged);

				redirect('painel');
			}else{
				set_msg('Usuário ou senha inválidos','danger');
			}
		}
		

		$this->load->view('painel/login');
	}

	public function sair(){
		$this->session->unset_userdata('logged');
		redirect('/');
	}
}