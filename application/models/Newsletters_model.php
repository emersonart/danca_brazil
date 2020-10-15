<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
	*	eth_blog

	*	new_id - int(11) - PK
	*	new_datetime - datetime() - CURRENT_TIMESTAMP
	*	new_type_id - int(11) FK -> type_of_menus
	*	new_updated_at - datetime()
	*	new_deleted_at - datetime()
	*	new_title - varchar()
	*	new_link - var_char()
	*	new_show - int(1)



*/

class Newsletters_model extends CI_Model {

	protected $table = 'newsletters';
	protected $table_send_new = 'newsletters_send_news';

	public function __construct() {
		parent::__construct();
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


		if(!isset($params['not_deleted']) || $params['not_deleted'] == false){
			$this->db->group_start()->where('new_deleted_at IS NULL',null,true)->or_where('new_deleted_at',"")->or_where('new_deleted_at','0000-00-00 00:00:00')->group_end();
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

	public function insert_send_new($params){
		$this->db->insert($this->table_send_new,$params);
		return $this->db->insert_id();
	}

	public function update($new_id,$params)
    {
        $this->db->where('new_id',$new_id);
        return $this->db->update($this->table,$params);
    }

    public function delete($new_id)
    {
        $this->db->where('new_id',$new_id);
        $now = date('Y-m-d H:i:s');
        $params = [
        	'new_deleted_at' => date('Y-m-d H:i:s')
        ];
        return $this->db->update($this->table,$params);
    }

    public function remove($new_id)
    {
        $this->db->delete($this->table,array('new_id'=>$new_id));
    }
}
