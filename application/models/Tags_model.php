<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
	*	eth_blog

	*	tag_id - int(11) - PK
	*	tag_datetime - datetime() - CURRENT_TIMESTAMP
	*	tag_type_id - int(11) FK -> type_of_menus
	*	tag_updated_at - datetime()
	*	tag_deleted_at - datetime()
	*	tag_title - varchar()
	*	tag_link - var_char()
	*	tag_show - int(1)



*/

class Tags_model extends CI_Model {

	protected $table = 'tags';

	public function __construct() {
		parent::__construct();
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

	
		$this->db->from($this->table);

		$query = $this->db->get();

		if($query->num_rows() > 0){
			return $query->row_array();
		}

		return FALSE;
	}

	public function insert($params){
		$this->db->insert($this->table,$params);
		return $this->db->insert_id();
	}

	public function update($tag_id,$params)
    {
        $this->db->where('tag_id',$tag_id);
        return $this->db->update($this->table,$params);
    }

    public function delete($tag_id)
    {
        $this->db->where('tag_id',$tag_id);
        $now = date('Y-m-d H:i:s');
        $params = [
        	'tag_deleted_at' => date('Y-m-d H:i:s'),
        	'tag_show' => 0
        ];
        return $this->db->update($this->table,$params);
    }

    public function remove($tag_id)
    {
        $this->db->delete($this->table,array('tag_id'=>$tag_id));
    }
}
