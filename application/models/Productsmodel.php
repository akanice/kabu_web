<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class ProductsModel extends MY_Model {
    protected $tableName = 'products';
    
    protected $table = array(
        'id' =>  array(
            'isIndex'   => true,
            'nullable'  => true,
            'type'      => 'integer'
        ),
        'title' => array(
            'isIndex'   => false,
            'nullable'  => false,
            'type'      => 'string'
        ),
        'alias' => array(
            'isIndex'   => false,
            'nullable'  => false,
            'type'      => 'string'
        ),
        'sku' => array(
            'isIndex'   => false,
            'nullable'  => false,
            'type'      => 'string'
        ),
		'categoryid' => array(
            'isIndex'   => false,
            'nullable'  => false,
            'type'      => 'integer'
        ),
        'price' => array(
            'isIndex'   => false,
            'nullable'  => false,
            'type'      => 'integer'
        ),
        'sale_price' => array(
            'isIndex'   => false,
            'nullable'  => false,
            'type'      => 'integer'
        ),
        'description' => array(
            'isIndex'   => false,
            'nullable'  => false,
            'type'      => 'string'
        ),
		'short_description' => array(
            'isIndex'   => false,
            'nullable'  => false,
            'type'      => 'string'
        ),
		'image' => array(
            'isIndex'   => false,
            'nullable'  => false,
            'type'      => 'string'
        ),
		'thumb' => array(
            'isIndex'   => false,
            'nullable'  => true,
            'type'      => 'string'
        ),
		'gallery' => array(
            'isIndex'   => false,
            'nullable'  => true,
            'type'      => 'string'
        ),
		'featured' => array(
            'isIndex'   => false,
            'nullable'  => false,
            'type'      => 'integer'
        ),
		'thumb' => array(
            'isIndex'   => false,
            'nullable'  => true,
            'type'      => 'string'
        ),
		'meta_title' => array(
            'isIndex'   => false,
            'nullable'  => true,
            'type'      => 'string'
        ),
		'meta_description' => array(
            'isIndex'   => false,
            'nullable'  => true,
            'type'      => 'string'
        ),
		'meta_keywords' => array(
            'isIndex'   => false,
            'nullable'  => true,
            'type'      => 'string'
        ),
		'create_time' => array(
            'isIndex'   => false,
            'nullable'  => true,
            'type'      => 'string'
        ),
    );

    public function __construct() {
        parent::__construct();
        $this->checkTableDefine();
    }

    public function getListProducts($title,$limit,$offset) {
        $this->db->select('products.*,products_category.title as cat_name');
		$this->db->join('products_category','products_category.id = products.categoryid', 'left');
        $this->db->like('products.title', $title);
		$this->db->order_by("id","DESC");
        if ($limit != "") {
            $query = $this->db->get('products', $limit, $offset);
        }
        if ($query->num_rows() > 0) {
			return $result = $query->result();
		}
        return false;
    }
	
    public function getCountproducts($title) {
        $this->db->select('*');
        $this->db->from('products');
        $this->db->like('products.title', $title);
		$this->db->order_by("id","DESC");
        return $this->db->count_all_results();
        return false;
    }
	
	public function getRelatedProducts($alias,$limit){
		if (isset($alias)) {
			$this->db->where('alias',$alias);
			$query = $this->db->get('products');
			if($query->num_rows()==0) return false;
			else {
				$r = $query->first_row();
				if($r->tour_cat_id){
					$this->db->like("products.tour_cat_id", $r->tour_cat_id);
					$this->db->where("products.alias !=", $r->alias);
					$query2 = $this->db->get("products",$limit);
					if ($query2->num_rows()>0) return $query2->result();
				}
				return false;
			}
		}
	}
	
	public function getFeaturedproductsHome($non_show,$limit){
		if (isset($non_show)) {
			$this->db->where('show',1);
			$this->db->where('featured',1);
			$this->db->where('id !=', $non_show);
			$this->db->order_by("id","DESC");
			$query = $this->db->get("products",$limit);
			if ($query->num_rows()>0) return $query->result();
		}
	}
	
	public function getCountProduct($title,$category="",$limit,$offset){
        $this->db->select('products.*');
        $this->db->like('products.title', $title);
		$this->db->order_by("id","DESC");
        if($category != "") {
            $this->db->where('products.tour_cat_id', $category);
        }
        return $this->db->count_all_results();
    }
	
	public function getProductByDeviceId($id_device) {
		$this->db->select('products.*,products.id as pro_id');
		$this->db->like('products.id_device',$id_device);
		$this->db->order_by('sell_price','ASC');
		$query = $this->db->get('products');
		if ($query->num_rows()>0) return $query->result();
	}
}