<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
	*	eth_blog

	*	blo_id - int(11) - PK
	*	blo_datetime - datetime() - CURRENT_TIMESTAMP
	*	blo_type_id - int(11) FK -> type_of_menus
	*	blo_updated_at - datetime()
	*	blo_deleted_at - datetime()
	*	blo_title - varchar()
	*	blo_link - var_char()
	*	blo_show - int(1)



*/

class Videos_model extends CI_Model {

	protected $table;
	protected $langua;
	protected $pk;
	public function __construct() {
		parent::__construct();
		$this->langua = str_replace('-','_', get_language());
		$t = explode('_',get_class($this));
		array_pop($t);
		$this->table = strtolower(implode('_',$t));

		$fields = $this->db->field_data($this->table);
		foreach ($fields as $field) {
			if($field->primary_key){
				$this->pk = $field->name;
				break;
			}
		}
	}

	protected function limpar_string($string){
		return preg_replace(array("/(á|ā|ã|â|ä)/","/(Á|Ā|Ã|Â|Ä)/","/(é|č|ę|ë)/","/(É|Č|Ę|Ë)/","/(í|ė|î|ï)/","/(Í|Ė|Î|Ï)/","/(ó|ō|õ|ô|ö)/","/(Ó|Ō|Õ|Ô|Ö)/","/(ú|ų|û|ü)/","/(Ú|Ų|Û|Ü)/","/(ņ)/","/(Ņ)/"),explode(" ","a A e E i I o O u U n N"),$string);
	}

	public function get_all($params = null){
		
		$this->db->from($this->table);

		if(isset($params['select'])){
			$this->db->select($params['select']);
		}else{
			$this->db->select('*');
		}

		if(isset($params['order']) && is_array($params['order'])){
			foreach ($params['order'] as $key => $value) {
				$this->db->order_by($key,$value);
			}
		}
		if(isset($params['limit'])){
			if(is_array($params['limit'])){
				$this->db->limit($params['limit']['limit'],$params['limit']['initial']);
			}else{
				$this->db->limit($params['limit']);
			}
		}

		if(isset($params['where']) && is_array($params['where'])){
			foreach ($params['where'] as $key => $value) {
				$this->db->where($key,$value);
			}
		}
		if(!isset($params['not_deleted']) || $params['not_deleted'] == false){
			$this->db->group_start()->where('vid_deleted_at IS NULL',null,true)->or_where('vid_deleted_at',"")->or_where('vid_deleted_at','0000-00-00 00:00:00')->group_end();
			$this->db->where('vid_show',1);
		}

		if(isset($params['search']) and $params['search'] != '' and strlen($params['search']) > 0){
			$params['search'] = $this->db->escape_like_str($params['search']);
			$params['search'] = $this->limpar_string(utf8_decode(trim($params['search'])));
			$params['search'] = implode('%',explode(' ',$params['search']));
			$this->db->group_start();
			$this->db->or_like('vid_title_pt_br',$params['search'],'both',FALSE);
			$this->db->or_like('vid_title_en',$params['search'],'both',FALSE);
			$this->db->group_end();
		}

		$query = $this->db->get();
		if($query->num_rows() > 0){
			$result = $query->result_array();
			
			return $result;
		}

		return FALSE;
	}
	public function get_by_pk($id){
		$this->db->where($this->pk,$id);
		$this->db->from($this->table);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			$result = $query->row_array();
			return $result;
		}
		return false;
	}

	public function get($params = FALSE){
		if(isset($params['where']) && is_array($params['where'])){
			foreach ($params['where'] as $key => $value) {
				$this->db->where($key,$value);
			}
		}
		if(isset($params['select'])){
			$this->db->select($params['select']);
		}else{
			$this->db->select('*');
		}
		if(isset($params['limit'])){
			if(is_array($params['limit'])){
				$this->db->limit($params['limit']['initial'],$params['limit']['limit']);
			}else{
				$this->db->limit($params['limit']);
			}
		}

		if(isset($params['order']) && is_array($params['order'])){
			foreach ($params['order'] as $key => $value) {
				$this->db->order_by($key,$value);
			}
		}
	
		$this->db->from($this->table);

		$query = $this->db->get();

		if($query->num_rows() > 0){
			$result = $query->result_array();
			return $result;
		}

		return FALSE;
	}

	public function count($params){

		$query = $this->db->get();

		return count($this->get_all($params));
	}

	public function insert($params){
		$this->db->insert($this->table,$params);
		return $this->db->insert_id();
	}

	public function update($pk,$params)
    {

        $this->db->where($this->pk,$pk);
		return $this->db->update($this->table,$params);
    }

    public function delete($pk)
    {

        return $this->remove($pk);
    }

    public function remove($pk)
    {
    	$this->db->where($this->pk,$pk);
    	return $this->db->delete($this->table);
    }

}
