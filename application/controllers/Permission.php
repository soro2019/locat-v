<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Permission extends CI_Controller{

    public function __construct()
    {
      parent::__construct();
      $this->load->model("Crud_model");
    }

    public function add()
    {
        if($this->input->post())
        {
            if(empty($this->input->post('name')))
            {
                $this->session->set_flashdata('error', 'Please fill in the name of group.');
            }elseif(is_numeric($this->input->post('name')))
            {
                $this->session->set_flashdata('error', 'Group name format is invalid');
            }
            else{
                $id = $this->Crud_model->insertion_('groups',array('name' => test_inputValide($_POST['name']), 'description' => test_inputValide($_POST['description'])));
                $this->Crud_model->insertion_('permission',array('group_id',$id));
            }
            redirect(site_url('usermanagement/permission'), 'refresh');
        }
    }




    
}