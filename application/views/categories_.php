<!-- Main content -->
<section class="content">
  <div class="row">
  	<div class="col-sm-1"></div>
  	<div class="col-sm-10">
	 <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Add Category</h3>
        </div> <br> <br>
        <div class="row">
        	<div class="col-sm-12">
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
        <form action="" method="POST">
            <div class="box-body">
                <div class="row">
                    <div class="col-sm-12">
                        <label for="name">Name</label>
                        <input id="name" class="form-control input-sm" name='name' type="text" placeholder="Category Name" required>
                    </div>
                </div><br>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-sm-12">
                            <label for="inputDescription">Description<label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                            <textarea style="height: 100px!important; resize:none;" class="form-control" type="text" name="description" id="inputDescription" placeholder="Description"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="row">   
                    <div class="col-sm-6">
                        <label>Parent category </label>
                        <select class="form-control input-sm" name='parent_id' >
                            <option value="">Choose a category</option>
                            <?php /*foreach ($category as $category){ ?>
                                <option value="<?=$category['id']?>"><?=ucfirst($category['name'])?></option>
                            <?php }*/ ?>
                        </select>
                    </div>
                    
                </div> -->

                <div class="row">
                    <div class="col-sm-6">
                                
                    </div>
                </div><br>
                <div class="row">
                    <div class="col-sm-6">
                        <button type="submit" class="btn btn-success" >Add Category</button> <!-- type="submit" class="btn btn-success" name="btn" value="Add Product"> -->
                    </div>
                </div>
            </div>
	    </form>
        <!-- /.box-body -->
      </div>
  	</div>
  </div>
</section>
<!-- /.content