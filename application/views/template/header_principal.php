<?php $setting = $this->Crud_model->selectSettings();?>
<?php $user = $this->Crud_model->selectUser($this->session->userdata('user_id'));?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo 'GEST-LOC'; ?> | <?=$page_title?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <link href="<?=site_url('assets/img/')?>apple-touch-icon.png" rel="apple-touch-icon">
  <link href=<?=site_url('assets/img/')?>favicon.ico rel=icon>

  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?=site_url('assets/bower_components')?>/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?=site_url('assets/bower_components')?>/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?=site_url('assets/bower_components')?>/Ionicons/css/ionicons.min.css">
  
  <!-- Select2 -->
  <link rel="stylesheet" href="<?=site_url('assets/bower_components')?>/select2/dist/css/select2.min.css">

  <!-- DataTables -->
  <link rel="stylesheet" href="<?=site_url('assets/bower_components')?>/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.5/css/responsive.bootstrap4.min.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="<?=site_url('assets/bower_components')?>/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?=site_url('assets/bower_components')?>/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="<?=site_url('assets/')?>plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

  <!-- Custom styles for this template -->
    <link href="<?=site_url('assets/css/style.css')?>" rel="stylesheet">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="<?=site_url('assets/')?>css/fonts.css">



  <!-- Theme style -->
  <link rel="stylesheet" href="<?=site_url('assets/')?>dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?=site_url('assets/')?>dist/css/skins/_all-skins.min.css">

  <link rel="stylesheet" href="<?=site_url('assets/')?>bower_components/jprobeweb/custom.css">
</head>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>I</b>C</span>
      <!-- logo for regular state and mobile devices -->
      <?php $chaine = explode(' ', $setting['system_name']); 
          //var_dump($chaine);die;
      ?>
      <span class="logo-lg"><b>GEST</b>Location</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          <!-- Notifications: style can be found in dropdown.less -->
          <!-- Tasks: style can be found in dropdown.less -->
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?=site_url('assets/')?>dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo ucfirst($user['first_name']).' '.$user['last_name']; ?></span>
            </a>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
              <li><a href="<?php echo site_url('main/edit_my_profile')?>">Profil</a></li>
              
              <li><a href="<?php echo site_url('main/logout') ?>">Deconnexion</a></li>
            </ul>
          </li>
          <!-- <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?=site_url('assets/')?>dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php if($this->session->userdata('first_name')) echo ucfirst($this->session->userdata('first_name')).' '.$this->session->userdata('last_name') ; ?></span>
            </a>
            <ul class="dropdown-menu" style="left: -122px !important;">
              
              <li class="user-header">
                <img src="<?=site_url('assets/')?>dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">

                <p>
                  <?php if($this->session->userdata('first_name')) echo ucfirst($this->session->userdata('first_name')).' '.$this->session->userdata('last_name') ; ?>
                  <small>Registered since <?php echo date($setting['format_date'], $this->session->userdata('created_on')) ?></small>
                </p>
              </li>
              Menu Body
              
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                   <a href="<?php echo site_url('main/logout') ?>" class="btn btn-default btn-flat">Sign out</a>
                  
                </div>
              </li>
            </ul>
          </li> -->
          
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <img src="<?=site_url('assets/')?>img/logo-light-inventorycount.png" class="img-logo" alt="User Image">
        <!-- <div class="pull-left image">
          <img src="<?=site_url('assets/')?>dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php if($this->session->userdata('first_name')) echo ucfirst($this->session->userdata('first_name')).' '.$this->session->userdata('last_name') ; ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div> -->
      </div>
      <!-- search form -->
      <!-- <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form> -->
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <?php 
        if($this->session->userdata('permission'))
        {
          $permission = $this->session->userdata('permission');
        }else
        {
          $champs = $this->db->list_fields('permission');
          foreach ($champs as $key => $field)
          {
            if($field != 'id' && $field != 'group_id')
            {
              $permission[$field] = 0;
            }
          }
        }
      //var_dump($permission);die;
      ?>
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <?php if($permission['main-dashbord']==1){ ?>
        <li class="<?php if($page_title=='Dashboard' || $page_title=='Versement de demain' || $page_title=='Versements du '.jourSemaine().' prochain' || $page_title=='Versement en retard' || $page_title=='Versement en cours'){ echo "active";} ?>">
          <a href="<?=site_url('main/dashboard')?>">
            <i class="fa fa-home"></i> <span>Tableau de bord</span>
          </a>
        </li>
        <?php } ?>
        <?php if($permission['product-add']==1 || $permission['product-list']==1 ||  $permission['product-import'] == 1){ ?>
         <li class="treeview <?php if($page_title=='Products'){ echo "active";} ?>">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>Gestion des véhicules </span>
            <span class="pull-right-container">
              
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <?php if($permission['product-add']==1){ ?>
             <li class="<?php if($page_title_sous=='add product'){ echo "active";} ?>"><a href="<?=site_url('products/add')?>"><i class="fa fa-circle-o"></i> Ajouter un véhicule</a></li>
            <?php } ?>
            <?php if($permission['product-list']==1){ ?>
            <li class="<?php if($page_title_sous=='list product'){ echo "active";} ?>"><a href="<?=site_url('products/list')?>"><i class="fa fa-circle-o"></i> Liste des véhicule</a></li>
            <?php } ?>
          </ul>
        </li>
        <?php } ?>
        <?php if($permission['sell-add']==1 || $permission['sell-list']==1 || $permission['sell-payments']==1 || $permission['sell-add_client']==1 || $permission['sell-list_client']==1){ ?>
          <li class="treeview <?php if($page_title=='Ventes' || $page_title=='Clients'){ echo "active";} ?>">
            <a href="#">
              <i class="fa fa-pie-chart"></i>
              <span>Location</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <?php if($permission['sell-add_client']==1){ ?>
              <li class="<?php if($page_title_sous=='Ajouter un client'){ echo "active";} ?>"><a href="<?=site_url('sells/add_client')?>"><i class="fa fa-circle-o"></i> Ajouter une location</a></li>
              <?php } ?>

              <?php if($permission['sell-list']==1){ ?>
               <li class="<?php if($page_title_sous=='Liste des ventes'){ echo "active";} ?>"><a href="<?=site_url('sells/list')?>"><i class="fa fa-circle-o"></i> Liste des location</a></li>
              <?php } ?>
            </ul>
          </li>
        <?php } ?>

         <?php if($permission['inventory-add']==1 || $permission['inventory-list']==1 || $permission['inventory-add_sub']==1 || $permission['inventory-list_sub']==1){ ?>
          <li class="treeview <?php if($page_title=='Inventaires'){ echo "active";} ?>">
            <a href="#">
              <i class="fa fa-pie-chart"></i>
              <span>Devis et Factures</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <?php if($permission['inventory-list']==1){ ?>
               <li class="<?php if($page_title_sous=='Liste des inventaires'){ echo "active";} ?>"><a href="<?=site_url('inventory/list')?>"><i class="fa fa-circle-o"></i> Ajouter un client</a></li>
              <?php } ?>
              <?php if($permission['inventory-list_sub']==1){ ?>
              <li class="<?php if($page_title_sous=='Liste des blocks'){ echo "active";} ?>"><a href="<?=site_url('inventory/list_sub')?>"><i class="fa fa-circle-o"></i> Liste des clients</a></li>
              <?php } ?>
            </ul>
          </li>
        <?php } ?>







        <?php if($permission['inventory-add']==1 || $permission['inventory-list']==1 || $permission['inventory-add_sub']==1 || $permission['inventory-list_sub']==1){ ?>
          <li class="treeview <?php if($page_title=='Inventaires'){ echo "active";} ?>">
            <a href="#">
              <i class="fa fa-pie-chart"></i>
              <span>Gestion des clients</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <?php if($permission['inventory-list']==1){ ?>
               <li class="<?php if($page_title_sous=='Liste des inventaires'){ echo "active";} ?>"><a href="<?=site_url('inventory/list')?>"><i class="fa fa-circle-o"></i> Ajouter un client</a></li>
              <?php } ?>
              <?php if($permission['inventory-list_sub']==1){ ?>
              <li class="<?php if($page_title_sous=='Liste des blocks'){ echo "active";} ?>"><a href="<?=site_url('inventory/list_sub')?>"><i class="fa fa-circle-o"></i> Liste des clients</a></li>
              <?php } ?>
            </ul>
          </li>
        <?php } ?>



     <?php if($permission['inventory-add']==1 || $permission['inventory-list']==1 || $permission['inventory-add_sub']==1 || $permission['inventory-list_sub']==1){ ?>
          <li class="treeview <?php if($page_title=='Inventaires'){ echo "active";} ?>">
            <a href="#">
              <i class="fa fa-pie-chart"></i>
              <span>Paramètres</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <?php if($permission['inventory-list']==1){ ?>
               <li class="<?php if($page_title_sous=='Liste des inventaires'){ echo "active";} ?>"><a href="<?=site_url('inventory/list')?>"><i class="fa fa-circle-o"></i> Contact et echanges</a></li>
              <?php } ?>
               <?php if($permission['inventory-list_sub']==1){ ?>
              <li class="<?php if($page_title_sous=='Liste des blocks'){ echo "active";} ?>"><a href="<?=site_url('inventory/list_sub')?>"><i class="fa fa-circle-o"></i> Zones de contacts</a></li>
              <?php } ?>
             

  <?php if($permission['inventory-list_sub']==1){ ?>
              <li class="<?php if($page_title_sous=='Liste des blocks'){ echo "active";} ?>"><a href="<?=site_url('inventory/list_sub')?>"><i class="fa fa-circle-o"></i> Devis et factures</a></li>
              <?php } ?>

              <?php if($permission['inventory-list_sub']==1){ ?>
              <li class="<?php if($page_title_sous=='Liste des blocks'){ echo "active";} ?>"><a href="<?=site_url('inventory/list_sub')?>"><i class="fa fa-circle-o"></i> Taxes et TVA</a></li>
              <?php } ?>


              <?php if($permission['inventory-list_sub']==1){ ?>
              <li class="<?php if($page_title_sous=='Liste des blocks'){ echo "active";} ?>"><a href="<?=site_url('inventory/list_sub')?>"><i class="fa fa-circle-o"></i> Comptabilite</a></li>
              <?php } ?>



               <?php if($permission['inventory-list_sub']==1){ ?>
              <li class="<?php if($page_title_sous=='Liste des blocks'){ echo "active";} ?>"><a href="<?=site_url('inventory/list_sub')?>"><i class="fa fa-circle-o"></i> Numerotation</a></li>
              <?php } ?>



              


               <?php if($permission['inventory-list_sub']==1){ ?>
              <li class="<?php if($page_title_sous=='Liste des blocks'){ echo "active";} ?>"><a href="<?=site_url('inventory/list_sub')?>"><i class="fa fa-circle-o"></i> Option</a></li>
              <?php } ?>




              <?php if($permission['inventory-list_sub']==1){ ?>
              <li class="<?php if($page_title_sous=='Liste des blocks'){ echo "active";} ?>"><a href="<?=site_url('inventory/list_sub')?>"><i class="fa fa-circle-o"></i> Autres</a></li>
              <?php } ?>





            </ul>
          </li>
        <?php } ?>




        <li class="header">EXTRA</li>
        <?php if($permission['backups']==1){ ?>
        <!-- <li class="<?php if($page_title=='Backups'){ echo "active";} ?>"><a href="<?=site_url('backups')?>"><i class="fa fa-circle-o text-red"></i> <span>Backups</span></a></li> -->
        <?php } ?>
        <li class="<?php if($page_title=='Documentation'){ echo "active";} ?>"><a href="<?=site_url('main/documentation')?>"><i class="fa fa-circle-o text-blue"></i> <span>Documentation</span></a></li>

<!-- PARAMETRE ----->











      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        
      </h1>
      <ol class="breadcrumb pl-10">
        <?php if($page_title_sous=='Dashboard'){ ?>
         <li><i class="fa fa-home"></i> Home</li>
        <?php } ?>
        <?php if($page_title_sous!='Dashboard'){ ?>
          <li><a href="<?=site_url('main/dashboard')?>"><i class="fa fa-home"></i> Home</a></li>
        <li class="active"><?=$page_title_sous?></li>
        <?php } ?>
      </ol>
    </section>


