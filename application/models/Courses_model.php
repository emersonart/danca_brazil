<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
	*	eth_curial_medias

	*	cur_id - int(11) - PK
	*	cur_datetime - datetime() - CURRENT_TIMESTAMP
	*	cur_type_id - int(11) FK -> type_of_menus
	*	cur_updated_at - datetime()
	*	cur_deleted_at - datetime()
	*	cur_title - varchar()
	*	cur_link - var_char()
	*	cur_show - int(1)



*/

class Courses_model extends CI_Model {

	protected $table;
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
	
		$this->db->from($this->table);

		$query = $this->db->get();

		if($query->num_rows() > 0){
			return $query->result_array();
		}

		return FALSE;
	}

	public function get_all($params = FALSE){
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

		if(!isset($params['not_deleted']) || $params['not_deleted'] == false){
			$this->db->group_start()->where('cur_deleted_at IS NULL',null,true)->or_where('cur_deleted_at',"")->or_where('cur_deleted_at','0000-00-00 00:00:00')->group_end();
		}

		if(isset($params['limit'])){
			if(is_array($params['limit'])){
				$this->db->limit($params['limit']['initial'],$params['limit']['limit']);
			}else{
				$this->db->limit($params['limit']);
			}
		}
	
		$this->db->from($this->table);

		$query = $this->db->get();

		if($query->num_rows() > 0){
			return $query->result_array();
		}

		return FALSE;
	}

	public function insert($params){
		$this->db->insert($this->table,$params);
		return $this->db->insert_id();
	}

	public function update($cur_id,$params)
    {
        $this->db->where($this->pk,$cur_id);
        return $this->db->update($this->table,$params);
    }

    public function delete($cur_id)
    {
        $this->db->where($this->pk,$cur_id);
        $now = date('Y-m-d H:i:s');
        $params = [
        	'cur_deleted_at' => date('Y-m-d H:i:s')
        ];
        return $this->db->update($this->table,$params);
    }

    public function remove($cur_id)
    {
    	$c = $this->get_by_pk($cur_id);
        $this->db->delete($this->table,array($this->pk=>$cur_id));
        if($this->db->affected_rows()){
        	remover_imagem($c['cur_image'],'courses');
        }
    }

    public function toggle($cur_id){
    	$new = $this->get_by_pk($cur_id);
    	if($new){
    		if($new['cur_show'] == 1){
    			$show = 0;
    		}else{
    			$show = 1;
    		}
    		$this->db->where('cur_id',$cur_id);
	        $params = [
	        	'cur_show' => $show
	        ];
	        return $this->db->update($this->table,$params);
    	}
    	return false;
    }
}
