<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class ProductsCategory extends MY_Controller{
    public $data;
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
	}
	
    public function index(){
        $this->data['title']    = 'Quản lý danh mục sản phẩm';
        $total = $this->productscategorymodel->readCount(array('title'=>'%'.$this->input->get('name').'%'));
        $this->data['name'] = $this->input->get('name');
        if($this->data['name'] != ""){
            $config['suffix'] = '?name='.urlencode($this->data['name']);
        }
        //Pagination
        $this->load->library('pagination');
        $config['base_url'] = base_url() . 'admin/productscategory/';
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
        $page_number = $this->uri->segment(3);
        if (empty($page_number)) $page_number = 1;
        $start = ($page_number - 1) * $config['per_page'];
        $this->data['page_links'] = $this->pagination->create_links();
        if($this->data['name'] != ""){
            $this->data['list'] = $this->productscategorymodel->read(array('title'=>'%'.$this->input->get('name').'%'),array('id'=>false),false,$config['per_page'],$start);
        }else{
            $this->data['list'] = $this->productscategorymodel->read(array(),array('id'=>false),false,$config['per_page'],$start);
        }
        $this->data['base'] = site_url('admin/productscategory/');
        $this->load->view('admin/common/header',$this->data);
        $this->load->view('admin/productscategory/list');
        $this->load->view('admin/common/footer');
    }

    public function add(){
		$this->data['parents'] = $this->productscategorymodel->getSortedCategories();
        if($this->input->post('submit') != null){
            $uploaddir = 'assets/uploads/productscategory/';
            $this->load->library("upload");
            if (move_uploaded_file($_FILES['image']['tmp_name'], $uploaddir . basename($_FILES['image']['name']))) {
                $image = $uploaddir . $_FILES['image']['name'];
            }
            else{
                $image = '';
            }
            //Create thumb
            if ($image != '') {
				$dir_thumb = 'assets/uploads/thumb/';
				if (!file_exists($dir_thumb) || !is_dir($dir_thumb)) mkdir($dir_thumb,0777,true);
				$this->load->library('image_lib');
				$config2 = array();
				$config2['image_library'] = 'gd';
				$config2['source_image'] = $image;
				$config2['new_image'] = $dir_thumb;
				$config2['create_thumb'] = TRUE;
				$config2['maintain_ratio'] = TRUE;
				$config2['width'] = 200;
				$config2['height'] = 200;
				$this->image_lib->clear();
				$this->image_lib->initialize($config2);
				if(!$this->image_lib->resize()){
					print $this->image_lib->display_errors();
				}else{
					$image_thumb = $dir_thumb.basename($_FILES['image']['name'], '.' . pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION)) . '_thumb.' . pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
				}
			} else {
				$image_thumb = 'assets/img/sample_thumb.png';
			}
			//Upload Quotation File
			$file_dir = 'assets/uploads/files/';
            if (move_uploaded_file($_FILES['quotation_file']['tmp_name'], $file_dir . basename($_FILES['quotation_file']['name']))) {
                $quotation_file = $file_dir . $_FILES['quotation_file']['name'];
				$quotation_file_name = $_FILES['quotation_file']['name'];
            } else{
                $quotation_file = '';
            }
			
            $data = array(
                "name" 					=> $this->input->post("name"),
				"parent_id"    			=> $this->input->post('parent'),
                "alias" 				=> make_alias($this->input->post("name")),
                "image" 				=> $image,
                "thumb" 				=> $image_thumb,
				"quotation_file"		=> $quotation_file,
				"quotation_file_name"	=> $quotation_file_name,
                "meta_title" 			=> $this->input->post("meta_title"),
                "meta_description"		=> $this->input->post("meta_description"),
                "meta_keyword"			=> $this->input->post("meta_keyword"),
            );
            $this->productscategorymodel->create($data);
            $alias = site_url('san-pham/'.make_alias($this->input->post("name")));
            $this->aliasmodel->create(array('alias'=>$alias,'type'=>'product_category'));
            redirect(base_url() . "admin/productscategory");
            exit();
        } else {
            $this->load->view('admin/common/header',$this->data);
            $this->load->view('admin/productscategory/add');
            $this->load->view('admin/common/footer');
        }
    }

    public function edit($id) {
        $this->data['productscategory'] = $this->productscategorymodel->read(array('id'=>$id),array(),true);
		$this->data['product_category'] = $this->productscategorymodel->read(array('id'=>$id),array(),true);
		$this->data['parents'] = $this->productscategorymodel->getSortedCategories();
        if($this->input->post('submit') != null){
            $uploaddir = 'assets/uploads/productscategory/';
            $this->load->library("upload");
            if(isset($_FILES['image']) && count($_FILES['image']) > 0 && $_FILES['image']['name'] != "") {
                if (move_uploaded_file($_FILES['image']['tmp_name'], $uploaddir . basename($_FILES['image']['name']))) {
                    $image = $uploaddir . $_FILES['image']['name'];
                    @unlink($this->data['productscategory']->image);
                    @unlink($this->data['productscategory']->thumb);
                } else {
                    $image = $this->data['productscategory']->image;
                }
                //Create thumb
                $dir_thumb = 'assets/uploads/thumb/';
                if (!file_exists($dir_thumb) || !is_dir($dir_thumb)) mkdir($dir_thumb,0777,true);
                $this->load->library('image_lib');
                $config2 = array();
                $config2['image_library'] = 'gd2';
                $config2['source_image'] = $image;
                $config2['new_image'] = $dir_thumb;
                $config2['create_thumb'] = TRUE;
                $config2['maintain_ratio'] = TRUE;
                $config2['width'] = 200;
                $config2['height'] = 200;
                $this->image_lib->clear();
                $this->image_lib->initialize($config2);
                if(!$this->image_lib->resize()){
                    print $this->image_lib->display_errors();
                }else{
                    $image_thumb = $dir_thumb.basename($_FILES['image']['name'], '.' . pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION)) . '_thumb.' . pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
                }
            }else{
                $image = $this->data['productscategory']->image;
                $image_thumb = $this->data['productscategory']->thumb;
            }
			//Upload Quotation File
			$file_dir = 'assets/uploads/files/';
            if (move_uploaded_file($_FILES['quotation_file']['tmp_name'], $file_dir . basename($_FILES['quotation_file']['name']))) {
                $quotation_file = $file_dir . $_FILES['quotation_file']['name'];
				$quotation_file_name = $_FILES['quotation_file']['name'];
            }
            else{
                $quotation_file = $this->data['productscategory']->quotation_file;
            }
			
			
            $data = array(
                "name" 					=> $this->input->post("name"),
                "parent_id" 			=> $this->input->post("parent"),
                "alias" 				=> make_alias($this->input->post("name")),
                "image" 				=> $image,
                "thumb" 				=> $image_thumb,
				"quotation_file"		=> $quotation_file,
				"quotation_file_name"	=> $quotation_file_name,
                "meta_title" 			=> $this->input->post("meta_title"),
                "meta_description"		=> $this->input->post("meta_description"),
                "meta_keyword" 			=> $this->input->post("meta_keyword"),
            );
            $this->productscategorymodel->update($data,array('id'=>$id));
            $alias_old = site_url('san-pham/'.$this->data['productscategory']->alias);
            $alias_id = $this->aliasmodel->read(array('alias'=>$alias_old,'type'=>'product_category'),array(),true)->id;
            $alias_new = site_url('san-pham/'.make_alias($this->input->post("name")));
            $this->aliasmodel->update(array('alias'=>$alias_new),array('id'=>$alias_id));
            redirect(base_url() . "admin/productscategory");
            exit();
        } else {
            $this->load->view('admin/common/header',$this->data);
            $this->load->view('admin/productscategory/edit');
            $this->load->view('admin/common/footer');
        }
    }

    public function delete($id){
        if(isset($id)&&($id>0)&&is_numeric($id)){
            $productscategory = $this->productscategorymodel->read(array('id'=>$id),array(),true);
            @unlink($productscategory->image);
            @unlink($productscategory->thumb);
            $this->productscategorymodel->delete(array('id'=>$id));
            redirect(base_url() . "admin/productscategory");
            exit();
        }
    }

}