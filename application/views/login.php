<?php include_once 'template/header_login.php'; ?>
<div class="login-box">
  <div class="login-logo">
    <?php 
     $setting = $this->Crud_model->selectSettings();

   //  var_dump($setting);die;
    ?>
    <img src="<?=site_url('assets/')?>img/logo-inventorycount.png" width="150px">
  </div>
  <!-- /.login-logo -->
  <?php if($this->session->flashdata('message')) {   ?>
                         
  <div class="alert alert-success alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <label id="testemise"><?php echo $this->session->flashdata('message'); ?></label>
    
  </div>
  <?php  } ?>
  <?php if($this->session->flashdata('error')) {   ?>
  <div class="alert alert-warning alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <?php echo $this->session->flashdata('error'); ?>
  </div>
  <?php  } ?>
  <div class="login-box-body">
    <p class="login-box-msg">Espace de connexion au système</p>

    <form action="" method="post">
      <div class="form-group has-feedback">
        <input type="text" name="identity" class="form-control" placeholder="Utilisateur">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="password" class="form-control" placeholder="Mot de passe">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-6">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox" name="souvenir" value="1"> Se souvenir
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-6">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Connexion</button>
          <!---->
        </div>
        <!-- /.col -->
      </div>
    </form>

   <!--  <div class="social-auth-links text-center">
      <p>- OR -</p>
      <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using
        Facebook</a>
      <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using
        Google+</a>
    </div> -->
    <!-- /.social-auth-links -->

    <!-- <a href="#">Mot de passe oublié</a><br> -->
    <!-- <a href="register.html" class="text-center">Register a new membership</a> -->
  </div>
  <!-- /.login-box-body -->
</div>
<?php include_once 'template/footer_login.php'; ?>