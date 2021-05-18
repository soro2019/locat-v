<div class="row">
  	<div class="col-sm-1"></div>
  	<div class="col-sm-10">
	 <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Add Product</h3>
        </div>
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
	      	Fill in the information below. Field labels marked with * are required input fields.<br><hr>
	        <div class="row">
	       	<?php if($champs['name']==1){ ?>
		       	<div class="col-sm-4">
		       		<label>Product Name *</label>
		       		<input class="form-control input-sm" name='name' type="text" placeholder="Product Name" required value="<?php isset_value('name'); ?>">
		       	</div>
		    <?php } ?>
	       	<?php if($champs['code']==1){ ?>
		       	<div class="col-sm-4">
		       		<label>Product code *</label>
		       		<input class="form-control input-sm" name='code' type="text" placeholder="Product code" required value="<?php isset_value('code'); ?>">
		       	</div>
		    <?php } ?>
		    <?php if($champs['ref']==1){ ?>
		       	<div class="col-sm-4">
		       		<label>Reference *</label>
		       		<input class="form-control input-sm" name='ref' type="text" placeholder="Reference" required value="<?php isset_value('ref'); ?>">
		       	</div>
		    <?php } ?>
	       </div><br>
	       <div class="row">
	       	<?php if($champs['category']==1){ ?>
		       	<div class="col-sm-4">
		       		<label>Category *</label>
		       		<select class="form-control input-sm select2" name='category_id' required>
		       			<option value="">Choose a category</option>
		       			<?php foreach ($category as $category){ 
		       				$selected = "";
                                    if($_POST['category_id']==$category['id']){
                                       $selected = "selected";
                                    }

                         ?>
                        	<option value="<?=$category['id']?>" <?=$selected?>><?=ucfirst($category['name'])?></option>
                        <?php } ?>
		       		</select>
		       	</div>
		    <?php } ?>
	       	<?php if($champs['brand']==1){ ?>
		       	<div class="col-sm-4">
		       	  <label>Brand *</label>
                  <select class="form-control input-sm select2" id="statut" name="brand" required>
                    <option value="">Choose a brand</option>
                     <?php foreach ($brand as $brand){ 
                     		$selected = "";
                                    if($_POST['brand']==$brand['id']){
                                       $selected = "selected";
                                    }
                      ?>
                    	<option value="<?=$brand['id']?>" <?=$selected?>><?=ucfirst($brand['name'])?></option>
                    <?php } ?>
                  </select>
		       	</div>
		    <?php } ?>
		    <?php if($champs['quantity']==1){ ?>
		       	<div class="col-sm-4">
		       		<label>Quantity *</label>
		       		<input class="form-control input-sm" name='quantity' type="number" placeholder="Quantity" required value="<?php isset_value('quantity'); ?>">
		       	</div>
		    <?php } ?>
	       </div>
	       <br>
	       <div class="row">
	       	<?php if($champs['price']==1){ ?>
		       	<div class="col-sm-4">
		       		<label>Unit sale price *</label>
		       		<input type="number" name="price" class="form-control input-sm" required value="<?php isset_value('price'); ?>">
		       	</div>
		    <?php } ?>
	       	<?php if($champs['supplier']==1){ ?>
		       	<div class="col-sm-4">
		       	  <label>Supplier *</label>
                  <select class="form-control input-sm" id="statut" name="supplier" required>
                    <option value="">Choose a supplier</option>
                     <?php foreach ($suppliers as $supplier){
                     	$selected = "";
                                    if($_POST['supplier']==$supplier['id']){
                                       $selected = "selected";
                                    }
                      ?>
                    	<option value="<?=$supplier['id']?>" <?=$selected?>><?=ucfirst($supplier['name'])?></option>
                    <?php } ?>
                  </select>
		       	</div>
		    <?php } ?>
		    <?php if($champs['location']==1){ ?>
		       	<div class="col-sm-4">
		       		<label>Location *</label>
		       		<select class="form-control input-sm " id="statut" name="warehouse" required>
	                    <option value="">Choose a location</option>
	                     <?php foreach($locations as $location){ 

	                     	 $selected = "";
                                    if($_POST['warehouse']==$location['id']){
                                       $selected = "selected";
                                    }
	                     ?>
	                    	<option value="<?=$location['id']?>" <?=$selected?>><?=ucfirst($location['location'])?></option>
	                    <?php } ?>
	                </select>
		       	</div>
		    <?php } ?>
	       </div>
	       <br><br>
	       <div class="row">
	       	 <div class="col-sm-6">
	       	 	<button type="submit" class="btn btn-success" >Add Product</button> <!-- type="submit" class="btn btn-success" name="btn" value="Add Product"> -->
	       	 </div>
	       </div>
	      </div>
	    </form>
      </div>
  	</div>
  </div>