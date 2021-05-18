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
        <div class="col-md-3"></div>
        <div class="col-md-6">    
            <div class="box box-info">
                <div class="box-header with-border" style="text-align: center!important;">
                    <h3 class="box-title">Affectation : <?=strtoupper($info_inv['nom_inventaire'])?></h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal" action="" method="POST">
                    <div class="box-body">
                        <!-- select -->
                        <div class="form-group">
                            <div class="col-sm-12">
                                <label>Utilisateur</label>
                                <select class="form-control select2" name="user" required>
                                    <option value="" >Choisir un validateur</option>
                                    <?php 
                                        foreach($users as $user){ ?>
                                            <option value="<?=$user['id']?>"><?=ucfirst($user['first_name'])?> <?=ucfirst($user['last_name'])?> [<?=ucfirst($user['username'])?>]</option>
                                        <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12">
                            
                                <h4>
                                <b>Liste des affectations</b>
                                </h4>
                                <div class="col-sm-12">
                                <?php
                                    foreach($info_assign as $us){?>
                                        <li>
                                            <?=ucfirst($us['title'])?> : <?=ucfirst($us['first_name'])?> <?=ucfirst($us['last_name'])?> [<?=$us['username'] == NULL ? "not assigned" : ucfirst($us['username'])?>]
                                        </li>
                                <?php } ?>
                                </div>
                            </div>
                        </div>
                        <?php //var_dump($suvinventory[0]['sub_id']);die; ?>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <label>Les Blocks</label>
                                <select class="form-control select2" name="sub[]" multiple="multiple" data-placeholder="Choisir un block"
                                        style="width: 100%;" required>
                                 <option value="">Choisir un block</option>
                                 <?php if(!is_bool($subinventory)){ foreach($subinventory as $inventory){ 
                                ?>
                                    <option value="<?=$inventory['id_sub']?>" ><?=ucfirst($inventory['title'])?></option>
                                <?php } } ?>
                                </select>
                            </div>
                        </div>

                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" class="btn btn-success">Affecter</button>
                    </div>
                    <!-- /.box-footer -->
                </form>
            </div>
        </div>
        <div class="col-md-3"></div>
    </div>
</section>
<!-- /.content -->