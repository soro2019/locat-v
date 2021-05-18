<style type="text/css">
  th{
     font-size: 10px;  }
</style>

<?php defined('BASEPATH') OR exit('No direct script access allowed');
  $group_id = $this->session->userdata('group_id');
  $permissions = $this->Crud_model->getPermission($group_id);
?><!-- Main content -->

<section class="content">
  <div class="row">
    <div class="col-sm-12">
      <!-- /.box -->
    	<div class="box box-default">
        <div class="box-header with-border">
          <div class="container-fluid">
    		    <h3 class="box-title">Liste des clients</h3>
          </div>
    		</div>
        <div class="row">
          <div class="col-sm-12">
    		      <?php  $setting = $this->Crud_model->selectSettings(); if($this->session->flashdata('message')) {   ?>
                             
              <br><div class="alert alert-success alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <label id="testemise"><?php echo $this->session->flashdata('message'); ?></label>
                
              </div>
              <?php  } ?>
              <?php if($this->session->flashdata('error')) {   ?>
              <br><div class="alert alert-warning alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <?php echo $this->session->flashdata('error'); ?>
              </div>
              <?php  } ?>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-12">
        		<div class="box-body">
              <div class="container-fluid">
                <br>
                <div class="table-responsive">
            		  <table id="example1" class="table table-bordered table-striped">
            		    <thead>
            		    <tr>
                       <th>ID</th>
                       <th>Date S</th>
            		       <th>Nom & Prénoms</th>
            		       <th>Contact1</th>
                       <th>Cantact2</th>
                       <th>Email</th>
                       <th>Profession</th>
                       <th>Lieu H</th>
                       <th>Date de naiss</th>
                       <th>Lieu de naiss</th>
            		       <th>Actions</th>
            		    </tr>
            		    </thead>
            		    <tbody>
            		     <?php if(!is_bool($users)){ foreach ($users as $user) { ?>
            			    <tr>
                        <td><?=$user['IDDOSSIER']?></td>
                        <td><?=date("d/m/Y",$user['date_add'])?></td>
            			      <td><?=ucfirst($user['full_name'])?> <?=ucfirst($user['prenoms'])?></td>
            			      <td><?=$user['contact']?></td>
                        <td><?=$user['contact_2']?></td>
                        <td><?=$user['email']?></td>
                        <td><?=$user['profession']?></td>
                        <td><?=$user['lieu_habitation']?></td>
                        <td><?php if($user['date_naiss'] != "0000-00-00") echo $user['date_naiss']?></td>
                        <td><?=$user['lieu_naiss']?></td>
            			      <td>
            			      	<div class="btn-group">
              						  <button data-toggle="dropdown" class="btn btn-default btn-sm dropdown-toggle" type="button">
              							  Actions <span class="caret"></span></button>
              						  <ul class="dropdown-menu">
                              <li><a type="button" href="#" data-backdrop="static" data-toggle="modal" data-target="#Modclient" onclick="modclient(<?=$user['id']?>)">Modifier</a></li>

                              <?php if($permissions['client-delete'] == 1){?>
                              <li><a type="button" href="#" data-backdrop="static" data-toggle="modal" data-target="#Suppclient" onclick="">Supprimer</a></li><?php } ?>
              						  </ul>
            					    </div>
            			      </td>
            			    </tr>
            			  <?php } } ?>
            		    </tbody>
            		  </table>
                </div>
                <br>
              </div>
        		</div>
        		<!-- /.box-body -->
          </div>
        </div>
    	</div>
    	<!-- /.box -->
    </div>
  </div>
</section>
<!-- /.content -->
<div class="modal modal-default fade" id="Modclient">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">
                    <center>
                        <h2 class="box-title">Modification du client</h2>
                    </center>
                </h4>
            </div>
            <div class="modal-body box box-primary" id="modclient">
                 
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>  
</div>


<script type="text/javascript">

  function modclient(id_client){
    var base_url = "<?php echo base_url('sells/');?>";
    $.ajax({
            url: base_url+'modeclient/',
            type: 'POST',
            data : {id_client : id_client},
            dataType: 'json',
            success:function(response) {
                document.getElementById('modclient').innerHTML=response;
            }
        });
     
  }
</script>
