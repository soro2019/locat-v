<?php $setting = $this->Crud_model->selectSettings();?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="<?=site_url('assets/img/')?>apple-touch-icon.png" rel="apple-touch-icon">
    <link href=<?=site_url('assets/img/')?>favicon.ico rel=icon>

    <title><?php echo ucfirst(strtolower($setting['system_name'])); ?></title>

    <!-- Bootstrap core CSS -->
    <link href="<?=site_url('/assets/css/bootstrap.min.css')?>" rel="stylesheet">
    <link href="<?=site_url('/assets/css/description.css')?>" rel="stylesheet">
    <!-- Google Font -->
    <link rel="stylesheet" href="<?=site_url('assets/')?>css/fonts.css">
    <!-- Custom styles for this template -->
    <link href="<?=site_url('/assets/css/style.css')?>" rel="stylesheet">

    <link rel="stylesheet" href="<?=site_url('/assets/css/font-awesome.min.css')?>">
    <script src="<?=site_url('/assets/js/vendor/jquery-slim.min.js')?>"></script>
    <script src="<?=site_url('/assets/js/qrcodelib.js')?>"></script>
    <script src="<?=site_url('/assets/js/webcodecamjquery.js')?>"></script>
    <link rel="stylesheet" href="<?=site_url('assets/bower_components')?>/select2/dist/css/select2.min.css">
</head>

<body>
    <nav class="navbar navbar-default">
        <div class="container">
            <div class="navbar-header">
              <?php if($this->session->userdata('identity')){ ?>
                <button type="button" class="btn navbar-toggle pd0" aria-label="Left Align" onclick="myFunction()">
                    <i class="fa fa-sign-out" aria-hidden="true"></i>
                </button>
              <?php } ?>
                <a class="navbar-brand" href="" disabled>APP <?php echo ucfirst(strtolower($setting['system_name'])); ?></a>
            </div>
        </div>
    </nav>
    
