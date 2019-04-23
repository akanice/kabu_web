<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class Cart extends MY_Controller {
        public function __construct() {
            parent::__construct();
            $this->load->library('cart');
        }
        
        public function add() {
            //lấy ra sản phẩm muốn thêm vào giỏ hàng
            $this->load->model('productsmodel');
            $id = $this->uri->rsegment(3);
            $product = $this->productsmodel->read(array('id'=>$id),array(),true);
            if(!$product){
                redirect();
            }
            
            //tổng số sản phẩm
            $quantity = $this->input->post('quantity');
            $price = $product->price;
            if($product->sale_price > 0) {
                $price = $product->sale_price;
            }
            $data = array(
				'id' => $product->id,
				'qty' => $quantity,
				'name' => $product->title,
				'thumb' => $product->thumb,
				'price' => $price,
			);
			$this->cart->insert($data);
			$carts = $this->cart->contents();
            //Chuyển sang trang danh sách sản phẩm trong giỏ hàng
            redirect(base_url('cart'));
        }
        
        //Hiển thị danh sách sản phẩm trong giỏ hàng
        public function index() {
            $this->data['title'] = 'Giỏ hàng';
			// thông tin giỏ hàng
            $carts = $this->cart->contents();
            
			// print_r($carts);die();
            //Tổng số sản phẩm có trong giỏ hàng
            $total_items = $this->cart->total_items();
            $this->data['carts'] = $carts;
            $this->data['total_items'] = $total_items;
            $this->data['temp'] = 'frontend/cart/index';
            $this->load->view('frontend/index', $this->data);
        }
        
        public function update() {
            $carts = $this->cart->contents();
            foreach ($carts as $key => $row) {
                $total_qty = $this->input->post('qty_'.$row['id']);
                $data = array();
                $data['rowid'] = $key;
                $data['qty'] = $total_qty;
                $this->cart->update($data);
            }
            redirect(base_url('cart'));
        }
        
        public function del() {
            $id = $this->uri->rsegment(3);
            $id = intval($id);
            //Trường hợp xóa 1 sản phẩm nào đó trong giỏ hàng
            if($id > 0){
                $carts = $this->cart->contents();
                foreach ($carts as $key => $row) {
                    if($row['id'] == $id){
                        $data = array();
                        $data['rowid'] = $key;
                        $data['qty'] = 0;
                        $this->cart->update($data);
                    }
                }
            } else {
                //xóa toàn bộ giỏ hàng
                $this->cart->destroy();
            }
            redirect(base_url('cart'));
        }
    }
    
    
    
    
    