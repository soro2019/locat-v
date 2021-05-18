<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

$this->load->view('template/_parts/front_master_header_view'); ?>

<div class="container">
    <div class="col-md-4 col-md-offset-4">
        <br>
        <br>
        <div class="panel panel-success">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-plus-square" aria-hidden="true"></i> ADD AN INVENTORY</h3>
            </div>
            <div class="panel-body">
                <?php if(isset($_SESSION['message_error1'])) {   ?>
                    <br>
                    <div class="alert alert-warning alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <?php
                        echo $_SESSION['message_error1'];
                        ?>
                    </div>
                <?php  } ?>
                <form method="post" action="" role="form">
                    <div class="form-group">
                        <input type="text" id="nom" name="nom" class="form-control" placeholder="Inventory name eg: books for BABY" title="Inventory name e.g. books for BABY" required />
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" name="des" id="des" placeholder="Description, e.g . From the right to the left of the department" title="Pressed position e.g. From the right to the left of the shelf" required></textarea>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-success btn-md btnmoi btn-block" name="btnsave" value="Create">
                    </div>
                </form>

            </div>

        </div>
        <br>
        <br>
        <a class="btn btn-primary btn-md btnmoi btn-block" href="<?=site_url('main/dashbord')?>">Retour en arrière</a>
    </div>
</div>


<?php $this->load->view('template/_parts/front_master_footer_view');?>
