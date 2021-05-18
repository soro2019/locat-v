<style type="text/css">
  th{
     font-size: 10px;  }
</style><!-- Main content -->
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
    		    <h3 class="box-title">Liste des ventes</h3>
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
                <?php //var_dump($ventes);die; ?>
          		  <table id="example1" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                      <thead>
                      <tr>
                          <!-- <th><input type="checkbox" name="checked0" onclick="toggle(this);"></th> -->
                          <th>Code Vente</th>
                          <th>Date Vente</th>
                          <th>Client</th>
                          <th>Quantité</th>
                          <th>Prix U</th>
                          <th>Prix Acc</th>
                          <th>Prix Total</th>
                          <th>Statut</th>
                          <th>Effectué par</th>
                          <th>Actions</th>
                      </tr>
                      </thead>
                      <tbody>
                       <?php if(!is_bool($ventes) && count($ventes) > 0){ foreach($ventes as $vente) {
                        $user = $this->Crud_model->selectUser($vente['user_id']);
                        //$vente_one = $this->Crud_model->selectOneVente($vente['idvente']);
                       ?>
                          <tr>
                              <td><?=$vente['codeVente']?></td>
                              <td><?=$vente['dateVente']?></td>
                              <td><?=$vente['full_name']?> <?=$vente['prenoms']?> | <?=$vente['contatClient']?></td>
                              <td><?=$vente['qnt']?></td>
                              <td><?=number_format($vente['prix_u'], 0, ' ', ' ').' Fcfa'?></td>
                              <td><?=number_format($vente['prix_acc'], 0, ' ', ' ').' Fcfa'?></td>
                              <td><?=number_format($vente['prixTotalVente'], 0, ' ', ' ').' Fcfa'?></td>
                              <td>
                                  <?php   
                                      if($vente['ss']==0){echo '<span class="label label-danger">Non cloturé</span>'; }
                                      else{echo '<span class="label label-success">Cloturé</span>'; }
                                  ?>
                              </td>
                              <td><?= ucfirst($user['username']) ?></td>

                              <td>
                               <div class="btn-group">
                                      <button data-toggle="dropdown" class="btn btn-default btn-sm dropdown-toggle" type="button">
                                          Actions <span class="caret"></span></button>
                                      <ul class="dropdown-menu">
                                        <li><a type="button" href="#" data-backdrop="static" data-toggle="modal" data-target="#Details" onclick="details(<?=$vente['idd']?>);">Détails</a></li>

                                       <li><a type="button" href="#" data-backdrop="static" data-toggle="modal" data-target="#Appareil" onclick="appareils(<?=$vente['idd']?>);">Appareils</a></li>

                                       <li><a href="<?=site_url('sells/imprimecontrat')?>/<?=$vente['idd']?>" target="_blank" title="Imprimer le contrat">Contrat</a></li>
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
<div class="modal modal-default fade" id="Details">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">
                    <center>
                        <h2 class="box-title">Détail de la vente</h2>
                    </center>
                </h4>
            </div>
            <div class="modal-body box box-primary" id="detail_line">
                 
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>  
</div>


<div class="modal modal-default fade" id="Appareil">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">
                    <center>
                        <h2 class="box-title">Les appareils vendu dans cette vente</h2>
                    </center>
                </h4>
            </div>
            <div class="modal-body box box-primary" id="appareils">
                 
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>  
</div>


<script type="text/javascript">
  function details(id){
      var base_url = "<?php echo base_url('sells/');?>";
      $.ajax({
              url: base_url+'modaldatail/',
              type: 'POST',
              data : {id : id},
              dataType: 'json',
              success:function(response) {
                  document.getElementById('detail_line').innerHTML=response;
              }
          });
       
    }

    function appareils(id){
      var base_url = "<?php echo base_url('sells/');?>";
      $.ajax({
              url: base_url+'modalappareil/',
              type: 'POST',
              data : {id : id},
              dataType: 'json',
              success:function(response) {
                  document.getElementById('appareils').innerHTML=response;
              }
          });
       
    }
</script>