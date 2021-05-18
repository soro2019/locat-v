<!-- Main content -->
<section class="content">

    <div class="row">
            
        <div class="col-md-12">
            <div class="container-fluid">
                <?php if($this->session->flashdata('error')) {   ?>
                    <br>
                    <div class="alert alert-warning alert-dismissible" role="alert">
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
        
        <div class="col-md-12">    
            <div class="box box-default">
                <div class="box-header with-border">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-8">
                                <h3 class="box-title">Enregistrement de la vente : <?= sessionExiste('codeVente');?></h3>
                            </div>
                            <div class="col-md-4">
                                <h3 class="box-title">Montant restant : <span class="mtn_r"> <?= sessionExiste('m_restant'); ?> </span> FCFA</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <div class="container-fluid">
                    <br>
                    <form class="form-horizontal" action="" method="POST">
                        <div class="box-body">
                            <?php $nb = (int) $_SESSION['data']['nb_v_restant'];
                                 for ($i=1; $i <= $nb ; $i++) { ?>
                                <div class="form-group">
                                    <div class="col-md-6">
                                        <label for="inputTitle" class="control-label">Montant V<?=($i+1)?> *</label>
                                        <input type="number" min="0" name="mnt_v<?=($i+1)?>" class="form-control" id="mnt_v<?=($i+1)?>" placeholder="Montant V<?=($i+1)?>" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="inputTitle" class="control-label">Echéance *</label>
                                        <input type="Date" name="echeance<?=($i+1)?>" class="form-control" id="echeance" placeholder="Echéance" required>
                                    </div>
                               </div>
                            <?php } ?>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <a type="button" href="<?=site_url('sells/add')?>" class="btn btn-primary">Retour</a>
                            <button type="submit" class="btn btn-success">Enregistrer</button>
                        </div>
                        <!-- /.box-footer -->
                    </form>
                    <br>
                </div>
            </div>
        </div>
        
    </div>
</section>
<!-- /.content -->