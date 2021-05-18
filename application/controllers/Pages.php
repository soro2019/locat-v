<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Crud_model');
	}


	public function index()
	{
	  $page_data['page_title'] = 'Profile';
	  $page_data['page_title_sous'] = 'Edit my profile';
	  $page_data['nbproduct'] = 0;
	  $this->load->view('page_view', $page_data);
	}


}