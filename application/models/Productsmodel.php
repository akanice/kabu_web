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

    public function getListProducts($title,$array_cat,$limit,$offset) {
        $this->db->select('products.*,products_category.title as cat_name');
		$this->db->join('products_category','products_category.id = products.categoryid', 'left');
		$this->db->where_in('products_category.id', $array_cat);
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
	
	public function getProductsByCategoryId($title,$category_id="",$per_page,$start){
        $this->db->select('products.*');
		$temp = $this->db->get("products")->result();
		// $product_array[] = new stdClass();
		foreach ($temp as $key=>$value) {
			$cat_array = json_decode($value->categoryid);
			$values[] = $value;
			if (in_array($category_id,$cat_array)) {
				// print_r($k);
				// echo '<br>';
				$product_array[] = $value;
			}
		}
		return $product_array;
    }
	
}