<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product_data_model extends CI_Model{
    
    function __construct() {
        // Set table name
        $this->table = 'products';
        // Set orderable column fields
        $this->column_order = array(null,'products.codeIdentification','products.name','brands.name','products.quantity','products.prix_vente');
        // Set searchable column fields
        $this->column_search = array('products.name','brands.name', 'codeIdentification');
        // Set default order
        $this->order = array('brands.name' => 'asc');
    }
    
    /*
     * Fetch members data from the database
     * @param $_POST filter data based on the posted parameters
     */
    public function getRows(){
        $postData = $this->input->post();
        $this->_get_datatables_query($postData);
        if(isset($postData['length']) && $postData['length'] != -1){
            $this->db->limit($postData['length'], $postData['start']);
        }
        $query = $this->db->get();
        return $query->result_array();
        //return $this->db->error();
        //die();
    }
    
    /*
     * Count all records
     */
    public function countAll(){
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }
    
    /*
     * Count records based on the filter params
     * @param $_POST filter data based on the posted parameters
     */
    public function countFiltered($postData){
        $this->_get_datatables_query($postData);
        $query = $this->db->get();
        return $query->num_rows();
    }
    
    /*
     * Perform the SQL queries needed for an server-side processing requested
     * @param $_POST filter data based on the posted parameters
     */
    private function _get_datatables_query($postData){

        $this->db->select('*, brands.name as brand, products.name as nameProd, products.id as id_prodt');

        $this->db->from($this->table);
        $this->db->join('brands', 'brands.id='.$this->table.'.brand');

        // Custom search filter 
         
        if(isset($postData['brand']) && $postData['brand'] != ''){
            $this->db->like('brand', $postData['brand']);
        }

        if(isset($postData['name']) && $postData['name'] != ''){
            $this->db->like($this->table.'.name', $postData['name']);
        }

        if(isset($postData['code']) && $postData['code'] != ''){
            $this->db->like('codeIdentification', $postData['code']);
        }

        

        $i = 0;
        // loop searchable columns 
        foreach($this->column_search as $item){
            // if datatable send POST for search
            if(isset($postData['search']['value'])){
                // first loop
                if($i===0){
                    // open bracket
                    $this->db->group_start();
                    $this->db->like($item, $postData['search']['value']);
                }else{
                    $this->db->or_like($item, $postData['search']['value']);
                }
                
                // last loop
                if(count($this->column_search) - 1 == $i){
                    // close bracket
                    $this->db->group_end();
                }
            }
            $i++;
        }
         
        if(isset($postData['order'])){
            $this->db->order_by($this->column_order[$postData['order']['0']['column']], $postData['order']['0']['dir']);
        }else if(isset($this->order)){
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

}