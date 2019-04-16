<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class Cart extends MY_Controller
    {
        public function __construct()
        {
            parent::__construct();
            $this->load->library('cart');
        }
        
        public function add()
        {
            //lấy ra sản phẩm muốn thêm vào giỏ hàng
            $this->load->model('Product_model');
            $id = $this->uri->rsegment(3);
            $product = $this->Product_model->get_info($id);
            if(!$product){
                redirect();
            }
            
            //tổng số sản phẩm
            $quantity = 1;
            $price = $product->price;
            if($product->discount > 0)
            {
                $price = $product->price - $product->discount;
            }
            $data = array();
            $data['id'] = $product->id;
            $data['qty'] = $quantity;
            $data['name'] = url_title($product->name);
            $data['avatar'] = $product->avatar;
            $data['price'] = $price;
            $this->cart->insert($data);
            
            //Chuyển sang trang danh sách sản phẩm trong giỏ hàng
            redirect(base_url('cart'));
        }
        
        //Hiển thị danh sách sản phẩm trong giỏ hàng
        public function index()
        {
            // thông tin giỏ hàng
            $carts = $this->cart->contents();
            
            //Tổng số sản phẩm có trong giỏ hàng
            $total_items = $this->cart->total_items();
            $this->data['carts'] = $carts;
            $this->data['total_items'] = $total_items;
            $this->data['temp'] = 'frontend/cart/index';
            $this->load->view('frontend/index', $this->data);
        }
        
        public function update()
        {
            $carts = $this->cart->contents();
            foreach ($carts as $key => $row)
            {
                $total_qty = $this->input->post('qty_'.$row['id']);
                $data = array();
                $data['rowid'] = $key;
                $data['qty'] = $total_qty;
                $this->cart->update($data);
            }
            redirect(base_url('cart'));
        }
        
        public function del()
        {
            $id = $this->uri->rsegment(3);
            $id = intval($id);
            //Trường hợp xóa 1 sản phẩm nào đó trong giỏ hàng
            if($id > 0){
                $carts = $this->cart->contents();
                foreach ($carts as $key => $row)
                {
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
    
    
    
    
    