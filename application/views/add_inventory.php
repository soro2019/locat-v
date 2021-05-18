<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">    
            <div class="box box-default">
                <div class="box-header with-border">
                    <div class="container-fluid">
                        <h3 class="box-title">Ajouter un inventaire</h3>
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
                                        <div class="col-sm-12">
                                            <label>Titre *</label>
                                            <input type="text" name="title" class="form-control" id="Title" placeholder="Titre" value="<?php isset_value('title'); ?>" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <label for="inputDescription" >Description</label>
                                            <textarea style="height: 100px!important; resize:none;" class="form-control" type="text" name="description" id="inputDescription" placeholder="Description"><?php isset_value('description'); ?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <label>Les blocks</label>
                                            <select class="form-control select2" name="sub[]" multiple="multiple" data-placeholder="Choisir les blocks"
                                                    style="width: 100%;" required>
                                             <option value="">Choisir les blocks</option>
                                             <option value="all">Tous les blocks</option>
                                             <?php foreach($suvinventory as $suvinventory){ 

                                                $selected = "";
                                                if($_POST['sub']==$suvinventory['id']){
                                                   $selected = "selected";
                                                }
                                             ?>
                                                <option value="<?=$suvinventory['id']?>" <?=$selected?> ><?=ucfirst($suvinventory['title'])?></option>
                                            <?php } ?>
                                            </select>
                                        </div>
                                    </div>

                                </div>
                                <!-- /.box-body -->
                                <div class="box-footer">
                                    <button type="submit" class="btn btn-success">Enregistrer</button>
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