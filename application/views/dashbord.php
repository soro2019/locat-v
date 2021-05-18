<?php $user = $this->Crud_model->selectUser($this->session->userdata('user_id'));?>
<!-- Main content -->
<section class="content">
  <div class="row mb-15">
    <div class="col-lg-12">
      <h2>Bonjour <?= ucfirst($user['first_name']) ?>, Bienvenue !</h2>
      <p style="color:#7e8486; font-size:25px;">Vous avez <a href="<?=site_url('sells/todaypayement')?>"><b><?=$VersementDuJour?></b></a> versement pour aujourd'hui !</p>
    </div>
  </div>

  <!-- Small boxes (Stat box) -->
  <div class="row">
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-white">
        <div class="inner">
          <h3><?php echo number_format($VersementDemain, 0, ' ', ' ');?></h3>

          <p style="font-size: 12px !important;">Versement de demain</p>
        </div>
        <div class="icon">
          <i class="ion ion-bag"></i>
        </div>
        <a href="<?=site_url('sells/tomorrowPayement')?>" class="small-box-footer">Voir la liste <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
  
    
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-white">
        <div class="inner">
          <h3><?php echo number_format($JourProchainPayement , 0, ' ', ' ');?></h3>

          <p class="sl" style="font-size: 12px !important;">Versements du <?=jourSemaine()?> prochain</p>
        </div>
        <div class="icon">
          <i class="ion ion-pie-graph"></i>
        </div>
        <a href="<?=site_url('sells/JourProchainPayement')?>" class="small-box-footer">Voir la liste <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-white">
        <div class="inner">
          <h3><?php echo number_format($VersementEnRetard , 0, ' ', ' ');?></h3>

          <p style="font-size: 12px !important;">Versements en retard</p>
        </div>
        <div class="icon">
          <i class="ion ion-pie-graph"></i>
        </div>
        <a href="<?=site_url('sells/enretard')?>" class="small-box-footer">Voir la liste <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-white">
        <div class="inner">
          <h3><?php echo number_format($VersementEnCours, 0, ' ', ' ');?></h3>

          <p style="font-size: 12px !important;">Versements en cours</p>
        </div>
        <div class="icon">
          <i class="ion ion-person-add"></i>
        </div>
        <a href="<?=site_url('sells/encours')?>" class="small-box-footer">Voir la liste <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
  </div>
  <!-- /.row -->
</section>
<!-- /.content -->