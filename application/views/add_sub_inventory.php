<!-- Main content -->
<section class="content">

    <div class="row">
            
        <div class="col-md-12">
            <div class="container-fluid">
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
        
        <div class="col-md-12">    
            <div class="box box-default">
                <div class="box-header with-border">
                    <div class="container-fluid">
                        <h3 class="box-title">Ajouter un nouveau Block</h3>
                    </div>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <div class="container-fluid">
                    <br>
                    <form class="form-horizontal" action="" method="POST">
                        <div class="box-body">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <label for="inputTitle" class="control-label">Titre *</label>
                                    <input type="text" name="title" class="form-control" id="Title" placeholder="Titre">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <label for="inputDescription" class="control-label">Description</label>
                                    <textarea name="description" class="form-control input-lg" id="inputDescription"></textarea>
                                </div>
                            </div>                               
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <button type="submit" class="btn btn-success">Ajouter</button>
                        </div>
                        <!-- /.box-footer -->
                    </form>
                    <br>
                </div>
            </div>
        </div>
        
    </div>
</section>
<!-- /.content -->