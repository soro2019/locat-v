<!-- Main content -->
<section class="content">
  <div class="row">
  	<div class="col-md-12">
	 <div class="box box-default">
        <div class="box-header with-border">
        	<div class="container-fluid">
          		<h3 class="box-title">Ajout d'un nouvelle utilisateur</h3>
          	</div>
        </div><br>
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
        </div>
        <div class="row">
			<div class="col-md-12">
		        
			      <div class="box-body">
			      	<div class="container-fluid">
			      		<p class="pt-10 f-13">Les champs avec les * sont obligatoires.</p>
						<br>
						<form action="" method="POST">
					        <div class="row">
						       	<div class="col-sm-4 mb-15">
						       		<label>Nom *</label>
						       		<input class="form-control input-sm" name='first_name' type="text" placeholder="Nom" required value="<?php if(isset($_POST['first_name'])) echo $_POST['first_name']; ?>">
						       	</div>
						       	<div class="col-sm-4 mb-15">
						       		<label>Prénoms *</label>
						       		<input class="form-control input-sm" name='last_name' type="text" placeholder="Prénoms" required value="<?php if(isset($_POST['last_name'])) echo $_POST['last_name']; ?>">
						       	</div>
						       	<div class="col-sm-4 mb-15">
						       		<label>Nom utilisateur *</label>
						       		<input class="form-control input-sm" name='identity' type="text" placeholder="Nom utilisateur" required value="<?php if(isset($_POST['identity'])) echo $_POST['identity']; ?>">
						       	</div>
						    </div>
						    <div class="row">
						       	<div class="col-sm-4 mb-15">
						       	  <label>Groupe *</label>
				                  <select class="form-control input-sm select2" id="statut" name="group" required>
				                    <option value="">Choisir un groupe</option>
				                     <?php foreach ($groups as $group){ ?>
				                    	<option value="<?=$group['id']?>" <?php if(isset($_POST['group']) && $_POST['group'] == $group['id']) echo "selected"; ?>><?=ucfirst($group['name'])?></option>
				                    <?php } ?>
				                  </select>
						       	</div>
						       	<div class="col-sm-4 mb-15">
						       		<label>Contact </label>
						       		<input class="form-control input-sm" name='phone' type="phone" placeholder="Contact" value="<?php if(isset($_POST['phone'])) echo $_POST['phone']; ?>">
						       	</div>
						       	<div class="col-sm-4 mb-15">
						       		<label>Email </label>
						       		<input class="form-control input-sm" name='email' type="email" placeholder="Email" value="<?php if(isset($_POST['email'])) echo $_POST['email']; ?>">
						       	</div>
						    </div>
						    <div class="row">
						       	<div class="col-sm-4 mb-15">
						       	 	<button type="submit" class="btn btn-success" >Ajouter</button> <!-- type="submit" class="btn btn-success" name="btn" value="Add Product"> -->
						       	</div>
					       </div>
					    </form>
			      </div>
        	</div>
		    <!-- /.box-body -->
        </div>
      </div>
  	</div>
  </div>
</section>
<!-- /.content -->