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
    		    <h3 class="box-title">Users List</h3>
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
            		      <th><input type="checkbox" name="checked0" onclick="toggle(this);"></th>
            		       <th>Login</th>
            		       <th>Email</th>
            		       <th>Nom & Prénoms</th>
            		       <th>Contact</th>
                       <th>Groupe</th>
            		       <th>Statut</th>
            		       <th>Dernière connexion</th>
            		      <th>Actions</th>
            		    </tr>
            		    </thead>
            		    <tbody>
            		     <?php foreach ($users as $user) { ?>
            			    <tr>
            			      <td><input type="checkbox" name="checked" value="<?=$user['id']?>"></td>
            			      <td><?=$user['username']?></td>
            			      <td><?=$user['email']?></td>
            			      <td><?=ucfirst($user['first_name'])?> <?=ucfirst($user['last_name'])?></td>
            			      <td><?=$user['phone']?></td>
                        <td><?=ucfirst(strtolower($user['company']))?></td>
            			      <td><?php if($user['active']==1){echo '<span class="label label-success">active</span>'; }else{ echo '<span class="label label-danger">inactive</span>'; } ?></td>
            			      <td><?php if(empty($user['last_login'])){ echo "Jamais connecté"; }else{echo date($setting['format_date'].' à H:i:s ', $user['last_login']); }?></td>
            			      <td>
            			      	<div class="btn-group">
            						  <button data-toggle="dropdown" class="btn btn-default btn-sm dropdown-toggle" type="button">
            							  Actions <span class="caret"></span></button>
            						  <ul class="dropdown-menu">
                            <?php if($permissions['userManagement-view'] == 1){ ?>
            							   <li><a href="#" data-backdrop="static" data-toggle="modal" data-target="#Viewusers" onclick="viewusers(<?=$user['id'] ?>)">Détails</a></li>
                            <?php } ?>

            							  <?php if($permissions['userManagement-account_status'] == 1){ ?>
                            <?php if($this->session->userdata('identity')!=$user['username']){ ?> 
                              <li><a href="#" data-backdrop="static" data-toggle="modal" data-target="#Changestatususer" onclick="changestatususer(<?=$user['id'] ?>)">

                            <?php if($user['active']==1){echo 'Désactivé ce compte'; }else{ echo 'Activé de compte'; } ?></a></li><?php } } ?>

            						  </ul>
            					    </div>
            			      </td>
            			    </tr>
            			 <?php } ?>
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
 <?php if($permissions['userManagement-view'] == 1){ ?>
  <div class="modal modal-default fade" id="Viewusers">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title">
                      <center>
                          <h2 class="box-title">Détails sur l'utilisateur</h2>
                      </center>
                  </h4>
              </div>
              <div class="modal-body box box-primary" id="viewusers">
                   
              </div>
              <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
      </div>  
  </div>
 <?php } ?>

<div class="modal modal-default fade" id="Changestatususer">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">
                    <center>
                        <h2 class="box-title">Changer le statut de ce compte</h2>
                    </center>
                </h4>
            </div>
            <div class="modal-body box box-primary" id="changestatususer">
                 
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>  
</div>


<script type="text/javascript">
  function toggle(source)
  {
    var checkboxes = document.querySelectorAll('input[type="checkbox"]');
    for(var i = 0; i < checkboxes.length; i++) {
        if (checkboxes[i] != source)
            checkboxes[i].checked = source.checked;
    }
  }

  function viewusers(user_id){
    var base_url = "<?php echo base_url('usermanagement/');?>";
    $.ajax({
            url: base_url+'modalviewusers/',
            type: 'POST',
            data : {user_id : user_id},
            dataType: 'json',
            success:function(response) {
                document.getElementById('viewusers').innerHTML=response;
            }
        });
     
  }

  function changestatususer(user_id){
    var base_url = "<?php echo base_url('usermanagement/');?>";
    $.ajax({
            url: base_url+'modalchangestatususer/',
            type: 'POST',
            data : {user_id : user_id},
            dataType: 'json',
            success:function(response) {
                document.getElementById('changestatususer').innerHTML=response;
            }
        });
     
  }
</script>
