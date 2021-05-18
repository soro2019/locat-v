<!-- Main content -->
<section class="content">

  <!-- /.box -->
	<div class="box">
		<div class="box-header">
		  <h3 class="box-title">Categories List</h3>
		</div>
		<!-- /.box-header -->
		<div class="box-body">
		  <table id="example1" class="table table-bordered table-striped">
		    <thead>
		    <tr>
		        <th><input type="checkbox" name="checked0" onclick="toggle(this);"></th>
            <th>ID</th>
		        <th>Name</th>
		        <th>Description</th>
            <th>Actions</th>
		    </tr>
		    </thead>
		    <tbody>
		      <?php foreach($category as $category) { ?>
            <tr>
              <td><input type="checkbox" name="checked" value="<?=$category['id']?>"></td>
              <td><?=$category['id']?></td>
              <td><?=$category['name']?></td>
              <td><?=$category['description']?></td>
              <td>
                <div id="myModal2<?=$category['id']?>" class="modal fade" role="dialog">
                  <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">
                            Modifying the category <?=$category['name'] ?>
                        </h4>
                      </div>
                      <div class="modal-body">
                    
                      </div>
                    </div>
                  </div>
                </div>
                <div id="myModal3<?=$category['id']?>" class="modal fade" role="dialog">
                  <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">
                            Modifying the category <?=$category['id'] ?>
                        </h4>
                      </div>
                      <div class="modal-body">
                                                                          
                        <!-- corps du modal -->
                              
                      </div>
                    </div>
                  </div>
                </div>
                <div id="myModal4<?=$category['id']?>" class="modal fade" role="dialog">
                  <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">
                            Modifying the category <?=$category['id'] ?>
                        </h4>
                      </div>
                      <div class="modal-body">
                                                                          
                        <!-- corps du modal -->
                              
                      </div>
                    </div>
                  </div>
                </div>
                <div class="btn-group">
                  <button data-toggle="dropdown" class="btn btn-default btn-sm dropdown-toggle" type="button">
                      Actions <span class="caret"></span></button>
                  <ul class="dropdown-menu">
                      <li><a href="#" data-backdrop="static" data-toggle="modal" data-target="#myModal2<?=$category['id']?>">View</a></li>
                      <li><a href="#" data-backdrop="static" data-toggle="modal" data-target="#myModal3<?=$category['id']?>">Modify</a></li>
                      <li><a href="#" data-backdrop="static" data-toggle="modal" data-target="#myModal4<?=$category['id']?>">Delete</a></li>
                  </ul>
                </div>
              </td>

            </tr>
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
