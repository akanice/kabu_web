<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Products extends MY_Controller{
    private $data;
    function __construct() {
        parent::__construct();
        $this->auth = new Auth();
        $this->auth->check();
		$this->checkCookies();
        // if($this->session->userdata('admingroup') == "mod"){
            // show_404();
        // }
        $this->data['email_header'] = $this->session->userdata('adminemail');
        $this->data['all_user_data'] = $this->session->all_userdata();
        $this->load->model('productsmodel');
        $this->load->model('productscategorymodel');
        $this->load->model('productsattachmodel');
	}
	
    public function index(){
        $this->data['title']    = 'Quản lý sản phẩm';
        $this->data['productcategory']    = $this->productscategorymodel->read();
		$this->data['name'] = $this->input->get('title');
		$this->data['category'] = $this->input->get('category');
        $total = $this->productsmodel->getCountProducts($this->input->get('title'));
        if($this->data['name'] != ""){
            $config['suffix'] = '?name='.urlencode($this->data['name']);
        }
        //Pagination
		$per_page = 15;
        list($this->data['page_links'],$start) = $this->productsmodel->pagination('admin/products/',$total,$per_page,3);
        if($this->data['name'] != ""){
            $this->data['list'] = $this->productsmodel->getListProducts($this->input->get('title'),$per_page,$start);
        }else{
            $this->data['list'] = $this->productsmodel->getListProducts("",$per_page,$start);
        }
        $this->data['base'] = site_url('admin/products/');
        $this->load->view('admin/common/header',$this->data);
        $this->load->view('admin/products/list');
        $this->load->view('admin/common/footer');
    }

    public function add() {
		$this->data['list_cat_id'] = $this->productscategorymodel->getSortedCategories();
		$this->data['allproducts'] = $this->productsmodel->read();
		if($this->input->post('submit') != null){
			$this->load->library('upload_file');
			$upload_path = 'assets/uploads/images/products/';
			$upload_data = $this->upload_file->upload($upload_path, 'image');
			$image = '';
			
			if(isset($upload_data['file_name'])){
				$image = $upload_path.$upload_data['file_name'];
				//Create cover thumb
				$thumb_path = 'assets/uploads/images/thumb/products/';
				$thumb = $this->productsmodel->createThumb($image,$thumb_path);
			}
			
			$gallery = array();
			$gallery = $this->upload_file->upload_file($upload_path, 'gallery');
			$gallery = json_encode($gallery);
			$categories = json_encode($this->input->post("categoryid"));
			if (!$categories) {$categories = '["0"]';}
			
			$data = array(
				"title"							=> $this->input->post("title"),
				"alias" 							=> make_alias($this->input->post("title")),
				"categoryid"				=> $categories,
				"image" 	    				=> @$image,
				"thumb" 						=> @$thumb,
				"gallery" 						=> $gallery,
				"sku" 							=> $this->input->post("sku"),
				"description" 				=> $this->input->post("description"),
				"short_description" 	=> $this->input->post("short_description"),
				"price"							=> $this->input->post("price"),
				"sale_price" 				=> $this->input->post("sale_price"),
				"featured" 					=> $this->input->post("featured"),
				"meta_title" 				=> @$this->input->post("meta_title"),
				"meta_description" 	=> @$this->input->post("meta_description"),
				"meta_keywords" 		=> @$this->input->post("meta_keywords"),
			);
			//print_r($data);die();
			$product_id = $this->productsmodel->create($data);
			$this->productsmodel->update(array('alias'=>make_alias($this->input->post("title").'-'.$product_id)),array('id'=>$product_id));
			$combo = json_encode($this->input->post("related"));
			$this->db->insert('products_attachdata',array('product_id'=>$product_id, 'attachdata'=>'combo', 'value'=>$combo));
			
			redirect(base_url() . "admin/products");
			exit();
		} else {
			$this->load->view('admin/common/header',$this->data);
			$this->load->view('admin/products/add');
			$this->load->view('admin/common/footer');
		}
    }

    public function edit($id) {
		$this->data['list_cat_id'] = $this->productscategorymodel->getSortedCategories();
		$this->data['products'] = $products = $this->productsmodel->read(array('id'=>$id),array(),true);
		$this->data['products']->categoryid = json_decode($this->data['products']->categoryid);
		if($this->input->post('submit') != null){
			$this->load->library('upload_file');
			$upload_path = 'assets/uploads/images/products/';
			$upload_data = $this->upload_file->upload($upload_path, 'image');
			$image = '';
			
			if(isset($upload_data['file_name'])){
				$image = $upload_path.$upload_data['file_name'];
				//Create cover thumb
				$thumb_path = 'assets/uploads/images/thumb/products/';
				$thumb = $this->productsmodel->createThumb($image,$thumb_path);
			} else {
				$image = $this->data['products']->image;
				$thumb = $this->data['products']->thumb;
			}
			
			$gallery = array();
			$gallery = $this->upload_file->upload_file($upload_path, 'gallery');
			$gallery = json_encode($gallery);
			$categories = json_encode($this->input->post("categoryid"));
			if (!$categories) {$categories = '["0"]';}
			
			$data = array(
				"title"							=> $this->input->post("title"),
				"alias" 							=> make_alias($this->input->post("title")),
				"categoryid"				=> $categories,
				"image" 	    				=> @$image,
				"thumb" 						=> @$thumb,
				"gallery" 						=> $gallery,
				"sku" 							=> $this->input->post("sku"),
				"description" 				=> $this->input->post("description"),
				"short_description" 	=> $this->input->post("short_description"),
				"price"							=> $this->input->post("price"),
				"sale_price" 				=> $this->input->post("sale_price"),
				"featured" 					=> $this->input->post("featured"),
				"meta_title" 				=> @$this->input->post("meta_title"),
				"meta_description" 	=> @$this->input->post("meta_description"),
				"meta_keywords" 		=> @$this->input->post("meta_keywords"),
			);
			
			$this->productsmodel->update($data,array('id'=>$id));
			$combo = json_encode($this->input->post("related"));
			$this->db->insert('products_attachdata',array('product_id'=>$id, 'attachdata'=>'combo', 'value'=>$combo));
			redirect(base_url() . "admin/products/edit/".$id);
			exit();
		} else {
			$this->load->view('admin/common/header',$this->data);
			$this->load->view('admin/products/edit');
			$this->load->view('admin/common/footer');
		}
    }
	
	public function detail($id) {
		$this->data['products'] = $products = $this->productsmodel->read(array('id'=>$id),array(),true);
		$this->load->view('admin/common/header',$this->data);
		$this->load->view('admin/products/detail');
		$this->load->view('admin/common/footer');
	}
    public function delete($id){
		if (in_array($this->data['admingroup'],$this->data['groups_permission'])) {
			if(isset($id)&&($id>0)&&is_numeric($id)){
				$this->productsmodel->delete(array('id'=>$id));
				redirect(base_url() . "admin/products");
				exit();
			}
		} else {
			redirect(base_url()."admin/access_denied");
		}
    }

}