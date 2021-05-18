<!-- Main content -->
<?php defined('BASEPATH') OR exit('No direct script access allowed');
  $group_id = $this->session->userdata('group_id');
  $permissions = $this->Crud_model->getPermission($group_id);
  $setting = $this->Crud_model->selectSettings();
 ?>
<section class="content">
  <div class="row">
    <div class="col-sm-12">
    	<div class="box box-default">
    		<div class="box-header with-border">
          <div class="container-fluid">
    		    <h3 class="box-title">Liste Des Iventaires</h3>
          </div>
    		</div>
        <!-- /.box-header -->
        <div class="row">
          <div class="col-sm-12">
            <div class="container-fluid">
              <?php if($this->session->flashdata('error')) {   ?>
                <br>
                <div class="alert alert-danger alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <?php
                    echo $this->session->flashdata('error');
                  ?>
                </div>
              <?php  }elseif($this->session->flashdata('message')){  ?>
                <div class="alert alert-success alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <?php
                  echo $this->session->flashdata('message');
                  ?>
                </div>
              <?php  } ?>
              </div>
          </div>
        </div>
    		<div class="row">
          <div class="col-sm-12">
        		<div class="box-body">
              <div class="container-fluid">
                <br>
          		  <table id="example1" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                      <thead>
                      <tr>
                          <th><input type="checkbox" name="checked0" onclick="toggle(this);"></th>
                          <th>Titre</th>
                          <th>Description</th>
                          <th>Date de Création</th>
                          <th>Date de Fin</th>
                          <th>Statut</th>
                          <th>Assignation</th>
                          <th>Actions</th>
                      </tr>
                      </thead>
                      <tbody>
                       <?php if(!is_bool($inventories) && count($inventories) > 0){ foreach($inventories as $inventory) { ?>
                          <tr>
                              <td><input type="checkbox" name="checked" value="<?=$inventory['id_inventory']?>"></td>
                              <td><?=$inventory['nom_inventaire']?></td>
                              <td><?=$inventory['des_inventaire']?></td>
                              <td><?=date($setting['format_date'],$inventory['date_create'])?></td>
                              <td><?php if($inventory['date_end']==0){ echo "Pas encore terminé"; }else{ echo date($setting['format_date'],$inventory['date_end']); } // date($setting['format_date'], $inventory['date_end'])?></td>
                              <td>
                                  <?php   
                                      if($inventory['etat']==0){echo '<span class="label label-danger">En cours</span>'; }
                                      elseif($inventory['etat']==1){echo '<span class="label label-warning">Iventaire complète</span>'; }
                                      elseif($inventory['etat']==-1){echo '<span class="label label-danger">En cours de traitement</span>'; }
                                      elseif($inventory['etat']==2){echo '<span class="label label-primary">Validation en cours</span>'; }
                                      elseif($inventory['etat']==3){echo '<span class="label label-success">Iventaire Validé</span>'; }
                                  ?>
                              </td>

                              <td>
                                  <?php   
                                      if($inventory['assigner']==0 || $inventory['assigner']==-1){echo '<span class="label label-danger">Pas encore attribuer</span>'; }
                                      else{echo '<span class="label label-success">Attribution OK</span>'; }
                                  ?>
                              </td>

                              <td>
                                <div class="btn-group">
                                      <button data-toggle="dropdown" class="btn btn-default btn-sm dropdown-toggle" type="button">
                                          Actions <span class="caret"></span></button>
                                      <ul class="dropdown-menu">
                                        <?php if($permissions['inventory-view'] == 1) {?>
                                          <li><a href="#" data-backdrop="static" data-toggle="modal" data-target="#Vinventory" onclick="viewinventory(<?= $inventory['id_inventory'] ?>)">Détail</a></li>
                                        <?php }  ?>
                                        <?php if($permissions['inventory-assignment'] == 1){ ?>
                                          <?php if($inventory['assigner']==0 || $inventory['assigner']==-1){ ?>
                                            <li><a href="<?php echo site_url('inventory/assignment/'.$inventory['id_inventory']) ?>" >Attribuer l'inventaire</a></li>
                                          <?php } } ?>
                                          <?php if($permissions['inventory-modifie-assigne'] == 1){ ?>
                                            <?php if($inventory['assigner']==1  && ($inventory['etat']==0 || $inventory['etat']==-1)){  ?>
                                                <li><a href="<?=site_url('inventory/modification_inventory_assignation/'.$inventory['id_inventory'])?>">Modifier l'attribution</a></li>
                                            <?php } ?>
                                          <?php } ?>

                                          <?php if($permissions['inventory-assigne-validator'] == 1){ ?>
                                            <?php if($inventory['nb_sub_fini']!=0 && $inventory['etat']!=3){  ?>
                                                <li><a href="<?=site_url('inventory/assign_validator/'.$inventory['id_inventory'])?>">Attribuer les validateur</a></li>
                                            <?php } ?>
                                          <?php } ?>

                                          <?php if($permissions['inventory-export'] == 1){ ?>
                                          <?php if($inventory['etat']==3){  ?>
                                            <li><a href="<?=site_url('inventory/rapports/'.$inventory['id_inventory'])?>">Rapport pdf</a></li>
                                           <li><a href="<?=site_url('inventory/exportations/'.$inventory['id_inventory'])?>">Rapport CSV</a></li>
                                           <li><a href="<?=site_url('inventory/archiver/'.$inventory['id_inventory'])?>">Archiver</a></li>
                                          <?php } ?>
                                          <?php } ?>
                                          <?php if($permissions['inventory-qnt-import'] == 1){ ?>
                                          <?php if(($inventory['etat']==0 && $inventory['assigner']==0) || $inventory['import_quantity'] == 0){ ?>
                                           <!-- <li><a href="<?=site_url('inventory/qntimport/'.$inventory['id_inventory'])?>">import quantities</a></li> -->
                                          <?php } ?>
                                          <?php } ?>
                                          <?php if($permissions['inventory-delete'] == 1){ ?>
                                          <?php if($inventory['etat']==0 && $inventory['assigner']==0){ ?>
                                           <li><a href="#" data-backdrop="static" data-toggle="modal" data-target="#Dinventory" onclick="deleteinventory(<?= $inventory['id_inventory'] ?>)">Supprimer ce inventaire</a></li>
                                          <?php } ?>
                                          <?php } ?>
                                      </ul>
                                </div>
                              </td>
                          </tr>
                       <?php } } ?>
                      </tbody>
                </table>
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
<?php if($permissions['inventory-view'] == 1){ ?>
<div class="modal modal-default fade" id="Vinventory">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">
                    <center>
                        <h2 class="box-title">Détail de l'inventaire</h2>
                    </center>
                </h4>
            </div>
            <div class="modal-body box box-primary" id="viewinventory">
                 
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>  
</div>
<?php } ?>
<?php if($permissions['inventory-delete'] == 1){ ?>
  <div class="modal modal-default fade" id="Dinventory">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title">
                      <center>
                          <h2 class="box-title">Supprimer cet inventaire</h2>
                      </center>
                  </h4>
              </div>
              <div class="modal-body box box-primary" id="deleteinventory">
                   
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

  function viewinventory(id_inventory){
    var base_url = "<?php echo base_url('inventory/');?>";
    $.ajax({
            url: base_url+'modalviewinventory/',
            type: 'POST',
            data : {id_inventory : id_inventory},
            dataType: 'json',
            success:function(response) {
                document.getElementById('viewinventory').innerHTML=response;
            }
        });
     
  }

  function deleteinventory(id_inventory){
    var base_url = "<?php echo base_url('inventory/');?>";
    $.ajax({
            url: base_url+'modaldeleteinventory/',
            type: 'POST',
            data : {id_inventory : id_inventory},
            dataType: 'json',
            success:function(response) {
                document.getElementById('deleteinventory').innerHTML=response;
            }
        });
     
  }
</script>
