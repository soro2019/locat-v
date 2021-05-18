<!-- Main content -->
<section class="content">
    <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
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
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">    
            <div class="box box-info">
                <div class="box-header with-border" style="text-align: center!important;">
                    <h3 class="box-title">PAIEMENT DU VERSEMENT <?=strtoupper($info_line['versement'])?></h3>
                </div>
                <?php $montant = number_format($info_line['montant'], 0, ' ', ' ')." Fcfa"; ?>
                <!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal" action="" method="POST">
                    <div class="box-body">
                        <!-- select -->
                        <div class="form-group">
                            <div class="col-sm-12">
                                <label>Montant</label>
                                <input type="text" style="font-size: 20px; font-weight: bold;" disabled class="form-control" value="<?=$montant?>">
                                <input type="hidden" id="montant" value="<?=$info_line['montant']?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <label>Echéance</label>
                                <input type="date" style="font-size: 20px; font-weight: bold;" disabled class="form-control" value="<?=$info_line['echeance']?>">
                            </div>
                        </div>
                        <input type="hidden" name="idvente" value="<?=$info_line['idvente']?>">
                        <input type="hidden" name="date_paiement" value="<?=strtotime($info_line['echeance'])?>">
                        <?php $datepenalite = strtotime($info_line['echeance']. ' + 1 days'); 
                           if(time() >= $datepenalite){ 
                              $montant2 = (int) $info_line['montant'];
                              $penalite = $montant2*15/100;
                              $total = $montant2 + $penalite;
                            ?>
                            <div class="form-group">
                                <div class="col-sm-6">
                                    <label>M. Pénalité (<span style="font-size: 12px; color: red; font-weight: bold;">Le délais depassé, 15% de penalaté appliquer</span>)</label>
                                    <input type="number" name="penalite" id="penalite" class="form-control" min="0" value="<?=$penalite?>">
                                </div>
                                <div class="col-sm-6">
                                    <label>Montant à verser</label><br>
                                    <input type="text" style="font-size: 20px; font-weight: bold;" disabled name="total" class="form-control" min="0" value="<?=$total?>">
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <a href="<?=site_url('sells/list')?>" class="btn btn-warning">Retour</a>
                        <button type="submit" class="btn btn-success">Payer</button>
                    </div>
                    <!-- /.box-footer -->
                </form>
            </div>
        </div>
        <div class="col-md-3"></div>
    </div>
</section>
<!-- /.content -->