<!-- Main content -->
<section class="content">

  <!-- /.box -->
	<div class="box">
		<div class="box-header">
		    <h3 class="box-title">Liste des marques</h3>
		</div>
		<!-- /.box-header -->
		<div class="box-body">
		    <table id="example1" class="table table-bordered table-striped">
		        <thead>
		            <tr>
                        <th>Marque</th>
                        <th>Description</th>
                        <th>Actions</th>
		            </tr>
		        </thead>
		        <tbody>
		            <?php foreach($brands as $brand) { ?>
                        <tr>
                            <td><?= strtoupper($brand['name']) ?></td>
                            <td><?=$brand['description']?></td>
                            <td>

                                <div class="btn-group">
                                    <button data-toggle="dropdown" class="btn btn-default btn-sm dropdown-toggle" type="button">
                                        Actions <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <!-- <li><a href="#" data-backdrop="static" data-toggle="modal" >View</a></li> -->
                                        <li><a href="#" data-backdrop="static" data-toggle="modal" data-target="#myModal3<?=$brand['id']?>">Modifier</a></li>

                                        <?php if($this->Crud_model->selectProduitByBrand($brand['id']) === 0){ ?>

                                        <li><a href="#" data-backdrop="static" data-toggle="modal" data-target="#myModal4<?=$brand['id']?>">Supprimer</a></li>

                                        <?php } ?>

                                    </ul>
                                </div>
                            </td>

                        </tr>
                        <div id="myModal3<?=$brand['id']?>" class="modal fade" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">
                                        Modifié cette marque
                                        </h4>
                                    </div>
                                    <form class="form-horizontal" action="<?php echo site_url('divers/brands/'.$brand['id']) ?>" method="POST">
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label for="Title">Marque *</label>
                                                    <input type="text" class="form-control" name="name" id="Title" placeholder="Marque" value="<?=$brand['name'] ?>" required>
                                                </div>
                                            </div><br>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label for="inputDescription">Description </label>
                                                    <textarea class="form-control" style="resize:none" name="description" id="inputDescription" placeholder="Description"><?=$brand['description'] ?></textarea>
                                                </div>
                                            </div><br>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-success">Modifier</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div id="myModal4<?=$brand['id']?>" class="modal fade" role="dialog">
                            <div class="modal-dialog">
                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">
                                            Suppression de la marque : <b><?= strtoupper($brand['name']) ?></b>
                                        </h4>
                                    </div>
                                    <div class="modal-body">
                                                                                        
                                        <!-- corps du modal -->
                                        <div class="row">
                                            <div class="col-sm-12">
                                                Voulez vous vraiment supprimé cette marque ?
                                            </div>
                                        </div><br>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">NON</button>
                                        <a href="<?=site_url('divers/delete_brand/'.$brand['id'])?>" type="button" class="btn btn-success">OUI</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <?php } ?>
		        </tbody>
		    </table>
		</div>
		<!-- /.box-body -->
	</div>
  <!-- /.box -->

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
