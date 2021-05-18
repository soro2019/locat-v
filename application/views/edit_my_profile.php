
    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-md-12">
                <div class="nav-tabs-custom" id="element_overlap1">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#activity" data-toggle="tab">General information</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="active tab-pane" id="activity">
                           <?php
                               if($this->session->flashdata('error') !== null){
                                   echo '<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Erreur: ' .$this->session->flashdata('error').'</div>';
                               }
                                 
                               elseif(validation_errors() !== ''){
                                   echo '<div class="alert alert-danger" role="alert">Erreur: ' .validation_errors().'</div>';
                               }elseif($this->session->flashdata('message')){  ?>
                            <div class="alert alert-success alert-dismissible" role="alert">
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                              <?php
                              echo $this->session->flashdata('message');
                               ?>
                            </div>
                           <?php  } 
                            
                            echo form_open(site_url('main/edit_my_profile'),array('class' => 'form-horizontal UpdateDetails'));?>
                                <div class="form-group">
                                    <label for="" class="col-sm-2 control-label">Username</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" value="<?=$user['username']?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="" class="col-sm-2 control-label">Last Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="prenoms" value="<?php if(isset($_POST['prenoms'])){ echo $_POST['prenoms']; }else{ echo $user['last_name'];} ?>" placeholder="Last Name">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="" class="col-sm-2 control-label">First Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="nom" value="<?php if(isset($_POST['nom'])){ echo $_POST['nom']; }else{ echo $user['first_name'];} ?>" placeholder="First Name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail" class="col-sm-2 control-label">Email</label>
                                    <div class="col-sm-10">
                                        <input type="email" class="form-control" name="email" value="<?php if(isset($_POST['email'])){ echo $_POST['email']; }else{ echo $user['email'];} ?>" placeholder="Email">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputExperience" class="col-sm-2 control-label">Old password</label>

                                    <div class="col-sm-10">
                                        <input type="password" class="form-control" name="old_password" value="" placeholder="Password">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputExperience" class="col-sm-2 control-label">New password</label>
                                    <div class="col-sm-10">
                                        <input type="password" class="form-control" name="new_password" value="" placeholder="New password">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                       <input type="submit" name="modifier-profil" value="I edit" class="btn btn-primary">
                                    </div>
                                </div>
                            </form>
                            
                        </div>
                        <!-- /.tab-pane -->
                    </div>
                    <!-- /.tab-content -->
                </div>
                <!-- /.nav-tabs-custom -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

    </section>

