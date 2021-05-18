<!-- Main content -->
<style type="text/css">
	table, th, td {
      border: 1px solid black !important;
   }
</style>
<section class="content">
  <table class="table">
	  <thead>
	    <tr>
	      <th colspan="6" style="background-color: #3c8dbc !important; color: white; font-size: 16px; font-weight: bold; text-align: center;">Group Authorizations</th>
	    </tr>
	  </thead>
	  <tbody>
	    <tr>
	      <td rowspan="2" width="100px" style="font-size: 16px; font-weight: bold; text-align: center;">Feature Name</td>
	      <td colspan="5" style="font-size: 16px; font-weight: bold; text-align: center;">Permissions</td>
	    </tr>
	    <tr>
	      <td width="20px" style="font-size: 16px; font-weight: bold; text-align: center;">View</td>
	      <td width="20px" style="font-size: 16px; font-weight: bold; text-align: center;">Add</td>
	      <td width="20px" style="font-size: 16px; font-weight: bold; text-align: center;">Edit</td>
	      <td width="20px" style="font-size: 16px; font-weight: bold; text-align: center;">Delete</td>
	      <td width="500px" style="font-size: 16px; font-weight: bold; text-align: center;">Divers</td>
	    </tr>
	    <tr>
	      <th>Products</th>
	      <td width="20px" style="font-size: 16px; font-weight: bold; text-align: center;">
	        <input type="checkbox" name="" <?php echo_checked($permission["product-list"]); ?> >
	      </td>
	      <td width="20px" style="font-size: 16px; font-weight: bold; text-align: center;">
	      	<input type="checkbox" name="" <?php echo_checked($permission["product-add"]); ?>>
	      </td>
	      <td width="20px" style="font-size: 16px; font-weight: bold; text-align: center;">
	      	<input type="checkbox" name="" <?php echo_checked($permission["product-list"]); ?>>
	      </td>
	      <td width="20px" style="font-size: 16px; font-weight: bold; text-align: center;">
	        <input type="checkbox" name="" <?php echo_checked($permission["product-list"]); ?>>
	      </td>
	      <td width="500px" style="font-size: 16px; font-weight: bold;">
	      	<div class="row">
	      		<div class="col-sm-4"><input type="checkbox" name="" <?php echo_checked($permission["product-import"]); ?>> Import</div>
	      		<div class="col-sm-4"><input type="checkbox" name=""> Import</div>
	      		<div class="col-sm-4"><input type="checkbox" name=""> Import</div>
	      	</div>
	      	<div class="row">
	      		<div class="col-sm-4"><input type="checkbox" name=""> Import</div>
	      		<div class="col-sm-4"><input type="checkbox" name=""> Import</div>
	      		<div class="col-sm-4"><input type="checkbox" name=""> Import</div>
	      	</div>
	      </td>
	    </tr>
	    <tr>
	      <th>Inventory</th>
	      <td width="20px" style="font-size: 16px; font-weight: bold; text-align: center;">
	      	<input type="checkbox" name="">
	      </td>
	      <td width="20px" style="font-size: 16px; font-weight: bold; text-align: center;">
	      	<input type="checkbox" name="">
	      </td>
	      <td width="20px" style="font-size: 16px; font-weight: bold; text-align: center;">
	      	<input type="checkbox" name="">
	      </td>
	      <td width="20px" style="font-size: 16px; font-weight: bold; text-align: center;">
	        <input type="checkbox" name="">
	      </td>
	      <td width="500px" style="font-size: 16px; font-weight: bold;">
	      	<div class="row">
	      		<div class="col-sm-4"><input type="checkbox" name=""> Import</div>
	      		<div class="col-sm-4"><input type="checkbox" name=""> Import</div>
	      		<div class="col-sm-4"><input type="checkbox" name=""> Import</div>
	      	</div>
	      	<div class="row">
	      		<div class="col-sm-4"><input type="checkbox" name=""> Import</div>
	      		<div class="col-sm-4"><input type="checkbox" name=""> Import</div>
	      		<div class="col-sm-4"><input type="checkbox" name=""> Import</div>
	      	</div>
	      </td>
	    </tr>
	    <tr>
	      <th>User Management</th>
	      <td width="20px" style="font-size: 16px; font-weight: bold; text-align: center;">
	      	<input type="checkbox" name="">
	      </td>
	      <td width="20px" style="font-size: 16px; font-weight: bold; text-align: center;">
	      	<input type="checkbox" name="">
	      </td>
	      <td width="20px" style="font-size: 16px; font-weight: bold; text-align: center;">
	      	<input type="checkbox" name="">
	      </td>
	      <td width="20px" style="font-size: 16px; font-weight: bold; text-align: center;">
	        <input type="checkbox" name="">
	      </td>
	      <td width="500px" style="font-size: 16px; font-weight: bold;">
	      	<div class="row">
	      		<div class="col-sm-4"><input type="checkbox" name=""> Import</div>
	      		<div class="col-sm-4"><input type="checkbox" name=""> Import</div>
	      		<div class="col-sm-4"><input type="checkbox" name=""> Import</div>
	      	</div>
	      	<div class="row">
	      		<div class="col-sm-4"><input type="checkbox" name=""> Import</div>
	      		<div class="col-sm-4"><input type="checkbox" name=""> Import</div>
	      		<div class="col-sm-4"><input type="checkbox" name=""> Import</div>
	      	</div>
	      </td>
	    </tr>
	    <tr>
	      <th>Settings</th>
	      <td width="20px" style="font-size: 16px; font-weight: bold; text-align: center;">
	      	<input type="checkbox" name="">
	      </td>
	      <td width="20px" style="font-size: 16px; font-weight: bold; text-align: center;">
	      	<input type="checkbox" name="">
	      </td>
	      <td width="20px" style="font-size: 16px; font-weight: bold; text-align: center;">
	      	<input type="checkbox" name="">
	      </td>
	      <td width="20px" style="font-size: 16px; font-weight: bold; text-align: center;">
	        <input type="checkbox" name="">
	      </td>
	      <td width="500px" style="font-size: 16px; font-weight: bold;">
	      	<div class="row">
	      		<div class="col-sm-4"><input type="checkbox" name=""> Import</div>
	      		<div class="col-sm-4"><input type="checkbox" name=""> Import</div>
	      		<div class="col-sm-4"><input type="checkbox" name=""> Import</div>
	      	</div>
	      	<div class="row">
	      		<div class="col-sm-4"><input type="checkbox" name=""> Import</div>
	      		<div class="col-sm-4"><input type="checkbox" name=""> Import</div>
	      		<div class="col-sm-4"><input type="checkbox" name=""> Import</div>
	      	</div>
	      </td>
	    </tr>
	    <tr>
	      <th>Backup</th>
	      <td colspan="6" style="font-size: 16px; font-weight: bold;">
	      	<div class="row">
	      		<div class="col-sm-4"><input type="checkbox" name=""> Backup</div>
	      	</div>
	      </td>
	    </tr>
	    <tr>
	      <th>Documentation</th>
	      <td colspan="6" style="font-size: 16px; font-weight: bold;">
	      	<div class="row">
	      		<div class="col-sm-4"><input type="checkbox" name=""> Read</div>
	      		<div class="col-sm-4"><input type="checkbox" name=""> Update</div>
	      	</div>
	      </td>
	    </tr>
	  </tbody>
	</table>
</section>
<!-- /.content -->