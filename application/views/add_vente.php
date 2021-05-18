<style type="text/css">
    .number1{
        font-size: 20px;
        font-weight: bold;
    }
</style>
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">    
            <div class="box box-default">
                <div class="box-header with-border">
                    <div class="container-fluid">
                        <h3 class="box-title">Ajouter une vente</h3>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="row">
                    <div class="col-md-12">
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
                </div><br>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="container-fluid">
                            <!-- form start -->
                           
                            <form class="form-horizontal" action="" method="POST">
                                <div class="box-body">
                                    <div class="form-group">
                                        <div class="col-sm-3">
                                            <label>Date vente *</label>
                                            <input type="date" name="dateVente" class="form-control" id="date" placeholder="date" value="<?= valueElement('dateVente'); ?>" required>
                                        </div>
                                        <div class="col-sm-4">
                                            <label>Marque *</label>
                                            <select class="form-control select2" id="brand" name="idbrand" required="">
                                                <option value="">Choisir une marque</option>
                                                 <?php foreach ($brands as $brand){
                                                 ?><option value="<?=$brand['id']?>" <?php echo echo_selected(valueElement('idbrand'), $brand['id']); ?>  ><?=ucfirst($brand['name'])?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="col-sm-5">
                                            <label>Modèle de l'apperiel *</label>
                                            <select class="form-control select2" id="modele" name="idProduit" required="">
                                                <option value="">Choisir une mar d'abord</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-3">
                                            <label>Quantité *</label>
                                            <input type="number" name="qnt" class="form-control" id="qnt" min="1" max="100" placeholder="Quantité" value="<?= valueElement('qnt'); ?>" required>
                                        </div>
                                        <div class="col-sm-3">
                                            <label>Prix unitaire *</label>
                                            <input type="number" name="prix_u" class="form-control" min="0" id="prix_u" placeholder="Prix unitaire" value="<?= valueElement('prix_u'); ?>" required>
                                        </div>
                                        <div class="col-sm-3">
                                            <label>Prix des accessoire </label>
                                            <input type="number" name="prix_acc" class="form-control" min="0" id="prix_acc" placeholder="Prix des accessoire" value="<?= valueElement('prix_acc'); ?>" >
                                        </div>
                                        <div class="col-sm-3">
                                            <label>Total de la vente<?=valueElement('prixTotalVente'); ?></label>
                                                <input type="text" class="form-control number1" id="totalPrix" disabled value="<?=valueElement('prixTotalVente'); ?>">
                                        <input type="hidden" name="prixTotalVente" id="prix_tn" value="<?=valueElement('prixTotalVente'); ?>">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-5">
                                            <label>Client *</label>
                                            <select class="form-control select2" id="client" name="idClient" required>
                                                <option value="">Choisir le client</option>
                                                <?php foreach ($allClient as $allClient){ 
                                                ?>
            <option value="<?=$allClient['id']?>" <?php echo echo_selected(valueElement('idClient'), $allClient['id']); ?> ><?=ucfirst($allClient['full_name'])?> <?=ucfirst($allClient['prenoms'])?> | <?=ucfirst($allClient['contact'])?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="col-sm-3">
                                            <label>Contact client *</label>
                                            <input type="text" name="contact" class="form-control" id="contact" placeholder="Contact client" value="<?= valueElement('contact'); ?>" required>
                                        </div>

                                        <div class="col-sm-4">
                                            <label>Type de vente *</label>
                                            <select class="form-control select2" id="type_vente" name="type_vente" required>
                                                <option value="">Choisir un type</option>
                                                <option value="-1" <?php echo echo_selected(valueElement('type_vente'), -1);?> >Cash</option>
                                                <option value="1" <?php echo echo_selected(valueElement('type_vente'), 1);?> >A crédit</option>
                                            </select>
                                        </div>
                                       
                                    </div>
                                    <br>
                                    <div class="row">
                                         
                                        <div class="col-sm-6">
                                            <label>Montant V1 *</label>
                                            <input type="number" min="0" name="mnt_v1" class="form-control" id="mnt_v1" placeholder="Montant V1" value="<?= valueElement('mnt_v1'); ?>" required>
                                        </div>
                                        <div class="col-sm-6">
                                            <label>Nb versement restant *</label>
                                            <input type="number" min="0" name="nb_v_restant" class="form-control" id="nb_v_restant" placeholder="Nb versement restant" value="<?= valueElement('nb_v_restant'); ?>" required>
                                        </div>
                                    </div><br>

                                    <div class="form-group">
                                       <label>EMEI des/de l'apperiel(s) *</label>
                                       <table class="table table-bordered" id="dynamic_field">
                                          <tr>
                                            <td><input type="text" class="form-control name_list" id="emeil" placeholder="EMEI de l'appareil 1" name="emeil[]" required value="<?php if(isset(valueElement('emeil')[0])) echo valueElement('emeil')[0]; ?>"></td>
                                            <td><a name="add" id="add" class="btn btn-primary">+</a></td>
                                          </tr> 
                                       </table> 
                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <label for="inputDescription" >Observation</label>
                                            <textarea style="height: 100px!important; resize:none;" class="form-control" type="text" name="description" id="inputDescription" placeholder="Observation"><?= valueElement('observation'); ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.box-body -->
                                <div class="box-footer">
                                    <button type="submit" id="btn" class="btn btn-primary">Suivant</button>
                                </div>
                                <!-- /.box-footer -->
                            </form>
                            <br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- /.content -->

