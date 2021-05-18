<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Divers extends CI_Controller{

    public function __construct()
    {
      parent::__construct();
      $this->load->model("Crud_model");
    }

    public function categories($id_modif=0)
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
        $page_data['page_title'] = 'Category';
        $page_data['page_title_sous'] = '';

        $page_data['categories'] = $this->Crud_model->selectAllCategory();

        if($this->input->post())
        {
          if(empty($this->input->post('name')))
          {
              $this->session->set_flashdata('error', 'Please fill in the name of the category.');
          }elseif(is_numeric($this->input->post('name')))
          {
           $this->session->set_flashdata('error', 'Category name format is invalid');
          }
          elseif($this->Crud_model->categoryExist($name = strtolower(test_inputValide($_POST['name']))))
          {
            $this->session->set_flashdata('error', 'Category exist');  
          }elseif($id_modif != 0)
          {
            if($this->Crud_model->update_category($id_modif,test_inputValide($_POST['name']) , test_inputValide($_POST['description'])))
            {
              $this->session->set_flashdata('message', 'Category successfully modified');
            }
            //redirect(site_url('divers/categories'), 'refresh');
          }else
          {
            $data = array(
              'name' => $name,
              'description' => test_inputValide($_POST['description']),
            );

            if($this->Crud_model->insertion_('sma_categories', $data))
            {
              $this->session->set_flashdata('message', 'Category successfully added');
              //redirect(site_url('divers/categories'), 'refresh');
            }else
            {
              $this->session->set_flashdata('error', 'Systeme error');
            }
          }
          redirect(site_url('divers/categories'), 'refresh');
        }
        $this->load->view('template/header_principal', $page_data);
        $this->load->view('categories', $page_data);
        $this->load->view('categories_list', $page_data);
        $this->load->view('template/footer_principal', $page_data);      
    }






    public function delete_category($id)
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
      $this->Crud_model->delete_row('sma_categories',array('id' =>$id));

      $this->session->set_flashdata('message', 'Category successfully deleted');
      redirect(site_url('divers/categories'), 'refresh');
    }






    public function brands($id_modif=0)
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
        $page_data['page_title'] = 'Marques';
        $page_data['page_title_sous'] = 'Marque';

        $page_data['brands'] = $this->Crud_model->selectAllBrand();

        if($this->input->post())
        {
          if(empty($this->input->post('name')))
          {
              $this->session->set_flashdata('error', 'Saisir le nom de la marque.');
          }elseif(is_numeric($this->input->post('name')))
          {
           $this->session->set_flashdata('error', 'Le nom saisi est invalide');
          }
          elseif($this->Crud_model->brandExist($name = strtolower(test_inputValide($_POST['name']))))
          {
            $this->session->set_flashdata('error', 'Cette marque existe déjà');  
          }elseif($id_modif!=0){
            $this->Crud_model->update_brand($id_modif, test_inputValide($_POST['name']) , test_inputValide($_POST['description']));
            $this->session->set_flashdata('message', 'Marque modifiée avec succès');
            //redirect(site_url('divers/brands'), 'refresh');
          }else
          {
            $data = array(
              'name' => $name,
              'description' => $_POST['description'],
            );
            if($this->Crud_model->insertion_('brands', $data))
            {
              $this->session->set_flashdata('message', 'Marque ajoutée avec succès');
              //redirect(site_url('divers/brands'), 'refresh');
            }else
            {
              $this->session->set_flashdata('error', 'Systeme error');
            }

          }

          redirect(site_url('divers/brands'), 'refresh');
        }

        $this->load->view('template/header_principal', $page_data);
        $this->load->view('brands', $page_data);
        $this->load->view('brands_list', $page_data);
        $this->load->view('template/footer_principal', $page_data);      
    }

    public function delete_brand($id)
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
      $this->Crud_model->delete_row('brands',array('id' =>$id));
      $this->session->set_flashdata('message', 'Marque supprimée avec succès');
      redirect(site_url('divers/brands'), 'refresh');
    }

    public function warehouses($id_modif=0)
    {
      if(!$this->ion_auth->logged_in())
      {
        redirect(site_url('main/connection'), 'refresh');
      }elseif($this->ion_auth->logged_in() && $this->session->userdata('nblogin') == 0)
      {
        redirect(site_url('main/change_password'), 'refresh');
      }
      $page_data['nbproduct'] = 0;
      if (!is_bool($this->Crud_model->selectAllProduit())) {
        $page_data['nbproduct'] = count($this->Crud_model->selectAllProduit());
      }

      $page_data['warehouses'] = $this->Crud_model->selectAllWarehouse();
      $page_data['page_title'] = 'Warehouses';
      $page_data['page_title_sous'] = '';

      if($this->input->post())
      {
        if(empty($this->input->post('name')))
        {
            $this->session->set_flashdata('error', 'Please fill in the name of the warehouse.');
        }elseif(is_numeric($this->input->post('name')))
        {
         $this->session->set_flashdata('error', 'Warehouse name format is invalid');
        }
        elseif($id_modif!=0){
          $this->Crud_model->updateGen(array('id'=>$id_modif), array('name'=>$name) , 'warehouse');
          $this->session->set_flashdata('message', 'Warehouse successfully modified');
          //redirect(site_url('divers/brands'), 'refresh');
        }elseif($this->Crud_model->nameExist('warehouse','name',$name = strtolower(test_inputValide($_POST['name']))))
        {
          $this->session->set_flashdata('error', 'Warehouse exist');  
        }else
        {
          $data = array(
            'name' => $name,
            'create' => time(),
          );
          if($this->Crud_model->insertion_('warehouse', $data))
          {
            $this->session->set_flashdata('message', 'Brand successfully added');
            //redirect(site_url('divers/brands'), 'refresh');
          }else
          {
            $this->session->set_flashdata('error', 'Systeme error');
          }

        }

        redirect(site_url('divers/warehouses'), 'refresh');
      }
  
  
      $this->load->view('template/header_principal', $page_data);
      $this->load->view('warehouses', $page_data);
      $this->load->view('warehouses_list', $page_data);
      $this->load->view('template/footer_principal', $page_data); 
      
    }

    public function delete_warehouse($id_ware)
    {
      if(!$this->ion_auth->logged_in())
      {
        redirect(site_url('main/connection'), 'refresh');
      }elseif($this->ion_auth->logged_in() && $this->session->userdata('nblogin') == 0)
      {
        redirect(site_url('main/change_password'), 'refresh');
      }
      $page_data['nbproduct'] = 0;
      if (!is_bool($this->Crud_model->selectAllProduit())) {
        $page_data['nbproduct'] = count($this->Crud_model->selectAllProduit());
      }
      $this->Crud_model->delete_row('warehouse',array('id' =>$id_ware));
      $this->session->set_flashdata('message', 'warehouse successfully deleted');
      redirect(site_url('divers/warehouses'), 'refresh');      
    }

}