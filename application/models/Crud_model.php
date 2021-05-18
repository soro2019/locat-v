<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Crud_model extends CI_Model
{
    public function __construct()
    {
       parent::__construct();
       date_default_timezone_set('UTC');
    }

    public function selectAllBrand()
    {
        $this->db->select('*');
        $this->db->from('brands');
        $this->db->order_by('name', 'ASC');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }else{
            return false;
        }
    }


    public function generate_pdf($content, $name = 'download.pdf', $output_type = null, $footer = null, $margin_bottom = null, $header = null, $margin_top = null, $orientation = 'P')
    {
        $this->load->library('tec_dompdf');

        /*var_dump( $this->load->library('tec_dompdf'));
        die();*/
        return $this->tec_dompdf->generate($content, $name, $output_type, $footer, $margin_bottom, $header, $margin_top, $orientation);
    }


    /////-******************* STATISTIQUES **********************-///////////////

         //////****Versement de demain

        public function tomorrowPayement()
        {
            $dateJ = date("Y-m-d");
            $dateDemain = strtotime($dateJ.' + 1 days');
            $dateDemain = date("Y-m-d", $dateDemain);
            $this->db->select('*');
            $this->db->from('details_vente');
            $this->db->where(array('status' => 0, 'echeance = ' => $dateDemain));
            $query = $this->db->get();
            if($query->num_rows() > 0){
                return $query->result_array();
            }else{
                return [];
            }
         }

        ///Versement jour prochain
        public function JourProchainPayement()
        {
            $dateJ = date("Y-m-d");
            $dateJourProchain = strtotime($dateJ.' + 7 days');
            $dateJourProchain = date("Y-m-d", $dateJourProchain);
            $this->db->select('*');
            $this->db->from('details_vente');
            $this->db->where(array('status' => 0, 'echeance = ' => $dateJourProchain));
            $query = $this->db->get();
            if($query->num_rows() > 0){
                return $query->result_array();
            }else{
                return [];
            }
         }

            //////****Versement en cours
         
         public function VersementEnCours()
         {
            $this->db->select('*');
            $this->db->from('details_vente');
            $this->db->where(array('status' => 0));
            $query = $this->db->get();
            if($query->num_rows() > 0){
                return $query->result_array();
            }else{
                return [];
            }
         }

          //////****Versement en retard

         public function VersementEnRetard()
         {
            $this->db->select('*');
            $this->db->from('details_vente');
            $this->db->where(array('status' => 0, 'DATE_ADD(echeance, INTERVAL 1 DAY) <=' => date("Y-m-d")));
            $query = $this->db->get();
            if($query->num_rows() > 0){
                return $query->result_array();
            }else{
                return [];
            }
         }

         //////****Versement de la semaine

         public function VersementDeSemaine()
         {
             $dateJ = date("Y-m-d");
             $date7 = strtotime($dateJ.' + 7 days');
             $date7 = date("Y-m-d", $date7);
            $this->db->select('*');
            $this->db->from('details_vente');
            $this->db->where('status', 0);
            $this->db->where("echeance >=", $dateJ);
            $this->db->where("echeance <=", $date7);
            $query = $this->db->get();
            if($query->num_rows() > 0){
                return $query->result_array();
            }else{
                return [];
            }
         }

         //////****Versement du jour

         public function VersementDuJour()
         {
            $this->db->select('*');
            $this->db->from('details_vente');
            $this->db->where(array('status' => 0, 'echeance' => date('Y-m-d')));
            $query = $this->db->get();
            if($query->num_rows() > 0){
                return $query->result_array();
            }else{
                return [];
            }
         }


    public function selectAllClient()
    {
        $this->db->select('*');
        $this->db->from('clients');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }else{
            return false;
        }
    }

    public function selectOneClient($id_client)
    {
        $this->db->select('*');
        $this->db->from('clients');
        $this->db->where('id', $id_client);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->row_array();
        }else{
            return false;
        }
    }

   /* public function selectOneVente($id_vente)
    {
        $this->db->select('*');
        $this->db->from('ventes');
        $this->db->where('id', $id_vente);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->row_array();
        }else{
            return false;
        }
    }
*/

    

    public function selectAllInventaire1()
    {
        $this->db->select('*');
        $this->db->from('inventory');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }else{
            return false;
        }
    }

    public function selectProduitByID($idproduit)
    {
        $this->db->select('*');
        $this->db->from('products');
        $this->db->where(array('id'=>$idproduit));
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->row();
        }else{
            return false;
        }
    }

    public function selectSubInventoryWithAssignValidatorByInv($id_inv)
    {
        $this->db->select('si.title, id_sub, username, last_name, first_name');
        $this->db->from('sub_inventory as si');
        $this->db->join('attribution_sub_inventory as asi','si.id = asi.id_sub and asi.id_inv = '.$id_inv);
        $this->db->join('users u','u.id = asi.user_id_validator','left');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }else{
            return array();
        }
    }

    public function updateGen($key, $data, $table)
    {
        //key est de la forme array('nom colonne' => $valeur)
        //idem pour data
        foreach($data as $at => $val)
        {
            $this->db->set($at,$val) ;
        }
        foreach($key as $at => $val)
        {
            $this->db->where($at,$val);
        }
        $this->db->update($table);

        return true;
    }

    public function selectTimeZones()
    {
        $query = $this->db->get('timezones');
        if($query->num_rows() > 0){
            return $query->result_array();
        }else{
            return false;
        }
    }


    public function backupInventory($id)
    {
        $this->db->select('u.username as user_name, i.nom_inventaire as inventory_name, si.title as sub_name, asi.date_create as create, asi.starting_date as start, asi.date_end as end, asi.status as status');
        $this->db->from('attribution_sub_inventory as asi');
        $this->db->join('users as u','asi.user_id = u.id');
        $this->db->join('sub_inventory as si','si.id = asi.id_sub');
        $this->db->join('inventory as i','i.id_inventory = asi.id_inv');
        $this->db->where('i.id_inventory', $id);
        $this->db->where('i.etat', 3);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }else{
            return array();
        }
    }


    public function selectSubIventoriesAttributeFinish($id_inv)
    {
        $this->db->select('*');
        $this->db->from('attribution_sub_inventory');
        $this->db->where(array('id_inv' => $id_inv, 'status' => 1));
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }else{
            return false;
        } 
    }

    public function selectFormatDate()
    {
        $query = $this->db->get('format_dates');
        if($query->num_rows() > 0){
            return $query->result_array();
        }else{
            return false;
        }
    }


    public function selectLangauge()
    {
        $query = $this->db->get('languages');
        if($query->num_rows() > 0){
            return $query->result_array();
        }else{
            return false;
        }
    }

    

    public function selectSettings()
    {
        $this->db->limit(1);
        $query = $this->db->get('settings');
        if($query->num_rows() == 1){
            return $query->row_array();
        }else{
            return false;
        }
    }

    public function selectUser($id)
    {
        $this->db->limit(1);
        $this->db->where('id', $id);
        $query = $this->db->get('users');
        if($query->num_rows() == 1){
            return $query->row_array();
        }else{
            return false;
        }
    }

    public function getPermission($group_id)
    {
        $this->db->where('group_id', $group_id);
        $this->db->select('*');
        $this->db->from('permission');
        $q = $this->db->get();
        if($q->num_rows() > 0)
        {
            return $q->row_array();
        }else
           return false;
    }


    public function update_category($id,$name, $description){
        $this->db->set('name',$name);
        $this->db->set('description',$description);
        $this->db->where('id',$id);
        $this->db->update('categories');
    }


    public function update_brand($id,$name, $description){
        $this->db->set('name',$name);
        $this->db->set('description',$description);
        $this->db->where('id',$id);
        $this->db->update('brands');
    }


    public function brandExist($name)
    {
         $this->db->select('name'); 
         $this->db->from('brands');
         $this->db->where(array('name' => $name));
         $query = $this->db->get();
         if($query->num_rows() != 0){
              return true;
         }else{
             return false;
         }
    }





    public function EmailExiste($email){
         $this->db->select('email'); 
         $this->db->from('users');
         $this->db->where('email', $email);
         $query = $this->db->get();
         if ($query->num_rows() != 0) {
              return true;
         } else {
             return false;
         }
    }


    public function EmailExisteModif($email, $id){
         $this->db->select('email'); 
         $this->db->from('users');
         $this->db->where(array('email' => $email, 'id!=' => $id));
         $query = $this->db->get();
         if ($query->num_rows() != 0) {
              return true;
         } else {
             return false;
         }
    }

   /*public function selectAllClient(){
         $this->db->select('*'); 
         $this->db->from('clients');
         $query = $this->db->get();
         if($query->num_rows() > 0){
              return $query->row_array();
         }else{
             return false;
         }
    }*/



    public function selectAllOrOneUsers($id=""){
         $this->db->select('*'); 
         $this->db->from('users');
         if(!empty($id)) {
            $this->db->where('id', $id);
         }
         $query = $this->db->get();
         if($query->num_rows() > 0){
            if(!empty($id)){
              return $query->row_array();
            }else
            {
              return $query->result_array();
            }
         } else {
             return false;
         }
    }

    public function selectAllSubInventories(){
        $this->db->select("*");
        $this->db->from("sub_inventory");
        $this->db->order_by("title", 'ASC');
        $query = $this->db->get();
        if ($query->num_rows() > 0){
            return $query->result_array();
        }
        return false;
    }


    public function selectSubInventories($id){
        $this->db->select("*");
        $this->db->from("sub_inventory");
        $this->db->where("id", $id);
        $query = $this->db->get();
        if ($query->num_rows() == 1){
            return $query->row_array();
        }
        return false;
    }





    public function selectSubInventories2($id_inv, $id_user="")
    {
        $this->db->select('si.id AS id, si.title AS title, si.description AS description, si.date_create AS date_create');
        $this->db->from('sub_inventory AS si');
        $this->db->join('relationsubinv_inv AS r', 'si.id = r.id_sub_inventory');
        $this->db->join('attribution_sub_inventory AS asi','r.id_sub_inventory = asi.id_sub AND r.id_inventory = asi.id_inv ','left');
        if($id_user == ""){
            $this->db->where(array('r.id_inventory' => $id_inv));
            $this->db->where('(asi.starting_date = 0 OR asi.starting_date IS NULL)');
            //$this->db->or_where(array('asi.starting_date' => NULL));

        }else{$this->db->where(array('r.id_inventory' => $id_inv, 'asi.starting_date' => 0, 'asi.user_id' => $id_user));}
            $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }else{
            return [];
        } 
    }

    public function UsernameExiste($username)
    {
         $this->db->select('username'); 
         $this->db->from('users');
         $this->db->where(array('username' => $username));
         $query = $this->db->get();
         if($query->num_rows() != 0){
              return true;
         }else{
             return false;
         }
    }


    public function getGroupByName($name)
    {
        $this->db->where('name', $name);
        $this->db->select('*');
        $this->db->from('groups');
        $q = $this->db->get();
        if($q->num_rows() > 0)
        {
          return $q->row_array();
        }else
           return false;
    }

    public function getGroupById($id)
    {
        $this->db->where('id', $id);
        $this->db->select('*');
        $this->db->from('groups');
        $q = $this->db->get();
        if($q->num_rows() > 0)
        {
          return $q->row_array()['name'];
        }else
           return false;
    }


    public function verification_($tablename, $verif)
    {
        $this->db->select('*');
        $this->db->from($tablename);
        $this->db->where($verif);
        $query = $this->db->get();
        if($query->num_rows() > 0){
             return true;
        }else{
            return false;
        }
    }

    public function insertion_($tablename, $data)
    {
      $this->db->insert($tablename, $data);
      return $this->db->insert_id();
    }


    public function subinventoryCompleted($id_sub, $id_inv)
    {
        $this->db->select('*');
        $this->db->from('attribution_sub_inventory');
        $this->db->where(array('id_sub' => $id_sub, 'id_inv' => $id_inv, 'status'=>1));
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return true;
        }else{
            return false;
        } 
    }

    public function subInventoryExisteByUser($sub_id, $id_inv, $user_id)
    {
        $this->db->select('*');
        $this->db->from('attribution_sub_inventory');
        $this->db->where(array('id_sub'=>$sub_id, 'id_inv'=> $id_inv, 'user_id'=> $user_id));
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return true;
        }else{
            return false;
        }
    }

    public function SelectProduitByInventory($id_inventaire)
    {
        $this->db->select('*');
        $this->db->from('inventory_products');
        $this->db->where(array('id_inv'=>$id_inventaire));
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return true;
        }else{
            return false;
        }
    }

    public function inventoryExporter($id_inventaire)
    {
        $this->db->select('*');
        $this->db->from('inventory');
        $this->db->where(array('id_inventory' => $id_inventaire));
        $this->db->where('exporter !=', 0);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return true;
        }else{
            return false;
        }
    }


    public function nbinventoryEncour()
    {
        $this->db->select('*');
        $this->db->from('inventory');
        $this->db->where('etat=-1');
         $query = $this->db->get();
        return $query->num_rows();
    }

    public function nameInventory($id_inventaire)
    {
        $this->db->select('nom_inventaire');
        $this->db->from('inventory');
        $this->db->where(array('id_inventory' => $id_inventaire));
        //$this->db->where('exporter !=', 0);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->row_array();
        }else{
            return false;
        }
    }

    public function nameExist($table, $field, $name)
    {
        $this->db->select('*'); 
        $this->db->from($table);
        $this->db->where(array($field => $name));
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->row_array();
        }else{
            return false;
        }        
    }
    

    public function SelectOneProduitByInventory($id_products)
    {
        $this->db->select('id_inv');
        $this->db->from('inventory_products');
        $this->db->where(array('id_products' => $id_products));
       // $this->db->where("etat=0 OR etat = 3");
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }else{
            return false;
        }
    }

    public function SelectProduitByInventorySub($id_sub, $id_inv)
    {
        $this->db->select('*');
        $this->db->from('product_on_inventory');
        $this->db->where(array('id_sub'=>$id_sub, 'id_inv'=>$id_inv, 'datecompte!=' => 0));
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return true;
        }else{
            return false;
        }
    }

    public function SelectOneProduitByInventorySub($id_sub, $id_inv, $id_prod)
    {
        $sql = 'SELECT * FROM `inventory_products` WHERE `id_inv` = 1 AND `id_sub` = 1 AND `id_products` = 3';
        $query = $this->db->query($sql);
        if($query->num_rows() > 0){
            return $query->row_array();
        }else{
            return false;
        }
    }

   /* public function countProduitByInventorySub($id_sub, $id_inv)
    {
        $this->db->select('*');
        $this->db->from('inventory_products');
        $this->db->where(array('id_sub'=>$id_sub, 'id_inv'=>$id_inv));
        $query = $this->db->get();
        if($query->num_rows() == 1){
            return true;
        }else{
            return false;
        }
    }*/


    public function countProduitByInventorySub2($id_sub, $id_inv)
    {
        $this->db->select('*');
        $this->db->from('product_on_inventory');
        $this->db->where(array('id_sub'=>$id_sub, 'id_inv'=>$id_inv));
        $query = $this->db->get();
        if($query->num_rows() == 1){
            return true;
        }else{
            return false;
        }
    }


    public function verfiExisteProd($info="", $type="")
    {
        $this->db->select('*');
        $this->db->from('products');
        $this->db->where(array($type => $info));
        $query = $this->db->get();
        if($query->num_rows()==1){
            return $query->row_array();
        }else{
            return false;
        }
    }


    public function verifProdComptInventory($value="", $champ="")
    {
        $this->db->select('*');
        $this->db->from('product_on_inventory');
        $this->db->where(array($champ => $value));
        $query = $this->db->get();
        if($query->num_rows()==1){
            return $query->row_array();
        }else{
            return false;
        }
    }


    public function sectionprod($cb="")
    {
        $this->db->select('*');
        $this->db->from('products');
        $this->db->where(array('code'=> $cb));
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->row_array();
        }else{
            return false;
        }
    }


    public function sectionform($elemt, $id)
    {
        $this->db->select('*');
        if ($elemt=='category') {
            $tableau='categories';
        }
        if ($elemt=='marque') {
            $tableau='brands';
        }
        $this->db->from($tableau);
        $this->db->where(array('id'=> $id));
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->row_array();
        }else{
            return false;
        }
    }

    public function terminervalidation($data, $idinv, $id_sub)
    {
      $this->db->where(array('id_inv'=>$idinv, 'id_sub'=>$id_sub));
      $this->db->update('attribution_sub_inventory', $data);
      return true;
    }

    public function update_where($table, $data, $condition, $where)
    {
      $this->db->where($where, $condition);
      $this->db->update($table, $data);
      return true;
    }

    public function countProduitByinventaire($id_inventaire)
    {
        $this->db->select('*');
        $this->db->from('inventory_products');
        $this->db->where(array('id_inv'=>$id_inventaire, 'etat'=>0));
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result();
        }else{
            return false;
        }
    }


    


    public function selectProduitByIDInventorie($idproduit, $id_sub, $id_inv)
    {
        $this->db->select('*');
        $this->db->from('products');
        $this->db->join('product_on_inventory', 'product_on_inventory.id_products = products.id');
        $this->db->where(array('product_on_inventory.id_products' => $idproduit, 'product_on_inventory.id_inv' => $id_inv, 'product_on_inventory.id_sub' => $id_sub));
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->row();
        }else{
            return false;
        }
    }


    public function correction($data, $data_where)
    {
      $this->db->where($data_where);
      $this->db->update('product_on_inventory', $data);
      return true;
    }


    public function operation_update($data, $table)
    {
      //$this->db->where('id_products', $id);
      $this->db->update($table, $data);
      return true;
    }



    public function selectSubIventories($id_inv)
    {
        $this->db->select('*, sub_inventory.id AS sub_id');
        $this->db->from('sub_inventory');
        $this->db->join('relationsubinv_inv', 'sub_inventory.id = relationsubinv_inv.id_sub_inventory');
        $this->db->where('relationsubinv_inv.id_inventory', $id_inv);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }else{
            return false;
        } 
    }

    public function selectSubIventoriesAttribute($id_inv)
    {
        $this->db->select('*');
        $this->db->from('attribution_sub_inventory');
        $this->db->where('id_inv', $id_inv);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }else{
            return false;
        } 
    }

    public function selectSubIventoriesUser($id_inv)
    {
        $this->db->select('users.first_name, users.last_name, users.username, users.id , id_sub, title');
        $this->db->from('attribution_sub_inventory');
        $this->db->where('id_inv', $id_inv);
        $this->db->join('users', 'users.id = attribution_sub_inventory.user_id');
        $this->db->join('sub_inventory', 'sub_inventory.id = attribution_sub_inventory.id_sub');
        $this->db->group_by('id_sub');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }else{
            return false;
        } 
    }

    public function selectSubInventoriesWithAssignedUser($id_inv)
    {
        //$this->db->select('*');
        //$this->db->from('sub_inventory');
        //$this->db->join();
        $this->db->select('si.id AS id, si.title AS title, si.description AS description, u.first_name AS first_name, u.last_name AS last_name, u.username AS username, asi.starting_date AS starting_date ');
        $this->db->from('sub_inventory AS si');
        $this->db->join('relationsubinv_inv AS r', 'si.id = r.id_sub_inventory');
        $this->db->join('attribution_sub_inventory AS asi','r.id_sub_inventory = asi.id_sub AND r.id_inventory = asi.id_inv ','left');
        $this->db->join('users AS u','asi.user_id = u.id','left');
        $this->db->where(array('r.id_inventory' => $id_inv));
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }else{
            return false;
        }    
    }


    public function selectSubIventoriesUser2($id_inv)
    {
        $this->db->select('id_sub, title, id_inv, attribution_sub_inventory.date_create, starting_date, date_end, attribution_sub_inventory.status');
        $this->db->from('attribution_sub_inventory');
        $this->db->where('id_inv', $id_inv);
        $this->db->where('username', $this->session->userdata('identity'));
        $this->db->join('users', 'users.id = attribution_sub_inventory.user_id');
        $this->db->join('sub_inventory', 'sub_inventory.id = attribution_sub_inventory.id_sub');
        $this->db->where('attribution_sub_inventory.status != ', 3);
        //$this->db->group_by('id_sub');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }else{
            return false;
        } 
    }


    public function selectSubInventoryAttribueByUser($id_sub)
    {
        $this->db->select('*');
        $this->db->from('sub_inventory');
        $this->db->where(array('id' => $id_sub));
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->row_array();
        }else{
            return false;
        } 
    }




    ///58808149
    //Capteur d'angle de braquage F25. BMW


    public function selectSubInventoryNotAssigne($id_inv, $id_sub_inv)
    {
        $this->db->select('*');
        $this->db->from('attribution_sub_inventory');
        $this->db->where(array('id_inv' => $id_inv, 'id_sub' => $id_sub_inv));
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return 'assigner';
        }else{
            return 'notassigner';
        } 
    }


    public function selectAllProduit()
    {
        $this->db->select('*');
        $this->db->from('products');
        $this->db->order_by('brand', 'ASC');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }else{
            return false;
        }
    }

    public function get_brand()
    {
        $this->db->distinct();
        $this->db->select('brand');
        $this->db->from('products');
        $this->db->order_by('brand', 'ASC');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }else{
            return false;
        }
    }


    public function selectProduitByVente($id_prod)
    {
        $this->db->select('*');
        $this->db->from('ventes');
        $this->db->where('idProduit', $id_prod);
        $query = $this->db->get();
        return $query->num_rows();
    }
    

    public function selectOneProduitById($id)
    {
        $this->db->select('*');
        $this->db->from('products');
        $this->db->where('id', $id);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->row_array();
        }else{
            return false;
        }
    }

    public function selectProduitByBrand($id_brand)
    {
        $this->db->select('*');
        $this->db->from('products');
        $this->db->where('brand', $id_brand);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function selectAllSupplier()
    {
        $this->db->select('*');
        $this->db->from('suppliers');
        $this->db->order_by('name', 'ASC');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }else{
            return false;
        }
    }

    public function selectAllWarehouse()
    {
        $this->db->select('*');
        $this->db->from('warehouse');
        $this->db->order_by('name', 'ASC');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }else{
            return false;
        }
    }

    public function selectAllLocation($id_prod="")
    {
        $this->db->select('*');
        $this->db->from('locations');
        $this->db->where('product_id', $id_prod);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->row_array();
        }else{
            return false;
        }
    }

    public function selectChampProduct()
    {
        $this->db->select('*');
        $this->db->from('product_settings');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->row_array();
        }else{
            return false;
        }
    }


    public function selectAllCategory()
    {
        $this->db->distinct();
        $this->db->select('*');
        $this->db->from('categories');
        $this->db->order_by('name', 'ASC');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }else{
            return false;
        }
    }


    public function selectAllGroup()
    {
        $this->db->select('*');
        $this->db->from('groups');
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }else{
            return false;
        }
    }

    public function selectOneGroup($id)
    {
        $this->db->select('*');
        $this->db->from('groups');
        $this->db->where('id', $id);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->row_array();
        }else{
            return false;
        }
    }

    public function delete_row($table,$row)
    {
      $this->db->delete($table,$row);
      return true;
    }

    public function update_sub_inventory($id,$title, $description){
        $this->db->set('title',$title);
        $this->db->set('description',$description);
        $this->db->where('id',$id);
        $this->db->update('sub_inventory');
        return true;
    }


    public function categoryExist($name)
    {
         $this->db->select('name'); 
         $this->db->from('categories');
         $this->db->where(array('name' => $name));
         $query = $this->db->get();
         if($query->num_rows() != 0){
              return true;
         }else{
             return false;
         }
    }

    public function subinventoryCompleted2($id_sub)
    {
        $this->db->select('*');
        $this->db->from('attribution_sub_inventory');
        $this->db->where(array('id_sub' => $id_sub, 'status'=>0));
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return true;
        }else{
            return false;
        } 
    }

    public function elementExist($where, $tablename)
    {
         $this->db->select('*'); 
         $this->db->from($tablename);
         $this->db->where($where);
         $query = $this->db->get();
         if($query->num_rows() > 0){
              return true;
         }else{
             return false;
         }
    }

    public function deplacementElement()
    {
        $q = $this->db->get('product_on_inventory')->result(); // get result from table
        foreach ($q as $r)
        { // loop over results
          $this->db->insert('product_on_inventory_history', $r); // insert each row to country table
        }
    }


    public function viderTable($table)
    {
      $this->db->truncate($table);
    }

    public function selectALLInventoriesNotArchive()
    {
        $this->db->select('*');
        $this->db->from('inventory');
        $this->db->where('etat !=', 4);
         $query = $this->db->get();
         if($query->num_rows() > 0){
            if(!empty($id)){
              return $query->row_array();
            }else
            {
              return $query->result_array();
            }
         } else {
             return false;
         }  
    }


    public function selectALLInventoriesArchive()
    {
        $this->db->select('*');
        $this->db->from('inventory');
        $this->db->where('etat =', 4);
         $query = $this->db->get();
         if($query->num_rows() > 0){
            if(!empty($id)){
              return $query->row_array();
            }else
            {
              return $query->result_array();
            }
         } else {
             return false;
         }  
    }

   

    public function selectALLInventories($id="")
    {
        $this->db->select('*');
        $this->db->from('inventory');
        if(!empty($id)) {
            $this->db->where('id_inventory', $id);
         }
         $query = $this->db->get();
         if($query->num_rows() > 0){
            if(!empty($id)){
              return $query->row_array();
            }else
            {
              return $query->result_array();
            }
         } else {
             return false;
         }  
    }


    public function selectAllVente()
    {
        $this->db->select('*, ventes.status AS ss, ventes.id AS idd, ventes.user AS user_id');
        $this->db->from('ventes');
        $this->db->join('products', 'ventes.idProduit = products.id');
        $this->db->join('clients', 'ventes.idClient = clients.id');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
         }else{
             return false;
         }  
    }


    public function selectAllVenteNotClose()
    {
        $this->db->select('*, ventes.status AS ss, ventes.id AS idd, ventes.user AS user_id');
        $this->db->from('ventes');
        $this->db->join('products', 'ventes.idProduit = products.id');
        $this->db->join('clients', 'ventes.idClient = clients.id');
        $this->db->where('ventes.status', 0);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
         }else{
             return false;
         }  
    }


    public function selectOneVente($id_vente)
    {
        $this->db->select('*, ventes.status AS ss, ventes.id AS idd');
        $this->db->from('ventes');
        $this->db->join('products', 'ventes.idProduit = products.id');
        $this->db->join('clients', 'ventes.idClient = clients.id');
        $this->db->join('brands', 'products.brand = brands.id');
        $this->db->where('ventes.id', $id_vente);
        $query = $this->db->get();
        if($query->num_rows() == 1){
            return $query->row_array();
         }else{
             return false;
         }  
    }


    public function details_vente($idvente)
    {
        $this->db->select('*');
        $this->db->from('details_vente');
        $this->db->where('idvente', $idvente);
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
         }else{
             return false;
         }  
    }

    public function appareil_vendu($idvente)
    {
        $this->db->select('emeil, idProduit, brands.name brand, products.name');
        $this->db->from('products_by_vente');
        $this->db->join('ventes', 'ventes.id = products_by_vente.vente');
        $this->db->join('products', 'ventes.idProduit = products.id');
        $this->db->join('brands', 'products.brand = brands.id');
        $this->db->where('ventes.id', $idvente);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
         }else{
             return false;
         }  
    }

    public function selectOnesLine($id_line)
    {
        $this->db->select('*');
        $this->db->from('details_vente');
        $this->db->where('id', $id_line);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->row_array();
         }else{
             return false;
         }  
    }


    public function selectImpaier($idvente)
    {
        $this->db->select('*');
        $this->db->from('details_vente');
        $this->db->where('idvente', $idvente);
        $this->db->where('status', 0);
        $query = $this->db->get();
        return $query->num_rows();
    }



    


    public function selectALLInventoriesInProcess()
    {
        $this->db->select('*');
        $this->db->from('inventory');
        //$this->db->where(array(/*'date_end'=>0, */'assigner'=> -1));
        $this->db->where('(assigner = 1 OR assigner = -1)');// AND date_end = 0
         $query = $this->db->get();
         if($query->num_rows() > 0){
            return $query->result_array();
         }else{
            return false;
         }
    }

    public function selectAllUsers()
    {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('active', 1);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }else{
            return false;
        }
    }

    public function selectAllUsers2()
    {
        $this->db->select('*');
        $this->db->from('users');
      //  $this->db->where('active', 1);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }else{
            return false;
        }
    }

    public function selectUsersByGroup($group_id)
    {
        $this->db->select('users.id, username, group_id, first_name, last_name');
        $this->db->from('users');
        $this->db->join('users_groups', 'users.id = users_groups.user_id');
        $this->db->where(array('group_id' => $group_id, 'active' => 1));
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }else{
            return false;
        }       
    }

    public function selectSubInventoryByInventory($idinv)
    {
        $this->db->select('*');
        $this->db->from('sub_inventory');
        $this->db->join('relationsubinv_inv', 'relationsubinv_inv.id_sub_inventory = sub_inventory.id');
        $this->db->where(array('id_inventory' => $idinv));
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }else{
            return false;
        }       
    }

    public function selectSubInventoryByInventory2($idinv)
    {
        $this->db->select('*, sub_inventory.id as id_sub');
        $this->db->from('sub_inventory');
        $this->db->join('relationsubinv_inv', 'relationsubinv_inv.id_sub_inventory = sub_inventory.id');
        $this->db->where(array('id_inventory' => $idinv));
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }else{
            return false;
        }       
    }

    public function selectSubInventoryByInventory225($idinv)
    {
        $this->db->select('*, sub_inventory.id as id_subb');
        $this->db->from('sub_inventory');
        $this->db->join('attribution_sub_inventory', 'attribution_sub_inventory.id_sub = sub_inventory.id');
        $this->db->where(array('attribution_sub_inventory.id_inv' => $idinv, 'attribution_sub_inventory.status' => 1));
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }else{
            return false;
        }       
    }


    public function selectSubInventoryForValidatorByInv($id_inv, $id_val)
    {
        $this->db->select('si.id as id');
        $this->db->from('sub_inventory as si');
        $this->db->join('attribution_sub_inventory as asi','si.id = asi.id_sub and asi.id_inv = '.$id_inv);
        $this->db->join('users u','u.id = asi.user_id_validator');
        $this->db->where('asi.user_id_validator', $id_val);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }else{
            return array();
        }
    }


    public function get_rapport($id_inv)
    {
        $table_action = "product_on_inventory";
        $invenNotArchive = $this->db->get_where($table_action, ['id_inv' => $id_inv])->num_rows();
        if($invenNotArchive == 0)
        {
          $table_action = "product_on_inventory_history";
        }
        $data_where = ['id_inv' => $id_inv, 'etat' => 1];
        $query = $this->db->get_where($table_action, $data_where);
        if($query->num_rows() > 0){
            return $query->result_array();
        }else{
            return array();
        }
    }

    ///AJAX RESOLUTION ////////////////////////

    public function getRows()
    {
        $postData = $this->input->post();
        $this->_get_datatables_query($postData);
        if(isset($postData['length']) && $postData['length'] != -1){
            $this->db->limit($postData['length'], $postData['start']);
        }
        $query = $this->db->get();
        return $query->result_array();
    }


    public function deleteATSI($sub, $user_id,$inv)
    {
        $this->db->delete('attribution_sub_inventory', array('id_sub' => $sub, 'user_id' => $user_id, 'id_inv' => $inv));
    }

    public function updateATSI($sub, $user_id,$inv)
    {
        $this->db->set('user_id', $user_id);
        $this->db->where(array('id_sub' => $sub, 'id_inv' => $inv));
        $this->db->update('attribution_sub_inventory');
    }

    public function existATSI($id_inv, $id_sub)
    {
         $this->db->select('id_inv, id_sub'); 
         $this->db->from('attribution_sub_inventory');
         $this->db->where(array('id_inv' => $id_inv, 'id_sub' => $id_sub));
         $query = $this->db->get();
         if($query->num_rows() != 0){
              return true;
         }else{
             return false;
         }
    }


    public function selectSubIventoryNotValid($user_id)
    {
        $this->db->select('*');
        $this->db->from('attribution_sub_inventory');
        $this->db->where(array('status'=> '1', "user_id_validator" => $user_id));
        $this->db->order_by('status', 'ASC');
        $this->db->order_by('date_end', 'ASC');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result();
        }else{
            return false;
        }
    }

    public function countSubIventoryByinventory($id_inv)
    {
        $this->db->where(array('id_inv'=>$id_inv));
        $query = $this->db->get('attribution_sub_inventory');
        return $query->num_rows();
    }

    public function countSelectSubIventoryValid($id_inv)
    {
        $this->db->where(array('id_inv'=>$id_inv, 'status'=> '3'));
        $query = $this->db->get('attribution_sub_inventory');
        return $query->num_rows();
    }

    public function countProduitBySubInventory($id_sub, $id_inv)
    {
        $this->db->select('*');
        $this->db->from('product_on_inventory');
        $this->db->where(array('id_inv'=>$id_inv, 'id_sub'=>$id_sub, 'etat'=>0));
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result();
        }else{
            return false;
        }
    }


    public function selectSubInventoriesByValidators($id_sub, $id_inv, $user_id)
    {
        $this->db->select('*');
        $this->db->from('attribution_sub_inventory');
        $this->db->where(array('id_inv' => $id_inv, 'id_sub' => $id_sub, 'status' => 1, 'user_id_validator' => $user_id));
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result();
        }else{
            return false;
        }
    }


    public function backupInventoryProducts($id_inv, $table_action)
    {
     $sql = "SELECT *, poi.date_add as date_ad from ".$table_action." as poi, inventory as inv, products p, sub_inventory sub where poi.id_inv = inv.id_inventory AND poi.id_products = p.id AND poi.id_sub = sub.id AND poi.etat = 1 AND poi.id_inv = ".$id_inv;
      $query = $this->db->query($sql);
       if($query->num_rows() > 0){
            return $query->result_array();
        }else{
            return false;
        }
    }


    public function codeExiste($code, $inv)
    {
      $this->db->select('*');
      $this->db->from('product_on_inventory');
      $this->db->where(array("code" => $code, "id_inv" => $inv));
      $query = $this->db->get();
        if($query->num_rows() == 1){
            return $query->row_array();
        }else{
            return false;
        }
    }

    public function EMEIExiste($emeil, $id)
    {
      $this->db->select('*');
      $this->db->from('products');
      $this->db->where(array("code" => $emeil, "id!=" => $id));
      $query = $this->db->get();
        if($query->num_rows() == 1){
            return true;
        }else{
            return false;
        }
    }

    public function EMEIExiste2($emeil)
    {
      $this->db->select('*');
      $this->db->from('products');
      $this->db->where(array("code" => $emeil));
      $query = $this->db->get();
        if($query->num_rows() == 1){
            return true;
        }else{
            return false;
        }
    }

    public function refExiste($ref, $inv)
    {
      $this->db->select('*');
      $this->db->from('product_on_inventory');
      $this->db->where(array("ref" => $ref, "id_inv" => $inv));
      $query = $this->db->get();
        if($query->num_rows() == 1){
            return $query->row_array();
        }else{
            return false;
        }
    }















}

    