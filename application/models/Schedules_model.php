<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
	*	eth_blog

	*	sch_id - int(11) - PK
	*	sch_datetime - datetime() - CURRENT_TIMESTAMP
	*	sch_type_id - int(11) FK -> type_of_menus
	*	sch_updated_at - datetime()
	*	sch_deleted_at - datetime()
	*	sch_title - varchar()
	*	sch_link - var_char()
	*	sch_show - int(1)



*/

class Schedules_model extends CI_Model {

	protected $table = 'schedules';
	protected $langua;
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

	public function get_all($params = FALSE,$lang = 'pt-br'){
		$this->db->group_by('sch_id');
		$lang = str_replace('-', '_', $lang);
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
			$this->db->group_start()->where('sch_deleted_at IS NULL',null,true)->or_where('sch_deleted_at',"")->or_where('sch_deleted_at','0000-00-00 00:00:00')->group_end();
			$this->db->where('sch_show',1);
		}

		if(isset($params['search']) and $params['search'] != '' and strlen($params['search']) > 0){
			$params['search'] = $this->db->escape_like_str($params['search']);
			$params['search'] = $this->limpar_string(utf8_decode(trim($params['search'])));
			$params['search'] = implode('%',explode(' ',$params['search']));
			$this->db->group_start();
			$this->db->or_like('sch_title_pt_br',$params['search'],'both',FALSE);
			$this->db->or_like('sch_title_en',$params['search'],'both',FALSE);
			$this->db->group_end();
		}
	
		$this->db->from($this->table);


		$query = $this->db->get();

		if($query->num_rows() > 0){
			$result_agenda = $query->result_array();
			if(!isset($params['no_schedules_courses'])){
				foreach ($result_agenda as $key => $value) {
					$this->db->from('schedules_courses sc');
					$this->db->join('courses c','c.cur_id = sc.scr_cur_id','inner');
					$this->db->select('*');
					$this->db->where('sc.scr_sch_id',$value['sch_id']);
					if(!isset($params['not_deleted']) || $params['not_deleted'] == false){
						$this->db->group_start()->where('cur_deleted_at IS NULL',null,true)->or_where('cur_deleted_at',"")->or_where('cur_deleted_at','0000-00-00 00:00:00')->group_end();
						$this->db->where('cur_show',1);
					}
					
					$cursos = $this->db->get();
					if($cursos->num_rows() > 0){
						$result_agenda[$key]['cursos'] = $cursos->result_array();
					}
				}
			}
			return $result_agenda;
		}

		return FALSE;
	}
	public function get_by_pk($id){
		$this->db->where('sch_id',$id);
		$this->db->from($this->table);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			$result = $query->row_array();
			$this->db->select('c.cur_id,c.cur_title_pt_br, c.cur_title_en');
			$this->db->from('schedules_courses sc');
			$this->db->where('sc.scr_sch_id',$id);
			$this->db->join('courses c','c.cur_id = sc.scr_cur_id','inner');
			$query2 = $this->db->get();
			if($query2->num_rows() > 0){
				$result['cursos'] = $query2->result_array();
			}
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

		if(!isset($params['not_deleted']) || $params['not_deleted'] == false){
			$this->db->group_start()->where('sch_deleted_at IS NULL',null,true)->or_where('sch_deleted_at',"")->group_end();
		}
	
		$this->db->from($this->table);

		$query = $this->db->get();

		if($query->num_rows() > 0){
			$result = $query->result_array();

			foreach ($result as $key => $value) {
				$this->db->select('c.cur_id,c.cur_title_pt_br, c.cur_title_en');
				$this->db->from('sch_schedules_courses sc');
				$this->db->where('scr_sch_id',$value['sch_id']);
				$this->db->join('courses c','c.cur_id = sc.scr_cur_id','inner');
				$query2 = $this->db->get();
				if($query2->num_rows() > 0){
					$result[$key]['cursos'] = $query2->result_array();
				}
				$result[$key]['autor'] = $this->users->get_by_pk($value['sch_use_id']);
				
			}
			return $result;
		}

		return FALSE;
	}

	public function count($params){
		$this->db->group_by('sch_id');

		if(!isset($params['not_deleted']) || $params['not_deleted'] == false){
			$this->db->group_start()->where('sch_deleted_at IS NULL',null,true)->or_where('sch_deleted_at',"")->or_where('sch_deleted_at','0000-00-00 00:00:00')->group_end();
		}

		if(isset($params['search']) and $params['search'] != '' and strlen($params['search']) > 0){
			$params['search'] = $this->db->escape_like_str($params['search']);
			$params['search'] = $this->limpar_string(utf8_decode(trim($params['search'])));
			$params['search'] = implode('%',explode(' ',$params['search']));
			$this->db->group_start();
			$this->db->or_like('sch_news_pt_br',$params['search'],'both',FALSE);
			$this->db->or_like('sch_news_en',$params['search'],'both',FALSE);
			$this->db->or_like('sch_title_pt_br',$params['search'],'both',FALSE);
			$this->db->or_like('sch_title_en',$params['search'],'both',FALSE);
			$this->db->group_end();
		}

		if(isset($params['curso']) and $params['curso'] != '' and $params['curso'] != 0){
			$this->db->join('sch_schedules_courses','sch_schedules_courses.scr_sch_id = sch.sch_id','inner');
			$this->db->join('cursos','courses.cur_id = sch_schedules_courses.scr_cur_id','inner');
			$this->db->where('scr_cur_id',$params['cur_id']);
		}
	
		$this->db->from($this->table);


		$query = $this->db->get();

		return $query->num_rows();
	}

	public function insert($params){
		$cursos = $params['cursos'];
		unset($params['cursos']);
		$this->db->insert($this->table,$params);
		$id = $this->db->insert_id();
		if($id){
			$arr = [];
			foreach ($cursos as $key => $value) {
				$arr[] = [
					'scr_cur_id' => $value,
					'scr_sch_id' => $id
				];
			}
			$this->db->insert_batch('schedules_courses',$arr);
		}
		return $id;
	}

	public function update($sch_id,$params)
    {
    	$cursos = $params['cursos'];
		unset($params['cursos']);
		if(isset($params['old_cover'])){
			$old_cover = $params['old_cover'];
			unset($params['old_cover']);
		}
		if(isset($params['old_image'])){
			$old_image = $params['old_image'];
			unset($params['old_image']);
		}
        $this->db->where('sch_id',$sch_id);
        $updated = $this->db->update($this->table,$params);
        $arr = [];
        $this->db->where('scr_sch_id',$sch_id);
        $this->db->delete('schedules_courses');
        foreach ($cursos as $key => $value) {
			$arr[] = [
				'scr_cur_id' => $value,
				'scr_sch_id' => $sch_id
			];
		}
		$this->db->insert_batch('schedules_courses',$arr);
		// if($updated){
		// 	if(isset($old_cover) && $params['sch_cover'] != $old_cover){
		// 		@unlink(set_realpath('assets/images/blog/'.$old_cover));
		// 	}
		// 	if(isset($old_image) && $params['sch_image'] != $old_image){
		// 		@unlink(set_realpath('assets/images/blog/'.$old_image));
		// 	}
		// }
		return true;
    }

    public function delete($sch_id)
    {
        $this->db->where('sch_id',$sch_id);
        $now = date('Y-m-d H:i:s');
        $params = [
        	'sch_deleted_at' => date('Y-m-d H:i:s')
        ];
        return $this->db->update($this->table,$params);
    }

    public function toggle($sch_id){
    	$new = $this->get_by_pk($sch_id);
    	if($new){
    		if($new['sch_show'] == 1){
    			$show = 0;
    		}else{
    			$show = 1;
    		}
    		$this->db->where('sch_id',$sch_id);
	        $params = [
	        	'sch_show' => $show
	        ];
	        return $this->db->update($this->table,$params);
    	}
    	return false;
    }

    public function remove($sch_id)
    {
    	$this->db->where('scr_sch_id',$sch_id);
    	if($this->db->delete('sch_schedules_courses')){
    		$this->db->where('sch_id',$sch_id);
    		return $this->db->delete($this->table);
		}
		return false;
       
    }

    public function next($sch_id){
    	$this->db->where('sch_id >',$sch_id);
    	$this->db->group_start()->where('sch_deleted_at IS NULL',null,true)->or_where('sch_deleted_at',"")->or_where('sch_deleted_at','0000-00-00 00:00:00')->group_end();
    	$this->db->from($this->table);
    	$this->db->limit(1);
    	$this->db->select('*');
    	$this->db->order_by('sch_id','asc');
    	$query = $this->db->get();
    	if($query->num_rows() > 0){
    		return $query->row_array();
    	}
    	return false;
    }
    public function prev($sch_id){
    	$this->db->where('sch_id <',$sch_id);
    	$this->db->group_start()->where('sch_deleted_at IS NULL',null,true)->or_where('sch_deleted_at',"")->or_where('sch_deleted_at','0000-00-00 00:00:00')->group_end();
    	$this->db->from($this->table);
    	$this->db->limit(1);
    	$this->db->select('*');
    	$this->db->order_by('sch_id','desc');
    	$query = $this->db->get();
    	if($query->num_rows() > 0){

    		return $query->row_array();
    	}
    	return false;
    }
}
