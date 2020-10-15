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

class Socialmedias_model extends CI_Model {

	protected $table = 'social_medias';

	public function __construct() {
		parent::__construct();
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
