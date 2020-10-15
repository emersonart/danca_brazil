<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tags extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library("pagination");
        $this->load->model('Tags_model','tags');
    }


    public function index(){
        $params['select'] = "tag_id, tag_datetime,tag_title_pt_br, tag_title_en,tag_show";
        $params['order'] = ["tag_id"=>"desc"];
        $tags = $this->tags->get_all($params);
        if($tags){
            foreach ($tags as $ln => $tag) {
                $tags[$ln]['tag_datetime'] = date('d/m/Y \à\s H:i',strtotime($tag['tag_datetime']));
                $tags[$ln]['tag_show'] = $tag['tag_show'] == 1 ? 'Sim' : 'Não';
                $eo = $tag['tag_show'] == 1 ? "<i class='far fa-eye'></i>" : "<i class='far fa-eye-slash'></i>";
                $cl = $tag['tag_show'] == 1 ? 'warning' : 'success';
                $tags[$ln]['botoes'] = "";
                $tags[$ln]['botoes'] .= "<a href='".base_url('painel/tags/edit/'.$tag['tag_id'])."' class='btn btn-sm btn-primary'><i class='far fa-edit'></i></a> ";
                // $tags[$ln]['botoes'] .= "<a href='".base_url('painel/tags/delete/'.$tag['tag_id'])."' class='btn btn-sm btn-".$cl."'>".$eo."</a> ";
                // $tags[$ln]['botoes'] .= "<a href='".base_url('painel/tags/remove/'.$tag['tag_id'])."' class='btn btn-sm btn-danger'><i class='far fa-trash-alt'></i></a> ";
                $tags[$ln]['botoes'] = ['style'=>'width: 180px','data'=>$tags[$ln]['botoes']];
            }
        }
        

        $data = [
            'heading' => 'Posts',
            'tags' => $tags
        ];
        load_template($data,'tags/index');
    }

    public function insert(){
        $data = [
            'heading' => 'Cadastrar nova tag',
            'title' => 'Cadastrar Tag'
        ];
        $this->form_validation->set_rules('tag_title_pt_br','Título em português','trim|required');
        $this->form_validation->set_rules('tag_title_en','Título em inglês','trim|required');

        if($this->form_validation->run() == FALSE){
            if(validation_errors()){
                set_msg(validation_errors(),'warning','fa-check');
            }
        }else{
            $dados = $this->input->post();
            $send_data['tag_link'] = remove_especial_chars($send_data['tag_title_pt_br']);
            if($this->tags->insert($dados)){
                set_msg('Tag atualizada com sucesso','success');
                redirect('painel/tags');
            }else{
                set_msg('Não foi possível atualizar a tag','danger');
            }
        }
        load_template($data,'tags/insert');
    }


    public function edit($id){
        $tag = $this->tags->get_by_pk($id);
        if(!$tag){
            redirect('painel/tags');
        }
        $data = [
            'heading' => 'Editar tag',
            'title' => 'Editar Tag',
            'tag' => $tag
        ];
        $this->form_validation->set_rules('tag_title_pt_br','Título em português','trim|required');
        $this->form_validation->set_rules('tag_title_en','Título em inglês','trim|required');

        if($this->form_validation->run() == FALSE){
            if(validation_errors()){
                set_msg(validation_errors(),'warning','fa-check');
            }
        }else{
            $dados = $this->input->post();
            $send_data['tag_link'] = remove_especial_chars($send_data['tag_title_pt_br']);
            if($this->tags->update($id,$dados)){
                set_msg('Tag atualizada com sucesso','success');
                redirect('painel/tags');
            }else{
                set_msg('Não foi possível atualizar a tag','danger');
            }
        }
        load_template($data,'tags/edit');
    }

}