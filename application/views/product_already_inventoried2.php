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
  //var_dump($product);die;
$brand = $this->db->get_where('brands', array('id' => $product->brand))->row_array();
?>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <h3 class="panel-title">Détail du Produit</h3>
                </div><br>
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
                <div class="panel-body">
                  <form action="" method="POST" action="<?=site_url('main/product_already_inventoried_action/'.$id_sub.'/'.$id_inv)?>">                    
                    <div class="dates ">
                      <h3 class="text-left">
                        <small class="col-md-6 text-left">Code : </small>
                        <label class="col-md-6 text-left"><?=$product->codeIdentification?></label>
                      </h3>
                      <h3 class="text-left">
                        <small class="col-md-6 text-left">Marque : </small>
                        <label class="col-md-6 text-left"><?=$brand['name']?></label>
                      </h3>
                      <h3 class="text-left">
                        <small class="col-md-6 text-left">Modèle produit : </small>
                        <label class="col-md-6 text-left"><?=$product->name?></label>
                      </h3>
                      
                      <h3 class="text-left">
                        <small class="col-md-10 col-lg-10 col-xs-10 text-left">Quantité déjà compter : </small>
                        <label class="col-md-2 text-left"><?php echo $product->qntcompter ?></label>
                      </h3>
                    </div>
                    <div class="dates">
                      <div class="row">
                        <div class="col-md-6">
                            <div class="ends">
                               <label>Nouvelle Quantité</label>
                               <input type="number" class="form-control" min="0" name="qte" required value="<?=round($product->qntcompter)?>">
                            </div>
                             <input type="hidden" name="id_prod" value="<?=$product->id_products?>">
                             <input type="hidden" name="product_qte" value="<?=$product->qntcompter?>">
                        </div><br>
                      <div class="row">
                        <div class="col-md-12">
                          <input type="radio" name="choix" value="1" required> Écraser la quantité
                        </div>
                      </div><br>
                      <div class="row">
                        <div class="col-md-12">
                            <input type="radio" name="choix" value="-1" required> Ajouté à la quantité déjà inventoriée
                        </div>
                      </div>
                    </div>
                    <div class="dates" style="border: 0px solid transparent;">
                       <a class="btn btn-danger" style="margin-left: -25px;width: 130px;" href="<?=site_url('main/product_already_inventoried2/'.$id_sub.'/'.$id_inv)?>">Retour</a>
                      <input class="btn btn-success" type="submit" style="color:#fff;/*font-size: 1.4em;*/float: right;width: 100px;" value="Valider"/>
                    </div>
                  </form>
                </div>
                <!-- <div class="panel-footer">
                    <center><a class="btn btn-danger" href="<?//=site_url('main/dashbord')?>">Back to the list</a></center>
                </div> -->
            </div>
        </div>

    </div>
</div>

<script src="<?=site_url('/assets/js/')?>dist/quagga.js"></script>

<script type="text/javascript">
    

</script>

<?php $this->load->view('template/_parts/front_master_footer_view');?>
