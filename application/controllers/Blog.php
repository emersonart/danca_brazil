<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blog extends CI_Controller {
	protected $langua;
	public function __construct() {
		parent::__construct();
		$this->load->library("pagination");
		$this->load->model('Blog_model','blog');
		$this->langua = str_replace('-','_', get_language());
	}

	protected function set_metatags($data, $tipo = 'post_unico'){
		$return = [];
		$return['og:locale'] = get_language();
		$return['og:site_name'] = SITE_NAME;
		$return['robots'] = 'all';
		$return['copyright'] = '2020 Hennekam Wines';
		switch ($tipo) {
			case 'post_unico':
				
				if($data['blo_cover'] != ''){
					$img = $data['blo_cover'];
				}elseif($data['blo_image'] != ''){
					$img  = $data['blo_image'];
				}else{
					$img = 'share_image.jpg';
				}
				if(isset($img)){
					$img = base_url('assets/images/blog/'.$img);
					$return['twitter:card'] = $img;
					$return['og:image'] = $img;
					$return['image']  = $img;
				}
				$return['canonical'] = base_url(get_language()."/blog"."/".date('m',strtotime($data['blo_datetime']))."/".date('Y',strtotime($data['blo_datetime']))."/".$data['blo_link']);
				$return['og:url'] = base_url(get_language()."/blog"."/".date('m',strtotime($data['blo_datetime']))."/".date('Y',strtotime($data['blo_datetime']))."/".$data['blo_link']);
				$return['url'] = $return['og:url'];
				$return['twitter:url'] = $return['url'];

				$return['title'] = $data['blo_title_'.$this->langua];
				$return['og:title'] = $data['blo_title_'.$this->langua];
				$return['twitter:title'] = $data['blo_title_'.$this->langua];

				$return['type'] = 'article';
				$return['og:type'] = 'article';
				$return['article:author'] = ($data['autor'] ? $data['autor']['use_name'] : 'Hennekam');
				$return['article:section'] = 'Blog';
				$tags = [];
				if(isset($data['tags'])){
					foreach ($data['tags'] as $key => $value) {
						$tags[] = $value['tag_title_'.$this->langua];
					}
				}
				$return['keywords'] = "Hennekam, blog, article,".implode(', ',$tags);
				$return['article:tag'] = "Hennekam, blog, article,".implode(', ',$tags);
				
				$dt = new DateTime($data['blo_datetime'],new DateTimeZone($data['blo_timezone']));
				$dt->setTimezone(new DateTimeZone(date_default_timezone_get()));

				$return['article:published_time'] = $dt->format(DATE_ISO8601);
				
				break;
			case 'blog':
				$return['canonical'] = base_url(get_language()."/blog");
				$return['og:url'] = $return['canonical'];
				$return['url'] = $return['canonical'];
				$return['twitter:url'] = $return['canonical'];
				$return['title'] = 'Blog';
				$return['og:title'] = $return['title'];
				$return['twitter:title'] = $return['title'];
				$return['type'] = 'website';
				$return['og:type'] = 'website';
				$return['description'] = lang('description_blog');
				$img = base_url('assets/images/blog/share_image.jpg');
				$return['twitter:card'] = $img;
				$return['og:image'] = $img;
				$return['image']  = $img;
				$return['keywords'] = "blog, hennekam, Vinhos, Wines, Australia, sommelier";
			default:
				$img = base_url('assets/images/blog/share_image.jpg');
				$return['twitter:card'] = $img;
				$return['og:image'] = $img;
				$return['image']  = $img;
				$return['canonical'] = base_url(get_language()."/blog");
				break;
		}
		return $return;
	}

	public function index($category = null,$search = null,$page = 0){
		$lang = str_replace('-','_', get_language());
		$this->load->model('Testimonials_model','testimonials');
		$search1 = $search;
		$search = urldecode($search);
		$params = [];

		$config['per_page'] = 6;

		if($category){
			$p = '/c/'.$category.'/p/';
			if($search){
				$p = '/c/'.$category.'/search/'.$search1.'/p/';
			}
		}else{
			$p = '/p/';
			if($search){
				$p = '/search/'.$search1.'/p/';
			}
		}

		$params['limit']['limit'] = $config['per_page'];
		$params['where'] = ['blo_show'=>1];
		$params['order'] = ['blo_id'=>'DESC'];
		$params['select'] = 'blo_id, blo_datetime,blo_title_'.$lang.' blo_title,blo_link,blo_news_'.$lang.' blo_news,blo_image,blo_updated_at,blo_cover';
		$params['tag'] = $category;
		$params['search'] = $search;
		if($page != 0){
			if($page == 1){
				$params['limit']['initial'] = ($page-1) * $config['per_page'];
			}else{
				$params['limit']['initial'] = ($page) * $config['per_page'];
			}
			
		}else{
			$params['limit']['initial'] = 0;
		}
		$news = $this->blog->get_all($params);
		//$config['suffix'] = ($search and $search != '') ? '/search/'.$search : '';
		$config['base_url'] = base_url(get_language().'/blog/').$p;
		$config['total_rows'] = $this->blog->count($params);
		$config['page_query_string'] = false;
		$config['query_string_segment'] = 'p/';
		$config['num_links'] = 3;
		$config['first_link'] = lang('pagination_first_link');
		$config['last_link'] = lang('pagination_last_link');
		$config['next_link'] = ' <i class="fa fa-chevron-right"></i> ';
		$config['prev_link'] = ' <i class="fa fa-chevron-left"></i> ';
		$config['full_tag_open'] = '<nav aria-label="Page navigation example"><ul class="pagination justify-content-center">';
		$config['full_tag_close'] = '</ul></nav>';
		$config['num_tag_open'] = '<li class="page-item">';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="page-item active" aria-current="page"><a href="#" class="page-link">';
		$config['cur_tag_close'] = '</a></li>';
		$config['attributes'] = array('class' => 'page-link');
		//$config['display_pages'] = FALSE;
		
		$config['use_page_numbers'] = true;

		$this->pagination->initialize($config);
		
		
		$exibir_comofunciona = false;
		$data = [
			'not_home'=> true,
			'data_bg'=>'blog',
			'title' => 'Blog',
			'heading' => 'Blog',
			'news' => $news,
			'link_nav' => $this->pagination->create_links(),
			'cat_uri' => $category,
			'testimonials' => false,
			'metatags' => $this->set_metatags(null,'blog'),
			'search' => true,
			'page' => $page,
			'not_show_dinners' => true,
			'total_news'=>$config['total_rows'],
			'atual_news'=> $params['limit']['initial'],
			'page_news' => $params['limit']['limit'],
			'p' => $page,
			'search' => $search1
		];

		load_template($data,'site/index','site');
	}

	public function ver($id,$mes,$ano){
		$params = [
			'where' => [
				'blo_link' => $id,
				'MONTH(blo_datetime)' => $mes,
				'YEAR(blo_datetime)' => $ano,
				'blo_show' => 1
			],
			'not_deleted' => false
		];
		$new = $this->blog->get($params)[0];
		if(!$new){
			redirect('blog');
		}
		if(!isset($new['auto']) || !$new['autor']){
			$new['autor']['use_name'] = SITE_NAME;
		}

		$data = [
			'title' => $new['blo_title_'.$this->langua],
			'heading' => $new['blo_title_'.$this->langua],
			'new' => $new,
			'news_tags' => $new['tags'],
			'metatags' =>$this->set_metatags($new),
			'data_bg' => 'blog',
			'nao_exibir_h1' => true,
			'next' => $this->blog->next($new['blo_id']),
			'previ' => $this->blog->prev($new['blo_id'])
		];
		if(is_file(set_realpath('assets/images/blog').$new['blo_cover'])){
			//$data['data_bg_custom'] = '/assets/images/blog/'.$new['blo_cover'];
		}
		load_template($data,'blog/ver','site');

	}
}
