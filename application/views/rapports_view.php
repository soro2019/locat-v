<!-- Main content -->
<?php defined('BASEPATH') OR exit('No direct script access allowed');
  $group_id = $this->session->userdata('group_id');
  $permissions = $this->Crud_model->getPermission($group_id);
  $setting = $this->Crud_model->selectSettings();
 ?>
 <section class="content">
  <div class="row">
    <div class="col-sm-12">
    	<div class="box box-default">
    		<div class="box-header with-border">
	          <div class="container-fluid">
	    		 <h3 class="box-title">Rapport de l'inventaire</h3>
	          </div>
    		</div>
        <!-- /.box-header -->
        	<div class="row">
	          <div class="col-sm-12">
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
              <div class="col-sm-12">
        		<div class="box-body">
                  <div class="container-fluid">
                   <br>
                   <?php //var_dump($this->uri->segment(3));die; ?>
                    <div class="row">
                    	<div class="col-sm-4"></div>
                    	<div class="col-sm-4">
                    		<a href="<?=site_url('inventory/export_pdf/'.$this->uri->segment(3))?>" class="btn btn-default">Export PDF</a>
                    		<a href="<?=site_url('inventory/exportations/'.$this->uri->segment(3))?>" class="btn btn-default">Export CSV</a>
                    	</div>
                    </div>
          		    <table id="example1" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                      <thead>
                      <tr>
                          <th><input type="checkbox" name="checked0" onclick="toggle(this);"></th>
                          <th>Code</th>
                          <th>Modéle Produit</th>
                          <th>Quantité Virtuelle</th>
                          <th>Quantité Physique 1</th>
                          <th>Quantité Physique 2</th>
                          <th>Rapport</th>
                          <th>Actions</th>
                      </tr>
                      </thead>
                      <tbody>
                      	<?php $i=0; if(!is_bool($rapports) && count($rapports) > 0){ foreach($rapports as $rapports){ $i++;
                      		$name = $this->db->get_where('products', ['id' => $rapports['id_products']])->row_array()['name'];
                      	  $rapport = $rapports['qntvalider'] - $rapports['qntsoumise'];
                      	  if($rapport < 0)
                      	  {
                      	  	$rap = '<span class="label label-danger">'.(-$rapport).'</span>';
                      	  }elseif($rapport==0)
                      	  {
                      	  	$rap = '<span class="label label-success">Conforme</span>';
                      	  }else
                      	  {
                      	  	$rap = '<span class="label label-info">'.($rapport).'</span>';
                      	  }

                      	  if(strlen($name) > 25)
                      	  {
                      	  	$name = substr($name, 0, 25).'...';
                      	  }
                  	  
                      	?>
                          <tr>
                          	<td><?=$i?></td>
                          	<td><?=$rapports['code']?></td>
                          	<td><?=$name?></td>
                          	<td style="color:blue; font-weight: bold; font-size: 20px;"><?=$rapports['qntsoumise']?></td>
                            <td><?=$rapports['qntcompter']?></td>
                          	<td style="color:red; font-weight: bold; font-size: 20px;"><?=$rapports['qntvalider']?></td>
                          	<td><?=$rap?></td>
                          	<td>
                          	 <div class="btn-group">
	                            <a type="button" href="#" data-backdrop="static" data-toggle="modal" class="btn btn-primary" data-target="#Details" onclick="details(<?=$rapports['id_products']?>);">Détails</a>
                             </div>	
                          	</td>
                          </tr>
                        <?php } } ?>  
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
         </div>
       </div>
   </section>

  <div class="modal modal-default fade" id="Details">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">
                    <center>
                        <h2 class="box-title">Détail de la ligne</h2>
                    </center>
                </h4>
            </div>
            <div class="modal-body box box-primary" id="detail_line">
                 
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>  
</div>

<script type="text/javascript">
	function details(id_products){
	    var base_url = "<?php echo base_url('inventory/');?>";
	    $.ajax({
	            url: base_url+'modaldatail/',
	            type: 'POST',
	            data : {id_products : id_products},
	            dataType: 'json',
	            success:function(response) {
	                document.getElementById('detail_line').innerHTML=response;
	            }
	        });
	     
	  }
</script>