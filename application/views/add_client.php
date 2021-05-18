<!-- Main content -->
<section class="content">
  <div class="row">
  <!-- 	<div class="col-sm-2"></div> -->
  	<div class="col-md-12">
	 <div class="box box-default">
        <div class="box-header with-border">
        	<div class="container-fluid">
          		<h3 class="box-title">Ajouter un client</h3>
          	</div>
        </div>
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
						<form action="" method="POST">
					        <div class="row">
						       	<div class="col-sm-4 mb-15">
						       		<label>Nom client *</label>
						       		<input class="form-control" name='full_name' type="text" placeholder="Nom client" required value="<?php if(isset($_POST['full_name'])) echo $_POST['full_name']; ?>">
						       	</div>

						       	<div class="col-sm-4 mb-15">
						       		<label>Prénoms client *</label>
						       		<input class="form-control" name='prenoms' type="text" placeholder="Prénoms client" required value="<?php if(isset($_POST['prenoms'])) echo $_POST['phone']; ?>">
						       	</div>
						       	<div class="col-sm-4 mb-15">
						       		<label>Contact 1 *</label>
						       		<input class="form-control" name='phone' type="tel" placeholder="Contact 1" required value="<?php if(isset($_POST['phone'])) echo $_POST['phone']; ?>">
						       	</div>
						    </div>
						    <div class="row">
						       	<div class="col-sm-4 mb-15">
						       		<label>Contact 2</label>
						       		<input class="form-control" name='phone2' type="tel" placeholder="Contact 2" value="<?php if(isset($_POST['phone2'])) echo $_POST['phone2']; ?>">
						       	</div>

						       	<div class="col-sm-4 mb-15">
						       		<label>Email</label>
						       		<input class="form-control" name='email' type="email" placeholder="Email client" value="<?php if(isset($_POST['email'])) echo $_POST['email']; ?>">
						       	</div>
						       	<div class="col-sm-4 mb-15">
						       		<label>Type de pièces </label>
						       		<select class="form-control select2" id="type_pieces" name="type_pieces">
                                        <option value="">Choisir un type</option>
                                        <option value="1" <?php echo echo_selected(valueElement('type_pieces'), 1);?> >CNI</option>
                                        <option value="2" <?php echo echo_selected(valueElement('type_pieces'), 2);?> >Attestation</option>
                                        <option value="3" <?php echo echo_selected(valueElement('type_pieces'), 3);?> >Passeport</option>
                                        <option value="4" <?php echo echo_selected(valueElement('type_pieces'), 4);?> >Carte Consulaire</option>
                                        <option value="5" <?php echo echo_selected(valueElement('type_pieces'), 5);?> >Autre</option>
                                    </select>
						       	</div>
						    </div>
						    <div class="row">
						       	<div class="col-sm-6 mb-15">
						       		<label>Numéro de la pièces</label>
						       		<input class="form-control" name='num_pieces' type="text" placeholder="Numéro de la pièces" value="<?php if(isset($_POST['num_pieces'])) echo $_POST['num_pieces']; ?>">
						       	</div>
						       	<div class="col-sm-6 mb-15">
						       		<label>Profession </label>
						       		<input class="form-control" name='profession' type="text" placeholder="profession client" value="<?php if(isset($_POST['profession'])) echo $_POST['profession']; ?>">
						       	</div>
						    </div>
						    <div class="row">
						       	<div class="col-sm-4 mb-15">
						       		<label>Date de naissance</label>
						       		<input class="form-control" name='date_naiss' type="date" placeholder="Date de naissance" value="<?php if(isset($_POST['date_naiss'])) echo $_POST['date_naiss']; ?>">
						       	</div>

						       	<div class="col-sm-4 mb-15">
						       		<label>Lieu de naissance</label>
						       		<input class="form-control" name='lieu_naiss' type="text" placeholder="Lieu de naissance" value="<?php if(isset($_POST['lieu_naiss'])) echo $_POST['lieu_naiss']; ?>">
						       	</div>
						       	<div class="col-sm-4 mb-15">
						       		<label>Lieu d'ahbitation </label>
						       		<input class="form-control" name='lieu_habi' type="text" placeholder="Lieu d'ahbitation" value="<?php if(isset($_POST['lieu_habi'])) echo $_POST['lieu_habi']; ?>">
						       	</div>
						    </div>
						       	 <div class="col-sm-6 mb-15">
						       	 	<button type="submit" class="btn btn-success" >Ajouter</button> <!-- type="submit" class="btn btn-success" name="btn" value="Add Product"> -->
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