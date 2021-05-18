<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

$this->load->view('template/_parts/front_master_header_view'); ?>
<style type="text/css">
    video {
        height: 300px;
        width: 100%;
    }

    label{

      font-size: 14px;
    }
</style><!-- <br><br><br><br><br><br><br><br> -->
<?php 
 $brand = $this->db->get_where('brands', array('id' => $product['brand']))->row_array();
?>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <h3 class="panel-title">Détail Produit</h3>
                </div>
                <div class="panel-body">
                  <form action="<?=site_url('main/receptionForProduit/'.$id_sub.'/'.$id_inv)?>" method="POST">
                    <div class="dates">
                      <h3 class="text-left">
                        <small class="col-md-6 text-left">Code : </small>
                        <label class="col-md-6 text-left"><?=$product['codeIdentification']?></label>
                      </h3>
                      <h3 class="text-left">
                        <small class="col-md-6 text-left">Marque : </small>
                        <label class="col-md-6 text-left"><?=$brand['name']?></label>
                      </h3>
                      <h3 class="text-left">
                        <small class="col-md-6 text-left">Modèle produit : </small>
                        <label class="col-md-6 text-left"><?=$product['name']?></label>
                      </h3>
                    </div>
                    <div class="dates">
                      <div class="row">
                        <div class="col-md-6">
                            <h4>Quantité en base : <strong><?=round($product['quantity'])?></strong></h4>
                            <div class="ends">
                               <label>Quantité</label>
                               <input type="number" class="form-control" min="0" value="<?=round($product['quantity'])?>" name="qte"> 
                               <input type="hidden" name="qteS" value="<?=$product['quantity']?>">
                               <input type="hidden" name="id_prod" value="<?=$product['id']?>">
                               <input type="hidden" name="code" value="<?=$product['codeIdentification']?>">
                               <!-- <input type="hidden" name="important1" value="<?=$element?>">
                               <input type="hidden" name="important" value="<?=$important?>"> -->
                            </div>
                        </div>
                        <!-- <div class="col-md-6">
                            <h4>Current Sale Price : <strong><?//=preg_replace("#,#"," ",number_format($product['price']))?></strong></h4>
                            <div class="ends"> -->
                               <!-- <label>Change here</label>
                               <input style="margin-bottom: 24px;" type="number" class="form-control" min="0" value="<?//=round($product['price'])?>" name="prix">  -->
                               <!-- <input type="hidden" name="mode" value="enregistre">
                               <input type="hidden" name="id_prod" value="<?//=$product['id']?>">
                            </div>
                        </div> -->
                      </div>
                    </div>
                    <div class="dates" style="border: 0px solid transparent;">
                      <a class="btn btn-danger" style="margin-left: -25px;width: 130px;" href="<?=site_url('main/dossier_de_inventaire/'.$id_sub.'/'.$id_inv)?>">Retour</a>
                      <input class="btn btn-success" type="submit" style="color:#fff;/*font-size: 1.4em;*/float: right;width: 100px;" value="Valider"/>
                    </div>
                  </form>
                </div>
                <div class="panel-footer">
                    <center><a class="btn btn-danger" href="<?=site_url('main/dashbord')?>">Retour liste</a></center>
                </div>
            </div>
        </div>

    </div>
</div>

<script src="<?=site_url('/assets/js/')?>dist/quagga.js"></script>

<script type="text/javascript">
    

</script>

<?php $this->load->view('template/_parts/front_master_footer_view');?>
