<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-default">
				<div class="box-header with-border">
					<div class="container-fluid">
						<h3 class="box-title">Ajouter un produit</h3>
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
								<p class="pt-10 f-13">Complétez les informations ci-dessous. Les champs marqués d'un * sont des champs de saisie obligatoires.</p>
								<br>
										<form action="" method="POST">
											<div class="row">
													<div class="col-sm-3 mb-15">
														<label>Marque *</label>
														<select class="form-control select2" id="brand" name="brand">
					                                    <option value="">Choisir une marque</option>
					                                     <?php foreach ($brand as $brand){ ?>
					                                    	<option value="<?=$brand['id']?>"><?=ucfirst($brand['name'])?></option>
					                                    <?php } ?>
					                                  </select>
													</div>
													<div class="col-sm-4 mb-15">
														<label>Modèle de l'appariel *</label>
														<input class="form-control input-md" name='name' type="text" placeholder="Modèle de l'appariel" required value="<?=isset_value('name')?>">
													</div>
					                                <div class="col-sm-2 mb-15">
														<label>Quantité *</label>
														<input type="number" min="0" name="quantity" class="form-control input-md" value="<?=isset_value('quantity')?>" placeholder="Quantité" required>
													</div>
					                                <div class="col-sm-3 mb-15">
					                                    <label>Prix de vente unitaire</label>
														<input class="form-control input-md" value="<?=isset_value('prix_vente')?>" name='prix_vente'  min="0" type="number" placeholder="Prix vente">
					                                </div>
					                        </div>
											<div class="row">
												<div class="col-sm-6 mt-15">
													<button type="submit" class="btn btn-primary" >Ajouter</button>
												</div>
											</div>
										</form>
							</div>		
							
						</div><br>
					</div>
				</div>

				
			</div>
		</div>
	</div>

</section>
<!-- /.content -->

