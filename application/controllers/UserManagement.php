<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserManagement extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Crud_model');
		$this->load->library('form_validation');
	}


	public function list()
	{
	  $page_data['page_title'] = 'Gestion Utilisateur';
	  $page_data['page_title_sous'] = 'Users list';
	  if(!$this->ion_auth->logged_in())
	  {
	   redirect(site_url('main/login'), 'refresh');
	  }
	  $page_data['nbproduct'] = 0;
	  if(!is_bool($this->Crud_model->selectAllProduit())) {
	  	$page_data['nbproduct'] = count($this->Crud_model->selectAllProduit());
	  }
	  $page_data['users'] = $this->Crud_model->selectAllOrOneUsers();
	  $this->load->view('template/header_principal', $page_data);
	  $this->load->view('list_user', $page_data);
	  $this->load->view('template/footer_principal', $page_data);
	}

	public function add()
	{
		if(!$this->ion_auth->logged_in())
		{
		  redirect(site_url('main/login'), 'refresh');
		}

		$page_data['nbproduct'] = 0;
		if(!is_bool($this->Crud_model->selectAllProduit())) {
		  $page_data['nbproduct'] = count($this->Crud_model->selectAllProduit());
		}
		$page_data['groups'] = $this->Crud_model->selectAllGroup();
    	$page_data['page_title'] = 'Gestion Utilisateur';
		$page_data['page_title_sous'] = 'Add user';

		$tables = $this->config->item('tables', 'ion_auth');
		$identity_column = $this->config->item('identity', 'ion_auth');
		$this->data['identity_column'] = $identity_column;
		if($this->input->post())
		{
          if(empty($_POST['first_name']) || empty($_POST['last_name']) || empty($_POST['identity']) || empty($_POST['group']))
          {
            $this->session->set_flashdata('error', 'Merci de renseingner tous les champs avec *');
          }/*elseif($_POST['password'] != $_POST['password_confirm'])
          {
          	$this->session->set_flashdata('error', 'Your two passwords do not match');

          }*/elseif(!empty($_POST['email']) && $this->Crud_model->EmailExiste($_POST['email']))
          {
          	$this->session->set_flashdata('error', 'Cette adresse mail est déjà utilisée');

          }elseif($this->Crud_model->UsernameExiste($_POST['identity']))
          {
          	$this->session->set_flashdata('error', 'Nom d\'utilisateur déjà utilisé');

          }/*elseif(strlen($_POST["password"]) < $this->data['min_password_length'])
          {
          	$this->session->set_flashdata('error', 'Your Password Must Contain At Least'.$this->data['min_password_length'].'Characters!');
          }elseif(!preg_match("#[0-9]+#",$_POST["password"]))
          {
          	$this->session->set_flashdata('error', 'Your Password Must Contain At Least 1 Number!');
          }elseif(!preg_match("#[A-Z]+#",$_POST["password"]))
          {
          	$this->session->set_flashdata('error', 'Your Password Must Contain At Least 1 Capital Letter!');
          }elseif(!preg_match("#[a-z]+#",$_POST["password"]))
          {
          	$this->session->set_flashdata('error', 'Your Password Must Contain At Least 1 Lowercase Letter!');
          }*/elseif(!empty($_POST['phone']) && preg_match('/^[0-9]{10}+$/', $_POST['phone']))
          {
			$this->session->set_flashdata('error', 'Le numéro est invalide');
          }elseif(is_numeric($_POST['first_name']))
          {
			$this->session->set_flashdata('error', 'Format du nom est invalide');
          }elseif(is_numeric($_POST['last_name']))
          {
			$this->session->set_flashdata('error', 'Prénoms invalide');
          }elseif(is_numeric($_POST['identity']))
          {
			$this->session->set_flashdata('error', 'Nom d\'utilisateur invalide');

          }elseif(!empty($_POST['email']) && !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
          {
            $this->session->set_flashdata('error', 'Adresse email invalide');
          }else
          {
          	$status = 1;
          	$email = !empty($_POST['email']) ? strtolower($this->input->post('email')) : '';
			$identity = $this->input->post('identity');
			$password = "00000";
			$additional_data = [
					'first_name' => $this->input->post('first_name'),
					'last_name' => $this->input->post('last_name'),
					'phone' => $this->input->post('phone'),
					'active' => $status,
					'company' => strtoupper($this->Crud_model->getGroupById($this->input->post('group'))),
				];
			//var_dump($email, $identity, $additional_data);die;
			if($this->ion_auth->register($identity, $password, $email, $additional_data, [$this->input->post('group')]))
			{
				$this->session->set_flashdata('message', $this->ion_auth->messages());
				redirect("usermanagement/add", 'refresh');
			}

          }
		}
		
		$this->load->view('template/header_principal', $page_data);
	    $this->load->view('add_user', $page_data);
	    $this->load->view('template/footer_principal', $page_data);
	}

	public function changestatusaccount()
	{
	  $id = (int) $this->uri->segment(3);
	  if(empty($id) || $id==0)
	  {
	  	$this->session->set_flashdata('error', 'ID invalid');
	  	redirect(site_url('usermanagement/list'), 'refresh');
	  }
	  $user = $this->Crud_model->selectAllOrOneUsers($id);
	  $data =  array('active' => 1);//compte active
	  if($user['active']==1)
	  {
	  	$data = array('active' => 0);//compte desactive
	  }
	  $this->db->where('id', $user['id']);
	  $this->db->update('users', $data);
	  redirect(site_url('usermanagement/list'), 'refresh');
	}

	public function permission($param="", $param2="")
	{
		if(!$this->ion_auth->logged_in())
		{
		  redirect(site_url('main/login'), 'refresh');
		}
		$current_page = 'permission';
		$page_data['nbproduct'] = 0;
		if(!is_bool($this->Crud_model->selectAllProduit())) {
		  $page_data['nbproduct'] = count($this->Crud_model->selectAllProduit());
		}
		$page_data['groups'] = $this->Crud_model->selectAllGroup();
    	$page_data['page_title'] = 'Gestion Utilisateur';
		$page_data['page_title_sous'] = 'permission';
		if($param=='autorisation')
		{
		 //var_dump($param2);die;
		 $current_page = 'autorisation';
		 $page_data['permission'] =  $this->Crud_model->getPermission($param2);
		 //var_dump($page_data['permission']);die;
		}
		if($param=='add')
		{
			if($this->input->post())
	        {
	        	if(empty($this->input->post('name')))
	            {
	              $this->session->set_flashdata('error', 'Merci de saisir le nom du groupe');
	            }elseif(is_numeric($this->input->post('name')))
	            {
	                $this->session->set_flashdata('error', 'Nom du groupe invalide');
	            }elseif(!is_bool($this->Crud_model->nameExist('groups', 'name', $this->input->post('name'))))
	            {
	              $this->session->set_flashdata('error', 'This group already exists');
	            }else
	            {
	              if($id = $this->Crud_model->insertion_('groups',array('name' => strtolower(test_inputValide($_POST['name'])) , 'description' => test_inputValide($_POST['description']))))
	              {
                     $this->Crud_model->insertion_('permission', array('group_id' => $id));
                     $this->session->set_flashdata('message', 'Groupe ajouter avec succès');
	              }
	            }
	           redirect(site_url('usermanagement/permission'), 'refresh');
	        }
		}
		if($param=='edit')
		{
			if($this->input->post())
	        {
	        	if(empty($this->input->post('name')))
	            {
	              $this->session->set_flashdata('error', 'Merci de saisir le nom du groupe');
	            }elseif(is_numeric($this->input->post('name')))
	            {
	                $this->session->set_flashdata('error', 'Nom de groupe invalide');
	            }elseif(!is_bool($this->Crud_model->nameExist('groups', 'name', $this->input->post('name'))))
	            {
	              $this->session->set_flashdata('error', 'Cet groupe existe déjà');
	            }else
	            {
	              if($id = $this->Crud_model->update_where('groups', array('name' => strtolower(test_inputValide($_POST['name'])), 'description' => test_inputValide($_POST['description'])), $param2, 'id'))
	              {
                     //$this->Crud_model->update_where('permission', array('group_id' => $id));
                     $this->session->set_flashdata('message', 'Groupe modifier avec succès');
	              }
	            }
	           redirect(site_url('usermanagement/permission'), 'refresh');
	        }
		}
		$page_data['id_group'] = $param2;
		$this->load->view('template/header_principal', $page_data);
	    $this->load->view($current_page, $page_data);
	    $this->load->view('template/footer_principal', $page_data);
	}


	public function modalviewusers()
	{
		if(!$this->ion_auth->logged_in())
	    {
	      redirect(site_url('main/login'), 'refresh');
	    }elseif($this->ion_auth->logged_in() && $this->session->userdata('nblogin') == 0)
	    {
	        redirect(site_url('main/change_password'), 'refresh');
	    }
	    $user = $this->Crud_model->selectAllOrOneUsers($_POST['user_id']);
	    $setting = $this->Crud_model->selectSettings();

	    $result = '<div class="modal-body">
                            <div class="row">
                            	<div class="col-sm-6">
                            		Utilisateur : '.$user['username'].'
                            	</div>
                            	<div class="col-sm-6">
                            		Email : '.$user['email'].'
                            	</div>
                            </div><br>
                            <div class="row">
                            	<div class="col-sm-6">
                            		Nom et Prénoms : '.$user['first_name'].' '.$user['last_name'].'
                            	</div>
                            	<div class="col-sm-6">
                            		Tel : '.$user['phone'].'
                            	</div>
                            </div><br>
                            <div class="row">
                            	<div class="col-sm-6">
                            		Groupe : '.$user['company'].'
                            	</div>
                            </div><br>
                            <div class="row">
                            	<div class="col-sm-6">
                            		Statut : ';
                            	if($user['active']==1)
                        		{ 
                        			$result .=  '<span class="label label-success">active</span>'; 
                        		}else
                        		{ 
                        			$result .=  '<span class="label label-danger">inactive</span>'; 
                            	} 
                            $result .=  '</div>
                            	<div class="col-sm-6">
                            		Dernière Connexion : ';
                            	if(empty($user['last_login']))
                            	{ 
                            		$result .=  "Jamais connecté";
                        		}else
                        		{
                        			$result .= date($setting['format_date'], $user['last_login']); 
                        	    }
                          $result .='</div>
                            </div><br>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
                          </div>';
         echo json_encode($result);
	}

	public function modalchangestatususer()
	{
		if(!$this->ion_auth->logged_in())
	    {
	      redirect(site_url('main/login'), 'refresh');
	    }elseif($this->ion_auth->logged_in() && $this->session->userdata('nblogin') == 0)
	    {
	        redirect(site_url('main/change_password'), 'refresh');
	    }
	    $user = $this->Crud_model->selectAllOrOneUsers($_POST['user_id']);
	    $setting = $this->Crud_model->selectSettings();

	    $result = '<div class="modal-body">
                      <div class="row">
                      	<div class="col-sm-12">';
                      	if($user['active']==1)
                      	{
                      		$result .=  'Voulez-vous vraiment désactiver ce compte ?'; 
                        }else
                        { 
                        	$result .=  'Voulez-vous vraiment activer ce compte ?'; 
                        } 
                      $result .=  '	</div>
                      </div><br>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-danger" data-dismiss="modal">NON</button>
                      <a href="'.site_url('usermanagement/changestatusaccount/'.$user['id']).'" type="button" class="btn btn-success">OUI</a>
                    </div>';
         echo json_encode($result);
	}

	public function modaleditgroup()
	{
		if(!$this->ion_auth->logged_in())
	    {
	      redirect(site_url('main/login'), 'refresh');
	    }elseif($this->ion_auth->logged_in() && $this->session->userdata('nblogin') == 0)
	    {
	        redirect(site_url('main/change_password'), 'refresh');
	    }
	    $groups = $this->Crud_model->selectOneGroup($_POST['group_id']);

	     $result = '<form class="form-horizontal" action="'.site_url('usermanagement/permission/edit/'.$groups['id']).'" method="POST">
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <label for="Title">Nom du groupe *</label>
                                           <input type="text" class="form-control" name="name" id="Title" placeholder="Nom du groupe" value="'.$groups['name'].'" required>
                                        </div>
                                    </div><br>
                                    <div class="row">
                                        <div class="col-sm-12">
                                          <label for="Title">Description </label>
                                           <textarea class="form-control" name="description" id="inputDescription" rows="10" placeholder="Description">'.$groups['description'].'</textarea>
                                        </div>
                                    </div><br>
                                </div>
                                <div class="modal-footer">
                                 <button type="submit" class="btn btn-success">Modifier</button>
                                </div>
                           </form>';
        echo json_encode($result);
	}

	public function update_permission($id_group)
    {
        //var_dump('champs');
        if($this->input->post('btn'))
        {
            $champs = $this->db->list_fields('permission');
            $data = $this->zero_fields($champs, $this->input->post());
            //var_dump($data);die;
            $this->Crud_model->updateGen(array('group_id' => $id_group), $data, 'permission');
            $this->session->set_flashdata('message', 'Mise à jour réussie');
            redirect(site_url('usermanagement/permission'), 'refresh');
        }
        
    }

    function zero_fields($champs, $post)
    {
        $data = array();
        //var_dump($post);die;
        foreach ($champs as $key => $field)
        {
            //var_dump($field);
            if($field != 'id' && $field != 'group_id')
            {
                //var_dump($field);
                if(!(array_key_exists($field,$post)))
                {
                    $data[$field] = 0;
                }
                else{
                    $data[$field] = 1;
                }
            }
            
        }//die;
        return $data;
    }


}
