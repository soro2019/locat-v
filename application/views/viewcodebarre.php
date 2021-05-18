<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('template/_parts/front_master_header_view');
 $block = $this->db->get_where('sub_inventory', array('id' => $id_sub))->row_array();
?>
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-danger">
                <div class="panel-heading">
                    <h3 class="panel-title">Inventaire des produits du <?=$block['title']?></h3>
                </div>
                <div class="panel-body text-center">
                     
                    <div class="form-group">
                        <?php if(!empty($_SESSION['message_error5'])) {   ?>
                            <div class="alert alert-success alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <label id="testemise"><?php echo $_SESSION['message_error5']; ?></label>
                            </div>
                        <?php  } ?>
                        <?php if(!empty($_SESSION['message_error4'])) {   ?>
                            <div class="alert alert-warning alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <?php echo $_SESSION['message_error4']; ?>
                            </div>
                        <?php  } ?>
                    </div>
                    <!-- <div id="camera" style="height: 300px; width:100%"></div> -->
                    <hr>
                    <form  action="<?=site_url('main/description_prodution/'.$id_sub.'/'.$id_inv)?>" method="post">
                        <input type="hidden" id="urlcode" value="<?=site_url('main/endInventaire/'.$id_sub.'/'.$id_inv)?>">
                        <input type="hidden" id="urlpasse" value="<?=site_url()?>">
                        <select class="form-control select2" id="brand" name="idbrand" required="">
                            <option value="">Choisir une marque</option>
                             <?php foreach ($brands as $brand){
                             ?><option value="<?=$brand['id']?>" <?php echo echo_selected(valueElement('idbrand'), $brand['id']); ?>  ><?=ucfirst($brand['name'])?></option>
                            <?php } ?>
                        </select><br/><br/>
                        <select class="form-control select2" id="modele" name="idProduit" required="">
                            <option value="">Choisir une marque d'abord</option>
                        </select><br/><br/>
                       
                        <button onclick="contolervalue()"  type="submit" class="btn btn-primary col-md-12" style="position: relative;" >Lancer</button><br/><br/>
                    </form>
                    <br/>
                     <?php 
                       if($this->Crud_model->SelectProduitByInventorySub($id_sub, $id_inv)){
                       ?>
                       <a href="#" data-backdrop="static" data-toggle="modal" data-target="#myModal3<?=$id_inv?>" class="btn btn-warning pd0" aria-label="Left Align">Cliquez ici pour terminer ce block</a>
                        <?php
                    }
                    ?>
                </div>
                <div class="panel-footer">
                </div>
            </div>

        </div>

    </div>
</div>

<div id="myModal3<?=$id_inv?>" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">
          Terminer l'inventaire de ce block
        </h4>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-sm-12">
                <?php echo 'Avez-vous vraiment terminer l\'inventaire de ce block ?';  ?>
            </div>
        </div><br>
      </div>
      <div class="modal-footer">

        <button type="button" class="btn btn-danger" data-dismiss="modal">NON</button>
        <a href="<?=site_url('main/endInventaire/'.$id_sub.'/'.$id_inv)?>" type="button" class="btn btn-success">OUI</a>
      </div>
    </div>
  </div>
</div>
<!-- <script src="<?=site_url('/assets/dist/')?>js/quagga.js"></script>
<script src="<?=site_url('/assets/dist/')?>js/controle.js"></script> -->
<?php $this->load->view('template/_parts/front_master_footer_view');?>

