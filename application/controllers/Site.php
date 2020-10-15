<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Site extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->library("pagination");

	}
	protected function set_metatags($data, $tipo = 'post_unico'){
		$return = [];
		$return['og:locale'] = get_language();
		$return['robots'] = 'all';
		$return['copyright'] = '2020 Hennekam Wines';
		$return['og:site_name'] = SITE_NAME;
		$return['keywords'] = "hennekam, Vinhos, Wines, Australia, sommelier";
		$img = base_url('assets/images/share_image.jpg');
		$return['twitter:card'] = $img;
		$return['og:image'] = $img;
		$return['image']  = $img;
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
				foreach ($data['tags'] as $key => $value) {
					$tags[] = $value['tag_title_'.$this->langua];
				}
				$return['article:tag'] = implode(', ',$tags);
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
				$img = base_url('assets/images/blog/'.$img);
				$return['twitter:card'] = $img;
				$return['og:image'] = $img;
				$return['image']  = $img;
			default:
				$img = base_url('assets/images/share_image.jpg');
				$return['twitter:card'] = $img;
				$return['og:image'] = $img;
				$return['image']  = $img;
				$return['canonical'] = base_url(get_language()."/");
				break;
		}
		return $return;
	}

	public function index($param = ''){

		$lang = str_replace('-','_', get_language());
		$menu = $this->menus->get_all_by_type('site');
		clear_cch();
		$data = [
			'lang_bd' => $lang,
			'title' => 'site',
			'menus' => $menu
		];
		//load_template($data,'site/modelo','site');
		$this->load->view('site/modelo',$data);
	}
}
