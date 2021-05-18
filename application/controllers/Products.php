<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Crud_model');
	}

	public function add()
	{
	    if(!$this->ion_auth->logged_in())
	    {
	      redirect(site_url('main/login'), 'refresh');
	    }elseif($this->ion_auth->logged_in() && $this->session->userdata('nblogin') == 0)
	    {
	        redirect(site_url('main/change_password'), 'refresh');
	    }
		  $page_data['page_title'] = 'Products';
		  $page_data['page_title_sous'] = 'add product';
		  $page_data['nbproduct'] = 0;
		  if(!is_bool($this->Crud_model->selectAllProduit())) {
		  	$page_data['nbproduct'] = count($this->Crud_model->selectAllProduit());
		  }
		  $page_data['brand'] = $this->Crud_model->selectAllBrand();
		  if($this->input->post())
		  {
	        if(empty($this->input->post()))
	        {
	          $this->session->set_flashdata('error', 'Les champs marqués d\'un * sont des champs de saisie obligatoires.');
	        }elseif($this->testeur('name', $this->input->post()) == 'empty')
	        {
	    	    $this->session->set_flashdata('error', 'Le nom du produit ne peut pas être vide');
	        }elseif($this->testeur('name', $this->input->post()) == 'is_numeric')
	        {
	    	    $this->session->set_flashdata('error', 'Le nom du produit ne peut pas être numérique.');
	        }elseif($this->testeur('brand', $this->input->post()) == 'empty')
	        {
	    	     $this->session->set_flashdata('error', 'La marque du produit ne peut pas être vide');
	        }elseif(array_key_exists('quantity', $this->input->post()) && empty($this->input->post('quantity')))
	        {
	    	  	$this->session->set_flashdata('error', 'La quantité du produit ne peut pas être vide');
	        }/*elseif(array_key_exists('prix_vente', $this->input->post()) && empty($this->input->post('prix_vente')))
	        {
	          $this->session->set_flashdata('error', 'Le prix de vente du produit ne peut pas être vide');
	        }*/else
	        {
	          $data = validation($this->input->post());
	          //var_dump($data);die;
	          if($id_prod = $this->Crud_model->insertion_('products', $data))
	          {
	          	$this->session->set_flashdata('message', 'Produit ajouté avec succès');
	          }else
	          {
	          	$this->session->set_flashdata('error', 'Erreur du Système');
	          }
	          redirect(site_url('products/list'), 'refresh');
	        }
		  }
		  $this->load->view('template/header_principal', $page_data);
		  $this->load->view('add_product', $page_data);
		  $this->load->view('template/footer_principal', $page_data);
	}


  public function selectQntByModel()
  {
  	$pro = $this->input->post('pro');
    $query = $this->db->get_where('products', array('id' => $pro))->result_array();
    $data = ["qnt" => $query[0]['quantity'], "prix" => $query[0]['prix_vente']];
     echo json_encode($data);
  }

  public function selectModelByBrand()
  {
    $brand = $this->input->post('brand');
    $query = $this->db->get_where('products', array('brand' => $brand))->result_array();
    //$query = $this->db->query("SELECT * FROM `products` WHERE brand = ".$brand." and `id` NOT IN (SELECT id_products FROM product_on_inventory WHERE id_inv = 1 )");

    if(count($query) > 0)
    {
      $tag_select = '';
      $tag_select .= '<option value="">Selectionner un modèle</option>';
      foreach($query as $query)
      {
          $selected = ''; 
          $tag_select .= '<option value="'.$query['id'].'" '.$selected.' >'.$query['name'].'</option>';
      }
    }else
    {
      $tag_select = '';
      $tag_select .= "<option value=''>Pas de modèle trouvé</option>";
    }
     echo json_encode($tag_select);
  }



  public function selectModelByBrandNotInvente()
  {
    $brand = $this->input->post('brand');
    //$query = $this->db->get_where('products', array('brand' => $brand))->result_array();
    $query = $this->db->query("SELECT * FROM `products` WHERE brand = ".$brand." and `id` NOT IN (SELECT id_products FROM product_on_inventory)")->result_array();

    if(count($query) > 0)
    {
      $tag_select = '';
      $tag_select .= '<option value="">Selectionner un modèle</option>';
      foreach($query as $query)
      {
          $selected = ''; 
          $tag_select .= '<option value="'.$query['id'].'" '.$selected.' >'.$query['name'].'</option>';
      }
    }else
    {
      $tag_select = '';
      $tag_select .= "<option value=''>Pas de modèle trouvé</option>";
    }
     echo json_encode($tag_select);
  }

  public function selectModelByBrandInInvente()
  {
    $brand = $this->input->post('brand');
    //$query = $this->db->get_where('products', array('brand' => $brand))->result_array();
    $query = $this->db->query("SELECT * FROM `products` WHERE brand = ".$brand." and `id` IN (SELECT id_products FROM product_on_inventory where id_counter =".$this->session->userdata('user_id')." and etat = 0)")->result_array();

    if(count($query) > 0)
    {
      $tag_select = '';
      $tag_select .= '<option value="">Selectionner un modèle</option>';
      foreach($query as $query)
      {
          $selected = ''; 
          $tag_select .= '<option value="'.$query['id'].'" '.$selected.' >'.$query['name'].'</option>';
      }
    }else
    {
      $tag_select = '';
      $tag_select .= "<option value=''>Pas de modèle trouvé</option>";
    }
     echo json_encode($tag_select);
  }


  public function approvisionnement()
  {
    if(!$this->ion_auth->logged_in())
    {
      redirect(site_url('main/login'), 'refresh');
    }elseif($this->ion_auth->logged_in() && $this->session->userdata('nblogin') == 0)
    {
        redirect(site_url('main/change_password'), 'refresh');
    }
    $page_data['page_title'] = 'Products';
    $page_data['page_title_sous'] = 'Approvisionnement';
    $page_data['nbproduct'] = 0;
    if(!is_bool($this->Crud_model->selectAllProduit())) {
      $page_data['nbproduct'] = count($this->Crud_model->selectAllProduit());
    }
    $page_data['brands'] = $this->Crud_model->selectAllBrand();

    if($this->input->post())
    {
        if(empty($_POST['idbrand']) || empty($_POST['qnt']) || empty($_POST['idProduit']))
        {
          $this->session->set_flashdata('error', 'Merci de renseigner tous les champs');
        }else
        {
          $id = (int) $_POST['idProduit'];
          $prod = $this->Crud_model->selectProduitByID($id);
          $old_quantity = $prod->quantity;
          $new_quantity = $old_quantity + (int) $_POST['qnt'];
          $this->Crud_model->update_where('products', ['quantity' => $new_quantity , 'date_add' => time()], $prod->id, 'id');

           $this->Crud_model->update_where('products', ['qnt_appro' => (int) $_POST['qnt']], $prod->id, 'id');
          
          $this->session->set_flashdata('message', 'Approvisionnement effectué avec succès');
          redirect(site_url('products/list'), 'refresh');
        }
         
    }

    $this->load->view('template/header_principal', $page_data);
    $this->load->view('approvionnement', $page_data);
    $this->load->view('template/footer_principal', $page_data);
  }



  public function generate()
  {
        $champ = $this->Crud_model->selectChampProduct();
        $csv_output="";
        $i=0;
        foreach($champ as $champ => $val)
        {
            if($champ != 'id')
            {
              if($i == 0 && $val == 1)
              {
                $csv_output .= strtoupper($champ);
              }elseif($i != 0 && $val == 1)
              {
                $csv_output .= ";".strtoupper($champ);
              }
              $i++;
            } 
        }
        $csv_output.="\n";

        // générer un CSV,
        $date = date('d_m_Y');
        ini_set('memory_limit','512M');
        header("content-type: application/octet-stream");
        header('Content-Type: text/csv; charset=utf-8');
        header("Content-Disposition: attachment; filename=file_model_".$date.".csv");
        flush();
        echo $csv_output;
  }

  public function list($id_modif=0)
	{
  	  if(!$this->ion_auth->logged_in())
      {
        redirect(site_url('main/login'), 'refresh');
      }elseif($this->ion_auth->logged_in() && $this->session->userdata('nblogin') == 0)
      {
          redirect(site_url('main/change_password'), 'refresh');
      }
  	  $page_data['page_title'] = 'Products';
  	  $page_data['page_title_sous'] = 'list product';
  	  $page_data['nbproduct'] = 0;
  	  if(!is_bool($this->Crud_model->selectAllProduit())) {
  	  	$page_data['nbproduct'] = count($this->Crud_model->selectAllProduit());
        }
  	  $page_data['champs'] = $this->Crud_model->selectChampProduct();
  	  $page_data['listproduct'] = $this->Crud_model->selectAllProduit();
  	  $page_data['brand'] = $this->Crud_model->selectAllBrand();
      //var_dump($page_data['brand']);die;

      if($this->input->post() && $id_modif != 0)
      {
          if(empty($this->input->post()))
          {
            $this->session->set_flashdata('error', 'Les champs marqués d\'un * sont des champs de saisie obligatoires.');
          }elseif($this->testeur('name', $this->input->post()) == 'empty')
          {
            $this->session->set_flashdata('error', 'Le nom du produit ne peut pas être vide');
          }elseif($this->testeur('name', $this->input->post()) == 'is_numeric')
          {
            $this->session->set_flashdata('error', 'Le nom du produit ne peut pas être numérique.');
          }elseif($this->testeur('brand', $this->input->post()) == 'empty')
          {
             $this->session->set_flashdata('error', 'La marque du produit ne peut pas être vide');
          }elseif(array_key_exists('prix_vente', $this->input->post()) && empty($this->input->post('prix_vente')))
          {
            $this->session->set_flashdata('error', 'Le prix de vente du produit ne peut pas être vide');
          }else
          {
            $data = validation($this->input->post());
            if($this->Crud_model->update_where('products', $data, $id_modif, 'id'))
            {
              $this->session->set_flashdata('message', 'Produit modifié avec succès');
              redirect(site_url('products/list'), 'refresh');
            }else
            {
              $this->session->set_flashdata('error', 'Erreur de système');
            }
            //insertion_($tablename, $data)
          }
      }
  	  $this->load->view('template/header_principal', $page_data);
  	  $this->load->view('list_product', $page_data);
  	  $this->load->view('template/footer_principal', $page_data);
  }


  public function supp($id_product)
  {
      if(!$this->ion_auth->logged_in())
      {
        redirect(site_url('main/login'), 'refresh');
      }elseif($this->ion_auth->logged_in() && $this->session->userdata('nblogin') == 0)
      {
        redirect(site_url('main/change_password'), 'refresh');
      }
      $page_data['page_title'] = 'Products';
      $page_data['page_title_sous'] = 'list product';
      $page_data['nbproduct'] = 0;
      if(!is_bool($this->Crud_model->selectAllProduit())) {
          $page_data['nbproduct'] = count($this->Crud_model->selectAllProduit());
      }
      if($id_product!=0 && !empty($id_product))
      {
         $champs = $this->Crud_model->selectChampProduct();
         if($this->Crud_model->delete_row('products',array('id' => $id_product)))
         {
            if($champs['location'] == 1)
            {
              $this->Crud_model->delete_row('locations', array('product_id' => $id_product));
            }
            $this->session->set_flashdata('message', 'Produit supprimé avec succès');
         }else
         {
           $this->session->set_flashdata('error', 'System error');
         }
      }else
      {
        $this->session->set_flashdata('error', 'Cet produit n\'existe pas en base');
      }
      redirect(site_url('products/list'), 'refresh');       
  }

  public function data_product()
  {

    if(!$this->ion_auth->logged_in())
    {
      redirect(site_url('main/login'), 'refresh');
    }elseif($this->ion_auth->logged_in() && $this->session->userdata('nblogin') == 0)
    {
        redirect(site_url('main/change_password'), 'refresh');
    }
    $this->load->model('product_data_model', 'productData');

    $data = array();
        
    $prodData = $this->productData->getRows();

    //var_dump($prodData);die;

    $group_id = $this->session->userdata('group_id');
    $permissions = $this->Crud_model->getPermission($group_id);
    
    $i = isset($_POST['start'])?$_POST['start']:0;
    foreach($prodData as $productd){

        $champs = $this->Crud_model->selectChampProduct();
        
        $i++; 
        $codeIdentification = $productd['codeIdentification']; 
        $name =$productd['nameProd'];   
        $quantity = preg_replace("#,#"," ",number_format($productd['quantity']));   
        $brand = $productd['brand'];   
        $prix_vente = number_format($productd['prix_vente'], 0, ' ', ' ').' FCFA'; 

        if( $productd['quantity'] <= 5) 
        {
          $status = '<span class="label label-danger">Faible</span>';
        }elseif($productd['quantity'] > 5 && $productd['quantity'] <= 10)
        {
          $status = '<span class="label label-warning">Moyen</span>';
        }else
        {
          $status = '<span class="label label-success">Approvisionner</span>';
        }

        $actions = "<div class='btn-group'>
					  <button data-toggle='dropdown' class='btn btn-default btn-sm dropdown-toggle' type='button'>
						  Actions <span class='caret'></span></button>
					  <ul class='dropdown-menu'>";
            if($permissions['product-edit']==1)
            {
              $actions .= "<li><a data-backdrop='static' data-toggle='modal' data-target='#Eproduct' onclick='editproduct(".$productd['id_prodt'].")'>Modifier</a></li>
              <li class='divider'></li>";
            }
            if($permissions['product-delete']==1 && $this->Crud_model->selectProduitByVente($productd['id_prodt']) === 0)
            {
                //toutes les inventaires auquelles le produit participe ont été exporté au moins une fois
                $actions .= "<li><a data-backdrop='static' data-toggle='modal' data-target='#Dproduct' onclick='deleteproduct(".$productd['id_prodt'].")'>Supprimer</a></li>";
            }
					$actions .=  "</ul>
				</div>
        "; 
        $dat = array();
        $dat[] = $i;
          
          array_push($dat, $codeIdentification);
          array_push($dat, $brand);
          array_push($dat, $name);
          array_push($dat, $quantity);
          array_push($dat, $prix_vente);
          array_push($dat, $status);
          array_push($dat, $actions);
        $data[] = $dat;

       
        /*$data[] = array($i,$code,$ref,$name,$price,$category,$quantity,$brand,$supplier,$warehouse,$location,$actions);*/
                              
    }

    //var_dump($data);die;
    
    $output = array(
        "draw" => isset($_POST['draw'])?$_POST['draw']:10,
        "recordsTotal" => $this->productData->countAll(),
        "recordsFiltered" => $this->productData->countFiltered($_POST),
        "data" => $data
    );
    
    // Output to JSON format
    echo json_encode($output);
  } 

  public function modaldeleteproduct()
  {
    if(!$this->ion_auth->logged_in())
    {
      redirect(site_url('main/login'), 'refresh');
    }elseif($this->ion_auth->logged_in() && $this->session->userdata('nblogin') == 0)
    {
        redirect(site_url('main/change_password'), 'refresh');
    }
    $result = '<div class="modal-body">';
    $result = '<div class="row">
                  <div class="col-sm-12">
                      <h3>Voulez-vous vraiment supprimé ce produit ?</h3>
                  </div>
               </div><br>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-danger" data-dismiss="modal">Je ne suis pas sûr</button>
                      <a href="'.site_url('products/supp/'.$_POST['id_product']).'" type="button" class="btn btn-success">Oui, je suis sûr</a>
              </div>';
    $result.='</div>';
    echo json_encode($result);
  }

  public function modaleditproduct()
  {
    if(!$this->ion_auth->logged_in())
    {
      redirect(site_url('main/login'), 'refresh');
    }elseif($this->ion_auth->logged_in() && $this->session->userdata('nblogin') == 0)
    {
        redirect(site_url('main/change_password'), 'refresh');
    }
    $info_pro = $this->Crud_model->selectOneProduitById($_POST['id_product']);

    //var_dump($_POST['id_product']);die;
    $brand = $this->Crud_model->selectAllBrand();

    $result ='<form class="form-horizontal" action="'.site_url('products/list/'.$_POST['id_product']).'" method="POST">';
    $result.='<div class="modal-body">
                <div class="row">';
                   $result.= '<div class="col-sm-12">
                      <label for="brand">Marque *</label>
                      <select class="form-control select2" id="brand5" name="brand">
                          <option value="">Choisir une marque</option>';
                          foreach ($brand as $brand)
                          {
                            $result.= '<option '.echo_selected($info_pro['brand'], $brand['id']).' value="'.$brand['id'].'">'.ucfirst($brand['name']).'</option>';
                          }
                    $result.= '</select>
                  </div>';
                $result.= '</div><br>
                <div class="row">';
                   $result.= '<div class="col-sm-12">
                        <label for="name">Nom de l\'appareil *</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Nom de l\'appareil" value="'.$info_pro['name'].'" required>
                    </div>';

                $result.= '</div><br>
                <div class="row">';
                   /*$result.= ' <div class="col-sm-6">
                        <label for="quantity">Quantité *</label>
                        <input type="number" class="form-control" name="quantity" id="quantity" placeholder="Quantité" value="'.preg_replace("#,#"," ", number_format($info_pro['quantity'])).'" required>
                    </div>';*/
                    $result.= '<div class="col-sm-12">
                        <label for="price">Prix de vente U</label>
                        <input type="number" class="form-control" name="prix_vente" id="price" placeholder="Prix vente U" value="'.$info_pro['prix_vente'].'" required>
                    </div>';
                $result.= '</div> <br>';

        $result.= '</div> <br>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Mettre à jour ce produit</button>
        </div>
    </form>';
    $result.='</div>';
    echo json_encode($result);
  }

	public function import()
	{
    if(!$this->ion_auth->logged_in())
    {
      redirect(site_url('main/login'), 'refresh');
    }elseif($this->ion_auth->logged_in() && $this->session->userdata('nblogin') == 0)
    {
        redirect(site_url('main/change_password'), 'refresh');
    }
	  $page_data['page_title'] = 'Products';
	  $page_data['page_title_sous'] = 'import product';
	  $page_data['nbproduct'] = 0;
	  if(!is_bool($this->Crud_model->selectAllProduit())) {
	  	$page_data['nbproduct'] = count($this->Crud_model->selectAllProduit());
	  }
    if(isset($_FILES["import"]))
    {
       if($_FILES["import"]["size"] < 0 || $_FILES["import"]["error"] == 4)
       {
         $this->session->set_flashdata('error', 'Choose the csv file');
       }elseif($_FILES['import']["type"] !=  "application/vnd.ms-excel")
       {
         $this->session->set_flashdata('error', 'Only CSV type files are accepted');
       }else
       {
         $fileName = $_FILES["import"]["tmp_name"];
         $handle = fopen($fileName, "r");
         $filesop = fgetcsv($handle, 100000, ",");
         $tables = explode(';', $filesop[0]);

         $champConditioner = ['category', 'supplier', 'brand', 'location', 'warehouse'];
         //var_dump($tables);die;
         $champs = $this->Crud_model->selectChampProduct();

         if($this->same_fields($tables, $champs))
         {
           //$j = 0;
           while(($column = fgetcsv($handle, 100000, ";")) !== FALSE)
           {
              for($i=0; $i < count($tables) ; $i++)
              { 
                if(!in_array(strtolower($tables[$i]), $champConditioner))
                {
                  ///sans les champs de condition
                  $data[strtolower($tables[$i])] = $column[$i];
                }else
                {
                  //avec condition
                  $condition[strtolower($tables[$i])] = $column[$i];
                }
              }

                $data['date_add'] = time();
                $id_prods = $this->Crud_model->insertion_('products', $data);
                
                if(count($data) != count($tables))
                {
                  //gestion des cas
                  if(array_key_exists('category', $condition))
                  {
                    $row = $this->Crud_model->nameExist('categories', 'name', $condition['category']);
                    if(is_bool($row))
                    {
                      //var_dump($row);die;
                      //n'existe pas en base
                      //faire une insertion dans la table categories
                      $id_cat = $this->Crud_model->insertion_('categories', ['name' => strtoupper($condition['category'])]);
                      //on faire le update maintenant
                      $this->Crud_model->update_where('products', ['category_id' => $id_cat], $id_prods, 'id');
                    }else
                    {
                      //existe en base
                      //update sur la table produit
                      $this->Crud_model->update_where('products', ['category_id' => $row['id']], $id_prods, 'id');
                    }
                  }
                  if(array_key_exists('brand', $condition))
                  {
                    $row = $this->Crud_model->nameExist('brands', 'name', $condition['brand']);
                    if(is_bool($row))
                    {
                      //var_dump($row);die;
                      //n'existe pas en base
                      //faire une insertion dans la table categories
                      $id_brand = $this->Crud_model->insertion_('brands', ['name' => strtoupper($condition['brand'])]);
                      //on faire le update maintenant
                      $this->Crud_model->update_where('products', ['brand' => $id_brand], $id_prods, 'id');
                    }else
                    {
                      //existe en base
                      //update sur la table produit
                      $this->Crud_model->update_where('products', ['brand' => $row['id']], $id_prods, 'id');
                    }
                  }
                  if(array_key_exists('supplier', $condition))
                  {
                    $row = $this->Crud_model->nameExist('suppliers', 'name', $condition['supplier']);
                    if(is_bool($row))
                    {
                      //var_dump($row);die;
                      //n'existe pas en base
                      //faire une insertion dans la table categories
                      $id_supp = $this->Crud_model->insertion_('suppliers', ['name' => strtoupper($condition['supplier']), 'date_create' => time()]);
                      //on faire le update maintenant
                      $this->Crud_model->update_where('products', ['supplier' => $id_supp], $id_prods, 'id');
                    }else
                    {
                      //existe en base
                      //update sur la table produit
                      $this->Crud_model->update_where('products', ['supplier' => $row['id']], $id_prods, 'id');
                    }
                  }
                  if(array_key_exists('warehouse', $condition))
                  {
                    $row = $this->Crud_model->nameExist('warehouse', 'name', $condition['warehouse']);
                    if(is_bool($row))
                    {
                      //var_dump($row);die;
                      //n'existe pas en base
                      //faire une insertion dans la table categories
                      $id_ware = $this->Crud_model->insertion_('warehouse', ['name' => strtoupper($condition['warehouse']), 'create' => time()]);
                      //on faire le update maintenant
                      $this->Crud_model->update_where('products', ['warehouse' => $id_ware], $id_prods, 'id');
                    }else
                    {
                      //existe en base
                      //update sur la table produit
                      $this->Crud_model->update_where('products', ['warehouse' => $row['id']], $id_prods, 'id');
                      $id_ware = $row['id'];
                    }

                    $location = ['product_id'=>$id_prods, 'warehouse_id'=> $id_ware, 'location'=>strtoupper($condition['location']), 'date_create'=>time()];

                    $this->Crud_model->insertion_('locations', $location);
                  }
                }
             // $j++;
           }
          // if($j==count($column)){
             $this->session->set_flashdata('message', 'Import successfully completed');
          // }
         }else
         {
           $this->session->set_flashdata('error', 'Your cvs file does not meet the requested conditions');
         }
       }

      redirect(site_url('products/list'), 'refresh');
    }
	  $this->load->view('template/header_principal', $page_data);
	  $this->load->view('import_product', $page_data);
	  $this->load->view('template/footer_principal', $page_data);
	}


	private function testeur($post_name, $data)
	{
	   if(array_key_exists($post_name, $data))
	   {
	   	 if(empty($data[$post_name]))
	   	 {
	   	 	//$this->session->set_flashdata('error', 'Product name cannot be empty');
	   	 	return 'empty';
	   	 }elseif(is_numeric($data[$post_name]))
	   	 {
	   	   //$this->session->set_flashdata('error', 'Product name cannot be empty');
	   	 	return 'is_numeric';
	   	 }else
	   	 {
	   	 	return $data[$post_name];
	   	 }
	   }
	}


  function same_fields($tables, $champs)
  {
      $nb_champs = 0;
      foreach($champs as $champ => $bool)
      {
          if($champ != 'id' && $bool == 1)
          {
            $nb_champs++;
            if(!(in_array(strtoupper($champ), $tables)))
            {
              return false;
            }
          }
      }
      if(count($tables) != $nb_champs)
      {
        return false;
      }

      return true;
  }

}
