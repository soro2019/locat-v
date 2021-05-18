<!-- Main content -->
<section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box box-default">
            <div class="box-header with-border">
                <div class="container-fluid">
                    <h3 class="box-title">Paramétrage Système</h3>
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
            </div>
            <div class="row">
              <div class="col-sm-12">
                <div class="container-fluid">
                  <!-- form start -->
                  <br>
                  <form class="form-horizontal" action="" method="POST">
                      <div class="box-body">
                          <div class="form-group">
                              <div class="col-sm-12">
                                  <label>Nom du système *</label>
                                  <input class="form-control input-sm" name='name' type="text" placeholder="System name" required value="<?=$setting['system_name']?>">
                              </div>
                          </div>
                          <div class="form-group">
                              <div class="col-sm-12">
                                  <label>Format date *</label>
                                  <select class="form-control input-sm select2" name='format_date' required>
                                    <option value="">Choisir un format de date</option>
                                    <?php foreach ($date_format as $date_format){ 
                                      $selected = "";
                                                      if($date_format['code'] == $setting['format_date']){
                                                         $selected = "selected";
                                                      }
                                    ?>
                                              <option value="<?=$date_format['code']?>" <?=$selected?>><?=$date_format['format_date']?></option>
                                            <?php } ?>
                                  </select>
                              </div>
                          </div>
                          <div class="form-group">
                              <div class="col-sm-12">
                                  <label>Zone *</label>
                                  <select class="form-control input-sm select2" name='time_zone' required>
                                    <option value="">Choisir une zone </option>
                                    <?php foreach ($time_zones as $time_zone){ 
                                      $selected = "";
                                                      if($time_zone['timezone_detail'] == $setting['time_zone']){
                                                         $selected = "selected";
                                                      }
                                    ?>
                                              <option value="<?=$time_zone['timezone_detail']?>" <?=$selected?> ><?=$time_zone['timezone_detail']?></option>
                                            <?php } ?>
                                  </select>
                              </div>
                          </div>
                          <div class="form-group">
                              <div class="col-sm-12">
                                  <label>Language *</label>
                                  <select class="form-control input-sm select2" name='language' required>
                                    <option value="">Choose a language </option>
                                    <?php foreach ($languages as $language){ 

                                      $selected = "";
                                                      if($language['code'] == $setting['language']){
                                                         $selected = "selected";
                                                      }
                                    ?>
                                              <option value="<?=$language['code']?>" <?=$selected?>><?=$language['label']?></option>
                                            <?php } ?>
                                  </select>
                              </div>
                          </div>

                      </div>
                      <!-- /.box-body -->
                      <div class="box-footer">
                          <input type="submit" name="btn" value="Mettre à jour" class="btn btn-primary">
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
    </div>       
</section>
<!-- /.content