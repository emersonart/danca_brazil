<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
	*	eth_social_medias

	*	soc_id - int(11) - PK
	*	soc_datetime - datetime() - CURRENT_TIMESTAMP
	*	soc_type_id - int(11) FK -> type_of_menus
	*	soc_updated_at - datetime()
	*	soc_deleted_at - datetime()
	*	soc_title - varchar()
	*	soc_link - var_char()
	*	soc_show - int(1)



*/

class Courses_model extends CI_Model {

	protected $table = 'social_medias';
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

	public function update($soc_id,$params)
    {
        $this->db->where('soc_id',$soc_id);
        return $this->db->update($this->table,$params);
    }

    public function delete($soc_id)
    {
        $this->db->where('soc_id',$soc_id);
        $now = date('Y-m-d H:i:s');
        $params = [
        	'soc_deleted_at' => date('Y-m-d H:i:s'),
        	'soc_show' => 0
        ];
        return $this->db->update($this->table,$params);
    }

    public function remove($soc_id)
    {
        $this->db->delete($this->table,array('soc_id'=>$soc_id));
    }
}
