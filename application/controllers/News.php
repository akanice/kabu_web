<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class News extends MY_Controller {
    public $data;

    function __construct() {
        parent::__construct();  
		//Get Menu 
        $this->load->model('menusmodel');

		// nav menu
        $nav_data = $this->menusmodel->read(array('menu_id' => '1'));
        $this->data['navmenu'] = json_decode(json_encode($nav_data), true);
		// footer menu
		$footer_data = $this->menusmodel->read(array('menu_id' => '2'));
        $this->data['footer_menu'] = json_decode(json_encode($footer_data), true);		
        $this->data['footermenu'] = $this->menusmodel->read(array('menu_id' => 2));
		
        $this->data['config_navmenu'] = $this->menusmodel->setup_navmenu();
        $this->data['config_mobilemenu'] = $this->menusmodel->setup_mobilemenu();
		
		$this->load->model('newsmodel');
		$this->data['newest_articles'] = $this->newsmodel->read(array(),array('id'=>false),false,5);

        //print_r($this->data['config_navmenu']);die();
        $this->load->model('menustermmodel');
        $this->load->model('configsmodel');

        //Options
        $this->load->model('optionsmodel');
        $options = array_swap_index($this->optionsmodel->read(), 'name');
        $this->data['options'] = $options;
        $this->data['home_logo'] = @$options['home_logo']->value;
        $this->data['tour_banner'] = @$options['tour_banner']->value;
        $this->data['home_hotline'] = @$options['home_hotline']->value;
        $this->data['home_short_introduction'] = @$options['home_short_introduction']->value;
        $this->data['link_facebook'] = @$options['link_facebook']->value;
        $this->data['link_twitter'] = @$options['link_twitter']->value;
        $this->data['link_gplus'] = @$options['link_gplus']->value;
        $this->data['link_instagram'] = @$options['link_instagram']->value;
        $this->data['tour_banner'] = @$options['tour_banner']->value;
		$this->data['global_header_code'] = @$options['global_header_code']->value;
        $this->data['global_footer_code'] = @$options['global_footer_code']->value;

        $this->load->model('newsmodel');
        $this->load->model('newsordermodel');
        $this->load->model('newscategorymodel');
		
		$this->load->model('landingpagemodel');
		$this->data['cookies_expires'] = $this->configsmodel->read(array(
				'term' => 'affiliate',
				'name' => 'cookie_time'), array(), true)->value / (24 * 60 * 60);
    }

    public function index($alias) {

        $arrShortCode = array(
            '[banner_top_display]' => 'banner_top',
            '[banner_bottom_display]' => 'banner_bottom'
        );

        $this->add_count($alias);
        // load data
        $this->data['new'] = $this->newsmodel->read(array('alias' => $alias), array(), true);
		if (!isset($this->data['new']) || $this->data['new']== null) {
			redirect(base_url());
		}
		$post_id = $this->data['new']->id;
        $content = $this->data['new']->content;
        //TODO - do short code here
        foreach($arrShortCode as $shortCodeStr => $funcName) {
            $shortCodePos = strrpos($content, $shortCodeStr);
            if($shortCodePos !== false) {
                do {
                    $contentBefore = substr($content, 0, $shortCodePos);
                    $contentShortCode = $this->$funcName($post_id);
                    $contentAfter = substr($content, $shortCodePos + strlen($shortCodeStr));
                    $content = $contentBefore.$contentShortCode.$contentAfter;
                    $shortCodePos = strrpos($content, $shortCodeStr);
                } while ($shortCodePos !== false);
            }
        }
        
		$this->data['new']->content = $this->convertYoutube($content);
        if (isset($this->data['new']) && ($this->data['new'] != '')) {
            $new_id = $this->data['new']->id;

            if ($this->data['new']->type == 'default') {
                $this->data['title'] = $this->data['new']->title;
				$this->data['meta_image'] = base_url($this->data['new']->image);
                $categoryid = json_decode($this->data['new']->categoryid);

                foreach ($categoryid as $n => $value) {
                    $this->data['category'][$n] = $cat_data = $this->newscategorymodel->read(array('id' => $value), array(), true);
                    if ($cat_data->parent_id == null or $cat_data->parent_id == 0) {
                        $cat_chosen = $value;
                    }
                }
                $this->load->model('adminsmodel');
                $author_id = $this->data['new']->author_id;
                $this->data['author'] = $this->adminsmodel->read(array('id' => $author_id), array(), true);
                $this->data['most_viewed'] = $this->newsmodel->read(array(), array('count_view' => false), false, 5);
                $this->data['related_news'] = $this->newsmodel->getRelatedNews($cat_chosen, 5);
                $this->load->view('blog/common/header', $this->data);
                $this->load->view('blog/news_detail');
                $this->load->view('blog/common/footer');
            } else {
                $this->data['title'] = $this->data['new']->title;
                $this->data['landing_data'] = $this->landingpagemodel->read(array('news_id' => $new_id), array(), true);
                $this->load->view('blog/common/header_landing', $this->data);
                $this->load->view('blog/template/landing_page');
                $this->load->view('blog/common/footer_landing');
            }
        } else {
            redirect('404_override');
        }
    }

	public function home() {
        $this->load->model('newsmodel');
        $this->load->model('newscategorymodel');
        $this->load->model('configsmodel');

        // load config data
        $configs = array();
        $this->data['cat_available'] = $configs['cat_available'] = $this->configsmodel->read(array('name' => 'cat_available'), array(), true)->value;

        //meta data
		
        $this->data['title'] = @$this->optionsmodel->read(array('name'=>'home_meta_title'),array(),true)->value;
        $this->data['meta_title'] = @$this->optionsmodel->read(array('name'=>'home_meta_title'),array(),true)->value;
        $this->data['home_meta_description'] = @$this->optionsmodel->read(array('name'=>'home_meta_description'),array(),true)->value;
        $this->data['home_meta_keywords'] = @$this->optionsmodel->read(array('name'=>'home_meta_keywords'),array(),true)->value;

        $this->load->view('blog/common/header', $this->data);

        // Slider data
        $this->data['section_sliders'] = array();
        for ($i = 1; $i <= 5; $i++) {
            $item_id = $this->configsmodel->read(array(
                'term'    => 'home',
                'name'    => 'slider_block',
                'term_id' => $i), array(), true)->value;
            $item = $this->newsmodel->read(array('id' => $item_id), array(), true);
            if ($item) $this->data['section_sliders'][] = $item;
        }

        $this->load->view('blog/template/home_slider', $this->data);
        //sections data
        $this->data['section_news'][] = new \stdClass;
        foreach (json_decode($configs['cat_available']) as $item) {
            $this->data['section_news']['parent_cat'] = $this->newscategorymodel->read(array('id' => $item), array(), true);
            $this->data['section_news']['child_cat'] = $this->newscategorymodel->read(array('parent_id' => $item), array(), false);

            $featured_new = $this->configsmodel->read(array(
                'term'    => 'category',
                'name'    => 'featured_new',
                'term_id' => $item), array(), true)->value;
            if ($featured_new) {
                $array = json_decode($featured_new);
                $this->data['section_news']['news_featured'] = $this->newsmodel->read(array("id" => $array), array(), false, false);
            }
            $this->data['section_news']['news_item'] = $this->newsmodel->get_random_news_single($item, 2);
            $this->data['section_news']['slogan'] = $this->configsmodel->read(array(
                "term"    => "category",
                "name"    => "slogan",
                "term_id" => $item), array(), true);
			$this->data['section_news']['banner'] = $this->configsmodel->read(array(
                "term"    => "category",
                "name"    => "banner",
                "term_id" => $item), array(), true);
            $this->data['section_news_content'] = $this->load->view('blog/template/section_news', $this->data);
        }
		
        //print_r($this->data['section_news']['news_featured']);
        // print_r($this->data['section_news'][1]['news_item']);
        // die();

        $this->load->view('blog/common/footer');
    }
	
    function add_count($alias) {
        // load cookie helper
        $this->load->helper('cookie');
        // this line will return the cookie which has alias name
        $check_visitor = $this->input->cookie(urldecode($alias), FALSE);
        // this line will return the visitor ip address
        $ip = $this->input->ip_address();
        // if the visitor visit this article for first time then //
        //set new cookie and update article_views column  ..
        //you might be notice we used alias for cookie name and ip
        //address for value to distinguish between articles  views
        if ($check_visitor == false) {
            $cookie = array(
                "name"   => urldecode($alias),
                "value"  => "$ip",
                "expire" => time() + 7200,
                "secure" => false
            );
            $this->input->set_cookie($cookie);
            $this->newsmodel->update_counter(urldecode($alias));
        }
    }

    public function category($alias) {
        $this->data['news_category'] = $news_category = $this->newscategorymodel->read(array('alias' => $alias), array(), true);
		$news_array = $this->newsordermodel->read(array('categoryid'=>$this->data['news_category']->id),array(),true)->news_array;
		$news_array = json_decode($news_array);
        $total = $this->newsmodel->readCountNew($news_category->id);
        $per_page = 12;
        $this->configPagination($slug = 'category', $per_page, $alias, $total);
        $page_number = $this->uri->segment(4);
        if (empty($page_number)) $page_number = 1;
        $start = ($page_number - 1) * $per_page;
        $this->data['page_links'] = $this->pagination->create_links();
        $this->data['news'] = $this->newsmodel->getListNews('', $news_array, $news_category->id, $per_page, $start,'post');
        if (empty($news_category->title)) {
            $this->data['title'] = 'Chuyên mục';
        } else {
            $this->data['title'] = 'Chuyên mục- ' . $news_category->title;
        }

        $this->data['most_viewed'] = $this->newsmodel->read(array('type'=>'normal'), array('count_view' => false), false, 5);

        $this->data['meta_keywords'] = $news_category->meta_keywords;
        $this->data['meta_description'] = $news_category->meta_description;

        $this->load->view('blog/common/header', $this->data);
        $this->load->view('blog/news_list');
        $this->load->view('blog/common/footer');
    }

    public function configPagination($slug, $per_page = 9, $alias, $total) {
        $this->load->library('pagination');
        $config['base_url'] = base_url() . $slug . '/' . $alias;
        $config['total_rows'] = $total;
        $config['uri_segment'] = 3;
        $config['per_page'] = $per_page;
        $config['num_links'] = 5;
        $config['use_page_numbers'] = TRUE;
        $config["num_tag_open"] = "<li class='page-item'>";
        $config["num_tag_close"] = "</li>";
        $config["cur_tag_open"] = "<li class='active page-item'><a href='#' class='page-link'>";
        $config["cur_tag_close"] = "</a></li>";
        $config["first_link"] = "Đầu";
        $config["first_tag_open"] = "<li class='first'>";
        $config["first_tag_close"] = "</li>";
        $config["last_link"] = "Cuối";
        $config["last_tag_open"] = "<li class='last'>";
        $config["last_tag_close"] = "</li>";
        // $config["next_link"] = "Tiếp → ";
        // $config["next_tag_open"] = "<li class='next'>";
        // $config["next_tag_close"] = "</li>";
        // $config["prev_link"] = "← Trước";
        // $config["prev_tag_open"] = "<li class='prev'>";
        // $config["prev_tag_close"] = "</li>";
        $config['attributes'] = array('class' => 'page-link');
        $this->pagination->initialize($config);
    }

    public function news_search() {
        //$this->data['prod_cat'] = $this->productcategorymodel->read();
        $this->data['name'] = $this->input->get('s_keyword');
        $total = $this->newsmodel->getCountNew($this->data['name'], '', '', '');
        $per_page = 6;
        if ($this->data['name'] != "") {
            $config['suffix'] = '?keyword=' . urlencode($this->data['name']);
        }
        //Pagination
        $this->configPagination($slug = 'search', $per_page, $alias = 'page', $total);
        $page_number = $this->uri->segment(3);
        if (empty($page_number)) $page_number = 1;
        $start = ($page_number - 1) * $per_page;
        $this->data['page_links'] = $this->pagination->create_links();
        $this->data['result'] = $this->newsmodel->getNewsSearch($this->data['name'], '', $per_page, $start);
        //print_r($this->data['result']);die();
        $this->data['title'] = 'Search: ' . $this->input->get('s_keyword');

        $this->load->view('blog/common/header', $this->data);
        $this->load->view('blog/news_search');
        $this->load->view('blog/common/footer');
    }

    private function banner_bottom($post_id) {
        $cat_id = json_decode($this->newsmodel->read(array('id'=>$post_id),array(),true)->categoryid);
		$k = array_rand($cat_id);
		$category_id = $cat_id[$k];
		$html = $this->newscategorymodel->read(array('id'=>$category_id),array(),true)->banner_bottom_display;
		return $html;
    }
    private function banner_top($post_id) {
        $cat_id = json_decode($this->newsmodel->read(array('id'=>$post_id),array(),true)->categoryid);
		$k = array_rand($cat_id);
		$category_id = $cat_id[$k];
		$html = $this->newscategorymodel->read(array('id'=>$category_id),array(),true)->banner_top_display;
		return $html;
    }
	
}
