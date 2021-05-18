<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Crud_model');
	}

	public function system_settings()
	{
	  if(!$this->ion_auth->logged_in())
      {
        redirect(site_url('main/login'), 'refresh');
      }elseif($this->ion_auth->logged_in() && $this->session->userdata('nblogin') == 0)
      {
        redirect(site_url('main/change_password'), 'refresh');
      }
	  $page_data['page_title'] = 'Paramétre';
	  $page_data['page_title_sous'] = 'Système';
	  $page_data['nbproduct'] = 0;
	  if(!is_bool($this->Crud_model->selectAllProduit())) {
	  	$page_data['nbproduct'] = count($this->Crud_model->selectAllProduit());
	  }
	  $page_data['date_format'] = $this->Crud_model->selectFormatDate();
	  $page_data['languages'] = $this->Crud_model->selectLangauge();
	 // var_dump($page_data['date_format']);die;
	  $page_data['setting'] = $this->Crud_model->selectSettings();
	  $page_data['time_zones'] = $this->Crud_model->selectTimeZones();

	  if($this->input->post())
	  {
	  	if(empty($_POST['name']) || empty($_POST['format_date']) || empty($_POST['time_zone']) || empty($_POST['language']))
	  	{
	  		$this->session->set_flashdata('error', 'Merci de remplir tous les champs');
	  	}else
	  	{
	  		$data = array( 'system_name' => test_inputValide($_POST['name']),
	  					   'format_date' => test_inputValide($_POST['format_date']),
	  					   'time_zone' => test_inputValide($_POST['time_zone']),
	  					   'language' => test_inputValide($_POST['language']),
	  					   'date_update' => time(),
	  		             );
	  		$this->db->update('settings', $data);
	  		$this->session->set_flashdata('message', 'Paramétres modifiés succès');
	  		redirect(site_url('settings/system_settings'), 'refresh');
	  	}
	  }

	  $this->load->view('template/header_principal', $page_data);
	  $this->load->view('system_parameter', $page_data);
	  $this->load->view('template/footer_principal', $page_data);
	}

	public function product_setting()
	{
	  if(!$this->ion_auth->logged_in())
      {
        redirect(site_url('main/login'), 'refresh');
      }elseif($this->ion_auth->logged_in() && $this->session->userdata('nblogin') == 0)
      {
        redirect(site_url('main/change_password'), 'refresh');
      }
	  $page_data['page_title'] = 'Settings';
	  $page_data['page_title_sous'] = 'Products setting';
	  $page_data['nbproduct'] = 0;
	  if(!is_bool($this->Crud_model->selectAllProduit())) {
	  	$page_data['nbproduct'] = count($this->Crud_model->selectAllProduit());
	  }
	  $page_data['champs'] = $this->Crud_model->selectChampProduct();
	  if($this->input->post())
	  {
	  	if(empty($this->input->post()) || count($this->input->post()) < 2)
	  	{
	  	 $this->session->set_flashdata('error', 'At least two fields must be selected');
	  	 //$this->session->mark_as_temp('error', 5);
	  	}else
	  	{
	  		$data = array('code' => 1,'ref' => 1,'name' => 1,'category' => 1,'quantity' => 1,'brand' => 1,'supplier' => 1,'location' => 1, 'price' => 1 , 'warehouse' => 1);
	  		if(!array_key_exists('code', $_POST)) {
				$data['code'] = 0;
			}
			if(!array_key_exists('ref', $_POST)) {
				$data['ref'] = 0;
			}
			if(!array_key_exists('name', $_POST)) {
				$data['name'] = 0;
			}
			if(!array_key_exists('category', $_POST)) {
				$data['category'] = 0;
			}
			if(!array_key_exists('quantity', $_POST)) {
				$data['quantity'] = 0;
			}
			if(!array_key_exists('brand', $_POST)) {
				$data['brand'] = 0;
			}
			if(!array_key_exists('supplier', $_POST)) {
				$data['supplier'] = 0;
			}
			if(!array_key_exists('warehouse', $_POST)) {
				$data['warehouse'] = 0;
				$data['location'] = 0;
			}
			if(!array_key_exists('price', $_POST)) {
				$data['price'] = 0;
			}
           if($this->Crud_model->operation_update($data, 'product_settings'))
           {
           	$this->session->set_flashdata('message', 'Update successfully completed');
           	redirect(site_url('settings/product_setting') ,'refresh');
           }else
           {
           	 $this->session->set_flashdata('error', 'System error');
           }
	  	}
	  }
	  $this->load->view('template/header_principal', $page_data);
	  $this->load->view('database_setting', $page_data);
	  $this->load->view('template/footer_principal', $page_data);
	}

	



}
