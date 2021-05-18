<section class="content">
  <!-- iCheck -->
  <div class="row">
  	<div class="col-md-12">
  	  <div class="box box-default">
	    <div class="box-header with-border">
	    	<div class="container-fluid">
	      		<h3 class="box-title">Choose the fields that best characterize your products</h3>
	      	</div>
	    </div><br>
        <div class="row">
        	<div class="col-md-12">
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
        <div class="row">
            <div class="col-md-12">
                <div class="container-fluid">
				    <form action="" method="POST">
					   
					   <div class="box-body">
					   	   <div class="row">
					         	<!-- <div class="col-sm-1"></div> -->
						        <div class="col-sm-12 mb-15">
						     	  <label>
							       <input type="checkbox" name="all" onclick="toggle(this);">
							       All
							      </label>
						        </div>
						      	<div class="col-sm-2 mb-15">
						      	   <label>
						              <input type="checkbox" name="code" <?php if($champs['code']==1) echo "checked"; ?> value="1">
						              Code
						           </label>
						      	</div>
						      	<div class="col-sm-2 mb-15">
						      	   <label>
						              <input type="checkbox" name="ref" <?php if($champs['ref']==1) echo "checked"; ?> value="1">
						              Ref
						           </label>
						      	</div>
						      	<div class="col-sm-3 mb-15">
						      	   <label>
						              <input type="checkbox" name="name" <?php if($champs['name']==1) echo "checked"; ?> value="1">
						              Name
						           </label>
						      	</div>
						      	<div class="col-sm-2 mb-15">
						      	   <label>
						              <input type="checkbox" name="price" <?php if($champs['price']==1) echo "checked"; ?> value="1">
						              Price
						           </label>
						      	</div>
						      	<div class="col-sm-3 mb-15">
						      	   <label>
						              <input type="checkbox" name="category" <?php if($champs['category']==1) echo "checked"; ?> value="1">
						              Category
						           </label>
						      	</div>
						      	<div class="col-sm-3 mb-15">
						      	   <label>
						              <input type="checkbox" name="quantity" <?php if($champs['quantity']==1) echo "checked"; ?> value="1">
						              Quantity
						           </label>
						      	</div>
						      	<div class="col-sm-3 mb-15">
						      	   <label>
						              <input type="checkbox" name="brand" <?php if($champs['brand']==1) echo "checked"; ?> value="1">
						              Brand
						           </label>
						      	</div>
						      	<div class="col-sm-3 mb-15">
						      	   <label>
						              <input type="checkbox" name="supplier" <?php if($champs['supplier']==1) echo "checked"; ?> value="1">
						              Supplier
						           </label>
						      	</div>
						      	<div class="col-sm-3 mb-15">
						      	   <label>
						              <input type="checkbox" name="warehouse" <?php if($champs['warehouse']==1) echo "checked"; ?> value="1">
						              Warehouse
						           </label>
						      	</div>
						      	<div class="col-sm-6 mb-15">
						      	  <input type="submit" name="btn" class="btn btn-success" value="Update this settings">
						      	</div>
					      	</div>
					   </div>
					</form>
				</div>
			</div>
		</div>
      </div>
  	</div>
  </div>
</section>
<!-- /.content -->
<script type="text/javascript">
  function toggle(source)
  {
    var checkboxes = document.querySelectorAll('input[type="checkbox"]');
    for(var i = 0; i < checkboxes.length; i++) {
        if (checkboxes[i] != source)
            checkboxes[i].checked = source.checked;
    }
  }
</script>