<?php defined('BASEPATH') OR exit('No direct script access allowed');
  $group_id = $this->session->userdata('group_id');
  $permissions = $this->Crud_model->getPermission($group_id);
 ?><!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <!-- /.box -->
    	<div class="box box-default">
        <div class="box-header with-border">
          <div class="container-fluid">
    		    <h3 class="box-title">Liste des blocks</h3>
          </div>
    		</div>
        <!-- /.box-header -->
        <div class="row">
          <div class="col-sm-12">
            <div class="container-fluid">
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
          </div>
    		<div class="row">
          <div class="col-sm-12">
            <div class="container-fluid">
              <br>
          		<div class="box-body">
          		  <table id="example1" class="table table-bordered table-striped">
          		    <thead>
          		    <tr>
          		        <th><input type="checkbox" name="checked0" onclick="toggle(this);"></th>
          		        <th>Titre</th>
          		        <th>Description</th>
          		        <th>Date création</th>
                      <th>Actions</th>
          		    </tr>
          		    </thead>
          		    <tbody>
          		     <?php if(!is_bool($subinventories) && count($subinventories) > 0){ foreach($subinventories as $sub_inventory) { ?>
          			    <tr>
                              <td><input type="checkbox" name="checked" value="<?=$sub_inventory['id']?>"></td>
                              <td><?=$sub_inventory['title']?></td>
                              <td><?=$sub_inventory['description']?></td>
                              <td><?=date($setting['format_date'],$sub_inventory['date_create'])?></td>
                              <td>
                                  <div class="btn-group">
                                      <button data-toggle="dropdown" class="btn btn-default btn-sm dropdown-toggle" type="button">
                                          Actions <span class="caret"></span></button>
                                      <ul class="dropdown-menu">
                                        <?php if($permissions['inventory-edit_sub'] == 1) {?>
                                          <li><a href="#" data-backdrop="static" data-toggle="modal" data-target="#Editsubinventory" onclick="edisubinventory(<?= $sub_inventory['id'] ?>)">Modifier</a></li>
                                        <?php } ?>

                                          <?php if(!$this->Crud_model->subinventoryCompleted2($sub_inventory['id'])){  ?>
                                          <!-- <li><a href="#" data-backdrop="static" data-toggle="modal" data-target="#myModal3<?//=$sub_inventory['id']?>">Delete</a></li> -->
                                          <?php } ?>
                                      </ul>
                                  </div>
                              </td>
          			    </tr>
          			 <?php } } ?>
          		    </tbody>
          		  </table>
          		</div>
              <br>
          		<!-- /.box-body -->
            </div>
          </div>
        </div>
    	</div>
    	<!-- /.box -->
    </div>
  </div>
</section>
<!-- /.content -->
 <?php if($permissions['inventory-edit_sub'] == 1) {?>
  <div class="modal modal-default fade" id="Editsubinventory">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title">
                      <center>
                          <h2 class="box-title">Modifier ce block</h2>
                      </center>
                  </h4>
              </div>
              <div class="modal-body box box-primary" id="edisubinventory">
                   
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

   function edisubinventory(id_sub){
    var base_url = "<?php echo base_url('inventory/');?>";
    $.ajax({
            url: base_url+'modaleditsubinventory/',
            type: 'POST',
            data : {id_sub : id_sub},
            dataType: 'json',
            success:function(response) {
                document.getElementById('edisubinventory').innerHTML=response;
            }
        });
     
  }
</script>