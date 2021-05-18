<?php include_once 'template/header_login.php'; ?>
<div class="login-box">
  <div class="login-logo">
    <a href="<?=site_url()?>"><b>E-Boutique</b></a>
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
    <p class="login-box-msg" style="color: green;">Ceci est votre première connexion, merci de changer votre mot de passe.</p>
    <form action="" method="post">
      <div class="form-group has-feedback">
        <input type="password" name="old" class="form-control" placeholder="Mot de passe actuel">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="new" pattern="^.{<?=$min_password_length?>}.*$" class="form-control" placeholder="Nouveau mot de passe">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="confirm_new" pattern="^.{<?=$min_password_length?>}.*$" class="form-control" placeholder="Confirmer le mot de passe">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
     
        <span style="font-style: italic; font-size: 12px; color: red;">Plus <?=$min_password_length?> caractèrs</span>
      <br> <br>
      <div class="row">
        <div class="col-xs-12">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Changer</button>
        </div>
      </div>
    </form>

  </div>
  <!-- /.login-box-body -->
</div>
<?php include_once 'template/footer_login.php'; ?>