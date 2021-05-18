<!-- Main content -->
<section class="content">
  <div class="row">
  	<div class="col-sm-2"></div>
  	<div class="col-md-8">
	 <div class="box box-default">
        <div class="box-header with-border">
        	<div class="container-fluid">
          		<h3 class="box-title">Approvisionnement des produits</h3>
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
						       	<div class="col-sm-6 mb-15">
						       		<label>Marque *</label>
                                    <select class="form-control select2" id="brand" name="idbrand" required="">
                                        <option value="">Choisir une marque</option>
                                         <?php foreach ($brands as $brand){
                                         ?><option value="<?=$brand['id']?>" <?php echo echo_selected(valueElement('idbrand'), $brand['id']); ?>  ><?=ucfirst($brand['name'])?></option>
                                        <?php } ?>
                                    </select>
						       	</div>
						       	<div class="col-sm-6 mb-15">
						       		<label>Modèle *</label>
						       		<select class="form-control select2" id="modele" name="idProduit" required="">
                                        <option value="">Choisir une mar d'abord</option>
                                    </select>
						       	</div>
						    </div>
						    <div class="row">
						    	<div class="col-sm-6 mb-15">
						       		<label>Quantité actuelle *</label>
						       		<input class="form-control" id='qntbis' disabled value="0" style="font-size: 25px; font-weight: bold;">
						       	</div>	
						      	<div class="col-sm-6 mb-15">
						       		<label>Quantité ajoutée *</label>
						       		<input class="form-control" name='qnt' min="1" type="number" placeholder="Quantité ajoutée" required value="">
						       	</div>	
						    </div><br/>
						    <div class="row">
						       	 <div class="col-sm-6 mb-15">
						       	 	<button type="submit" class="btn btn-primary" >Provisionner </button> <!-- type="submit" class="btn btn-success" name="btn" value="Add Product"> -->
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