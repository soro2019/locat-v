<!-- Main content -->
<section class="content">

  <!-- /.box -->
  <div class="box">
    <div class="box-header">
      <h3 class="box-title">Warehouses List</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <table id="example1" class="table table-bordered table-striped">
        <thead>
        <tr>
            <th><input type="checkbox" name="checked0" onclick="toggle(this);"></th>
            <th>Name</th>
            <th>Create date</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
          <?php foreach($warehouses as $warehouse) { ?>
            <tr>
              <td><input type="checkbox" name="checked" value="<?=$warehouse['id']?>"></td>
              <td><?=$warehouse['name']?></td>
              <td><?=$warehouse['create']?></td>
              <td>
                <div class="btn-group">
                  <button data-toggle="dropdown" class="btn btn-default btn-sm dropdown-toggle" type="button">
                      Actions <span class="caret"></span></button>
                  <ul class="dropdown-menu">
                      <li><a href="#" data-backdrop="static" data-toggle="modal" data-target="#myModal3<?=$warehouse['id']?>">Modify</a></li>
                      <li><a href="#" data-backdrop="static" data-toggle="modal" data-target="#myModal4<?=$warehouse['id']?>">Delete</a></li>
                  </ul>
                </div>
              </td>

            </tr>

            <div id="myModal3<?=$warehouse['id']?>" class="modal fade" role="dialog">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">
                    Modifying the warehouse<strong> <?=$warehouse['name'] ?> </strong>
                    </h4>
                  </div>
                  <form class="form-horizontal" action="<?php echo site_url('divers/warehouses/'.$warehouse['id']) ?>" method="POST">
                    <div class="modal-body">
                      <div class="row">
                        <div class="col-sm-12">
                          <label for="Title">Warehouse Name *</label>
                          <input type="text" class="form-control" name="name" id="Title" placeholder="Name" value="<?=$warehouse['name'] ?>" required>
                        </div>
                      </div><br>
                    
                    </div>
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-success">Save</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <div id="myModal4<?=$warehouse['id']?>" class="modal fade" role="dialog">
              <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">
                        Deleting the warehouse <?=$warehouse['name'] ?>
                    </h4>
                  </div>
                  <div class="modal-body">
                                                                      
                    <!-- corps du modal -->
                    <div class="row">
                      <div class="col-sm-12">
                        Do you really want to delete this warehouse ?
                      </div>
                    </div><br>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">NO</button>
                    <a href="<?=site_url('divers/delete_warehouse/'.$warehouse['id'])?>" type="button" class="btn btn-success">YES</a>
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
