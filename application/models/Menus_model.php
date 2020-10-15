<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
	*	eth_menus

	*	men_id - int(11) - PK
	*	men_datetime - datetime() - CURRENT_TIMESTAMP
	*	men_type_id - int(11) FK -> type_of_menus
	*	men_updated_at - datetime()
	*	men_deleted_at - datetime()
	*	men_title - varchar()
	*	men_link - var_char()
	*	men_show - int(1)



*/

class Menus_model extends CI_Model {

	protected $table = 'menus';
	protected $language;

	public function __construct() {
		parent::__construct();
		$this->language = str_replace('-', '_', get_language()); 
	}

	public function get_all_by_type($type = 'panel', $all = FALSE){
		if($type == 'panel'){
			$this->db->where('men_type_id',2);
		}elseif($type == 'site'){
			$this->db->where('men_type_id',1);
		}
		
		$this->db->select('*, men_title_'.$this->language." men_title");

		$this->db->from($this->table);
		if(!$all){
			$this->db->where('men_show',1);
		}

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
			return $query->row_array();
		}

		return FALSE;
	}

	public function insert($params){
		$this->db->insert($this->table,$params);
		return $this->db->insert_id();
	}

	public function update($men_id,$params)
    {
        $this->db->where('men_id',$men_id);
        return $this->db->update($this->table,$params);
    }

    public function delete($men_id)
    {
        $this->db->where('men_id',$men_id);
        $now = date('Y-m-d H:i:s');
        $params = [
        	'men_deleted_at' => date('Y-m-d H:i:s'),
        	'men_show' => 0
        ];
        return $this->db->update($this->table,$params);
    }

    public function remove($men_id)
    {
        $this->db->delete($this->table,array('men_id'=>$men_id));
       	$this->db->delete('tb_submenus',array('sub_men_id'=>$men_id));
    }
}
