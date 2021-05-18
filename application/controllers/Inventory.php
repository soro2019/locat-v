<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inventory extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model("Crud_model");
	}

	public function modalviewinventory()
	{
	    if(!$this->ion_auth->logged_in())
	    {
	      redirect(site_url('main/login'), 'refresh');
	    }elseif($this->ion_auth->logged_in() && $this->session->userdata('nblogin') == 0)
	    {
	        redirect(site_url('main/change_password'), 'refresh');
	    }
	    $setting = $this->Crud_model->selectSettings();
	    $inventory = $this->Crud_model->selectALLInventories($_POST['id_inventory']);
	    $result = '<div class="modal-body">
	    		    <div class="row">
                      <div class="col-sm-6">
                        Créer le : '.date($setting['format_date'], $inventory['date_create']).'</div>
                   <div class="col-sm-6">
	                   Date de fin :  ';
	              if($inventory['date_end']==0)
	              { 
	              	$result .= "Pas encore terminé"; 
	              }else
	              { 
	              	$result .= date($setting['format_date'], $inventory['date_end']); 
	              }
	    $result .='</div>
                   </div><br>
                   <div class="row">
                              <div class="col-sm-6">
                                  Statut : ';
                                      if($inventory['etat']==0){ $result .= '<span class="label label-danger">En cours</span>'; }
                                      elseif($inventory['etat']==1){ $result .= '<span class="label label-warning">Iventaire complète</span>'; }
                                      elseif($inventory['etat']==2){ $result .= '<span class="label label-primary">Validation en cours</span>'; }
                                      elseif($inventory['etat']==3){ $result .= '<span class="label label-success">Terminé</span>'; }

                            $result .='  </div>
                              <div class="col-sm-6">
                                  Attribution : ';   
                                      if($inventory['assigner']==0){ $result .= '<span class="label label-danger">Pas encore attribué</span>'; }
                                      else{ $result .= '<span class="label label-success">Déjà attribué</span>'; }
                             $result .='  </div>
                          </div><br>
                          ';

           /* <!--LISTE USER-->*/
               if($inventory['assigner']==1 || $inventory['assigner']==-1){ 

                  $infos = $this->Crud_model->selectSubInventoriesWithAssignedUser($inventory['id_inventory']);

                $result .='<hr>
                    <h4 class="modal-title">
	                  <b>Liste des blocks'; $inventory['etat'] == 0 ? $result .= ' en cours' : $result .=''; 
	            $result .='</b>
	                </h4><br>
                ';

                foreach($infos as $info){
                    if($info['starting_date'] !=0 && $info['first_name'] != NULL ){
                    
                   $result .='<li>'.ucfirst($info['title']).' : '.ucfirst($info['first_name']).' '.ucfirst($info['last_name']).' '.'['.ucfirst($info['username']).'] </li>'; 
                } }

               $result .='<hr><h4 class="modal-title">
                            <b>Liste des blocks attribués mais pas encore inventorié</b>
                          </h4><br>';
                    foreach($infos as $info){
                            if($info['starting_date'] ==0 && $info['first_name'] != NULL ){
                           
                            $result .='<li>'.ucfirst($info['title']).' : '.ucfirst($info['first_name']).' '.ucfirst($info['last_name']).' [ '.ucfirst($info['username']).'] </li>';
                          }
                      }

                    $result .='<hr><h4 class="modal-title">
                            <b>Liste des blocks non attribués</b>
                          </h4><br>';

					foreach($infos as $info){
                            if($info['first_name'] == NULL ){
                            
                            $result .='<li>'.ucfirst($info['title']).'</li>'; 
                           } 
                    }
                }else{
                   $sub = $this->Crud_model->selectSubInventoryByInventory($inventory['id_inventory']);
                    $result .='<hr>
                              <h4 class="modal-title">
                                <b>Liste des blocks</b>
                              </h4><br>';
                            foreach($sub as $sub){
                               $result .=' <li>'.ucfirst($sub['title']).'</li>';
                            }
                    }

                 $result .='   </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
                        </div>';
	    $result.='</div>';
	    echo json_encode($result);
	}

	public function modaldatail()
	{
		if(!$this->ion_auth->logged_in())
	    {
	      redirect(site_url('main/login'), 'refresh');
	    }elseif($this->ion_auth->logged_in() && $this->session->userdata('nblogin') == 0)
	    {
	        redirect(site_url('main/change_password'), 'refresh');
	    }
	    $setting = $this->Crud_model->selectSettings();

	    $table_action = "product_on_inventory";
        $invenNotArchive = $this->db->get_where($table_action, ['id_products' => $_POST['id_products']])->num_rows();
        if($invenNotArchive == 0)
        {
          $table_action = "product_on_inventory_history";
        }

	    $query = $this->db->get_where($table_action, ['id_products' => $_POST['id_products']])->row_array();
	    $produit = $this->db->get_where('products', ['id' => $query['id_products']])->row_array();
	    $name = $produit['name'];
	    $brand = $this->db->get_where('brands', array('id' => $produit['brand']))->row_array();
	    $title = $this->db->get_where('sub_inventory', ['id' => $query['id_sub']])->row_array()['title'];

	    $counter = $this->db->get_where('users', ['id' => $query['id_counter']])->row_array();

	    $counter_name = ucfirst($counter['first_name']).' '.ucfirst($counter['last_name']).'['.ucfirst($counter['username']).']';

	    $validator = $this->db->get_where('users', ['id' => $query['id_validator']])->row_array();

	    $validator_name = ucfirst($validator['first_name']).' '.ucfirst($validator['last_name']).'['.ucfirst($validator['username']).']';
	      $rapport = $query['qntvalider'] - $query['qntsoumise'];
	  	  if($rapport < 0)
	  	  {
	  	  	$rap = '<span class="label label-danger">'.(-$rapport).'</span>';
	  	  }elseif($rapport==0)
	  	  {
	  	  	$rap = '<span class="label label-success">Conforme</span>';
	  	  }else
	  	  {
	  	  	$rap = '<span class="label label-info">'.($rapport).'</span>';
	  	  }

	    $result = '<div class="modal-body">
	               <div class="row">
                       <div class="col-sm-6">
                        Block : <b>'.ucfirst($title).'</b></div>
                        <div class="col-sm-6">
                        Code Produit: <b>'.$query['code'].'</b></div>
                    </div><br>
	               <div class="row">
	                   <div class="col-sm-6">
                         Marque : <b>'.$brand['name'].'</b></div>
                       <div class="col-sm-6">
                        Modéle Produit : <b>'.$name.'</b></div>
                    </div><br>
                    <div class="row">
                       <div class="col-sm-4">
                        Quantité Virtuelle: <b>'.$query['qntsoumise'].'</b></div>
                        <div class="col-sm-5">
                        Quantité Physique validée : <b>'.$query['qntvalider'].'</b></div>
                        <div class="col-sm-3">
                         Rapport : <b>'.$rap.'</b></div>
                    </div><br>
                    <div class="row">
                      <div class="col-sm-6">
                        Agent Compteur : <b>'.$counter_name.'</b></div>
                        <div class="col-sm-6">
                        Agent Validateur : <b>'.$validator_name.'</b></div>
                    </div><br>

                    <div class="row">
                        <div class="col-sm-6">
                        Date de Comptage : <b>'.date($setting['format_date'].' H:i:s',$query['datecompte']).'</b></div>
                        <div class="col-sm-6">
                        Date de Validation : <b>'.date($setting['format_date'].' H:i:s',$query['datevalidate']).'</b></div>
                    </div><br>
                     
                  </div>
                  <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                  </div>';
        echo json_encode($result);
	}

	public function modaldeleteinventory()
	{
		if(!$this->ion_auth->logged_in())
	    {
	      redirect(site_url('main/login'), 'refresh');
	    }elseif($this->ion_auth->logged_in() && $this->session->userdata('nblogin') == 0)
	    {
	        redirect(site_url('main/change_password'), 'refresh');
	    }

	    $result = '<div class="modal-body">
	    			<div class="row">
                       <div class="col-sm-12">
                         Cette action est irreversible, voulez-vous vraiment supprimer cet inventaire ?
                       </div>
                    </div><br>
                  </div>
                  <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">NO</button>
                        <a href="'.site_url('inventory/delete_invetory/'.$_POST['id_inventory']).'" type="button" class="btn btn-success">YES</a>
                      </div>';
        echo json_encode($result);
	}

	public function modaleditsubinventory()
	{
		if(!$this->ion_auth->logged_in())
	    {
	      redirect(site_url('main/login'), 'refresh');
	    }elseif($this->ion_auth->logged_in() && $this->session->userdata('nblogin') == 0)
	    {
	        redirect(site_url('main/change_password'), 'refresh');
	    }

	    $sub_inventory = $this->Crud_model->selectSubInventories($_POST['id_sub']);

	    $result = '<form class="form-horizontal" action="'.site_url('inventory/list_sub/'.$sub_inventory['id']).'" method="POST">
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <label for="Title">Title *</label>
                                           <input type="text" class="form-control" name="title" id="Title" placeholder="Titre" value="'.$sub_inventory['title'].'" required>
                                        </div>
                                    </div><br>
                                    <div class="row">
                                        <div class="col-sm-12">
                                          <label for="Title">Description </label>
                                           <textarea class="form-control" name="description" id="inputDescription" rows="10" placeholder="Description">'.$sub_inventory['description'].'</textarea>
                                        </div>
                                    </div><br>
                                </div>
                                <div class="modal-footer">
                                 <button type="submit" class="btn btn-success">Enregistrer</button>
                                </div>
                           </form>';
        echo json_encode($result);
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
	  $page_data['nbproduct'] = 0;
	  if (!is_bool($this->Crud_model->selectAllProduit())) {
		$page_data['nbproduct'] = count($this->Crud_model->selectAllProduit());
	  }
	  $page_data['page_title'] = 'Inventaires';
	  $page_data['page_title_sous'] = 'Ajouter un inventaire';
	  $page_data['suvinventory'] = $this->Crud_model->selectAllSubInventories();
	  if($this->input->post())
	  {
	  	if(empty($this->input->post('title')))
	  	{
          $this->session->set_flashdata('error', 'Merci de saisir le titre de l\'inventaire');
	  	}elseif(is_numeric($this->input->post('title')))
	  	{
	  	 $this->session->set_flashdata('error', 'Format du titre invalide');
	  	}elseif(empty($this->input->post('sub')))
	  	{
          $this->session->set_flashdata('error', 'Choisir obligatoirement un ou plusieurs blocks');
	  	}elseif($this->Crud_model->elementExist(array('nom_inventaire'=> test_inputValide($_POST['title'])), "inventory"))
	  	{
          $this->session->set_flashdata('error', 'Le titre saisi existe déjà en base');
	  	}else
	  	{
	  	  	$datas = array(
				'nom_inventaire' => test_inputValide($_POST['title']),
				'des_inventaire' => test_inputValide($_POST['description']),
				'date_create' =>time(),
			);
			if($id_ins = $this->Crud_model->insertion_("inventory",$datas))
			{
				$subData = [];
				if($_POST['sub'][0] === 'all')
				{
					foreach ($page_data['suvinventory'] as $value)
					{
					  array_push($subData, $value['id']);
					}
				}else
				{
					$subData = $_POST['sub'];
				}

				foreach($subData as $id_sub)
				{
					$datas = array(
						'id_inventory' => $id_ins,
						'id_sub_inventory' => $id_sub,
					);
					$id = $this->Crud_model->insertion_("relationsubinv_inv", $datas);

					$this->db->where(array('id'=>$id_sub, 'status' => 0));
					$this->db->update('sub_inventory', array('status' => 1));
				}
				if($id)
				{
				 $this->session->set_flashdata('message', 'Inventaire ajouté avec succès');
				 redirect(site_url('inventory/list'), 'refresh');
				}else
				{
				 $this->session->set_flashdata('error', 'System error');
				}
			}
	  	}
	  }
	  $this->load->view('template/header_principal', $page_data);
	  $this->load->view('add_inventory', $page_data);
	  $this->load->view('template/footer_principal', $page_data);
	}


	public function list()
	{
		if(!$this->ion_auth->logged_in())
		{
		  redirect(site_url('main/login'), 'refresh');
		}elseif($this->ion_auth->logged_in() && $this->session->userdata('nblogin') == 0)
		{
		  redirect(site_url('main/change_password'), 'refresh');
		}
		$page_data['nbproduct'] = 0;
		if (!is_bool($this->Crud_model->selectAllProduit())) {
		  $page_data['nbproduct'] = count($this->Crud_model->selectAllProduit());
		}
		$page_data['page_title'] = 'Inventaires';
		$page_data['page_title_sous'] = 'Liste des inventaires';
		$page_data['inventories'] = $this->Crud_model->selectALLInventoriesNotArchive();
		$this->load->view('template/header_principal', $page_data);
		$this->load->view('list_inventory', $page_data);
		$this->load->view('template/footer_principal', $page_data);
	}


	public function archiver($id)
	{
	    if(!$this->ion_auth->logged_in())
		{
		  redirect(site_url('main/login'), 'refresh');
		}elseif($this->ion_auth->logged_in() && $this->session->userdata('nblogin') == 0)
		{
		  redirect(site_url('main/change_password'), 'refresh');
		}
		$page_data['nbproduct'] = 0;
		if (!is_bool($this->Crud_model->selectAllProduit())) {
		  $page_data['nbproduct'] = count($this->Crud_model->selectAllProduit());
		}
		$page_data['page_title'] = 'Inventaires';
		$page_data['page_title_sous'] = 'Archives';

		if($id != null and !empty($id))
		{
		   $this->Crud_model->deplacementElement();
		   $this->Crud_model->viderTable('product_on_inventory');
		   $this->db->where('id_inventory', $id);
		   $this->db->update('inventory', ['etat' => 4]);
		   $this->session->set_flashdata('message', 'Inventaire archivé avec succès, merci de consulter la liste des inventaires archivés');
		}else
		{
		  $this->session->set_flashdata('error', 'Parametre invalide');
		}

		redirect(site_url('inventory/list'), 'refresh');
	}


	public function list_archive()
	{
		if(!$this->ion_auth->logged_in())
		{
		  redirect(site_url('main/login'), 'refresh');
		}elseif($this->ion_auth->logged_in() && $this->session->userdata('nblogin') == 0)
		{
		  redirect(site_url('main/change_password'), 'refresh');
		}
		$page_data['nbproduct'] = 0;
		if (!is_bool($this->Crud_model->selectAllProduit())) {
		  $page_data['nbproduct'] = count($this->Crud_model->selectAllProduit());
		}
		$page_data['page_title'] = 'Inventaires';
		$page_data['page_title_sous'] = 'Liste des inventaires Archivés';
		$page_data['inventories'] = $this->Crud_model->selectALLInventoriesArchive();
		$this->load->view('template/header_principal', $page_data);
		$this->load->view('list_inventory_archive', $page_data);
		$this->load->view('template/footer_principal', $page_data);
	}



	public function add_sub()
	{   
		  if(!$this->ion_auth->logged_in())
		  {
		    redirect(site_url('main/login'), 'refresh');
		  }elseif($this->ion_auth->logged_in() && $this->session->userdata('nblogin') == 0)
		  {
		  	redirect(site_url('main/change_password'), 'refresh');
		  }
		 $page_data['nbproduct'] = 0;
		 if (!is_bool($this->Crud_model->selectAllProduit())) {
			$page_data['nbproduct'] = count($this->Crud_model->selectAllProduit());
		 }

		if($this->input->post())
		{
			if(empty($_POST['title']))
			{
				$this->session->set_flashdata('error', 'Les champs avec * sont obligatoire');
			}
			elseif(is_numeric($_POST['title'])){
				$this->session->set_flashdata('error', 'Titre invalide');		
			}
			else
			{
				$title = test_inputValide($this->input->post('title'));
				$description = test_inputValide($this->input->post('description'));
				$datas = array(
					'title' => $title,
					'description' => $description,
					'date_create' =>time(),
				);
				if($this->Crud_model->insertion_("sub_inventory",$datas))
				{
					$this->session->set_flashdata('message', 'Block ajouté avec succès');
					
				}else
				{
					$this->session->set_flashdata('error', 'System erros');
				}
				redirect(site_url('inventory/list_sub'), 'refresh');
			}
		}
	    $page_data['page_title'] = 'Inventaires';
	    $page_data['page_title_sous'] = 'Ajouter un block';

	    $this->load->view('template/header_principal', $page_data);
	    $this->load->view('add_sub_inventory', $page_data);
	    $this->load->view('template/footer_principal', $page_data);
	}

	public function assignment($id="")
	{
	   if(!$this->ion_auth->logged_in())
	   {
	    redirect(site_url('main/login'), 'refresh');
	   }elseif($this->ion_auth->logged_in() && $this->session->userdata('nblogin') == 0)
	   {
	  	redirect(site_url('main/change_password'), 'refresh');
	   }
	   $page_data['nbproduct'] = 0;
	    if (!is_bool($this->Crud_model->selectAllProduit())){
		$page_data['nbproduct'] = count($this->Crud_model->selectAllProduit());
	   }
	   $id = (int) $id;
	   if($id == 0 || $id == NULL)
	   {
	   	 //$this->session->set_flashdata('error', 'This element does not exist in base');
	   	 redirect(site_url('inventory/list'), 'refresh');
	   }
	   $page_data['page_title'] = 'Inventaires';
	   $page_data['page_title_sous'] = 'Liste des inventaires';
       $group_id = 2;
	   $page_data['users'] = $this->Crud_model->selectUsersByGroup($group_id);
	   
	   $page_data['info_inv'] = $this->Crud_model->selectALLInventories($id);
	   //var_dump($id);die;
	   $page_data['suvinventory'] = $this->Crud_model->selectSubIventories($id);


	   if($this->input->post())
	   {
		   	if(empty($_POST['sub']))
			{
			  $this->session->set_flashdata('error', 'Choisir au moins un block');
			}elseif(empty($_POST['user']))
			{
			  $this->session->set_flashdata('error', 'Choisir un utilisateur');
			}else
			{
				foreach($_POST['sub'] as $id_sub)
				{
					$data = array(
						'id_inv' => $id,
						'id_sub' => $id_sub,
						'user_id' => $_POST['user'],
						'date_create' => time(),
					);
				  $id1 = $this->Crud_model->insertion_("attribution_sub_inventory", $data);
				}
				if($id1)
				{
					 $total_assigne = count($this->Crud_model->selectSubIventoriesAttribute($id));
					 if(count($page_data['suvinventory'])==$total_assigne)
					 {
					 	//tous les sub ont été assigné
					 	$this->Crud_model->update_where('inventory', array('assigner'=>1), $id, 'id_inventory');
					 }else
					 {
					 	//au moins un sub à été assigné
					 	$this->Crud_model->update_where('inventory', array('assigner'=>-1), $id, 'id_inventory');
					 }
				 $this->session->set_flashdata('message', 'Attribution ok');
				 redirect(site_url('inventory/list'), 'refresh');
				}else
				{
				 $this->session->set_flashdata('error', 'System error');
				}
			}
	   }

	   $this->load->view('template/header_principal', $page_data);
	   $this->load->view('assignment', $page_data);
	   $this->load->view('template/footer_principal', $page_data);
	}

	public function delete_invetory($id)
	{

		if(!$this->ion_auth->logged_in())
		{
		    redirect(site_url('main/login'), 'refresh');
		}elseif($this->ion_auth->logged_in() && $this->session->userdata('nblogin') == 0)
		{
		  	redirect(site_url('main/change_password'), 'refresh');
		}
		$page_data['nbproduct'] = 0;
		if (!is_bool($this->Crud_model->selectAllProduit())){
			$page_data['nbproduct'] = count($this->Crud_model->selectAllProduit());
		}
		$id = (int) $id;
		if(empty($id) || $id == 0)
		{
		    $this->session->set_flashdata('error', 'ID invalid');
		    redirect(site_url('inventory/list'), 'refresh');
		}
		$invent = $this->Crud_model->selectALLInventories($id);
		if($invent['assigner'] != 0)
		{
		  $this->session->set_flashdata('error', 'You cannot delete this inventory because it has already been assigned');
		  redirect(site_url('inventory/list'), 'refresh');
		}
		$this->db->where('id_inventory', $id);
	    $this->db->delete('inventory');
	    $this->session->set_flashdata('message', 'Inventory deleted successfully');
	    redirect(site_url('inventory/list'), 'refresh');
	}

	public function list_sub($id_modif="")
	{
		if(!$this->ion_auth->logged_in())
		{
		  redirect(site_url('main/login'), 'refresh');
		}elseif($this->ion_auth->logged_in() && $this->session->userdata('nblogin') == 0)
		{
			redirect(site_url('main/change_password'), 'refresh');
		}
		$page_data['nbproduct'] = 0;
		if (!is_bool($this->Crud_model->selectAllProduit())) {
		  $page_data['nbproduct'] = count($this->Crud_model->selectAllProduit());
		}
		if($this->input->post())
		{
			if(empty($_POST['title']))
			{
				$this->session->set_flashdata('error', 'Tous les champs en * sont obligatoire');
			}
			elseif(is_numeric($_POST['title'])){
				$this->session->set_flashdata('error', 'Titre invalide');		
			}
			else
			{
				$title = test_inputValide($this->input->post('title'));
				$description = test_inputValide($this->input->post('description'));
				if($this->Crud_model->update_sub_inventory($id_modif, $title, $description))
				{
				  $this->session->set_flashdata('message', 'Modification effectué avec succès');	
				}else
				{
				  $this->session->set_flashdata('error', 'Système erreur');	
				}
				redirect(site_url('inventory/list_sub'), 'refresh');
			}
		}
		
		$page_data['subinventories'] = $this->Crud_model->selectAllSubInventories();
		$page_data['page_title'] = 'Inventaires';
		$page_data['page_title_sous'] = 'Liste des blocks';
		$this->load->view('template/header_principal', $page_data);
		$this->load->view('list_sub_inventory', $page_data);
		$this->load->view('template/footer_principal', $page_data);		
	}

	public function delete_sub_inventory($id)
	{
		if(!$this->ion_auth->logged_in())
		{
		  redirect(site_url('main/login'), 'refresh');
		}elseif($this->ion_auth->logged_in() && $this->session->userdata('nblogin') == 0)
		{
			redirect(site_url('main/change_password'), 'refresh');
		}
		$page_data['nbproduct'] = 0;
		if (!is_bool($this->Crud_model->selectAllProduit())) {
		  $page_data['nbproduct'] = count($this->Crud_model->selectAllProduit());
		}
		$id = (int) $id;
		if(empty($id) || $id == 0)
		{
		    $this->session->set_flashdata('error', 'ID invalid');
		    redirect(site_url('inventory/list_sub'), 'refresh');
		}

		$sub = $this->Crud_model->selectSubInventories($id);

		if($sub['status'] == 1)
		{
			$this->session->set_flashdata('error', "This sub inventory is already assigned so you can't delete it.");
		}else
		{
		    if($this->Crud_model->delete_row('sub_inventory', array('id' =>$id)))
			{
			  $this->session->set_flashdata('message', 'Sub-inventory deleted successfully');
			}else
			{
			  $this->session->set_flashdata('error', 'System error');
			}
		}
		
		redirect(site_url('inventory/list_sub'), 'refresh');
	}


	public function modification_inventory_assignation($id="")
	{
		if(!$this->ion_auth->logged_in())
		{
		  redirect(site_url('main/login'), 'refresh');
		}elseif($this->ion_auth->logged_in() && $this->session->userdata('nblogin') == 0)
		{
			redirect(site_url('main/change_password'), 'refresh');
		}
		$page_data['nbproduct'] = 0;
		if (!is_bool($this->Crud_model->selectAllProduit())) {
		  $page_data['nbproduct'] = count($this->Crud_model->selectAllProduit());
		}
		if((int)$id == NULL || (int)$id == 0)
		{
		    $this->session->set_flashdata('error', 'ID invalid');
		    //die;
		    redirect(site_url('inventory/list'), 'refresh');
		}
		if($this->input->post())
		{
			if(empty($_POST['user']))
			{
				$this->session->set_flashdata('error', 'Choisir un utilisateur');
				redirect(site_url('inventory/modification_inventory_assignation/'.$id), 'refresh');
			}
			else
			{
				//var_dump($this->Crud_model->selectSubInventories2($id, $_POST['user']),$_POST["sub"]);die;
				foreach($this->Crud_model->selectSubInventories2($id, $_POST['user']) as $subinv)
				{
					if( ! in_array($subinv['id'], $_POST["sub"] ))
					{
						$this->Crud_model->deleteATSI($subinv['id'], $_POST['user'],$id);
					}
				}
				//var_dump($_POST["sub"]);die;
				foreach($_POST["sub"] as $sub)
				{
					if($this->Crud_model->existATSI($id, $sub))
					{
						$this->Crud_model->updateATSI($sub, $_POST['user'],$id);
					}else{
						$data = array(
							'id_inv' => $id,
							'id_sub' => $sub,
							'user_id' => $_POST['user'],
							'date_create' => time(),
						);
						$this->Crud_model->insertion_('attribution_sub_inventory',$data);
					}
				}
				$this->session->set_flashdata('message', 'Attribution modifiée');
				redirect(site_url('inventory/list'), 'refresh');
			}
		}

		$page_data['page_title'] = 'Inventaires';
	    $page_data['page_title_sous'] = 'Liste des inventaires';
		$page_data['info_inv'] = $this->Crud_model->selectALLInventories($id);
		$group_id = 2;
	    $page_data['users'] = $this->Crud_model->selectUsersByGroup($group_id);
		$page_data['subinventory'] = $this->Crud_model->selectSubInventories2($id);
		$page_data['userssubinventory'] = $this->Crud_model->selectSubInventoriesWithAssignedUser($id);
		//var_dump($page_data['userssubinventory']);die;
		//$page_data['userssubinventory'] = $this->Crud_model->selectSubIventoriesUser($id);
        
	   $this->load->view('template/header_principal', $page_data);
	   $this->load->view('assignment_modif', $page_data);
	   $this->load->view('template/footer_principal', $page_data);
	}


	public function assign_validator($id_inv)
	{
		if(!$this->ion_auth->logged_in())
		{
		  redirect(site_url('main/login'), 'refresh');
		}elseif($this->ion_auth->logged_in() && $this->session->userdata('nblogin') == 0)
		{
			redirect(site_url('main/change_password'), 'refresh');
		}
		$page_data['nbproduct'] = 0;
		if (!is_bool($this->Crud_model->selectAllProduit())) {
		  $page_data['nbproduct'] = count($this->Crud_model->selectAllProduit());
		}
		if($this->input->post())
		{
			if(empty($_POST['user']))
			{
				$this->session->set_flashdata('error', 'Choisir un validateur');
			}
			else
			{
				$subValid = $this->Crud_model->selectSubInventoryForValidatorByInv($id_inv, $_POST['user']);
				//var_dump($subValid);die;
				foreach($subValid as $subinv)
				{
					if(!in_array($subinv['id'], $_POST["sub"]))
					{
						$this->Crud_model->updateGen(array('id_inv' => $id_inv, 'id_sub' => $subinv['id']), array('user_id_validator' => NULL), 'attribution_sub_inventory');
					}
				}
				
				//var_dump($_POST["sub"]);die;

				foreach($_POST["sub"] as $sub)
				{
					$id = $this->Crud_model->updateGen(array('id_inv' => $id_inv, 'id_sub' => $sub), array('user_id_validator' => $_POST['user']),'attribution_sub_inventory');
					//var_dump($sub, $_POST['user'], $id_inv);
				}//die;
				$this->session->set_flashdata('message', 'Affectation terminée');
			}
		   redirect(site_url('inventory/list/'.$id_inv), 'refresh');
		}
		
		$page_data['page_title'] = 'Inventaires';
		$page_data['page_title_sous'] = 'Assign Validators';
		$page_data['info_inv'] = $this->Crud_model->selectALLInventories($id_inv);

		$page_data['info_assign'] = $this->Crud_model->selectSubInventoryWithAssignValidatorByInv($id_inv);
		$group_id = 3;
	    $page_data['users'] = $this->Crud_model->selectUsersByGroup($group_id);

		$page_data['subinventory'] = $this->Crud_model->selectSubInventoryByInventory225($id_inv);

	   //var_dump($page_data['subinventory']);die;
		//$page_data['userssubinventory'] = $this->Crud_model->selectSubIventoriesUser($id);
        
	   $this->load->view('template/header_principal', $page_data);
	   $this->load->view('assign_validator', $page_data);
	   $this->load->view('template/footer_principal', $page_data);
	}

	public function exportations($id_inv)
	{
		$csv_output="";
		$csv_output.="CODE;MODELE PRODUIT;QUANTITE VIRTUELLE;QUANTITE PHYSIQUE 1;QUANTITE PHYSIQUE 2;BLOCK;COMPTEUR;VALIDATEUR;DATE DU COMPTAGE;DATE DE VALIDATION;RAPPORT;CONCLUSION\n";
		$table_action = "product_on_inventory";
		$invenNotArchive = $this->db->get_where($table_action, ['id_inv' => $id_inv])->num_rows();
		if($invenNotArchive == 0)
		{
		 $table_action = "product_on_inventory_history";
		}
		$query = $this->Crud_model->backupInventoryProducts($id_inv, $table_action);
		$setting = $this->Crud_model->selectSettings();
		//var_dump($query);die;
		foreach($query as $row){
			$counter = $this->db->get_where('users', ['id' => $row['id_counter']])->row_array();

	        $counter_name = ucfirst($counter['first_name']).' '.ucfirst($counter['last_name']).'['.ucfirst($counter['username']).']';

	        $validator = $this->db->get_where('users', ['id' => $row['id_validator']])->row_array();

	        $validator_name = ucfirst($validator['first_name']).' '.ucfirst($validator['last_name']).'['.ucfirst($validator['username']).']';

	        $result = $row['qntvalider'] - $row['qntsoumise'];
	        $con ="Conforme";
	        if($result < 0)
	        {
	          $con ="Perte";
	        }elseif($result > 0)
	        {
	          $con ="Plus";
	        }

	        $datevalidate = date($setting['format_date'].' H:i:s',$row['datevalidate']);
	        $datecompte = date($setting['format_date'].' H:i:s',$row['datecompte']);

            $csv_output.= "$row[code];$row[name];$row[qntsoumise];$row[qntcompter];$row[qntvalider];$row[title];$counter_name;$validator_name;$datecompte;$datevalidate;$result;$con\n";
        }
		// générer un CSV,
		$date = date('d_m_Y');
		$query[0]['nom_inventaire'] = str_replace(" ", "_", $query[0]['nom_inventaire']);
		$file_name = $query[0]['nom_inventaire']."_".$date;
		ini_set('memory_limit','1024M');
		header("content-type: application/octet-stream");
		header('Content-Type: text/csv; charset=utf-8');
		header("Content-Disposition: attachment; filename=".$file_name.".csv");
		flush();
		echo $csv_output;
	}


	public function export_pdf($id_inv)
	{
	  $table_action = "product_on_inventory";
	  $invenNotArchive = $this->db->get_where($table_action, ['id_inv' => $id_inv])->num_rows();
	  if($invenNotArchive == 0)
	  {
	    $table_action = "product_on_inventory_history";
	  }
	  $page_data['rapports'] = $this->Crud_model->backupInventoryProducts($id_inv, $table_action);

	  //var_dump($page_data['rapports']);die;
	  $this->load->view('export_pdf_view', $page_data);
	}


	public function rapports($id_inv)
	{
		if(!$this->ion_auth->logged_in())
		{
		  redirect(site_url('main/login'), 'refresh');
		}elseif($this->ion_auth->logged_in() && $this->session->userdata('nblogin') == 0)
		{
			redirect(site_url('main/change_password'), 'refresh');
		}
		$page_data['nbproduct'] = 0;
		if (!is_bool($this->Crud_model->selectAllProduit())) {
		  $page_data['nbproduct'] = count($this->Crud_model->selectAllProduit());
		}
		$page_data['page_title'] = 'Inventaires';
	    $page_data['page_title_sous'] = 'inventory report';
	    $page_data['rapports'] = $this->Crud_model->get_rapport($id_inv);

	    //var_dump($page_data['rapports']);die;
	    $this->load->view('template/header_principal', $page_data);
	    $this->load->view('rapports_view', $page_data);
	    $this->load->view('template/footer_principal', $page_data);
	}



	public function generat_quantity_file225()
	{
        $champ = $this->Crud_model->selectChampProduct();
        $csv_output="";
        $i=0;
        foreach($champ as $champ => $val)
        {
            if($champ == 'code' || $champ == 'ref')
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
        
        $csv_output.=";QUANTITY\n";
        // générer un CSV,
        $date = date('d_m_Y');
        ini_set('memory_limit','512M');
        header("content-type: application/octet-stream");
        header('Content-Type: text/csv; charset=utf-8');
        header("Content-Disposition: attachment; filename=file_model_qnt_".$date.".csv");
        flush();
        echo $csv_output;
	}


	public function generat_quantity_file()
	{ 
	   
	    $rows = $this->Crud_model->selectAllProduit();
	    $champ = $this->Crud_model->selectChampProduct();
        $csv_output = "";
        $i=0;
        foreach($champ as $champ => $val)
        {
          if($champ != 'id' && $champ != 'price' && $champ != 'ref')
          {
          	if($i == 0 && $val == 1)
            {
             $csv_output .= strtoupper($champ);
            }elseif($i != 0 && $val == 1)
            {
             $csv_output .= strtoupper($champ).";";
            }
          }
          $i++; 
        }
        $csv_output.="QUANTITY TO SUBMIT\n";

        foreach ($rows as $row)
        {
	      $csv_output.= "$row[code];$row[name]\n";
        }

        $date = date('d_m_Y');
        ini_set('memory_limit','512M');
        header("content-type: application/octet-stream");
        header('Content-Type: text/csv; charset=utf-8');
        header("Content-Disposition: attachment; filename=file_model_upload_qnt_".$date.".csv");
	    flush();
		echo $csv_output;
    }

	public function qntimport($id_inv)
	{
	  if(!$this->ion_auth->logged_in())
	  {
	    redirect(site_url('main/login'), 'refresh');
	  }elseif($this->ion_auth->logged_in() && $this->session->userdata('nblogin') == 0)
	  {
	    redirect(site_url('main/change_password'), 'refresh');
	  }
	  $page_data['page_title'] = 'Inventory';
	  $page_data['page_title_sous'] = 'import quantities';
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
	       	 //var_dump($fileName);die;
	         $handle = fopen($fileName, "r");
	         $filesop = fgetcsv($handle, 100000, ",");
	         $tables = explode(';', $filesop[0]);
	         //var_dump($handle, $filesop);die;
	         if((in_array(strtoupper('code'), $tables)) && in_array('QUANTITY TO SUBMIT', $tables))
	         {
	         	//var_dump($tables);die;

	         	while(($column = fgetcsv($handle, 100000, ";")) !== FALSE)
                {
                  //on verifie si le code dans le file existe deja en base
                  $prod_code = $this->Crud_model->codeExiste($column[0], $id_inv);
                  if(is_bool($prod_code))
                  {
                  	///le prod n'est pas en base
                  	//on fait le insert
                    $this->Crud_model->insertion_('product_on_inventory', ['code' => $column[0], 'qntsoumise' => $column[2], 'id_inv' => $id_inv, 'date_add' => time()]);
                  }else
                  {
                  	$new_qnt = $prod_code['qntsoumise'] + $column[2];
                  	//la ref est deja en base
                  	$this->db->where(array("code" => $column[0], 'id_inv' => $id_inv));
                  	$this->db->update('product_on_inventory', ['qntsoumise' => $new_qnt]);
                  }
                }
                $this->Crud_model->update_where('inventory', array('import_quantity'=>1), $id_inv, 'id_inventory');
                $this->session->set_flashdata('message', 'Import successfully completed');
                redirect(site_url('inventory/list'), 'refresh');
	         }else
	         {
	          $this->session->set_flashdata('error', 'Your cvs file does not qualify. Thank you to download the template at your disposal');
	         }
	       }
      }
	  $this->load->view('template/header_principal', $page_data);
	  $this->load->view('import_quantity', $page_data);
	  $this->load->view('template/footer_principal', $page_data);
	}


}
