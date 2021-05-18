<style type="text/css">
	[hidden] {
  display: none !important;
}
</style>


<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title">Import quantities</h3>
                </div>
                <div class="row">
                  <div class="col-sm-12">
                    <div class="container-fluid">
                      <?php if($this->session->flashdata('error')) {   ?>
                        <br>
                        <div class="alert alert-danger alert-dismissible" role="alert">
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
                </div>
                <div class="box-body" style="text-align:center;">
                    <a href="<?= site_url('inventory/generat_quantity_file') ?> " >
                        <button type="button" class="btn btn-primary" style="margin-right: 5px;">
                            <i class="fa fa-download"></i> Generate Model File
                        </button>
                    </a> 
                </div>
                <form class="form-horizontal" action="" method="POST" enctype='multipart/form-data'>
                    <div class="box-body">
                        <div class="row">
                          <div class="col-md-3"></div>
                          <div class="col-md-6">
                          	<label class="btn btn-default" style="width: 800px;">
							   <i class="fa fa-download"></i> <span>Click to choose a file for import</span>
                               <div style="margin-left:100px; margin-top:10px;">
                                    <input accept=".csv" type="file" name="import">
                               </div>
						    </label>
                          </div>
                        </div>
                    </div>
                    <div class="box-footer" style="text-align:center!important;">
                        <button type="submit" class="btn btn-success">Upload</button>
                    </div>
                </form>
            </div>                                                                          
        </div>

    </div>
</section>