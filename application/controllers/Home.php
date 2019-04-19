<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {
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
		
		$this->load->model('landingpagemodel');
		$this->data['cookies_expires'] = $this->configsmodel->read(array(
				'term' => 'affiliate',
				'name' => 'cookie_time'), array(), true)->value / (24 * 60 * 60);
    }

    public function index() {
        $this->load->model('newsmodel');
        $this->load->model('newscategorymodel');
        $this->load->model('configsmodel');

        $this->data['title'] = $this->optionsmodel->read(array('name'=>'home_meta_title'), array(), true)->value;
        $this->data['temp'] = 'frontend/home/index';
		$this->load->view('frontend/index', $this->data);
    }

    public function pages($alias) {
        $this->load->model('pagesmodel');
        $this->data['page_data'] = $this->pagesmodel->read(array('alias' => $alias), array(), true);
        $this->data['title'] = $this->data['page_data']->title;
        $this->data['meta_title'] = $this->data['page_data']->title;
        $this->data['meta_description'] = $this->data['page_data']->meta_description;
        $this->data['meta_keywords'] = $this->data['page_data']->meta_keywords;
		
        $this->load->view('home/common/header', $this->data);
        $this->load->view('home/pages');
        $this->load->view('home/common/footer');
    }

    public function affiliateUserInfo() {
        $this->auth = new auth();
        $this->auth->check();
        $this->data['title'] = 'Dashboard';
        $this->data['meta_title'] = '';
        $this->data['meta_description'] = '';
        $this->data['meta_keywords'] = '';
        $this->data['affiliate_user'] = $this->auth->getUser();
		print_r($this->data['affiliate_user']);die();
        //-------------page link
        $total = 100;
        $this->load->library('pagination');
        $config['base_url'] = base_url() . 'admin/affiliate/';
        $config['total_rows'] = $total;
        $config['uri_segment'] = 3;
        $config['per_page'] = 10;
        $config['num_links'] = 5;
        $config['use_page_numbers'] = TRUE;
        $config["num_tag_open"] = "<p class='paginationLink'>";
        $config["num_tag_close"] = '</p>';
        $config["cur_tag_open"] = "<p class='currentLink'>";
        $config["cur_tag_close"] = '</p>';
        $config["first_link"] = "First";
        $config["first_tag_open"] = "<p class='paginationLink'>";
        $config["first_tag_close"] = '</p>';
        $config["last_link"] = "Last";
        $config["last_tag_open"] = "<p class='paginationLink'>";
        $config["last_tag_close"] = '</p>';
        $config["next_link"] = "Next";
        $config["next_tag_open"] = "<p class='paginationLink'>";
        $config["next_tag_close"] = '</p>';
        $config["prev_link"] = "Back";
        $config["prev_tag_open"] = "<p class='paginationLink'>";
        $config["prev_tag_close"] = '</p>';
        $this->pagination->initialize($config);
        $page_number = $this->uri->segment(4);
        if (empty($page_number)) $page_number = 1;
        $start = ($page_number - 1) * $config['per_page'];
        $this->data['page_links'] = $this->pagination->create_links();
        $this->load->model('affiliatesmodel');
        $this->data['listAffiliates'] = $this->affiliatesmodel->getListAffiliateTransactionOfUser($this->data['affiliate_user'], $start, $config['per_page']);
        $this->data['statisticAffiliate'] = $this->affiliatesmodel->getStatisticAffiliateStatistic($this->data['affiliate_user']);
        $this->load->view('home/common/header', $this->data);
        $this->load->view('home/affiliate_user_dashboard');
        $this->load->view('home/common/footer');
    }
}
