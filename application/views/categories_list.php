<!-- Main content -->
<section class="content">

  <!-- /.box -->
  <div class="box box-default">
    <div class="box-header with-border">
        <div class="container-fluid">
          <h3 class="box-title">Categories List</h3>
        </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <div class="container-fluid">
        <br>
        <table id="example1" class="table table-bordered table-striped">
          <thead>
          <tr>
              <th>N°</th>
              <th>Name</th>
              <!-- <th>Slug</th> -->
              <!-- <th>Parent Category</th> -->
              <th>Description</th>
              <!-- <th>Code</th> -->
              <th>Actions</th>
          </tr>
          </thead>
          <tbody>
            <?php foreach($categories as $category) { ?>
              <tr>
                <td><?=$category['id']?></td>
                <td><?=$category['name']?></td>
                <td><?=$category['description']?></td>
                <td>
                  <div class="btn-group">
                    <button data-toggle="dropdown" class="btn btn-default btn-sm dropdown-toggle" type="button">
                        Actions <span class="caret"></span></button>
                    <ul class="dropdown-menu">
                        <!-- <li><a href="#" data-backdrop="static" data-toggle="modal" data-target="#myModal2<?=$category['id']?>">View</a></li> -->
                        <li><a href="#" data-backdrop="static" data-toggle="modal" data-target="#myModal3<?=$category['id']?>">Modify</a></li>
                        <li><a href="#" data-backdrop="static" data-toggle="modal" data-target="#myModal4<?=$category['id']?>">Delete</a></li>
                    </ul>
                  </div>
                </td>

              </tr>

              <div id="myModal3<?=$category['id']?>" class="modal fade" role="dialog">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title">
                      Modifying the Category<strong> <?=$category['name'] ?> </strong>
                      </h4>
                    </div>
                    <form class="form-horizontal" action="<?php echo site_url('divers/categories/'.$category['id']) ?>" method="POST">
                      <div class="modal-body">
                        <div class="row">
                          <div class="col-sm-12">
                            <label for="Title">Name *</label>
                            <input type="text" class="form-control" name="name" id="Title" placeholder="Name" value="<?=$category['name'] ?>" required>
                          </div>
                        </div><br>
                        <div class="row">
                          <div class="col-sm-12">
                            <label for="inputDescription">Description </label>
                            <textarea class="form-control" style="resize:none" name="description" id="inputDescription" placeholder="Description"><?=$category['description'] ?></textarea>
                          </div>
                        </div><br>
                      
                        <!-- <div class="row">
                          <div class="col-sm-12">
                            <label for="code">Code</label>
                            <input type="text" class="form-control" name="code" id="code" placeholder="Code" value="<?//=$category['code'] ?>">
                          </div>
                        </div><br> -->
                      </div>
                      <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Save</button>
                      </div>
                    </form>
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
                          Delete the category <?=$category['id'] ?>
                      </h4>
                    </div>
                    <div class="modal-body">
                                                                        
                      <!-- corps du modal -->
                      <div class="row">
                        <div class="col-sm-12">
                          Do you really want to delete this category ?
                        </div>
                      </div><br>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-danger" data-dismiss="modal">NO</button>
                      <a href="<?=site_url('divers/delete_category/'.$category['id'])?>" type="button" class="btn btn-success">YES</a>
                    </div>
                            
                    </div>
                  </div>
                </div>
              </div>


            <?php } ?>
          </tbody>
        </table>
        <br>
      </div>
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
