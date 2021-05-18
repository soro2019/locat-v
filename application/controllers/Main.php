<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Crud_model');
	}

	public function login()
	{
        if($this->ion_auth->logged_in() && $this->session->userdata('nblogin') != 0)
		{
		 redirect(site_url('main/dashboard'), 'refresh');
		}elseif($this->ion_auth->logged_in() && $this->session->userdata('nblogin') == 0)
		{
		  redirect(site_url('main/change_password'), 'refresh');
		}
		if($this->input->post())
        {
	        $this->load->library('form_validation');
	        $this->form_validation->set_rules('identity', '', 'trim|required');
	        $this->form_validation->set_rules('password', '', 'trim|required');
	        $this->form_validation->set_rules('souvenir','Se souvenir de moi','integer');
	        if($this->form_validation->run()===TRUE)
	        {
	          $souvenir = (bool) $this->input->post('souvenir');
	          /*var_dump($this->ion_auth->login($this->input->post('identity'), $this->input->post('password'), $souvenir));die;*/
	          if($this->ion_auth->login($this->input->post('identity'), $this->input->post('password'), $souvenir)===FALSE)
	          {
	            //$this->session->set_flashdata('message', $this->ion_auth->errors());
	            $this->session->set_flashdata('error', 'Incorrect login or password');
	           // redirect('administrator~ffcom2020/auth/connexion', 'refresh');
	          }elseif($this->ion_auth->login($this->input->post('identity'), $this->input->post('password'), $souvenir)===-1)
	          {
	          	 $this->session->set_flashdata('error', 'Unable to log in because your account has been disabled by the administrator.');

	          }elseif($this->ion_auth->login($this->input->post('identity'), $this->input->post('password'), $souvenir)==="time_out")
	          {
	         	$this->session->set_flashdata('error', 'You have exceeded the number of attempts allowed, be sure to wait 5 minutes before trying again.');
	          }else
	          {   
	          	 
	          	  $role = strtolower($this->session->userdata('company'));

	          	  //var_dump($role);die;
	          	  if($this->ion_auth->in_group($role))
	          	  {
	          	  	$group_id = $this->Crud_model->getGroupByName($role)['id'];
                    $this->session->set_userdata('group_id', $group_id);
	          	  }else
	          	  {
	          	  	$this->session->set_flashdata('error', 'You belong to an unknown user group');

	          	  	redirect(site_url('main/logout'), 'refresh');
	          	  }
	              /*if($this->ion_auth->in_group('manager'))
	              {
	              	$group_id = $this->Crud_model->getGroupByName('manager')['id'];

	              }elseif($this->ion_auth->in_group('counter'))
	              {
	              	$group_id = $this->Crud_model->getGroupByName('counter')['id'];

	              }elseif($this->ion_auth->in_group('validator'))
	              {
	              	$group_id = $this->Crud_model->getGroupByName('validator')['id'];

	              }else
	              {
	              	$group_id = 0;
	              }*/

	              //var_dump($this->session->userdata('nblogin'), $group_id);die;


	              $permissions = $this->Crud_model->getPermission($group_id);

	              //die;
                  $this->session->set_userdata('permission', $permissions);
                  //$nblogin = $this->Crud_model->selectAllOrOneUsers($this->session->userdata('user_id'))['nblogin'];
                  //$this->session->set_userdata('nblogin', $nblogin);
                  if($this->session->userdata('nblogin') == 0)
                  {
                  	redirect(site_url('main/change_password'), 'refresh');
                  }else
              	  {
              	  	redirect(site_url('main/dashboard'), 'refresh');
              	  }
	          }
	        }
        }
		//$this->session->set_userdata('setting', $this->Crud_model->selectSettings());
	    $page_data['page_title'] = 'Login';
     	$this->load->view('login', $page_data);
	}

	public function edit_my_profile()
	{
	  if(!$this->ion_auth->logged_in())
      {
        redirect(site_url('main/login'), 'refresh');
      }elseif($this->ion_auth->logged_in() && $this->session->userdata('nblogin') == 0)
      {
        redirect(site_url('main/change_password'), 'refresh');
      }
      $page_data['page_title'] = 'Profile';
	  $page_data['page_title_sous'] = 'Edit my profile';
	  $page_data['nbproduct'] = 0;
	  if(!is_bool($this->Crud_model->selectAllProduit())) {
	  	$page_data['nbproduct'] = count($this->Crud_model->selectAllProduit());
	  }
      $user = $page_data['user'] = $this->Crud_model->selectAllOrOneUsers($this->session->userdata('user_id'));
      $identity = $this->session->userdata('identity');
      if($this->input->post())
      {
      	if(empty($_POST['prenoms']) || empty($_POST['nom']) || empty($_POST['email']))
      	{
      	 $this->session->set_flashdata('error', 'The fields last name, first name and email are mandatory.');
      	}elseif(!empty($_POST['old_password']) && empty($_POST['new_password']))
      	{
      		$this->session->set_flashdata('error', 'Please fill in the New password field');
      	}elseif(empty($_POST['old_password']) && !empty($_POST['new_password']))
      	{
      		$this->session->set_flashdata('error', 'Please fill in the Old password field');
      	}elseif(empty($_POST['old_password']) && empty($_POST['new_password']))
      	{
      	  if($_POST['email']==$user['email'] && $_POST['nom']==$user['first_name'] && $_POST['prenoms']==$user['last_name'])
      	  {
      	  	$this->session->set_flashdata('error', 'No changes have been made');
      	  }else
      	  {
      	  	if($this->Crud_model->EmailExisteModif($_POST['email'], $this->session->userdata('user_id')))
      	  	{
      	  	  $this->session->set_flashdata('error', 'This email address already exists!');
      	  	}else
      	  	{
      	  	  $data["last_name"] = $_POST['prenoms'];
      		  $data["first_name"] = $_POST['nom'];
      		  $data["email"] = $_POST['email'];
      		  $this->db->where('id', $this->session->userdata('user_id'));
			  $this->db->update('users', $data);
			  $this->session->set_flashdata('message', 'Profile successfully modified');
			  //redirect(site_url('main/edit_my_profile'), 'refresh');
      	  	}
      	  }
      	}else
      	{
      	 if($_POST['email']==$user['email'] && $_POST['nom']==$user['first_name'] && $_POST['prenoms']==$user['last_name'])
      	  {
  	  	    $change = $this->ion_auth->change_password($identity, $this->input->post('old_password'), $this->input->post('new_password'));
	        if($change)
			{
			  $this->session->set_flashdata('message', 'password changed successfully');
			  $this->logout();
			}else
			{
			  $this->session->set_flashdata('error', 'Your current password is not recognized');
			}
      	  }else
      	  {
      	  	$change = $this->ion_auth->change_password($identity, $this->input->post('old_password'), $this->input->post('new_password'));
      	  	if($change)
			{
				if($this->Crud_model->EmailExisteModif($_POST['email'], $this->session->userdata('user_id')))
	      	  	{
	      	  	  $this->session->set_flashdata('error', 'This email address already exists!');
	      	  	}else
	      	  	{
	      	  		$data["last_name"] = $_POST['prenoms'];
      		        $data["first_name"] = $_POST['nom'];
      		        $data["email"] = $_POST['email'];
      		        $this->db->where('id', $this->session->userdata('user_id'));
					$this->db->update('users', $data);
					$this->session->set_flashdata('message', 'Profile successfully modified');
					$this->logout();
	      	  	}
			}else
			{
			  $this->session->set_flashdata('error', 'Your current password is not recognized');
			}
      	  }
      	}

      }

	  $this->load->view('template/header_principal', $page_data);
	  $this->load->view('edit_my_profile', $page_data);
	  $this->load->view('template/footer_principal', $page_data);
	}

	public function change_password()
	{
		if(!$this->ion_auth->logged_in())
		{
		  redirect(site_url('main/login'), 'refresh');

		}elseif($this->ion_auth->logged_in() && $this->session->userdata('nblogin') == 1)
		{
		  redirect(site_url('main/dashboard'), 'refresh');
		}
	    $user = $this->ion_auth->user()->row();
	    //var_dump($user);die;
	    $page_data['min_password_length'] = $this->config->item('min_password_length', 'ion_auth');
	    if($this->input->post())
	    {
	      if(strlen($_POST["new"]) < $page_data['min_password_length'])
          {
          	$this->session->set_flashdata('error', 'Mot de passe trop court, plus '.$page_data['min_password_length'].' caractèrs svp!');
          }/*elseif(!preg_match("#[0-9]+#",$_POST["new"]))
          {
          	$this->session->set_flashdata('error', 'Your Password Must Contain At Least 1 Number!');

          }elseif(!preg_match("#[A-Z]+#",$_POST["new"]))
          {
          	$this->session->set_flashdata('error', 'Your Password Must Contain At Least 1 Capital Letter!');
          }elseif(!preg_match("#[a-z]+#",$_POST["new"]))
          {
          	$this->session->set_flashdata('error', 'Your Password Must Contain At Least 1 Lowercase Letter!');

          }*/elseif($_POST['new'] != $_POST['confirm_new'])
	      {
	      	$this->session->set_flashdata('error', 'Vos mots de passes ne correspondent');
	      }else
	      {
	      	//var_dump($_POST);die;
	      	$identity = $this->session->userdata('identity');
	    	$change = $this->ion_auth->change_password($identity, $this->input->post('old'), $this->input->post('new'));

	    	if($change)
			{
				//if the password was successfully changed
				$this->session->set_flashdata('message', 'Mot de passe changé avec succès');
				$this->db->where('username', $identity);
				$this->db->update('users', array('nblogin' => 1));
				$this->logout();
			}
			else
			{
			  $this->session->set_flashdata('error', 'Mot de passe actuel saisi est incorrect');
			}

	      }
	    }
	    $page_data['page_title'] = 'Change password';
     	$this->load->view('change_password', $page_data);
	}

	public function dashboard()
	{
	  if(!$this->ion_auth->logged_in())
	  {
	    redirect(site_url('main/login'), 'refresh');
	  }elseif($this->ion_auth->logged_in() && $this->session->userdata('nblogin') == 0)
	  {
	  	redirect(site_url('main/change_password'), 'refresh');
	  }
	  $page_data['page_title'] = 'Dashboard';
	  $page_data['page_title_sous'] = 'Dashboard';
	  $page_data['VersementEnCours'] = 0;
	  $page_data['JourProchainPayement'] = 0;
	  $page_data['VersementDemain'] = 0;
	  $page_data['VersementEnRetard'] = 0;
	  $page_data['VersementDuJour'] = 0;
	  
	  
	  if(count($this->Crud_model->tomorrowPayement()) > 0) {
	  	$page_data['VersementDemain'] = count($this->Crud_model->tomorrowPayement());
	  }


	  if(count($this->Crud_model->VersementDuJour()) > 0) {
	  	$page_data['VersementDuJour'] = count($this->Crud_model->VersementDuJour());
	  }


	  if(count($this->Crud_model->JourProchainPayement()) > 0) {
	  	$page_data['JourProchainPayement'] = count($this->Crud_model->JourProchainPayement());
	  }

	  if(count($this->Crud_model->VersementEnRetard()) > 0) {
	  	$page_data['VersementEnRetard'] = count($this->Crud_model->VersementEnRetard());
	  }

	  if(count($this->Crud_model->VersementEnCours()) > 0) {
	  	$page_data['VersementEnCours'] = count($this->Crud_model->VersementEnCours());
	  }

	  $page_data['nbinventoryEncour'] = $this->Crud_model->nbinventoryEncour();

	  $view_name = 'dashbord';
	  $user_id = $this->session->userdata('user_id');
	  $group_id = $this->session->userdata('group_id');
	  
	  if($this->ion_auth->in_group('compteurs'))
	  {
        $inventaire_encours = $this->Crud_model->selectALLInventoriesInProcess();
        $data = [];
        if(!is_bool($inventaire_encours) && count($inventaire_encours) > 0)
        {
        	foreach($inventaire_encours as $value) {
        		//echo "id_inventory = ".$value['id_inventory'].'<br><br>';
        		$sub = $this->Crud_model->selectSubIventoriesUser2($value['id_inventory']);
        		if(!is_bool($sub))
        		{
        			foreach($sub as $sub){
        				$var = $sub['id_sub'].'|'.ucfirst($sub['title']).'|'.$value['id_inventory'].'|'.$sub['starting_date'].'|'.$sub['date_end'].'|'.$sub['status'];
        				array_push($data, $var);
        			}
        		}
        	}
        }
        $page_data['data'] = $data;
	  	//$page_data['veriftrans'] = $this->Crud_model->verifSelectInventaireByUser($user_id);
		//$page_data['listinventaires'] = $this->Crud_model->selectInventaireByUser($user_id);
		$view_name = 'dashbordcounter';
	  }elseif($this->ion_auth->in_group('validateur'))
	  {
	  	$user_id = $this->session->userdata('user_id');
	  	$page_data['listinventairesnotvalided'] = $this->Crud_model->selectSubIventoryNotValid($user_id);
	  	$view_name = 'dashbordvalidator';
	  }elseif($group_id != 3 && $group_id != 2)
	  {
	  	//les counter et velidateur ne voyent pas ça
	  	$this->load->view('template/header_principal', $page_data);
	  }else
	  {

	  }
	  
	  $this->load->view($view_name, $page_data);

	  if($group_id != 3 && $group_id != 2)
	  {
	  	$this->load->view('template/footer_principal', $page_data);
	  }
	}

	public function dossier_de_inventaire($id_sub, $id_inv)
	{
		$data = [];
	    if(!$this->ion_auth->logged_in())
	    {
	      redirect(site_url('main/login'), 'refresh');
	    }elseif($this->ion_auth->logged_in() && $this->session->userdata('nblogin') == 0)
	    {
	  	  redirect(site_url('main/change_password'), 'refresh');
	    }
	    if($id_sub==NULL || $id_sub==0 || $id_inv==NULL || $id_inv==0){
			$this->session->set_flashdata('message_error', "Ce sous-inventaire ou inventaire n'existe pas dans la base de données !");
		  	$this->session->mark_as_temp('message_error', 5);
		  	redirect(site_url('main/dashboard'), 'refresh');
		}elseif($this->Crud_model->subinventoryCompleted($id_sub, $id_inv))
		{
		  $this->session->set_flashdata('message_error', "Sous-inventaire déjà terminé ! !!");
		  $this->session->mark_as_temp('message_error', 5);
		  redirect(site_url('main/dashboard'), 'refresh');
		}elseif($this->Crud_model->subInventoryExisteByUser($id_sub, $id_inv, $this->session->userdata('user_id'))==false)
		{
			$this->session->set_flashdata('message_error', "Cet inventaire ne vous appartient pas");
		  	$this->session->mark_as_temp('message_error', 5);
		  	redirect(site_url('main/dashboard'), 'refresh');
		}else
		{
		  //$nb = $this->db->get_where("product_on_inventory", ['id_inv' => $id_inv, 'id_products' => 0])->num_rows();
		
		  $data = ['id_inv' => $id_inv, 'id_sub' => $id_sub/*, 'nbp' => $nb*/];
			//$this->load->view('viewcodebarre', $data);
		}
	   $data['brands'] = $this->Crud_model->selectAllBrand();
	   $this->load->view('viewcodebarre', $data);
	}

	public function description_prodution($id_sub, $id_inv)
	{
		if(!$this->ion_auth->logged_in())
		{
		    redirect(site_url('main/login'), 'refresh');
		}elseif($this->ion_auth->logged_in() && $this->session->userdata('nblogin') == 0)
		{
		 redirect(site_url('main/change_password'), 'refresh');
		}
		$_SESSION['message_error4']="";
		if($id_sub==NULL || $id_sub==0 || $id_inv==NULL || $id_inv==0){
			$this->session->set_flashdata('message_error', "Ce sous-inventaire ou inventaire n'existe pas dans la base de données !");
		  	$this->session->mark_as_temp('message_error', 5);
		  	redirect(site_url('main/dashboard'), 'refresh');
		}elseif($this->Crud_model->subinventoryCompleted($id_sub, $id_inv))
		{
		  $this->session->set_flashdata('message_error', "Sous-inventaire déjà terminé ! !!");
		  $this->session->mark_as_temp('message_error', 5);
		  redirect(site_url('main/dashboard'), 'refresh');
		}elseif($this->Crud_model->subInventoryExisteByUser($id_sub, $id_inv, $this->session->userdata('user_id'))==false)
		{
			$this->session->set_flashdata('message_error', "Cet inventaire ne vous appartient pas");
		  	$this->session->mark_as_temp('message_error', 5);
		  	redirect(site_url('main/dashboard'), 'refresh');
		}elseif($this->input->post())
		{
			$idProduit = test_inputValide($this->input->post('idProduit'));

	        $idbrand = test_inputValide($this->input->post('idbrand'));

			if(empty($idProduit) or empty($idbrand))
			{
			  $this->session->set_flashdata('message_error4', "Selectionner au moins un produit");
			  $this->session->mark_as_temp('message_error4', 2);
			  redirect('main/dossier_de_inventaire/'.$id_sub.'/'.$id_inv);	
			}elseif(!$this->Crud_model->selectOneProduitById($idProduit))
			{
			  $this->session->set_flashdata('message_error4', "Ce produit n'existe pas en base. Veuillez le signaler");
			  $this->session->mark_as_temp('message_error4', 2);
			  redirect('main/dossier_de_inventaire/'.$id_sub.'/'.$id_inv);
			}else
			{
			  $infoprod = $this->Crud_model->selectOneProduitById($idProduit);
			}
			/*$this->db->limit(1);
			$search_array = $this->db->get_where('product_on_inventory', array('id_inv' => $id_inv))->row_array();
			if(!empty($search_array['code']))
			{
			  $prodexiste = $this->Crud_model->verifProdComptInventory($infoprod['code'], 'code');
			  $important = 'code';
			}elseif(!empty($search_array['ref']))
			{
			  $prodexiste = $this->Crud_model->verifProdComptInventory($infoprod['ref'], 'ref');
			  $important = 'ref';
			}*/

			/*if(is_bool($prodexiste))
			{
			  $this->session->set_flashdata('message_error4', "This product has not been counted in this inventory. Please report it.");
			  $this->session->mark_as_temp('message_error4', 2);
			  redirect('main/dossier_de_inventaire/'.$id_sub.'/'.$id_inv);
			}*/


			$data = [	'id_sub' => $id_sub,
						'id_inv' => $id_inv,
						'product' => $infoprod,
						/*'qntsoumise' => $prodexiste['qntsoumise'],
						'important' => $important,
						'element' => $prodexiste[$important],*/
				];
		    //var_dump($prodexiste);die;
			$this->load->view('description',$data);
		}
    }

    public function receptionForProduit($id_sub, $id_inv)
    {
    	if(!$this->ion_auth->logged_in())
		{
		    redirect(site_url('main/login'), 'refresh');
		}elseif($this->ion_auth->logged_in() && $this->session->userdata('nblogin') == 0)
		{
		 redirect(site_url('main/change_password'), 'refresh');
		}
		$_SESSION['message_error4']="";
		if($id_sub==NULL || $id_sub==0 || $id_inv==NULL || $id_inv==0){
			$this->session->set_flashdata('message_error', "Ce sous-inventaire ou inventaire n'existe pas dans la base de données !");
		  	$this->session->mark_as_temp('message_error', 5);
		  	redirect(site_url('main/dashboard'), 'refresh');
		}elseif($this->Crud_model->subinventoryCompleted($id_sub, $id_inv))
		{
		  $this->session->set_flashdata('message_error', "Sous-inventaire déjà terminé ! !!");
		  $this->session->mark_as_temp('message_error', 5);
		  redirect(site_url('main/dashboard'), 'refresh');
		}elseif($this->Crud_model->subInventoryExisteByUser($id_sub, $id_inv, $this->session->userdata('user_id'))==false)
		{
			$this->session->set_flashdata('message_error', "Cet inventaire ne vous appartient pas");
		  	$this->session->mark_as_temp('message_error', 5);
		  	redirect(site_url('main/dashboard'), 'refresh');
		}elseif($this->input->post())
		{
			//var_dump($this->input->post());die;
		   if(empty($this->input->post('qte'))/* or empty($this->input->post('prix'))*/)
		   {
		   	 $this->session->set_flashdata('message_error', "Merci de remplir le champ quantité ou de le laisser par défaut");
		     $this->session->mark_as_temp('message_error', 5);
		   }else
		   {
		   	 $setting = $this->Crud_model->selectSettings();
             date_default_timezone_set($setting["time_zone"]);
			 $tim = time();
			 $table='product_on_inventory';
		  	 $data = array(
				"id_products" => $this->input->post('id_prod'),
				"qntcompter" => $this->input->post('qte'),
				"qntsoumise" => $this->input->post('qteS'),
				"id_counter" => $this->session->userdata('user_id'),
				"etat" => 0,
				"id_sub" => $id_sub,
				'id_inv' => $id_inv,
				"datecompte" => $tim,
				"code" => $this->input->post('code'),
			 );

			 //VERIFIE SI LE PRODUIT A ETE DEJA INVENTORIER
			 $data_verif = array(
					  			"id_inv" => $id_inv,
					  			"id_sub" => $id_sub,
								"id_products" => $this->input->post('id_prod'),
							);

			 //var_dump($data_verif);die;
			  

			  //var_dump($this->Crud_model->verification_($table, $data_verif));die;

			   if(!$this->Crud_model->verification_($table, $data_verif))
			   {
				   	//pas encore inventorie (le produit n'existe pas encore dans la table)
				    $update_etatinven = array('status' => 2, 'starting_date' => time());

				    ////il faut voir si le update se fait selon le code ou la ref
				    /*if($this->input->post('important') == 'code')
				    {
                      $this->db->where('code', $this->input->post('important1'));
				    }else
				    {
                     $this->db->where('ref', $this->input->post('important1'));
				    }*/
					if($this->Crud_model->insertion_($table, $data))
					{
						//si c'est le 1er produit du block
						if($this->Crud_model->countProduitByInventorySub2($id_sub, $id_inv))
						{
							//on change le status à 2 et on renseigne le champ starting_date
				          $this->Crud_model->terminervalidation($update_etatinven, $id_inv, $id_sub);

				          //ici on signalé que l'inventaire a commencé
				          $this->db->where('id_inventory', $id_inv);
		  	              $this->db->update('inventory', ['etat' => -1]);
						}

						$this->session->set_flashdata('message_error5', "Produit inventorié avec succès");
				  		$this->session->mark_as_temp('message_error5', 5);
						redirect(site_url('main/commencescanne/'.$id_sub.'/'.$id_inv));
					}else
					{
					  $this->session->set_flashdata('message_error4', "System error");
				  	  $this->session->mark_as_temp('message_error4', 5);
					}
			   }else
			   {
			   	//deja inventorier
			   	$this->session->set_flashdata('message_error4', "Ce produit a été déjà inventorié");
				$this->session->mark_as_temp('message_error4', 5);
				$this->session->set_userdata("id_products", $this->input->post('id_prod'));
				$this->session->set_userdata("qte000", $this->input->post('qte'));
				$this->session->set_userdata("code000", $this->input->post('code'));
				$this->session->set_userdata("qteS000", $this->input->post('qteS'));
			   	redirect(site_url('main/product_already_inventoried/'.$id_sub.'/'.$id_inv));
			  	/*$this->db->set('qte', $this->input->post('qte'));
			  	$this->db->set('unit_price', $this->input->post('prix'));
			  	//$this->db->set('user_id', $this->session->userdata('user_id'));
			  	$this->db->where($data_verif);
			  	$this->db->update($table);
			  	//ici on signalé que l'inventaire a commencé
	            $this->db->where('id_inventory', $id_inv);
	            $this->db->update('inventory', ['etat' => -1]);
			  	$this->session->set_flashdata('message_error5', "Save successfully");
				$this->session->mark_as_temp('message_error5', 5);*/
			  }
		   }

		   redirect(site_url('main/commencescanne/'.$id_sub.'/'.$id_inv));	
		}
	}

   public function product_already_inventoried_action($id_sub, $id_inv)
   {
   	    if(!$this->ion_auth->logged_in())
		{
		    redirect(site_url('main/login'), 'refresh');
		}elseif($this->ion_auth->logged_in() && $this->session->userdata('nblogin') == 0)
		{
		 redirect(site_url('main/change_password'), 'refresh');
		}
		$_SESSION['message_error4']="";
		if($id_sub==NULL || $id_sub==0 || $id_inv==NULL || $id_inv==0){
			$this->session->set_flashdata('message_error', "Ce sous-inventaire ou inventaire n'existe pas dans la base de données !");
		  	$this->session->mark_as_temp('message_error', 5);
		  	redirect(site_url('main/dashboard'), 'refresh');
		}elseif($this->Crud_model->subinventoryCompleted($id_sub, $id_inv))
		{
		  $this->session->set_flashdata('message_error', "Sous-inventaire déjà terminé ! !!");
		  $this->session->mark_as_temp('message_error', 5);
		  redirect(site_url('main/dashboard'), 'refresh');
		}elseif($this->Crud_model->subInventoryExisteByUser($id_sub, $id_inv, $this->session->userdata('user_id'))==false)
		{
			$this->session->set_flashdata('message_error', "Cet inventaire ne vous appartient pas");
		  	$this->session->mark_as_temp('message_error', 5);
		  	redirect(site_url('main/dashboard'), 'refresh');
		}elseif($this->input->post())
		{
			  if(empty($this->input->post('qte')))
			  {
			   $this->session->set_flashdata('message_error4', 'Le champs quantité est obligatoire');

			  }elseif(empty($this->input->post('choix')))
			  {
			  	$this->session->set_flashdata('message_error4', 'Merci de choisir un mode');
			  }else
			  {
			  	$data_verif = ['id_sub' => $id_sub, 'id_inv' => $id_inv, 'id_products' => $this->input->post('id_prod')];
			  	//var_dump($data_verif);die;
			  	if($this->input->post('choix')==-1)
			  	{
			  	  //on ajoute à la qte déjà là
			  		$new_qte = (int) $this->input->post('qte') + (int) $this->input->post('product_qte');
			  	}else
			  	{
			  	  //on ecrase l'ancienne valeur 
			  	  $new_qte = (int) $this->input->post('qte');
			  	}
			  	$this->db->set('qntcompter', $new_qte);
			  	$this->db->where($data_verif);
			  	$this->db->update('product_on_inventory');
			  	$this->session->set_flashdata('message_error5', "Modification effectuée");
				$this->session->mark_as_temp('message_error5', 5);
			  	redirect(site_url('main/product_already_inventoried/'.$id_sub.'/'.$id_inv));
			  }
		}
   }


	public function product_already_inventoried2($id_sub, $id_inv)
	{
		if(!$this->ion_auth->logged_in())
		{
		    redirect(site_url('main/login'), 'refresh');
		}elseif($this->ion_auth->logged_in() && $this->session->userdata('nblogin') == 0)
		{
		 redirect(site_url('main/change_password'), 'refresh');
		}
		if($this->input->post('idProduit'))
		{
			//var_dump($this->input->post('idProduit'));die;
          $data['product'] = $this->Crud_model->selectProduitByIDInventorie($this->input->post("idProduit"), $id_sub, $id_inv);
		}elseif($this->input->post('qte'))
		{
			  if(empty($this->input->post('qte')))
			  {
			   $this->session->set_flashdata('message_error4', 'Le champs quantité est obligatoire');

			  }elseif(empty($this->input->post('choix')))
			  {
			  	$this->session->set_flashdata('message_error4', 'Merci de choisir un mode');
			  }else
			  {
			  	$data_verif = ['id_sub' => $id_sub, 'id_inv' => $id_inv, 'id_products' => $this->input->post('id_prod')];
			  	//var_dump($data_verif);die;
			  	if($this->input->post('choix')==-1)
			  	{
			  	  //on ajoute à la qte déjà là
			  		$new_qte = (int) $this->input->post('qte') + (int) $this->input->post('product_qte');

			  	}else
			  	{
			  	  //on ecrase l'ancienne valeur 
			  	  $new_qte = (int) $this->input->post('qte');
			  	}
			  	$this->db->set('qntcompter', $new_qte);
			  	$this->db->where($data_verif);
			  	$this->db->update('product_on_inventory');
			  	$this->session->set_flashdata('message_error5', "Modification effectuée");
				$this->session->mark_as_temp('message_error5', 5);
			  	redirect(site_url('main/product_already_inventoried/'.$id_sub.'/'.$id_inv));
			  }
		}else
		{
		  redirect(site_url('main/product_already_inventoried/'.$id_sub.'/'.$id_inv), 'refresh');
		}
		$data['id_inv'] = $id_inv;
		$data['id_sub'] = $id_sub;
		//var_dump($data);die;
	    $this->load->view('product_already_inventoried2', $data);
	}

	public function product_already_inventoried($id_sub, $id_inv)
	{
		$data = [];
	    if(!$this->ion_auth->logged_in())
	    {
	      redirect(site_url('main/login'), 'refresh');
	    }elseif($this->ion_auth->logged_in() && $this->session->userdata('nblogin') == 0)
	    {
	  	  redirect(site_url('main/change_password'), 'refresh');
	    }
	    if($id_sub==NULL || $id_sub==0 || $id_inv==NULL || $id_inv==0){
			$this->session->set_flashdata('message_error', "Ce sous-inventaire ou inventaire n'existe pas dans la base de données !");
		  	$this->session->mark_as_temp('message_error', 5);
		  	redirect(site_url('main/dashboard'), 'refresh');
		}/*elseif($this->Crud_model->subinventoryCompleted($id_sub, $id_inv))
		{
		  $this->session->set_flashdata('message_error', "Sous-inventaire déjà terminé ! !!");
		  $this->session->mark_as_temp('message_error', 5);
		  redirect(site_url('main/dashboard'), 'refresh');
		}*/elseif($this->Crud_model->subInventoryExisteByUser($id_sub, $id_inv, $this->session->userdata('user_id'))==false)
		{
			$this->session->set_flashdata('message_error', "Cet inventaire ne vous appartient pas");
		  	$this->session->mark_as_temp('message_error', 5);
		  	redirect(site_url('main/dashboard'), 'refresh');
		}else
		{
		
		  $data = ['id_inv' => $id_inv, 'id_sub' => $id_sub/*, 'nbp' => $nb*/];
			//$this->load->view('viewcodebarre', $data);
		}
	   $data['brands'] = $this->Crud_model->selectAllBrand();
	   $this->load->view('product_already_inventoried', $data);
	}


	public function commencescanne($id_sub, $id_inv)
	{
		if(!$this->ion_auth->logged_in())
		{
		    redirect(site_url('main/login'), 'refresh');
		}elseif($this->ion_auth->logged_in() && $this->session->userdata('nblogin') == 0)
		{
		 redirect(site_url('main/change_password'), 'refresh');
		}
		$_SESSION['message_error4']="";
		if($id_sub==NULL || $id_sub==0 || $id_inv==NULL || $id_inv==0){
			$this->session->set_flashdata('message_error', "Ce sous-inventaire ou inventaire n'existe pas dans la base de données !");
		  	$this->session->mark_as_temp('message_error', 5);
		  	redirect(site_url('main/dashboard'), 'refresh');
		}elseif($this->Crud_model->subinventoryCompleted($id_sub, $id_inv))
		{
		  $this->session->set_flashdata('message_error', "Sous-inventaire déjà terminé ! !!");
		  $this->session->mark_as_temp('message_error', 5);
		  redirect(site_url('main/dashboard'), 'refresh');
		}elseif($this->Crud_model->subInventoryExisteByUser($id_sub, $id_inv, $this->session->userdata('user_id'))==false)
		{
			$this->session->set_flashdata('message_error', "Cet inventaire ne vous appartient pas");
		  	$this->session->mark_as_temp('message_error', 5);
		  	redirect(site_url('main/dashboard'), 'refresh');
		}
		$nb = $this->db->get_where("product_on_inventory", ['id_inv' => $id_inv, 'id_products' => 0])->num_rows();
		
		$data = ['id_inv' => $id_inv, 'id_sub' => $id_sub, 'nbp' => $nb];

		$this->load->view('commencescanne',$data);
	}

	public function endInventaire($id_sub, $id_inv)
	{
		if(!$this->ion_auth->logged_in())
		{
		    redirect(site_url('main/login'), 'refresh');
		}elseif($this->ion_auth->logged_in() && $this->session->userdata('nblogin') == 0)
		{
		 redirect(site_url('main/change_password'), 'refresh');
		}
		$_SESSION['message_error4']="";
		if($id_sub==NULL || $id_sub==0 || $id_inv==NULL || $id_inv==0){
			$this->session->set_flashdata('message_error', "Ce sous-inventaire ou inventaire n'existe pas dans la base de données !");
		  	$this->session->mark_as_temp('message_error', 5);
		  	redirect(site_url('main/dashboard'), 'refresh');
		}elseif($this->Crud_model->subinventoryCompleted($id_sub, $id_inv))
		{
		  $this->session->set_flashdata('message_error', "Sous-inventaire déjà terminé ! !!");
		  $this->session->mark_as_temp('message_error', 5);
		  redirect(site_url('main/dashboard'), 'refresh');
		}elseif($this->Crud_model->subInventoryExisteByUser($id_sub, $id_inv, $this->session->userdata('user_id'))==false)
		{
			$this->session->set_flashdata('message_error', "Cet inventaire ne vous appartient pas");
		  	$this->session->mark_as_temp('message_error', 5);
		  	redirect(site_url('main/dashboard'), 'refresh');
		}else
		{
		  $update_etatinven = array('status' => 1, 'date_end' => time());
		  if($this->Crud_model->terminervalidation($update_etatinven, $id_inv, $id_sub))
		  {
		  	$total_sub = $this->Crud_model->selectSubIventoriesAttribute($id_inv);
		  	$total_finish = $this->Crud_model->selectSubIventoriesAttributeFinish($id_inv);
		  	//signalé qu'on a fini au moins 1 bloc
		  	$this->db->where('id_inventory', $id_inv);
		  	$this->db->update('inventory', ['nb_sub_fini' => count($total_finish)]);
		  	if($total_sub==$total_finish)
		  	{
		  	  $this->Crud_model->update_where('inventory', array('etat'=>1, 'date_end' => time()), $id_inv, 'id_inventory');
		  	}

		  	$this->session->set_flashdata('message_error', "l'inventaire du Block ".$id_sub." est terminé");
		    $this->session->mark_as_temp('message_error', 5);
		  }
		  redirect(site_url('main/dashboard'), 'refresh');
		}
	}

	public function logout()
    {
     // $current_language=$this->session->userdata('language');
        if($this->ion_auth->logout())
        {
          redirect(site_url('main/login'), 'refresh');
        }else
        {
          $this->session->set_flashdata('error', 'Error while disconnecting');
        }
        //$this->session->set_userdata('language' , $current_language);
       //redirect(site_url($this->session->userdata('language').'/administrator~ffcom2020'), 'refresh'); 
    }


    /////////VALIDATEUR/////////////

    public function valideinvetaire($id_sub, $id_inv)
	{
	   	if(!$this->ion_auth->logged_in())
		{
		    redirect(site_url('main/login'), 'refresh');
		}elseif($this->ion_auth->logged_in() && $this->session->userdata('nblogin') == 0)
		{
		 redirect(site_url('main/change_password'), 'refresh');
		}
		$_SESSION['message_error4']="";
		if($id_sub==NULL || $id_sub==0 || $id_inv==NULL || $id_inv==0)
		{
			$this->session->set_flashdata('message_error', 'Ce produit n\'existe pas dans notre base merci de le signalé');
		  	$this->session->mark_as_temp('message_error', 5);
		  	redirect(site_url('main/dashboard'), 'refresh');
		}/*elseif($this->Crud_model->subinventoryIsValidate($id_sub, $id_inv)==true)
		{
		  $this->session->set_flashdata('errors', "Product already approved !!!");
		  $this->session->mark_as_temp('errors', 5);
		  redirect(site_url('main/dashboard'), 'refresh');
		}*/else
		{
			//$user_id = $this->session->userdata('user_id');
			$page_data['listproduit'] = $this->Crud_model->countProduitBySubInventory($id_sub, $id_inv);
			/*$page_data['listsubinventories'] = $this->Crud_model->selectSubInventoriesByValidators($id_sub, $id_inv, $user_id);

			var_dump($page_data['listsubinventories']);die;*/

			$this->session->set_userdata(['id_inv' => $id_inv, 'id_sub'=> $id_sub]);
			$this->load->view('valideinvetaire', $page_data);
		}
	}


	public function validationinventaireByproduit($idproduit)
	{
		if(!$this->ion_auth->logged_in())
		{
		    redirect(site_url('main/login'), 'refresh');
		}elseif($this->ion_auth->logged_in() && $this->session->userdata('nblogin') == 0)
		{
		 redirect(site_url('main/change_password'), 'refresh');
		}
		if($idproduit==NULL || $idproduit==0){
			$this->session->set_flashdata('errors', 'This product does not exist in the database !!!');
		  	$this->session->mark_as_temp('errors', 5);
		  	redirect(site_url('main/dashboard'), 'refresh');
		}else
		{
		  	 $id_inv = $this->session->userdata('id_inv');
		  	 $id_sub = $this->session->userdata('id_sub');
		  	 $nbp_restant = count($this->Crud_model->countProduitBySubInventory($id_sub, $id_inv));
		  	 $data_where = ["id_inv" => $id_inv, 'id_sub' => $id_sub, "id_products" => $idproduit];

		  	 $query = $this->db->get_where('product_on_inventory', $data_where)->row_array();
		  	 //var_dump();die;
		  	 $this->db->where('id_inventory', $id_inv);
		  	 $this->db->update('inventory', ['etat' => 2]);
		  	 if($nbp_restant==1)
		  	 {
		  	 	//c'est le dernier produit a validé
		  	 	/*"user_id" => $this->session->userdata('user_id'),*/
		  	 	
		  	 	if($this->Crud_model->correction(array('etat' => 1, 'id_validator' => $this->session->userdata('user_id'), 'qntvalider' => $query['qntcompter'], 'datevalidate' => time()), $data_where))
		  	 		
			  	{
			  	  $this->session->set_flashdata('message', 'Validé avec succès');
			  	  
                  $this->Crud_model->terminervalidation(array('status' => 3, 'date_end'=>time()), $id_inv, $id_sub);
			  	  $nbsub_novalid = $this->Crud_model->countSubIventoryByinventory($id_inv);
		  	      $nbsub_valid = $this->Crud_model->countSelectSubIventoryValid($id_inv);

			  	  if($nbsub_novalid == $nbsub_valid)
			  	  {
			  	  	//nous avons validé le dernier bloc
			  	  	//ici on change le satus de l'inventaire pour le mettre à validé
			  	  	$this->db->where('id_inventory', $id_inv);
		  	        $this->db->update('inventory', ['etat' => 3, 'date_end'=>time()]);
			  	  }
			  	  redirect(site_url('main/dashboard'), 'refresh');
			  	}
		  	 }else
		  	 {
		  	 	if($this->Crud_model->correction(array('etat' => 1, 'id_validator' => $this->session->userdata('user_id'), 'qntvalider' => $query['qntcompter'], 'datevalidate' => time()), $data_where))
			  	{
			  	  $this->session->set_flashdata('message', 'Validé avec succès');
			  	  redirect(site_url('main/valideinvetaire/'.$id_sub.'/'.$id_inv));
			  	}
		  	 }	
		}
	}


	public function corrections()
	{
		if(!$this->ion_auth->logged_in())
		{
		    redirect(site_url('main/login'), 'refresh');
		}elseif($this->ion_auth->logged_in() && $this->session->userdata('nblogin') == 0)
		{
		 redirect(site_url('main/change_password'), 'refresh');
		}
	    if(isset($_POST['btncorrige']))
	    {
	  	    /*$data = array('qte'=>trim($_POST['quantity']),  'etat'=>1);*/
           //var_dump($data);
		  	$idproduit = $_POST['id_pro'];
		  	//var_dump($idproduit);
		  	$id_inv = $this->session->userdata('id_inv');
		  	$id_sub = $this->session->userdata('id_sub');
		  	//var_dump($id_inv);
		  	$nbp_restant = count($this->Crud_model->countProduitBySubInventory($id_sub, $id_inv));
		  	$data_where = ["id_inv" => $id_inv, 'id_sub' => $id_sub, "id_products" => $idproduit];
		  	//var_dump($nbsub_novalid, $nbsub_valid);die;
		  	//var_dump($this->AdminModel->correction($data, $idproduit));die;
		  	$this->db->where('id_inventory', $id_inv);
		  	$this->db->update('inventory', ['etat' => 2]);
		  	if($nbp_restant==1)
		  	{
		  		//var_dump($this->AdminModel->correction($data, $idproduit));die;
		  		if($this->Crud_model->correction(array('etat' => 1, 'id_validator' => $this->session->userdata('user_id'), 'qntvalider' => trim($_POST['quantity']), 'datevalidate' => time()), $data_where))
		        {
		        	$this->session->set_flashdata('message', 'Corrigé et Validé avec succès');
		        	$this->Crud_model->terminervalidation(array('status'=> 3, 'date_end'=>time()), $id_inv, $id_sub);
		        	$nbsub_novalid = $this->Crud_model->countSubIventoryByinventory($id_inv);
		  	        $nbsub_valid = $this->Crud_model->countSelectSubIventoryValid($id_inv);

		        	  if($nbsub_novalid == $nbsub_valid)
				  	  {
				  	  	//nous avons validé le dernier bloc
				  	  	//ici on change le satus de l'inventaire pour le mettre à validé
				  	  	$this->db->where('id_inventory', $id_inv);
			  	        $this->db->update('inventory', ['etat' => 3, 'date_end'=>time()]);
				  	  }
			  	    redirect(site_url('main/dashboard'), 'refresh');
		        	//redirect(site_url('admin/valideinvetaire/'.$id_inv));
		        }
		  	}
		  	else
		  	{
		  		//var_dump($this->AdminModel->correction($data, $idproduit));die;
		  	 	if($this->Crud_model->correction(array('etat' => 1, 'id_validator' => $this->session->userdata('user_id'), 'qntvalider' => trim($_POST['quantity']), 'datevalidate' => time()), $data_where))
			  	{
			  	  $this->session->set_flashdata('message', 'Corrigé et Validé avec succès');
			  	  redirect(site_url('main/valideinvetaire/'.$id_sub.'/'.$id_inv));
			  	}
		  	}
	  }
	}

	public function documentation()
	{
	  if(!$this->ion_auth->logged_in())
	  {
	    redirect(site_url('main/login'), 'refresh');
	  }elseif($this->ion_auth->logged_in() && $this->session->userdata('nblogin') == 0)
	  {
	  	redirect(site_url('main/change_password'), 'refresh');
	  }
	  $page_data['page_title'] = 'Documentation';
	  $page_data['page_title_sous'] = 'Documentation';
	  $page_data['nbproduct'] = 0;
	  if(!is_bool($this->Crud_model->selectAllProduit())) {
	  	$page_data['nbproduct'] = count($this->Crud_model->selectAllProduit());
	  }

	  $this->load->view('template/header_principal', $page_data);
	  $this->load->view('documentation', $page_data);
	  $this->load->view('template/footer_principal', $page_data);
	}
    

}
