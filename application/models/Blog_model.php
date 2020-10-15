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

class Blog_model extends CI_Model {

	protected $table = 'blog';
	protected $langua;
	public function __construct() {
		parent::__construct();
		$this->langua = str_replace('-','_', get_language());
		$this->load->model('Tags_model','tags');
	}

	protected function limpar_string($string){
		return preg_replace(array("/(á|ā|ã|â|ä)/","/(Á|Ā|Ã|Â|Ä)/","/(é|č|ę|ë)/","/(É|Č|Ę|Ë)/","/(í|ė|î|ï)/","/(Í|Ė|Î|Ï)/","/(ó|ō|õ|ô|ö)/","/(Ó|Ō|Õ|Ô|Ö)/","/(ú|ų|û|ü)/","/(Ú|Ų|Û|Ü)/","/(ņ)/","/(Ņ)/"),explode(" ","a A e E i I o O u U n N"),$string);
	}

	public function get_all($params = FALSE,$lang = 'pt-br'){
		$this->db->group_by('blo_id');
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
			$this->db->group_start()->where('blo_deleted_at IS NULL',null,true)->or_where('blo_deleted_at',"")->or_where('blo_deleted_at','0000-00-00 00:00:00')->group_end();
		}

		if(isset($params['search']) and $params['search'] != '' and strlen($params['search']) > 0){
			$params['search'] = $this->db->escape_like_str($params['search']);
			$params['search'] = $this->limpar_string(utf8_decode(trim($params['search'])));
			$params['search'] = implode('%',explode(' ',$params['search']));
			$this->db->group_start();
			$this->db->or_like('blo_news_pt_br',$params['search'],'both',FALSE);
			$this->db->or_like('blo_news_en',$params['search'],'both',FALSE);
			$this->db->or_like('blo_title_pt_br',$params['search'],'both',FALSE);
			$this->db->or_like('blo_title_en',$params['search'],'both',FALSE);
			$this->db->group_end();
		}

		if(isset($params['tag']) and $params['tag'] != '' and $params['tag'] != 0){
			$this->db->join('blog_tags','blog_tags.btg_blo_id = blog.blo_id','inner');
			$this->db->join('tags','tags.tag_id = blog_tags.btg_tag_id','inner');
			$this->db->where('btg_tag_id',$param['tag']);
		}
	
		$this->db->from($this->table);


		$query = $this->db->get();

		if($query->num_rows() > 0){
			$result_blog = $query->result_array();
			if(!isset($params['no_tags'])){
				foreach ($result_blog as $key => $value) {
					$this->db->from('blog_tags');
					$this->db->join('tags','tag_id = btg_tag_id','inner');
					$this->db->select('tag_id, tag_title_'.$lang." tag_title, tag_link");
					$this->db->where('tag_show',1);
					$tags = $this->db->get();
					if($tags->num_rows() > 1){
						$result_blog[$key]['tags'] = $tags->result_array();
					}
				}
			}
			return $result_blog;
		}

		return FALSE;
	}
	public function get_by_pk($id){
		$this->db->where('blo_id',$id);
		$this->db->from($this->table);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			$result = $query->row_array();
			$this->db->select('t.tag_id,t.tag_title_pt_br, t.tag_title_en');
			$this->db->from('blog_tags bt');
			$this->db->where('btg_blo_id',$id);
			$this->db->join('tags t','t.tag_id = bt.btg_tag_id','inner');
			$query2 = $this->db->get();
			if($query2->num_rows() > 0){
				$result['tags'] = $query2->result_array();
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
			$this->db->group_start()->where('blo_deleted_at IS NULL',null,true)->or_where('blo_deleted_at',"")->group_end();
		}
	
		$this->db->from($this->table);

		$query = $this->db->get();

		if($query->num_rows() > 0){
			$result = $query->result_array();

			foreach ($result as $key => $value) {
				$this->db->select('t.tag_id,t.tag_title_pt_br, t.tag_title_en');
				$this->db->from('blog_tags bt');
				$this->db->where('btg_blo_id',$value['blo_id']);
				$this->db->join('tags t','t.tag_id = bt.btg_tag_id','inner');
				$query2 = $this->db->get();
				if($query2->num_rows() > 0){
					$result[$key]['tags'] = $query2->result_array();
				}
				$result[$key]['autor'] = $this->users->get_by_pk($value['blo_use_id']);
				
			}
			return $result;
		}

		return FALSE;
	}

	public function count($params){
		$this->db->group_by('blo_id');

		if(!isset($params['not_deleted']) || $params['not_deleted'] == false){
			$this->db->group_start()->where('blo_deleted_at IS NULL',null,true)->or_where('blo_deleted_at',"")->or_where('blo_deleted_at','0000-00-00 00:00:00')->group_end();
		}

		if(isset($params['search']) and $params['search'] != '' and strlen($params['search']) > 0){
			$params['search'] = $this->db->escape_like_str($params['search']);
			$params['search'] = $this->limpar_string(utf8_decode(trim($params['search'])));
			$params['search'] = implode('%',explode(' ',$params['search']));
			$this->db->group_start();
			$this->db->or_like('blo_news_pt_br',$params['search'],'both',FALSE);
			$this->db->or_like('blo_news_en',$params['search'],'both',FALSE);
			$this->db->or_like('blo_title_pt_br',$params['search'],'both',FALSE);
			$this->db->or_like('blo_title_en',$params['search'],'both',FALSE);
			$this->db->group_end();
		}

		if(isset($params['tag']) and $params['tag'] != '' and $params['tag'] != 0){
			$this->db->join('blog_tags','blog_tags.btg_blo_id = blog.blo_id','inner');
			$this->db->join('tags','tags.tag_id = blog_tags.btg_tag_id','inner');
			$this->db->where('btg_tag_id',$params['tag']);
		}
	
		$this->db->from($this->table);


		$query = $this->db->get();

		return $query->num_rows();
	}

	public function insert($params){
		$tags = $params['tags'];
		unset($params['tags']);
		$this->db->insert($this->table,$params);
		$id = $this->db->insert_id();
		if($id){
			$arr = [];
			foreach ($tags as $key => $value) {
				$arr[] = [
					'btg_tag_id' => $value,
					'btg_blo_id' => $id
				];
			}
			$this->db->insert_batch('blog_tags',$arr);
		}
		return $id;
	}

	public function update($blo_id,$params)
    {
    	$tags = $params['tags'];
		unset($params['tags']);
		if(isset($params['old_cover'])){
			$old_cover = $params['old_cover'];
			unset($params['old_cover']);
		}
		if(isset($params['old_image'])){
			$old_image = $params['old_image'];
			unset($params['old_image']);
		}
        $this->db->where('blo_id',$blo_id);
        $updated = $this->db->update($this->table,$params);
        $arr = [];
        $this->db->where('btg_blo_id',$blo_id);
        $this->db->delete('blog_tags');
        foreach ($tags as $key => $value) {
			$arr[] = [
				'btg_tag_id' => $value,
				'btg_blo_id' => $blo_id
			];
		}
		$this->db->insert_batch('blog_tags',$arr);
		// if($updated){
		// 	if(isset($old_cover) && $params['blo_cover'] != $old_cover){
		// 		@unlink(set_realpath('assets/images/blog/'.$old_cover));
		// 	}
		// 	if(isset($old_image) && $params['blo_image'] != $old_image){
		// 		@unlink(set_realpath('assets/images/blog/'.$old_image));
		// 	}
		// }
		return true;
    }

    public function delete($blo_id)
    {
        $this->db->where('blo_id',$blo_id);
        $now = date('Y-m-d H:i:s');
        $params = [
        	'blo_deleted_at' => date('Y-m-d H:i:s')
        ];
        return $this->db->update($this->table,$params);
    }

    public function toggle($blo_id){
    	$new = $this->get_by_pk($blo_id);
    	if($new){
    		if($new['blo_show'] == 1){
    			$show = 0;
    		}else{
    			$show = 1;
    		}
    		$this->db->where('blo_id',$blo_id);
	        $params = [
	        	'blo_show' => $show
	        ];
	        return $this->db->update($this->table,$params);
    	}
    	return false;
    }

    public function remove($blo_id)
    {
    	$this->db->where('btg_blo_id',$blo_id);
    	if($this->db->delete('blog_tags')){
    		$this->db->where('blo_id',$blo_id);
    		return $this->db->delete($this->table);
		}
		return false;
       
    }

    public function next($blo_id){
    	$this->db->where('blo_id >',$blo_id);
    	$this->db->group_start()->where('blo_deleted_at IS NULL',null,true)->or_where('blo_deleted_at',"")->or_where('blo_deleted_at','0000-00-00 00:00:00')->group_end();
    	$this->db->from($this->table);
    	$this->db->limit(1);
    	$this->db->select('*');
    	$this->db->order_by('blo_id','asc');
    	$query = $this->db->get();
    	if($query->num_rows() > 0){
    		return $query->row_array();
    	}
    	return false;
    }
    public function prev($blo_id){
    	$this->db->where('blo_id <',$blo_id);
    	$this->db->group_start()->where('blo_deleted_at IS NULL',null,true)->or_where('blo_deleted_at',"")->or_where('blo_deleted_at','0000-00-00 00:00:00')->group_end();
    	$this->db->from($this->table);
    	$this->db->limit(1);
    	$this->db->select('*');
    	$this->db->order_by('blo_id','desc');
    	$query = $this->db->get();
    	if($query->num_rows() > 0){

    		return $query->row_array();
    	}
    	return false;
    }
}
