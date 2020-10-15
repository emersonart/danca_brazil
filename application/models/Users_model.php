<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
	*	eth_users

	*	use_id - int(11) - PK
	*	use_datetime - datetime() - CURRENT_TIMESTAMP
	*	use_per_id - int(11) FK -> permissions
	*	use_updated_at - datetime()
	*	use_deleted_at - datetime()
	*	use_salt - varchar(255)
	*	use_password - longtext
	*	use_avatar - varchar(255)
	*	use_email - varchar(255)
	*	use_stu_id - int(11) FK -> user_status
	*	use_show - int(1)



*/

class Users_model extends CI_Model {

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

	public function get_by_pk($id,$unprotected =false){
		if(!$unprotected){
			$this->db->select('use_id,use_datetime,use_nickname,use_name,use_avatar,use_per_id,use_stu_id');
		}
		$this->db->from($this->table);
		$this->db->where($this->pk,$id);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			return $query->row_array();
		}
		return false;
	}

	public function login($params){
		$this->db->select('u.use_id,u.use_password');
		$this->db->from($this->table." u");
		$this->db->join('user_status us','u.use_stu_id = us.stu_id','inner');
		$this->db->or_group_start()
				 	->or_where('u.use_nickname',$params['login'])
				 	->or_where('u.use_email',$params['login'])
				 ->group_end();
		$this->db->where('us.stu_active',1);
		$get_password = $this->db->get();

		if($get_password->num_rows() == 1){

			$result_password = $get_password->row_array();
			$password = $result_password['use_password'];
			if(password_verify($params['password'],$password)){
				$this->db->select('use_id,use_nickname,use_email,use_name,use_per_id,use_stu_id');
				$this->db->from($this->table);
				$this->db->where('use_id',$result_password['use_id']);
				$this->db->where('use_password',$password);
				$get_user = $this->db->get();

				if($get_user->num_rows() == 1){
					$return = $get_user->row_array();
					return $return;
				}
			}

			
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
			return $query->result_array();
		}

		return FALSE;
	}

	public function insert($params){
		$params['use_password'] = password_hash($params['use_password'], PASSWORD_BCRYPT, ['cost'=>10]);
		$this->db->insert($this->table,$params);
		return $this->db->insert_id();
	}

	public function update($use_id,$params)
    {
    	if(isset($params['use_password'])){
    		password_hash($params['use_password'], PASSWORD_BCRYPT, ['cost'=>10]);
    	}
        $this->db->where('use_id',$use_id);
        return $this->db->update($this->table,$params);
    }

    public function delete($use_id)
    {
        $this->db->where('use_id',$use_id);
        $now = date('Y-m-d H:i:s');
        $params = [
        	'use_deleted_at' => date('Y-m-d H:i:s'),
        	'use_stu_id' => 2
        ];
        return $this->db->update($this->table,$params);
    }

    public function remove($use_id)
    {
        $this->db->delete($this->table,array('use_id'=>$use_id));
    }

    public function get_permissions(){
    	$this->db->from('permissions');
    	$query = $this->db->get();
    	if($query->num_rows() > 0){
    		return $query->result_array();
    	}
    	return false;
    }

    public function get_status(){
    	$this->db->from('user_status');
    	$query = $this->db->get();
    	if($query->num_rows() > 0){
    		return $query->result_array();
    	}
    	return false;
    }
}
