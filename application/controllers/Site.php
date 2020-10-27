<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Site extends MY_Controller {
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
		$this->load->model('Testimonials_model','testimonials');
		$this->load->model('Videos_model','videos');
		$this->load->model('Team_model','team');
		$this->load->model('Socialmedias_model','social');
		$this->load->model('Services_model','service');
		$this->load->model('Schedules_model','agenda');
		$lang = str_replace('-','_', get_language());
		$menu = $this->menus->get_all_by_type('site');
		if(ENVIRONMENT == 'development'){
			clear_cch();
		}
		$videos = $this->videos->get(['where'=>['vid_show'=>1]]);
		if($videos){
			foreach ($videos as $key => $video) {

                if(is_file(set_realpath('/assets/images/videos/').$video['vid_image'])){
                    $imagem = 'assets/images/videos/'.$video['vid_image'];
                }else{
                    $imagem = 'assets/images/videos/no_video.jpg';
                    if(strpos($video['vid_link'],'youtu.be') !== false){
                        $imagem = 'https://i.ytimg.com/vi/'.explode('youtu.be/',$video['vid_link'])[1].'/mqdefault.jpg';
                    }else{
                        $yt = explode('?',$video['vid_link']);
                        if(strpos($video['vid_link'],'youtube') !== false && isset($yt[1])){

                            $q = explode('&',$yt[1]);
                            $code = [];
                            foreach ($q as $key => $value) {
                                $code_e = explode('=',$value);
                                $code[$code_e[0]] = $code_e[1];
                            }
                            if(isset($code['v'])){
                                $imagem = 'https://i.ytimg.com/vi/'.$code['v'].'/mqdefault.jpg';
                            }
                            
                            
                        }
                    }
                    
                    
                }
                $videos[$key]['vid_image'] = $imagem;
			}
		}
		$agenda = $this->agenda->get_all();
		$data = [
			'lang_bd' => $lang,
			'title' => 'site',
			'menus' => $menu,
			'testimonials' => $this->testimonials->get(['where'=>['tes_show'=>1],'order'=>['tes_id'=>'DESC']]),
			'language' => $lang,
			'videos' => $videos,
			'team' => $this->team->get(['where'=>['tea_show'=>1],'order'=>['tea_id'=>'DESC']]),
			'servicos_adicionais' => $this->service->get_all(),
			'agenda' => $agenda
		];
		$data['social_medias'] = $this->social->get();
		//load_template($data,'site/modelo','site');
		$this->load->view('site/modelo',$data);
	}
}
