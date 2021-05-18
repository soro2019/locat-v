<!-- Main content -->
<?php defined('BASEPATH') OR exit('No direct script access allowed');
  $group_id = $this->session->userdata('group_id');
  $permissions = $this->Crud_model->getPermission($group_id);
 ?>
<section class="content">
	<div class="modal fade" id="modal">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
					<h3 class="modal-title"> <b>Création d'un nouveau groupe</b> </h3>
				</div>
				<form class="form-horizontal" action="<?php echo site_url('usermanagement/permission/add') ?>" method="POST">
					<div class="modal-body box box-primary">
						<div class="row"><div class="col-sm-12">
							<label for="name">Nom du groupe *</label>
							<input type="text" class="form-control" name="name" id="name" placeholder="Nom du groupe" required >
					
						</div></div><br>
						<div class="row"><div class="col-sm-12">
                            <label for="description" >Description</label>
                            <textarea style="resize:none;" class="form-control" type="text" name="description" id="description" placeholder="Description"></textarea>
						</div></div>
					</div>
				<form>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary">Ajouter</button>
				</div>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
    </div>
  
	<div class="box">
		<div class="box-header">
			<div class="row">
				<div class="col-md-6"><h3 class="box-title">Groupe | Permission</h3></div>
				<div class="col-md-6">
				<?php if($permissions['userManagement-add_group'] == 1){ ?>
				  <button href="#" data-backdrop="static" data-toggle="modal" type="button" class="btn btn-primary pull-right" data-target="#modal" style="margin-right: 5px;">
					Ajouter un groupe
		          </button>
		        <?php } ?>
				</div>
			</div>
		</div>
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
		<!-- /.box-header -->
		<div class="box-body">
		  <table id="example1" class="table table-bordered table-striped">
		    <thead>
		    <tr>
		       <th>ID</th>
		       <th>Nom du Groupe</th>
		       <th>Description</th>
		      <th>Actions</th>
		    </tr>
		    </thead>
		    <tbody>
		     <?php $i = 0; foreach ($groups as $group) { $i++; ?>
			    <tr>
					<td><?=$i?></td>
					<td><?=ucfirst($group['name'])?></td>
					<td><?=ucfirst($group['description'])?></td>
					<td>
						<?php if(in_array($group['name'],array('compteurs','validateur','manager', 'vendeurs'))){?>
							<div class="row">

								<div class="col-sm-12">
									<span class="label label-danger">Non autorisé</span>
								</div>
							</div>
						<?php }else{ ?>
							<div class="btn-group">
								<button data-toggle="dropdown" class="btn btn-default btn-sm dropdown-toggle" type="button">
									Actions <span class="caret"></span></button>
								<ul class="dropdown-menu">
									<?php if($permissions['userManagement-permission'] == 1){ ?>
									<li><a href="<?=site_url('usermanagement/permission/autorisation/'.$group['id'])?>">Modifier les autorisations</a></li>
								    <?php } ?>
								    <?php if($permissions['userManagement-edit_group'] == 1){ ?>
									<li><a href="#" data-backdrop="static" data-toggle="modal" data-target="#Modifgroup" onclick="modifgroup(<?=$group['id'] ?>)">Modifier le Groupe</a></li>
									<?php } ?>
									<?php if($permissions['userManagement-delete_group'] == 1){ ?>
									<li><a href="#">Supprimer ce Groupe</a></li>
									<?php } ?>
								</ul>
							</div>
						<?php }?>
					</td>
			    </tr>
			 <?php } ?>
		    </tbody>
		  </table>
		</div>
		<!-- /.box-body -->
	</div>
	<!-- /.box -->
</section>
<!-- /.content -->
<?php if($permissions['userManagement-edit_group'] == 1) {?>
  <div class="modal modal-default fade" id="Modifgroup">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title">
                      <center>
                          <h2 class="box-title">Modification du groupe</h2>
                      </center>
                  </h4>
              </div>
              <div class="modal-body box box-primary" id="modifgroup">
                   
              </div>
              <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
      </div>  
  </div>
 <?php } ?>


<script type="text/javascript">
  function toggle(source)
  {
    var checkboxes = document.querySelectorAll('input[type="checkbox"]');
    for(var i = 0; i < checkboxes.length; i++) {
        if (checkboxes[i] != source)
            checkboxes[i].checked = source.checked;
    }
  }

  function modifgroup(group_id){
    var base_url = "<?php echo base_url('usermanagement/');?>";
    $.ajax({
            url: base_url+'modaleditgroup/',
            type: 'POST',
            data : {group_id : group_id},
            dataType: 'json',
            success:function(response) {
                document.getElementById('modifgroup').innerHTML=response;
            }
        });
     
  }
</script>
