<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
	*	eth_menus

	*	tes_id - int(11) - PK
	*	tes_datetime - datetime() - CURRENT_TIMESTAMP
	*	tes_type_id - int(11) FK -> type_of_menus
	*	tes_updated_at - datetime()
	*	tes_deleted_at - datetime()
	*	tes_title - varchar()
	*	tes_link - var_char()
	*	tes_show - int(1)



*/

class Testimonials_model extends CI_Model {

	protected $table;
	protected $pk;

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

	public function get($params = FALSE){
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
			$this->db->group_start()->where('tes_deleted_at IS NULL',null,true)->or_where('tes_deleted_at',"")->or_where('tes_deleted_at','0000-00-00 00:00:00')->group_end();
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

	public function update($tes_id,$params)
    {
        $this->db->where('tes_id',$tes_id);
        return $this->db->update($this->table,$params);
    }

    public function delete($tes_id)
    {
        $this->db->where('tes_id',$tes_id);
        $now = date('Y-m-d H:i:s');
        $params = [
        	'tes_deleted_at' => date('Y-m-d H:i:s'),
        ];
        return $this->db->update($this->table,$params);
    }


    public function toggle($tes_id){
    	$new = $this->get_by_pk($tes_id);
    	if($new){
    		if($new['tes_show'] == 1){
    			$show = 0;
    		}else{
    			$show = 1;
    		}
    		$this->db->where($this->pk,$tes_id);
	        $params = [
	        	'tes_show' => $show
	        ];
	        return $this->db->update($this->table,$params);
    	}
    	return false;
    }

    public function remove($tes_id)
    {
        $this->db->delete($this->table,array('tes_id'=>$tes_id));
    }
}
