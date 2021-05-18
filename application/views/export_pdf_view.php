<!-- Main content -->
<?php defined('BASEPATH') OR exit('No direct script access allowed');
  $group_id = $this->session->userdata('group_id');
  $permissions = $this->Crud_model->getPermission($group_id);
  $setting = $this->Crud_model->selectSettings();
 ?>
<!DOCTYPE html>
<html>
<head>
 <link rel="stylesheet" href="<?=site_url('assets/')?>bower_components/bootstrap/dist/css/bootstrap.min.css">
 <style type="text/css" media="all">
   @import "<?=site_url('assets/css/print.css')?>";
   @media print 
   {
     .no-print { display: none; }
   }
</style>
</head>
<body>
	<?php 

	   $id = $this->uri->segment(3);

	   $name = $this->db->get_where('inventory', ['id_inventory' => $id])->row_array()["nom_inventaire"];

	?>
	<div style="width: 1000px; height: 50px; font-weight: bold; margin-left: 50px; font-size: 20px;">
	  INVENTORY REPORT : <?=strtoupper($name)?>
	</div>
<table id="customers">
  <thead>
	  <tr>
	      <th>Code</th>
	      <th>Name</th>
	      <th>Quantity submitted</th>
	      <th>Quantity inventoried</th>
	      <th>Submission date</th>
	      <th>Counting date</th>
	      <th>Validation date</th>
	      <th>Count Result</th>
	      <th>Conclusion</th>
	  </tr>
  </thead>
  <tbody>
  	<?php $i=0; if(!is_bool($rapports) && count($rapports) > 0){ foreach($rapports as $rapports){ $i++;
  		$name = $this->db->get_where('products', ['id' => $rapports['id_products']])->row_array()['name'];
  	  $rapport = $rapports['qntvalider'] - $rapports['qntsoumise'];
  	  if($rapport < 0)
  	  {
  	  	$rap = /*'<span class="label label-danger">'.*/(-$rapport)/*.'</span>'*/;
  	  	$con = "Marquant";
  	  }elseif($rapport==0)
  	  {
  	  	$rap = /*'<span class="label label-success">*/0/*</span>'*/;
  	  	$con ="Conforme";
  	  }else
  	  {
  	  	$rap = /*'<span class="label label-warning">'.*/($rapport)/*.'</span>'*/;
  	  	$con ="Sur plus";
  	  }

  	  $datevalidate = date($setting['format_date'],$rapports['datevalidate']);
      $date_add = date($setting['format_date'],$rapports['date_ad']);
      $datecompte = date($setting['format_date'],$rapports['datecompte']);
  	?>
      <tr>
      	<td><?=$rapports['code']?></td>
      	<td><?=$name?></td>
      	<td><?=$rapports['qntsoumise']?></td>
      	<td><?=$rapports['qntvalider']?></td>
      	<td><?=$date_add?></td>
      	<td><?=$datecompte?></td>
      	<td><?=$datevalidate?></td>
      	<td><?=$rap?></td>
      	<td><?=$con?></td>
      </tr>
    <?php } } ?>  
  </tbody>
</table>
<br>
<div class="row no-print">
  <div class="col-sm-1"></div>
  <div class="col-sm-3">
  	<button onclick="window.print();" class="btn btn-block btn-primary">Imprimer</button>
  </div>
  <div class="col-sm-3">
  	<a class="btn btn-block btn-warning" href="<?= site_url('inventory/rapports/'.$id); ?>"><?='Retour'; ?></a>
  </div>
</div>
</body>
</html>

                  