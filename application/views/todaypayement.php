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
    		    <h3 class="box-title">Liste des versements du jour</h3>
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
                          <th>Code Vente</th>
                          <th>Client</th>
                          <th>Versement</th>
                          <th>Montant</th>
                          <th>Echéance</th>
                          <th>Status</th>
                          <th>Actions</th>
                      </tr>
                      </thead>
                      <tbody>
                       <?php if(count($todaypayement) > 0){ foreach($todaypayement as $vente) {
                         $client = $this->Crud_model->selectOneClient($vente['idclient']);
                         $vente_one = $this->Crud_model->selectOneVente($vente['idvente']);
                       ?>
                          <tr>
                              <td><?=$vente_one['codeVente']?></td>
                              <td><?=ucfirst($client['full_name'])?> <?=ucfirst($client['prenoms'])?> | <?=$client['contact']?></td>
                              <td><?=$vente['versement']?></td>
                              <td><?=number_format($vente['montant'], 0, ' ', ' ').' Fcfa'?></td>
                              <td><?=formtageDate2($vente['echeance'])?></td>
                              <td>
                                  <?php   
                                      if($vente['echeance'] == date('Y-m-d')){echo '<span class="label label-warning">Encours</span>'; }
                                      elseif($vente['echeance'] < date('Y-m-d')){echo '<span class="label label-danger">En retard</span>'; }
                                      elseif($vente['echeance'] > date('Y-m-d')){echo '<span class="label label-primary">Dans le temps</span>'; }
                                  ?>
                              </td>
                              <td>
                                <a href="<?=site_url('sells/payments/'.$vente['id'])?>" title="Payé maintenant"><b style="font-size: 12px;">Payer maitenant</b></a>
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
