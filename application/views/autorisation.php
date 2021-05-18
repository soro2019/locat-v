<!-- Main content -->
<style type="text/css">
	table, th, td {
      border: 1px solid black !important;
   }
</style>
<section class="content">
	<form action="<?=site_url('usermanagement/update_permission/'.$id_group)?>" method="POST">
		<table class="table bg-white">
			<thead>
				<tr>
				<th colspan="6" style="background-color: #3c8dbc !important; color: white; font-size: 16px; font-weight: bold; text-align: center;">Autorisation des groupes</th>
				</tr>
			</thead>
			<tbody>
				<tr>
				<td rowspan="2" width="100px" style="font-size: 16px; font-weight: bold; ">Fonctionnalités</td>
				<td colspan="5" style="font-size: 16px; font-weight: bold;">
   					<div class="row">
						<div class="col-sm-2"><label style="text-align:left!important;"><input type="checkbox" onclick="toggle(this);">&ensp;Tous les droits</label></div>
						<div class="col-sm-10"  style="text-align: center;"> Permissions </div>
					</div>
				</td>
				</tr>
				<tr>
				<td width="20px" style="font-size: 16px; font-weight: bold; text-align: center;">Lister</td>
				<td width="20px" style="font-size: 16px; font-weight: bold; text-align: center;">Ajouter</td>
				<td width="20px" style="font-size: 16px; font-weight: bold; text-align: center;">Modifier</td>
				<td width="20px" style="font-size: 16px; font-weight: bold; text-align: center;">Supprimer</td>
				<td width="500px" style="font-size: 16px; font-weight: bold; text-align: center;">Autres</td>
				</tr>
				<tr>
				<th>Produits</th>
				<td width="20px" style="font-size: 16px; font-weight: bold; text-align: center;">
					<input type="checkbox" name="product-list" value='1' <?php echo_checked($permission["product-list"]); ?> >
				</td>
				<td width="20px" style="font-size: 16px; font-weight: bold; text-align: center;">
					<input type="checkbox" name="product-add" value='1' <?php echo_checked($permission["product-add"]); ?>>
				</td>
				<td width="20px" style="font-size: 16px; font-weight: bold; text-align: center;">
					<input type="checkbox" name="product-edit" value='1' <?php echo_checked($permission["product-edit"]); ?>>
				</td>
				<td width="20px" style="font-size: 16px; font-weight: bold; text-align: center;">
					<input type="checkbox" name="product-delete" value='1' <?php echo_checked($permission["product-delete"]); ?>>
				</td>
				<td width="500px" style="font-size: 16px; font-weight: bold;">
					<div class="row">
						<div class="col-sm-6"><label><input type="checkbox" name="product-import" value='1' <?php echo_checked($permission["product-import"]); ?>> Import<label></div>
						<div class="col-sm-6"><label><input type="checkbox" name="product-export" value='1' <?php echo_checked($permission["product-export"]); ?>> Export<label></div>
					</div>
				</td>
				</tr>
				<tr>
				<th>Inventaires</th>
				<td width="20px" style="font-size: 16px; font-weight: bold; text-align: center;">
					<input type="checkbox" name="inventory-list" value='1' <?php echo_checked($permission["inventory-list"]); ?>>
				</td>
				<td width="20px" style="font-size: 16px; font-weight: bold; text-align: center;">
					<input type="checkbox" name="inventory-add" value='1' <?php echo_checked($permission["inventory-add"]); ?> >
				</td>
				<td width="20px" style="font-size: 16px; font-weight: bold; text-align: center;">
					<input type="checkbox" name="inventory-edit" value='1' <?php echo_checked($permission["inventory-edit"]); ?> >
				</td>
				<td width="20px" style="font-size: 16px; font-weight: bold; text-align: center;">
					<input type="checkbox" name="inventory-delete" value='1' <?php echo_checked($permission["inventory-delete"]); ?> >
				</td>
				<td width="500px" style="font-size: 16px; font-weight: bold;">
					
					<div class="row">
						<div class="col-sm-6"><label><input type="checkbox" name="inventory-modifie-assigne" value='1' <?php echo_checked($permission["inventory-modifie-assigne"]); ?> > Modifier l'attribution des compteurs<label></div>
						<div class="col-sm-6"><label><input type="checkbox" name="inventory-assignment" value='1' <?php echo_checked($permission["inventory-assigne-validator"]); ?> > Assigné les validateurs<label></div>
					</div>
					<div class="row">
						<div class="col-sm-6"><label><input type="checkbox" name="inventory-view" value='1' <?php echo_checked($permission["inventory-view"]); ?> > View Inventory<label></div>
						<div class="col-sm-6"><label><input type="checkbox" name="inventory-export" value='1' <?php echo_checked($permission["inventory-export"]); ?>> Export Inventory<label></div>
					</div>
					<div class="row">
						<div class="col-sm-6"><label><input type="checkbox" name="inventory-add_sub" value='1' <?php echo_checked($permission["inventory-add_sub"]); ?> > Add Sub-Inventory<label></div>
						<div class="col-sm-6"><label><input type="checkbox" name="inventory-assignment" value='1' <?php echo_checked($permission["inventory-assignment"]); ?> > Assigned Sub-Inventory to counter<label></div>	
					</div>
					<div class="row">
						<div class="col-sm-6"><label><input type="checkbox" name="inventory-list_sub" value='1' <?php echo_checked($permission["inventory-list_sub"]); ?> > List Sub-Inventory<label></div>
						<div class="col-sm-6"><label><input type="checkbox" name="inventory-edit_sub" value='1' <?php echo_checked($permission["inventory-edit_sub"]); ?> > Edit Sub-Inventory<label></div>
					</div>
					<div class="row">
						<div class="col-sm-6"><label><input type="checkbox" name="inventory-edit_sub" value='1' <?php echo_checked($permission["inventory-edit_sub"]); ?> > Modify assignation validator<label></div>
					</div>
				</td>
				</tr>
				<tr>
				<th>Gestion des utilisateurs</th>
				<td width="20px" style="font-size: 16px; font-weight: bold; text-align: center;">
					<input type="checkbox" name="userManagement-list" value='1' <?php echo_checked($permission["userManagement-list"]); ?> >
				</td>
				<td width="20px" style="font-size: 16px; font-weight: bold; text-align: center;">
					<input type="checkbox" name="userManagement-add" value='1' <?php echo_checked($permission["userManagement-add"]); ?>>
				</td>
				<td width="20px" style="font-size: 16px; font-weight: bold; text-align: center;">
					<input type="checkbox" name="userManagement-edit" value='1' <?php echo_checked($permission["userManagement-edit"]); ?>>
				</td>
				<td width="20px" style="font-size: 16px; font-weight: bold; text-align: center;" >
					
				</td>
				<td width="500px" style="font-size: 16px; font-weight: bold;">
					<div class="row">
					  <div class="col-sm-4">
					  	<label><input type="checkbox" name="userManagement-view" value="1"><?php echo_checked($permission["userManagement-view"]); ?> View details user<label>
					  </div>
					</div>
					<div class="row">
						<div class="col-sm-4"><label><input type="checkbox" name="userManagement-account_status" value='1' <?php echo_checked($permission["userManagement-account_status"]); ?>> Change Account Status<label></div>
						<div class="col-sm-4"><label><input type="checkbox" name="userManagement-list_group" value='1' <?php echo_checked($permission["userManagement-list_group"]); ?>> List Group<label></div>
						<div class="col-sm-4"><label><input type="checkbox" name="userManagement-permission" value='1' <?php echo_checked($permission["userManagement-permission"]); ?>> Edit Permission<label></div>
						
					</div>
					<div class="row">
						<div class="col-sm-4"><label><input type="checkbox" name="userManagement-add_group" value='1' <?php echo_checked($permission["userManagement-add_group"]); ?>> Add Group<label></div>
						<div class="col-sm-4"><label><input type="checkbox" name="userManagement-edit_group" value='1' <?php echo_checked($permission["userManagement-edit_group"]); ?>> Edit Group<label></div>
						<div class="col-sm-4"><label><input type="checkbox" name="userManagement-delete_group" value='1' <?php echo_checked($permission["userManagement-delete_group"]); ?>> Delete Group<label> </div>
					</div>
				</td>
				</tr>
				<tr>
				<th>Parametrage</th>
				<td colspan="6" style="font-size: 16px; font-weight: bold;">
					<div class="row">
					<div class="col-sm-4"><label><input type="checkbox" name="settings-system_settings" value='1' <?php echo_checked($permission["settings-system_settings"]); ?>> System<label></div>
					<div class="col-sm-4"><label><input type="checkbox" name="settings-product_setting" value='1' <?php echo_checked($permission["settings-product_setting"]); ?>> Products Setting<label></div>
					<div class="col-sm-4"><label><input type="checkbox" name="settings-categories" value='1' <?php echo_checked($permission["settings-categories"]); ?>> Categories (all) <label></div>
					
					</div>
					<div class="row">
						<div class="col-sm-4"><label><input type="checkbox" name="settings-brands" value='1' <?php echo_checked($permission["settings-brands"]); ?>> Brands (all) <label></div>
					<div class="col-sm-4"><label><input type="checkbox" name="settings-warehouse" value='1' <?php echo_checked($permission["settings-warehouse"]); ?>> Warehouses (all) <label></div>
					<div class="col-sm-4"><label><input type="checkbox" name="settings-supplier" value='1' <?php echo_checked($permission["settings-supplier"]); ?>> Suppliers (all) <label></div>
					</div>
				</td>
				</tr>
				<tr>
				<th>Backup</th>
				<td colspan="6" style="font-size: 16px; font-weight: bold;">
					<div class="row">
						<div class="col-sm-4"><label><input type="checkbox" name="backups" value='1' <?php echo_checked($permission["backups"]); ?>> Backup<label></div>
					</div>
				</td>
				</tr>
			</tbody>
		</table>
		<div class="row">
			<div class="col-sm-6">
				<input type="submit" name="btn" class="btn btn-success" value="Mettre à jour">
			</div>
		</div>
	</form>
</section>
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