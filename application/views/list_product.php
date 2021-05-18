<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-sm-12">
		  	<!-- /.box -->
			<div class="box box-default">
				<div class="box-header with-border">
					<div class="container-fluid">
				  		<h3 class="box-title">Liste des appareils</h3>
				  	</div>
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
				<!-- /.box-header -->
				<div class="row">
					<div class="col-sm-12">
						<div class="box-body">
							<div class="row">
			                    <form>
			                        <fieldset style="border: #505458 2px solid; border-radius:5px; margin:2em;">
			                            <legend style='border: none; border-radius:3px;background-color: #505458;color: #fff;padding: 2px 10px; width: 6.5em; margin-left: 1em; font-size: 1.25em;'>Filtre</legend>
			                               <div class="col-md-4">
				                              <div class="form-group">
				                                <label>Code Identificateur</label>
				                                <input type="text" id="code" class="form-control" placeholder="Code Identificateur">
				                              </div>
				                            </div>
			                            	<div class="col-md-4">
				                              <div class="form-group">
				                                  <label>Marque</label>
				                                  <select class="form-control select2" id="brand">
				                                    <option value="">Choisir une marque</option>
				                                     <?php foreach ($brand as $brand){ ?>
				                                    	<option value="<?=$brand['id']?>"><?=ucfirst($brand['name'])?></option>
				                                    <?php } ?>
				                                  </select>
				                              </div>
				                            </div>
				                            <div class="col-md-4">
				                              <div class="form-group">
				                                  <label>Modèle de l'appareil</label>
				                                  <input type="text" id="name" class="form-control" placeholder="Modèle de l'appareil">
				                              </div>
				                            </div>
			                        </fieldset>
			                    </form>
				            </div>

				            <div class="container-fluid">               
							 <!-- Search filter -->
				                <div class="table-responsive">
								  <table id="productTable" class="table table-bordered table-striped">
								    <thead>
								    <tr>
								      <th><input type="checkbox" name="checked0" onclick="toggle(this);"></th>
								       <th>Identifiant</th>
								       <th>Marque</th>
								       <th>Modèle de l'appareil</th>
								       <th>Quantité</th>
								       <th>Prix de vente</th>
								       <th>Status</th>
								       <th>Actions</th>
								    </tr>
								    </thead>
								    <tbody>

								     
								    </tbody>
								  </table>
								</div>
								  <br>
						  	</div>
						</div>
						<!-- /.box-body -->
					</div>
				</div>
			</div>
			<!-- /.box -->
		</div>
	</div>
</section>
<!-- /.content -->

<div class="modal modal-default fade" id="Dproduct">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">
                    <center>
                        <h2 class="box-title">Supprimé ce produit</h2>
                    </center>
                </h4>
            </div>
            <div class="modal-body box box-primary" id="deleteproduct">
                 
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>  
</div>


<div class="modal modal-default fade" id="Eproduct">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">
                    <center>
                        <h2 class="box-title">Modifier le produit</h2>
                    </center>
                </h4>
            </div>
            <div class="modal-body box box-primary" id="editproduct">
                 
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>  
</div>


<script type="text/javascript">
  function toggle(source)
  {
    var checkboxes = document.querySelectorAll('input[type="checkbox"]');
    for(var i = 0; i < checkboxes.length; i++) {
        if (checkboxes[i] != source)
            checkboxes[i].checked = source.checked;
    }
  }

  function editproduct(id_product){
  	var base_url = "<?php echo base_url('products/');?>";
    $.ajax({
            url: base_url+'modaleditproduct/',
            type: 'POST',
            data : {id_product : id_product},
            dataType: 'json',
            success:function(response) {
                document.getElementById('editproduct').innerHTML=response;
            }
        });
     
  }

  function deleteproduct(id_product){
  	var base_url = "<?php echo base_url('products/');?>";
    $.ajax({
            url: base_url+'modaldeleteproduct/',
            type: 'POST',
            data : {id_product : id_product},
            dataType: 'json',
            success:function(response) {
                document.getElementById('deleteproduct').innerHTML=response;
            }
        });
     
  }

</script>



