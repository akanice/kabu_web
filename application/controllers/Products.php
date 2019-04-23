<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Products extends MY_Controller {
    function __construct() {
        parent::__construct();
		$this->load->model('productsmodel');
		$this->load->model('productscategorymodel');
		$this->data['categories'] = $this->productscategorymodel->read(array('parent_id'=>0),array(),false,10);
    }

    public function index() {
        $this->data['title'] = 'Kabu - Shop';
		
		$total = $this->productsmodel->getCountproducts();
        $per_page = 12;
        list($this->data['page_links'],$start)	= $this->productsmodel->pagination('shop/',$total,$per_page,2);
        $this->data['page_links'] 					= $this->pagination->create_links();
		$this->data['products'] 						= $this->productsmodel->read(array(),array(),false);
		
        $this->data['temp'] = 'frontend/products/index';
		$this->load->view('frontend/index', $this->data);
    }

   public function category($alias) {
		$this->data['category_data'] = $this->productscategorymodel->read(array('alias'=>$alias),array(),true);
        $this->data['title'] = $this->data['category_data']->title;
		
		$total = count($this->productsmodel->getProductsByCategoryId('',$this->data['category_data']->id,'',''));
        $per_page = 12;
        list($this->data['page_links'],$start) = $this->productsmodel->pagination('danh-muc/',$total,$per_page,2);
        $this->data['page_links'] = $this->pagination->create_links();
		$this->data['products'] = $this->productsmodel->getProductsByCategoryId('',$this->data['category_data']->id,$per_page,$start);
		
        $this->data['temp'] = 'frontend/products/category';
		$this->load->view('frontend/index', $this->data);
    }
	
	public function view($alias) {
		$this->data['product_data'] = $this->productsmodel->read(array('alias'=>$alias),array(),true);
        $this->data['title'] = $this->data['product_data']->title;
		
        $this->data['temp'] = 'frontend/products/view';
		$this->load->view('frontend/index', $this->data);
	}
}
