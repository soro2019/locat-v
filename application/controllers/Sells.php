<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sells extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model("Crud_model");
	}

	public function modalappareil()
	{
		if(!$this->ion_auth->logged_in())
	    {
	      redirect(site_url('main/login'), 'refresh');
	    }elseif($this->ion_auth->logged_in() && $this->session->userdata('nblogin') == 0)
	    {
	        redirect(site_url('main/change_password'), 'refresh');
	    }
	    $setting = $this->Crud_model->selectSettings();

	    $query = $this->Crud_model->appareil_vendu($_POST['id']);

	    $i = 0;
	    $result = '<div class="panel-body">
            <div class="table-wrap">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                          <th>Emeil</th>
                          <th>Marque</th>
                          <th>Modèle</th>
                        </tr>
                    </thead>
                    <tbody>';
                       foreach ($query as $query){

					          $result .= '<tr>
					                    <td>'.$query['emeil'].'
					                    </td>
					                    <td>
					                      '.$query['brand'].'
					                    </td>
					                    <td>
					                      '.$query['name'].'
					                    </td>
					                  </tr>';
					    }
                    '</tbody>
                </table>
            </div>
        </div>';
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

	    $query = $this->Crud_model->details_vente($_POST['id']);

	   /* foreach ($query as $query){
	    	
	    }*/
	    $i = 0;
	    $result = '<div class="panel-body">
            <div class="table-wrap">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                          <th>Versement</th>
                          <th>Montant</th>
                          <th>Echéance</th>
                          <th>Status</th>
                          <th>Encaissé par</th>
                          <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>';
                       foreach ($query as $query){
	        
					          $i++;
					          $status = "Non payer";
					          $action = '<a href="'.site_url('sells/payments/'.$query['id']).'" title="Payé maintenant"><b style="font-size: 12px;">Payer maitenant</b></a>';

					          $datepenalite = strtotime($query['echeance']. ' + 1 days');

					          $user_encaisse = $this->Crud_model->selectUser($query['user_encaisse']);

					          if(!is_bool($user_encaisse))
					          {
					          	$user_encaisse = $user_encaisse['username'];
					          }else
					          {
					          	$user_encaisse = '';
					          }

					          if($query['status'] != 1)
					          {
					          	if(time() >= $datepenalite)
					          	{
					          		//avec penalité
					          	    $status = '<span class="label label-danger">En retard</span>';
					          	    //$action = '<a href="'.site_url('inventory/paiementpenalite/'.$query['id']).'" title="Payé maintenant"><b>Payé M</b></a>';
					          	}else
					          	{
					          	 $status = '<span class="label label-warning">En cours</span>';	
					          	}
					          }else
					          {
					          	$action = '<span class="label label-success">Ok</span>';
					          	$status = '<span class="label label-success">Payer</span>';
					          }

					          $result .= '<tr>
					                    <td>
					                      V'.$i.'
					                    </td>
					                    <td>
					                      '.number_format($query['montant'], 0, ' ', ' ').' Fcfa
					                    </td>
					                    <td>
					                      '.date("d/m/Y", strtotime($query['echeance'])).'
					                    </td>
					                    <td>
					                      '.$status.'
					                    </td>
					                    <td>
					                      '.$user_encaisse.'
					                    </td>
					                    <td>
					                      '.$action.'
					                    </td>
					                  </tr>';
					    }
                    '</tbody>
                </table>
            </div>
        </div>';
        echo json_encode($result);
	}

	public function payments($id_line)
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
	  $page_data['page_title'] = 'Ventes';
	  $page_data['page_title_sous'] = 'Versement';
	  //controle sur $id_line

	   $id_line = (int) $id_line;
	   if($id_line == 0 || $id_line == NULL)
	   {
	   	 //$this->session->set_flashdata('error', 'This element does not exist in base');
	   	 redirect(site_url('sells/list'), 'refresh');
	   }
	   $page_data['info_line'] = $this->Crud_model->selectOnesLine($id_line);

	   if($this->input->post())
	   {
	   	 $data = ['status' => 1, 'date_paiement' => time(), 'montant_penalite' => 0, 'user_encaisse' => $this->session->userdata('user_id')];
	   	//date_paiement
	   	 if(isset($_POST['penalite']) && !empty($_POST['penalite']))
	   	 {
	   	 	$data['montant_penalite'] = (int) $_POST['penalite'];
	   	 	$penalite_old = $this->db->get_where('ventes', array('id'=>$_POST['idvente']))->row_array()['penalite'];
	   	 	$penalite_new = $penalite_old + $data['montant_penalite'];

	   	 	$this->Crud_model->update_where('ventes', ["penalite" => $penalite_new], $_POST['idvente'], 'id');
	   	 }

	   	 if($this->Crud_model->update_where('details_vente', $data, $id_line, 'id'))
	   	 {
	   	 	 $nb = $this->Crud_model->selectImpaier($_POST['idvente']);
		   	 if($nb == 0)
		   	 {
		   	 	$this->Crud_model->update_where('ventes', ['status' => 1], $_POST['idvente'], 'id');
		   	 }
		   	 $this->session->set_flashdata('message', 'Paiement effectué avec succès');
           	 redirect(site_url('sells/list'), 'refresh');
	   	 }
	   	 
	   }

	  $this->load->view('template/header_principal', $page_data);
	  $this->load->view('versement', $page_data);
	  $this->load->view('template/footer_principal', $page_data);
	}

    public function getinfoByAppareil()
    {
      $emeil = $this->input->post('brand');
      $query = $this->db->get_where('products', array('id' => $emeil,))->row_array();
      echo json_encode($query);
    }

    public function getinfoByClient()
    {
      $id_client = $this->input->post('id_client');
      $query = $this->db->get_where('clients', array('id' => $id_client,))->row_array();
      echo json_encode($query);
    }

    private function generateIdentifiant()
	{
	  $nb_al = random_int(1000000000, 9999999999);
	  $query = $this->db->get_where('ventes', array('codeVente' => $nb_al));
	  if($query->num_rows() > 0)
	  {
	  	$this->generateIdentifiant();
	  }else
	  {
	    return $nb_al;
	  }
	}


	private function insert_emeil($data, $vente)
	{
		  foreach ($data as $emeil)
	  	  {
	  	  	$id = $this->Crud_model->insertion_("products_by_vente", ['emeil' => $emeil , 'vente' => $vente]);
	  	  }

	  	  return $id;
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
	  if(isset($_SESSION['data']))
	  {
	    unset($_SESSION['data']); 
	  }
	  $page_data['page_title'] = 'Ventes';
	  $page_data['page_title_sous'] = 'Ajouter une vente';
	  $page_data['brands'] = $this->Crud_model->selectAllBrand();
	  $page_data['allClient'] = $this->Crud_model->selectAllClient();

	  if($this->input->post())
	  {
	  	//var_dump($this->input->post());die;
	  	if(empty($_POST["dateVente"]) || empty($_POST["prix_u"]) || empty($_POST["idProduit"]) || empty($_POST["contact"]) || empty($_POST["emeil"]) || empty($_POST["qnt"]) || empty($_POST["idClient"]) || empty($_POST["type_vente"]) || empty($_POST['idbrand']))
	  	{
          $this->session->set_flashdata('error', 'Merci de renseigner tous les champ avec *');

	  	}elseif($_POST["type_vente"] == 1 and (empty($_POST["mnt_v1"]) || empty($_POST["nb_v_restant"])))
	  	{
	  	  $this->session->set_flashdata('error', 'Le type de vente utilisé vous oblige à saisir les champs montantV1 et nb_versement');
	  	}elseif($_POST["qnt"] != count($_POST["emeil"]))
	  	{
	  	  $this->session->set_flashdata('error', 'La quantité commandez n\'est pas en conformité avec le nombre d\'appareil ajouté');
	  	}else
	  	{
	  	   
	  	    if($_POST["type_vente"] == 1)
	  		{
	  			//a crédit
	  			$_POST['m_restant'] = (int) $_POST['prixTotalVente'] - (int) test_inputValide($_POST["mnt_v1"]);
	  		    $this->session->set_userdata('data', $_POST);
	  		   //var_dump($this->session->userdata('data'));die;
	  		   redirect(site_url('sells/next'), 'refresh');
	  		}else
	  		{
	  			///immediat
	  			$datas = array(
					'idClient' => $_POST["idClient"],
					'idProduit' => $_POST["idProduit"],
					'montantV1' => (int) test_inputValide($_POST["prixTotalVente"]),
					'prixTotalVente' => (int) test_inputValide($_POST["prixTotalVente"]),
					'nb_versement' => 0,
					'dateVente' => $_POST["dateVente"],
					'contatClient' => $_POST["contact"],
					'observation' => test_inputValide($_POST["description"]),
					"type_vente" => $_POST["type_vente"],
					'qnt' => (int) $_POST["qnt"],
					'prix_u' => (int) $_POST["prix_u"],
					'prix_acc' => (int) $_POST["prix_acc"],
					'date_create' => time(),
					'status'   => 1,
					'user' => $this->session->userdata('user_id'),
					'codeVente' => $this->generateIdentifiant(),
			    );

			    $qnt_old = $this->Crud_model->selectProduitByID($_POST["idProduit"])->quantity;
			  	$qnt_new = $qnt_old - (int) $_POST["qnt"];

			  	if($qnt_new < 0)
			  	{
			  	 $this->session->set_flashdata('error', 'Impossible de faire cette vente, le stock du produit choisir est faible');
			  	 //redirect(site_url('sells/add'), 'refresh');
			  	}else
			  	{
			  		if($id = $this->Crud_model->insertion_("ventes", $datas))
				  	{
				  	  $this->Crud_model->insertion_("details_vente", ['idclient' => $datas['idClient'], 'versement' => 'V1', 'montant' =>  $datas['montantV1'], 'echeance' => $datas['dateVente'] , 'status' => 1, 'idvente' => $id, 'date_paiement' => time(), 'user_encaisse' => $this->session->userdata('user_id')]);

				  	  	if($this->insert_emeil($_POST["emeil"], $id))
				  	  	{
				  	  	  
				  	     $this->Crud_model->update_where('products', ['quantity' => $qnt_new], $_POST["idProduit"], 'id');
			           	 
			           	 $this->session->set_flashdata('message', 'Vente enregistrée avec succès');
				          redirect(site_url('sells/list'), 'refresh');
				  	  	}else
				  	  	{
				  	  		$this->session->set_flashdata('message', 'Erreur du système, merci de contacter le concepteur');
				  	  	}
			        }
			  	}
	  		}
	  	}
	  }
	  $this->load->view('template/header_principal', $page_data);
	  $this->load->view('add_vente', $page_data);
	  $this->load->view('template/footer_principal', $page_data);
	}

	public function next()
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
	  $page_data['page_title'] = 'Ventes';
	  $page_data['page_title_sous'] = 'Ajouter une vente';
      if(!$this->session->userdata('data'))
      {
      	redirect(site_url('sells/add'), 'refresh');
      }
	  if($this->input->post())
	  {
	  	//RECUPERATION DES DATA
	  	$datas = array(
				'idClient' => $_SESSION['data']['idClient'],
				'idProduit' => $_SESSION['data']['idProduit'],
				'montantV1' => $_SESSION['data']['mnt_v1'],
				'prixTotalVente' => $_SESSION['data']['prixTotalVente'],
				'nb_versement' => (int) $_SESSION['data']['nb_v_restant'] + 1,
				'dateVente' => $_SESSION['data']['dateVente'],
				'contatClient' => $_SESSION['data']['contact'],
				'observation' => $_SESSION['data']['description'],
				'qnt' => $_SESSION['data']['qnt'],
				'prix_u' => $_SESSION['data']["prix_u"],
				'prix_acc' => $_SESSION['data']["prix_acc"],
				'date_create' => time(),
				"type_vente" => 1,
				'user' => $this->session->userdata('user_id'),
				'codeVente' => $this->generateIdentifiant(),
			);
	  	 //var_dump($datas);die;
	  	$qnt_old = $this->Crud_model->selectProduitByID($_SESSION['data']['idProduit'])->quantity;
		$qnt_new = $qnt_old - (int) $_SESSION['data']['qnt'];

		if($qnt_new < 0)
	  	{
	  	 $this->session->set_flashdata('error', 'Impossible de faire cette vente, le stock du produit choisir est faible');
	  	 redirect(site_url('sells/add'), 'refresh');
	  	}else
	  	{
	  		if($id = $this->Crud_model->insertion_("ventes", $datas))
		  	{
		  	  $this->Crud_model->insertion_("details_vente", ['idclient' => $_SESSION['data']['idClient'], 'versement' => 'V1', 'montant' =>  $_SESSION['data']['mnt_v1'], 'echeance' => $_SESSION['data']['dateVente'] , 'status' => 1, 'idvente' => $id, 'date_paiement' => time(), 'user_encaisse' => $this->session->userdata('user_id')]);

	           $nb = (int) $_SESSION['data']['nb_v_restant'] + 1;

	           for($i=2; $i <= $nb ; $i++) {
	               $id_b = $this->Crud_model->insertion_("details_vente", ['idclient' => $_SESSION['data']['idClient'], 'versement' => 'V'.$i, 'montant' => (int) $_POST['mnt_v'.$i], 'echeance' => $_POST['echeance'.$i], 'status' => 0, 'idvente' => $id]);
	           }

	           if($this->insert_emeil($_SESSION['data']["emeil"], $id))
	           {
	           	 
				 $this->Crud_model->update_where('products', ['quantity' => $qnt_new], $_SESSION['data']['idProduit'], 'id');
				 unset($_SESSION['data']);
	           	 $this->session->set_flashdata('message', 'Vente enregistrée avec succès');
	           	 redirect(site_url('sells/list'), 'refresh');

	           }else
		  	   {
		  	  	$this->session->set_flashdata('message', 'Erreur du système, merci de contacter le concepteur');
		  	   }
		  	}
	  	}

	  }

	  $this->load->view('template/header_principal', $page_data);
	  $this->load->view('next_view', $page_data);
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
		if(isset($_SESSION['data']))
		{
		   unset($_SESSION['data']); 
		}
		$page_data['page_title'] = 'Ventes';
		$page_data['page_title_sous'] = 'Liste des ventes';

		if($this->session->userdata('group_id') == 1)
		{
			$page_data['ventes'] = $this->Crud_model->selectAllVente();
		}else
		{
			$page_data['ventes'] = $this->Crud_model->selectAllVenteNotClose();
		}
		
		//var_dump($page_data['ventes']);die;
		$this->load->view('template/header_principal', $page_data);
		$this->load->view('list_ventes', $page_data);
		$this->load->view('template/footer_principal', $page_data);
	}

	public function add_client()
	{
		if(!$this->ion_auth->logged_in())
		{
		  redirect(site_url('main/login'), 'refresh');
		}

		$page_data['nbproduct'] = 0;
		if(!is_bool($this->Crud_model->selectAllProduit())) {
		  $page_data['nbproduct'] = count($this->Crud_model->selectAllProduit());
		}
		if(isset($_SESSION['data']))
		{
		   unset($_SESSION['data']); 
		}
		$page_data['groups'] = $this->Crud_model->selectAllGroup();
    	$page_data['page_title'] = 'Clients';
		$page_data['page_title_sous'] = 'Ajouter un client';

		if($this->input->post())
		{
          if(empty($_POST['full_name']) || empty($_POST['phone']) || empty($_POST['prenoms']))
          {
            $this->session->set_flashdata('error', 'Merci de renseigner tous les champs avec des *');
          }elseif(preg_match('/^[0-9]{11}+$/', $_POST['phone']))
          {
			$this->session->set_flashdata('error', 'Format du contact 1 invalide');
          }elseif(is_numeric($_POST['full_name']) || is_numeric($_POST['prenoms']))
          {
			$this->session->set_flashdata('error', 'Format du nom ou du prénom est invalide');
          }elseif(!empty($_POST['phone2']) && preg_match('/^[0-9]{11}+$/', $_POST['phone2']))
          {
			$this->session->set_flashdata('error', 'Format du contact 2 invalide');
          }elseif(!empty($_POST['email']) && !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
          {
            $this->session->set_flashdata('error', 'Email invalide');
          }elseif(!empty($_POST['type_piece']) && empty($_POST['num_piece']))
          {
            $this->session->set_flashdata('error', 'Merci de renseigner le numéro de la pièce');
          }else
          {
          	//var_dump($this->input->post());die;
			$additional_data = [
					'full_name' => strtoupper($this->input->post('full_name')),
					'contact' => $this->input->post('phone'),
					'prenoms' => strtoupper($this->input->post('prenoms')),
					'email' => $this->input->post('email'),
					'type_piece' => strtoupper($this->input->post('type_pieces')),
					'contact_2' => $this->input->post('phone2'),
					'profession' => strtoupper($this->input->post('profession')),
					'date_naiss' => $this->input->post('date_naiss'),
					'lieu_naiss' => strtoupper($this->input->post('lieu_naiss')),
					'lieu_habitation' => $this->input->post('lieu_habi'),
					'num_piece' => $this->input->post('num_pieces'),
					'date_add' => time(),
					'user' => $this->session->userdata('user_id'),
				];

			if($id = $this->Crud_model->insertion_('clients', $additional_data))
			{
			  $this->Crud_model->update_where('clients', array('IDDOSSIER' => 'ID'.$id), $id, 'id');
			  $this->session->set_flashdata('message', 'Client enregistré avec succès');
				redirect("sells/add", 'refresh');
			}

          }
		}
		
		$this->load->view('template/header_principal', $page_data);
	    $this->load->view('add_client', $page_data);
	    $this->load->view('template/footer_principal', $page_data);
	}

	public function modeclient()
	{
	    if(!$this->ion_auth->logged_in())
	    {
	      redirect(site_url('main/login'), 'refresh');
	    }elseif($this->ion_auth->logged_in() && $this->session->userdata('nblogin') == 0)
	    {
	        redirect(site_url('main/change_password'), 'refresh');
	    }
	    $setting = $this->Crud_model->selectSettings();

	    $client = $this->Crud_model->selectOneClient($_POST['id_client']);

	    $result = '<div class="panel-body">
	    			    <form action="'.site_url('sells/modifclient').'" method="POST">
					        <div class="row">
						       	<div class="col-sm-6 mb-15">
						       		<label>Nom client *</label>
						       		<input class="form-control" name="full_name" type="text" placeholder="Nom client" required value="'.$client['full_name'].'">
						       		<input name="id_client" type="hidden" value="'.$_POST['id_client'].'">
						       	</div>
						       	<div class="col-sm-6 mb-15">
						       		<label>Prénoms client *</label>
						       		<input class="form-control" name="prenoms" type="text" placeholder="Prénoms client" required value="'.$client['prenoms'].'">
						       	</div>
						    </div>
						    <div class="row">
						        <div class="col-sm-6 mb-15">
						       		<label>Contact 1 *</label>
						       		<input class="form-control" name="phone" type="tel" placeholder="Contact 1" required value="'.$client['contact'].'">
						       	</div>
						       	<div class="col-sm-6 mb-15">
						       		<label>Contact 2</label>
						       		<input class="form-control" name="phone2" type="tel" placeholder="Contact 2" value="'.$client['contact_2'].'">
						       	</div>
						    </div>
						    <div class="row">
						       <div class="col-sm-6 mb-15">
						       		<label>Email</label>
						       		<input class="form-control" name="email" type="email" placeholder="Email client" value="'. $client['email'].'">
						       	</div>
						       	<div class="col-sm-6 mb-15">
						       		<label>Type de pièces </label>
						       		<select class="form-control select2" id="type_pieces" name="type_pieces">
                                        <option value="">Choisir un type</option>
                                        <option value="1"'.echo_selected($client['type_piece'], 1).'>CNI</option>
                                        <option value="2"'.echo_selected($client['type_piece'], 2).' >Attestation</option>
                                        <option value="3"'.echo_selected($client['type_piece'], 3).' >Passeport</option>
                                        <option value="4"'.echo_selected($client['type_piece'], 4).' >Carte Consulaire</option>
                                        <option value="5"'.echo_selected($client['type_piece'], 5).' >Autre</option>
                                    </select>
						       	</div>
						    </div>
						    <div class="row">
						       	<div class="col-sm-6 mb-15">
						       		<label>Numéro de la pièces</label>
						       		<input class="form-control" name="num_pieces" type="text" placeholder="Numéro de la pièces" value="'.$client['num_piece'].'">
						       	</div>
						       	<div class="col-sm-6 mb-15">
						       		<label>Profession </label>
						       		<input class="form-control" name="profession" type="text" placeholder="profession client" value="'. $client['profession'].'">
						       	</div>
						    </div>
						    <div class="row">
						       	<div class="col-sm-6 mb-15">
						       		<label>Date de naissance</label>
						       		<input class="form-control" name="date_naiss" type="date" placeholder="Date de naissance" value="'.$client['date_naiss'].'">
						       	</div>

						       	<div class="col-sm-6 mb-15">
						       		<label>Lieu de naissance</label>
						       		<input class="form-control" name="lieu_naiss" type="text" placeholder="Lieu de naissance" value="'.$client['lieu_naiss'].'">
						       	</div>
						       	<div class="col-sm-6 mb-15">
						       		<label>Lieu d"ahbitation </label>
						       		<input class="form-control" name="lieu_habi" type="text" placeholder="Lieu d\'ahbitation" value="'.$client['lieu_habitation'].'">
						       	</div>

						    </div>
						       	 <div class="col-sm-6 mb-15">
						       	 	<button type="submit" class="btn btn-success" >Modifier</button> 
						       	 </div>
					       </div>
					    </form>
	               </div>';

	    echo json_encode($result);
	}


	public function modifclient()
	{
		if(!$this->ion_auth->logged_in())
	    {
	      redirect(site_url('main/login'), 'refresh');
	    }elseif($this->ion_auth->logged_in() && $this->session->userdata('nblogin') == 0)
	    {
	        redirect(site_url('main/change_password'), 'refresh');
	    }

	    if($this->input->post())
	    {
	      if(empty($_POST['full_name']) || empty($_POST['phone']) || empty($_POST['prenoms']))
          {
            $this->session->set_flashdata('error', 'Merci de renseigner tous les champs avec des *');
          }elseif(preg_match('/^[0-9]{11}+$/', $_POST['phone']))
          {
			$this->session->set_flashdata('error', 'Format du contact 1 invalide');
          }elseif(is_numeric($_POST['full_name']) || is_numeric($_POST['prenoms']))
          {
			$this->session->set_flashdata('error', 'Format du nom ou du prénom est invalide');
          }elseif(!empty($_POST['phone2']) && preg_match('/^[0-9]{11}+$/', $_POST['phone2']))
          {
			$this->session->set_flashdata('error', 'Format du contact 2 invalide');
          }elseif(!empty($_POST['email']) && !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
          {
            $this->session->set_flashdata('error', 'Email invalide');
          }elseif(!empty($_POST['type_piece']) && empty($_POST['num_piece']))
          {
            $this->session->set_flashdata('error', 'Merci de renseigner le numéro de la pièce');

          }elseif($this->Crud_model->elementExist(['contact' => $_POST['phone'], 'id !=' => $_POST['id_client']], 'clients') || (!empty($_POST['phone2']) && $this->Crud_model->elementExist(['contact' => $_POST['phone2'], 'id !=' => $_POST['id_client']], 'clients')))
          {
          	$this->session->set_flashdata('error', 'Cet concats appartient déjà à un autre client');
          	redirect("sells/clients_list", 'refresh');
          }else
          {
          	/*$client = $this->Crud_model->selectOneClient($_POST['id_client']);

          	if($_POST['full_name'] == $client['full_name'] && $_POST['phone'] == $client['contact'] && $_POST['prenoms'] == $client['prenoms'] && $_POST['phone2'] == $client['contact_2'] && $_POST['email'] == $client['email'] && $_POST['phone2'] == $client['contact_2'] && $_POST['phone2'] == $client['contact_2'])
          	{
          	}else
          	{

          	}*/

          	$additional_data = [
					'full_name' => strtoupper($this->input->post('full_name')),
					'contact' => $this->input->post('phone'),
					'prenoms' => strtoupper($this->input->post('prenoms')),
					'email' => $this->input->post('email'),
					'type_piece' => strtoupper($this->input->post('type_pieces')),
					'contact_2' => $this->input->post('phone2'),
					'profession' => strtoupper($this->input->post('profession')),
					'date_naiss' => $this->input->post('date_naiss'),
					'lieu_naiss' => strtoupper($this->input->post('lieu_naiss')),
					'lieu_habitation' => $this->input->post('lieu_habi'),
					'num_piece' => $this->input->post('num_pieces'),
					'date_modif' => time(),
					'user_modif' => $this->session->userdata('user_id'),
				];

			if($this->Crud_model->update_where('clients', $additional_data, $_POST['id_client'], 'id'))
			{
			  $this->session->set_flashdata('message', 'Client modifié avec succès');
			  redirect("sells/clients_list", 'refresh');
			}


          }
	    }
	}


	public function clients_list()
	{
	  $page_data['page_title'] = 'Clients';
	  $page_data['page_title_sous'] = 'Mes clients';
	  if(!$this->ion_auth->logged_in())
	  {
	   redirect(site_url('main/login'), 'refresh');
	  }
	  if(isset($_SESSION['data']))
	  {
		   unset($_SESSION['data']); 
	  }
	  $page_data['nbproduct'] = 0;
	  if(!is_bool($this->Crud_model->selectAllProduit())) {
	  	$page_data['nbproduct'] = count($this->Crud_model->selectAllProduit());
	  }
	  
	  $page_data['users'] = $this->Crud_model->selectAllClient();
	  $this->load->view('template/header_principal', $page_data);
	  $this->load->view('list_client', $page_data);
	  $this->load->view('template/footer_principal', $page_data);
	}

	public function imprimecontrat($id = null, $view = null, $save_bufffer = null)
	{
        if(!$this->ion_auth->logged_in())
		{
		  redirect(site_url('main/login'), 'refresh');
		}
		if(isset($_SESSION['data']))
		{
		  unset($_SESSION['data']); 
		}

        if ($this->input->get('id')) {
            $id = $this->input->get('id');
        }
        $vente = $this->Crud_model->selectOneVente($id);
        //var_dump($vente);die;
        if($vente == false){
        	$this->session->set_flashdata('error', 'Le paramètre passé n\'existe pas en base');
        	redirect(site_url('sells/list'), 'refresh');
        }
        
        
        $date_naiss = '';
        $lieu_naiss = '';
        
        if(trim($vente['date_naiss']) != '0000-00-00')
        {
          $date_naiss = formtageDate2($vente['date_naiss']);
        }
    
        if(trim($vente['lieu_naiss']) != '')
        {
          $lieu_naiss = " à ".$vente['lieu_naiss'];
        }
        
        if($vente['type_piece'] == 1)
        {
          $lib ='Carte d\'identité ';
        }elseif($vente['type_piece'] == 3)
        {
           $lib ='Passeport '; 
        }elseif($vente['type_piece'] == 4)
        {
            $lib ='Carte Consulaire';
        }elseif($vente['type_piece'] == 2)
        {
          $lib ='Attestation ';   
        }else
        {
          $lib ='Autre ';
        }
        
        //var_dump($date_naiss, $lieu_naiss);die;
        
        $name = 'contrat_vente_' .$vente['idd']. '.pdf';

        $path   = 'http://127.0.0.1/e-boutique/assets/styles/logo.png';
	    $type   = pathinfo($path, PATHINFO_EXTENSION);
	    $data   = file_get_contents($path);
	    $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);

	    //var_dump($data);die;

        $html                     = "
        	<html>
				<head>
				    <meta charset='utf-8'>
				    <meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
				    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
				    <title>Contrat_vente_" . $vente['idd']."</title>
				    <link href='http://127.0.0.1/e-boutique/assets/styles/pdf/bootstrap.min.css')' rel='stylesheet'>
				    <link href='http://127.0.0.1/e-boutique/assets/styles/pdf/pdf.css'' rel='stylesheet'>
				    <style>
				    
				     .moi_1{
				         border-style: solid !important;
				         background-color: #d30f8b !important;
				         color: white !important;
				         font-size: 13px !important;
				         border: solid 2px #d30f8b !important;
				         /* border-radius: 8px !important;
				          border-top-right-radius: 100px;
				          width: 100px !important;*/
				     }
				     .moi_11{
				         border: solid 2px #d30f8b !important;
				         color: #d30f8b !important;
				         font-size: 14px !important;
				         border-radius: 8px !important;
				         height: 90px !important;
				     }
				     
				     .border_bon{
				         border: solid 2px #d30f8b !important;
				         border-radius: 8px !important;
				     }
				     .contrat_title{
				         
				         color: #d30f8b !important;
				         /*font-size: 16px !important;*/
				     }
				     
				     .color_change{
				         color: #d30f8b !important;
				     }
				     
				     .text_gras{
				         
				         font-weight: bold !important;
				     }
				    </style>
				</head>

				<body  style='background-color: #fae6f1 !important;' class='color_change'>
				<div>
                   <div class='container'>

                   <div class='container'>


                   	<div class='row'>

                       <div class='col-sm-4'>
                         <div class='panel panel-default' style='background-color: #f4d3e4 !important;'>
						  <div class='panel-heading moi_1'><p>Agrafer le R.I.B. ici</p></div>
						  <div class='panel-body moi_11'>
	                         <p>LE PETIT COIN SMARTPHONES<br>Site : lepetitcoinsmartphones.com<br>11 BP 2354 Abidjan 11<br>Cel : 07-89-80-78-87 / 07-08-85-66-95</p>
						  </div>
						</div>
                      </div> <br> <br>

                      <div class='col-sm-3' style='padding-top:25px;'>
                         <h4 class='contrat_title'>CONTRAT DE PAIEMENT</h4>
                      </div>
                

                      <div class='col-sm-4'>
                         <div class='panel panel-default'>
						  <div class='panel-body moi_11'>
						    <p class='text-center' style='font-size: 10px !important;'><b>VENDEUR ou PRESTATAIRE DE SERVICES</b></p>
						    <br>
						    <p class='text-center'>(Tampon)</p>
						  </div>
						</div>
                      </div>

                     </div>
                   </div><br>

                     <div class='row'>
                       <div class='col-sm-8'>
                       		<p class='text-center text_gras'>EMPRUNTEUR*</p>
                         <div class='panel panel-default border_bon'>
						  
						  <div class='panel-body'>
	                         <table>

							  <tr>
							    <td>Nom</td>
							    <td>: " . $vente['full_name']."</td>
							  </tr>

							  <tr>
							    <td>Prénoms</td>
							    <td>: " . $vente['prenoms']."</td>
							  </tr>

							  <tr>
							    <td>Nom de jeune fille </td>
							    <td>: </td>
							  </tr>

							  <tr>
							    <td>Née le</td>
							    <td>: " . $date_naiss." ". $lieu_naiss."</td>
							  </tr>

							  <tr>
							    <td>Adresse</td>
							    <td>: " . $vente['lieu_habitation']."</td>
							  </tr>

							  <tr>
							    <td>Ville</td>
							    <td>: " . $vente['lieu_habitation']."</td>
							  </tr>

							  <tr>
							    <td>Tel. fixe</td>
							    <td>: " . $vente['contact_2']."</td>
							  </tr>

							  <tr>
							    <td>Tel. portable</td>
							    <td>: " . $vente['contact']."</td>
							  </tr>


							  
							</table>
							<br>
						  </div>
						</div>


						<div class='panel panel-default deux border_bon'>
						  
						  <div class='panel-body'>
						  	<h6>Référence de pièces d'identité</h6>
	                         <table>
							  <tr>
							    <td>".$lib." : </td>
							    <td> n° " . $vente['num_piece']."</td>
							  </tr>
							</table>
							<br>
						  </div>
						</div>


						<br>
						<p class='non'><b>Acceptation par l'Emprunteur :</b></p>
	                         <p class='non'>Le soussigné reconnait avoir pris connaissance du pret figurant ci-contre et au verso du présent contrat. Il les accepte sans restriction, ni réserve.</p>
                      </div>

                      <div class='col-sm-3' style='height: 400px !important;'>
                      		<p class='text-center'><b>CARACTERISTIQUES DU PRET</b></p>
                         <div class='panel panel-default paddin-right border_bon'>
						  
						  <div class='panel-body '>
						  	 <br/>
	                         <p>A RECOPIER PAR LE VENDEUR :</p>
	                          <br/>
	                           

	                         <ul>
					            <li class='non'>Numéro du dossier :</li>
					         </ul>
					         <p class='non'><b>" . $vente['IDDOSSIER']."</b></p>

					         <br/>
					         <ul>
					            <li class='non'>Montant de l'apport :</li>
					         </ul>
					         <p class='non'><b>" .number_format($vente['montantV1'], 0, ' ', '.')." frcs</b></p>

					         <br/>
					         <ul>
					            <li class='non'>Montant du pret :</li>
					         </ul>
					         <p class='non'><b>" .number_format($vente['prixTotalVente'], 0, ' ', '.')." frcs</b></p>

					         <br/>
					         <ul>
					            <li class='non'>Montant de chaque échéance :</li>
					         </ul>";
					         
					         $versements = $this->Crud_model->details_vente($vente['idd']);
					         
					         foreach($versements as $versement)
					         {
					           $html .= "<p class='non' style='font-size: 12px;'><b>" .$versement['versement']."</b> => <b>".number_format($versement['montant'], 0, ' ', '.')." frcs
					            | ".formtageDate2($versement['echeance'])."</b></p>"; 
					         }
					         
					         $html .= "
					         <br/>
					         <br/>
					         
						  </div>
						</div>
                      </div>

                   
                    </div>
                    
                      
	                         <div class='row'>
	                           <div class='col-sm-5'>
	                            <div class='panel panel-default border_bon'>
	                             <div class='panel-body'>
        						  	 Fait le Abidjan le ".formtageDate2($vente['dateVente'])."
        	                         <br><br>
        	                         <b style=' font-size: 14px !important;'>Signature du client</b>
        							  
        							  <br><br><br><br>
        							    
        							  <p>en deux exemplaires originaux</p>
        						  </div>
        						</div>
                               </div>
                               
                               <div class='col-sm-4'>
        						  Signature prêteur
                               </div>
                               
	                         </div>



                    </div>




                   	<div class='container-wide'>
                   		
	                    <div class='row'>
	                       <div class='col-sm-12'>
	                         <p style='font-size:18px;'><b>CONDITIONS GENERALES DE VENTE</b></p>
	                         
	                         <br/>
	                         <p><b>1) GENERALITES</b></p>
	                         <p>Les présentes conditions générales de vente sont conclues entre la Société LE PETIT COIN SMARTPHONES dont le siège social est situé 11 BP 2354 ABIDJAN 11 et toute personne physique ou morale souhaitant effectuer un achat ou une prestation de service par les différentes modalités de paiement ci-dessous énoncées, dénommée le «CLIENT».</p>
	                         <p>Le «PRÊT» correspond au montant total de la transaction réalisée, diminuée d’un premier acompte payé au comptant. «LE PRÊT» est donc payable en deux (2) mensualités.</p>
	                         <p>Sauf convention particulière expresse, toute commande du client est soumise aux présentes conditions générales de vente, nonobstant toute clause contraire qui pourrait figurer sur les documents du CLIENT</p>
	                         <p>LE PETIT COIN SMARTPHONES se réserve la possibilité d’adapter ou de modifier à tout moment les présentes conditions générales de vente. En cas de modification, seront appliquées à chaque commande les conditions générales de vente en vigueur au jour de l’enregistrement de la commande.</p>

	                         <br/>
	                         <p><b>2) OBJET</b></p>
	                         <p>Les présentes conditions générales de vente visent à définir les modalités de vente entre LE PETIT COIN SMARTPHONES et le CLIENT, à partir de la passation de commande jusqu’au service après-vente.</p>

	                         <br/>
	                         <p><b>3) PRIX & PRODUITS</b></p>
	                         <p>Les prix sont définis en Francs CFA toutes taxes comprises pour la Côte d’Ivoire. Le montant de la TVA est indiqué lors de la sélection d'un produit par le Client. Si le taux de TVA venait à être modifié, ces changements pourront être répercutés sur le prix suivant les exigences légales sans que le client en soit préalablement informé.</p>
	                         <p>LE PETIT COIN SMARTPHONES se réserve le droit de modifier ses prix à tout moment mais les produits sont facturés au prix en vigueur lors de la souscription du contrat.</p>
	                         <p>Le CLIENT a toujours la possibilité de s’assurer d’un prix en contactant LE PETIT COIN SMARTPHONES.</p>

	                         <br/>
	                         <p><b>4) MODALITES DU PAIEMENT DIFFERE</b></p>
	                         <p><b><i>4.1) CONDITIONS</i></b></p>
	                         <p>Il est possible de payer en 3 fois (un acompte et deux mensualités). La mise en place de ces conditions de paiement préférentielles ne pourra intervenir qu’après accord express de LE PETIT COIN SMARTPHONES sur le prix du produit traité avec le CLIENT, et après paiement d’un premier apport payé au comptant. La première mensualité du PRÊT sera versée un (1) mois après l’achat, et le solde deux (2) mois après l’achat. Les dates précises des versements et les montants dus sont stipulés dans le contrat. Le CLIENT bénéficiaire de conditions préférentielles de paiement est soumis à l’obligation d’informer LE PETIT COIN SMARTPHONES en cas de déplacement hors de la ville d’Abidjan. Le CLIENT a également l’obligation de souscrire dans cette éventualité un contrat de cautionnement solidaire dépourvu du bénéfice de la discussion et du bénéfice la division, faute de quoi il sera fait état de sa défaillance. Le CLIENT n’est propriétaire du produit qu’après le solde de toutes ses mensualités.</p>

	                         <p><b><i>4.2) MODALITÉS DE RÈGLEMENT</i></b></p>
	                         <p>Les deux (2) mensualités sont payables par les modalités suivantes :</p>
	                         <ul>
					            <li>Au comptant (cash)</li>
					         </ul>
					         <p>Le paiement en cash est réalisé en magasin. A défaut, LE PETIT COIN SMARTPHONES conviendra du lieu de rencontre où le paiement sera effectué.</p>

					         <ul>
					            <li>Par transfert ORANGE MONEY au  <b>89-80-78-87</b></li>
					         </ul>
					         <p>Les frais de transfert et de retrait sont à la charge du CLIENT.</p>
					         <p>LE PETIT COIN SMARTPHONES se réserve le droit de modifier le numéro de transfert ORANGE MONEY après notification au CLIENT.</p>

					         <ul>
					            <li> Par prélèvement bancaire sur autorisation de prélèvement signée par le CLIENT</li>
					         </ul>
					         <p>Il appartient au CLIENT de s’assurer des fonds disponibles sur son compte courant. Le CLIENT est également soumis à l’obligation d’indiquer au PETIT COIN SMARTPHONES tout changement d’adresse de facturation bancaire.</p>
					         <p>La mise en place d’autres modalités de paiement est possible après accord avec LE PETIT COIN SMARTPHONES.</p>


					         <br/>
	                         <p><b>5) DEFAUT DE PAIEMENT</b></p>
	                         <p>Sauf report sollicité avant l’échéance et expressément accordé par LE PETIT COIN SMARTPHONES, le défaut de paiement d’une mensualité à l’échéance fixée entraîne après mise en demeure :</p>
	                         <ul>
					            <li> L’exigibilité immédiate par anticipation de toutes les sommes restant dues, quel que soit le mode de règlement prévu.</li>
					            <li>  L’exigibilité immédiate par anticipation de toutes les factures non encore échues.</li>
					            <li>  Le versement d’intérêts courants jusqu’à paiement effectif encaissé.</li>
					            <li>  L’exigibilité d’une indemnité forfaitaire égale à 15% des sommes dues.</li>
					            <li>  L’exigibilité immédiate de tous les frais d’huissiers et autres frais engagés pour le recouvrement.</li>
					         </ul>
					         <p>&nbsp;</p>
	                         <p>LE PETIT COIN SMARTPHONES se réserve le droit de faire état de la défaillance du CLIENT auprès de toute personne ou organisme susceptible de contribuer à la sauvegarde ou à la récupération des sommes dues.</p>
	                         <p>Le CLIENT autorise LE PETIT COIN SMARTPHONES à récupérer le produit du dit CONTRAT après deux semaines de non-paiement d’une mensualité à l’échéance fixée, pour recouvrer les sommes dues.</p>
	                         <p>LE PETIT COIN SMARTPHONES se réserve le droit de demander la résolution de la vente suite à la défaillance du CLIENT.</p>
	                         <p>La fausse déclaration du CLIENT sur les pièces fournies nécessaires à la réalisation du paiement différé emporte les mêmes effets que le défaut de paiement.</p>


	                         <br/>
	                         <p><b>6) GARANTIES COMMERCIALES</b></p>
	                         <p>LE PETIT COIN SMARTPHONES accorde une garantie commerciale pour vices cachés empêchant l’utilisation normale des produits durant un (1) mois. Toute réclamation doit être présentée, munie de la preuve d’achat, à l’adresse de LE PETIT COIN SMARTPHONES afin de faire constater le vice par le vendeur. Le défaut avéré du produit emporte le remplacement du produit défectueux par un produit de même nature, ou interruption du paiement différé avec remboursement des sommes perçues.</p>


	                         <br/>
	                         <p><b>7) INFORMATIQUE, LIBERTE & CONFIDENTIALITE</b></p>
	                         <p>Les informations personnelles recueillies dans le cadre du présent contrat ou, ultérieurement, à l’occasion de la relation avec les services du PETIT COIN SMARTPHONES (dont les informations concernant le dossier de prêt, les produits détenus, les médias et moyens de communication...) peuvent faire l’objet d’un traitement informatisé. Elles sont principalement utilisées par LE PETIT COIN SMARTPHONES pour les finalités suivantes : octroi de crédits, gestion de la relation, recouvrement, prospection, animation commerciale et études statistiques, évaluation du risque, sécurité et prévention de la fraude et obligations légales et réglementaires du PETIT COIN SMARTPHONES. Celles spécialement collectées lors de la demande de prêt sont obligatoires pour permettre la décision d’octroi de ce dernier : en cas de non réponse, le dossier pourra être refusé. LE PETIT COIN SMARTPHONES est autorisé par le CLIENT à partager le secret bancaire sur ses données personnelles en vue des mêmes finalités que celles précédemment indiquées au profit des établissements et sociétés membres du Groupe auquel appartient LE PETIT COIN SMARTPHONES, de ses partenaires (dont la liste peut être communiquée sur demande), de ses sous-traitants et prestataires et des autorités administratives et judiciaires légalement habilitées. Sur ses informations personnelles collectées le CLIENT dispose d'un droit d'accès et de rectification. En outre, le CLIENT peut se prévaloir d'un droit d'opposition, notamment pour l'utilisation desdites informations à des fins de prospection commerciale.</p>

	                         <br/>
	                         <p><b>8)  LES PRESENTS TERMES ET CONDITIONS SONT SOUMIS AU DROIT APPLICABLE EN COTE D’IVOIRE</b></p>

	                         <br/>
	                         <p><b>ATTESTATION DE LIVRAISON ET RECEPTION DU BIEN </b></p>
	                         <p>LE PETIT COIN SMARTPHONES</p>
	                         <p>- Certifie que le bien objet du financement a été livré (ou exécuté) intégralement, conformément aux références figurant sur le présent contrat.</p>

	                         <br/>
	                         <p>Date et Signature du CLIENT suivie de la mention ‘’lu et approuvé’’ :</p>


	                      </div>
	                    </div>
	                    
	                </div>

	                

	                <div class='row'>
                      <div class='col-sm-8'>
                      </div>
                       <div class='col-sm-4'>
                         <img src='".$base64."' width='150px'/>
                      </div>
                    </div>


	                    

                   </div>
				</div>
				</body>
			</html>";


			///var_dump($html);die;
        
		//$this->Crud_model->update_impression($id, array('is_imprimer' => 1));
		
        $this->Crud_model->generate_pdf($html, $name);
	}


	public function tomorrowPayement()
	{
	  if(!$this->ion_auth->logged_in())
	  {
	    redirect(site_url('main/login'), 'refresh');
	  }elseif($this->ion_auth->logged_in() && $this->session->userdata('nblogin') == 0)
	  {
	  	redirect(site_url('main/change_password'), 'refresh');
	  }
	  $page_data['page_title'] = 'Versement de demain';
	  $page_data['page_title_sous'] = 'Versements de demain';
	  $page_data['tomorrowPayement'] = $this->Crud_model->tomorrowPayement();
	  $this->load->view('template/header_principal', $page_data);
	  $this->load->view('tomorrowPayement', $page_data);
	  $this->load->view('template/footer_principal', $page_data);
	}


	public function JourProchainPayement()
	{
	  if(!$this->ion_auth->logged_in())
	  {
	    redirect(site_url('main/login'), 'refresh');
	  }elseif($this->ion_auth->logged_in() && $this->session->userdata('nblogin') == 0)
	  {
	  	redirect(site_url('main/change_password'), 'refresh');
	  }
	  /*$dateJ = date("Y-m-d");
      $dateDemain = strtotime($dateJ.' + 1 days');
      $dateDemain = date("Y-m-d", $dateDemain);
	  var_dump($dateDemain);die;*/
	  $page_data['page_title'] = 'Versements du '.jourSemaine().' prochain';
	  $page_data['page_title_sous'] = 'Versement';
	  $page_data['JourProchainPayement'] = $this->Crud_model->JourProchainPayement();
	  $this->load->view('template/header_principal', $page_data);
	  $this->load->view('JourProchainPayement', $page_data);
	  $this->load->view('template/footer_principal', $page_data);
	}

	public function enretard()
	{
	  if(!$this->ion_auth->logged_in())
	  {
	    redirect(site_url('main/login'), 'refresh');
	  }elseif($this->ion_auth->logged_in() && $this->session->userdata('nblogin') == 0)
	  {
	  	redirect(site_url('main/change_password'), 'refresh');
	  }
	  $page_data['page_title'] = 'Versement en retard';
	  $page_data['page_title_sous'] = 'versement';
	  $page_data['retard'] = $this->Crud_model->VersementEnRetard();
	  $this->load->view('template/header_principal', $page_data);
	  $this->load->view('v_retard', $page_data);
	  $this->load->view('template/footer_principal', $page_data);
	}

	public function semaine()
	{
	  if(!$this->ion_auth->logged_in())
	  {
	    redirect(site_url('main/login'), 'refresh');
	  }elseif($this->ion_auth->logged_in() && $this->session->userdata('nblogin') == 0)
	  {
	  	redirect(site_url('main/change_password'), 'refresh');
	  }
	  $page_data['page_title'] = 'Versement de la semaine';
	  $page_data['page_title_sous'] = 'versement';
	  $page_data['semaine'] = $this->Crud_model->VersementDeSemaine();
	  $this->load->view('v_semaine', $page_data);
	}

	public function todaypayement()
	{
	  if(!$this->ion_auth->logged_in())
	  {
	    redirect(site_url('main/login'), 'refresh');
	  }elseif($this->ion_auth->logged_in() && $this->session->userdata('nblogin') == 0)
	  {
	  	redirect(site_url('main/change_password'), 'refresh');
	  }
	  $page_data['page_title'] = 'Versement du jour';
	  $page_data['page_title_sous'] = 'versement';
	  $page_data['todaypayement'] = $this->Crud_model->VersementDuJour();
	  $this->load->view('template/header_principal', $page_data);
	  $this->load->view('todaypayement', $page_data);
	  $this->load->view('template/footer_principal', $page_data);
	}
	public function encours()
	{
	  if(!$this->ion_auth->logged_in())
	  {
	    redirect(site_url('main/login'), 'refresh');
	  }elseif($this->ion_auth->logged_in() && $this->session->userdata('nblogin') == 0)
	  {
	  	redirect(site_url('main/change_password'), 'refresh');
	  }
	  $page_data['page_title'] = 'Versement en cours';
	  $page_data['page_title_sous'] = 'versement';
	  $page_data['encours'] = $this->Crud_model->VersementEnCours();
	  $this->load->view('template/header_principal', $page_data);
	  $this->load->view('encours', $page_data);
	  $this->load->view('template/footer_principal', $page_data);
	}


}
