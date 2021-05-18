<?php 

defined('BASEPATH') OR exit('No direct script access allowed');
$setting = $this->Crud_model->selectSettings();
date_default_timezone_set($setting["time_zone"]);
$this->load->view('template/_parts/front_master_header_view'); ?>
<!--<meta http-equiv="Refresh" content="5; url=<=site_url('admin/tableaubord')>">-->
<section class="content">
    <br>
    
     <?php //}

      if(isset($_SESSION['message_error'])) {   ?>
        <br>
        <div class="alert alert-warning alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?php
            echo $_SESSION['message_error'];
            ?>
        </div>
    <?php  } ?>
    <br>
    <div class="panel panel-success">
        <div class="panel-heading">
            <h3 class="panel-title"><span class="fa fa-home"></span> Liste de mes blocks à inventorié</h3>
        </div>

        <?php //var_dump($data);die; ?>
        <div class="panel-body">
            <div class="table-wrap">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Inventaire</th>
                            <th>Block</th>
                            <th>Date debut</th>
                            <th>Date fin</th>
                            <th>Statut</th>
                            <th>Déjà inventorié</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(is_array($data)){foreach ($data as $data) {  
                            $resul = explode('|', $data);
                            $id_inv = (int) $resul[2];
                            $id_sub = (int) $resul[0];
                            $inv = $this->Crud_model->selectALLInventories($id_inv);
                        ?>
                        <tr>
                            <td><?=strtoupper($inv['nom_inventaire'])?></td>
                            <td><?=strtoupper($resul[1])?></td>
                            <td><?php if($resul[3]==0){echo "Pas encore commencé";}else{echo date("d/m/Y H:i:s", $resul[3]);} ?></td>
                            <td><?php if($resul[4]==0){echo "Pas encore terminé";}else{echo date("d/m/Y H:i:s", $resul[4]);} ?></td>
                            <td>
                                <?php if($resul[5] == 2){ ?>
                                <a class="statut" href="<?=site_url('main/dossier_de_inventaire/'.$id_sub.'/'.$id_inv)?>"><span class="label label-danger">Clique pour continuer</span></a>
                                <?php }  else if($resul[5] == 1){ ?>
                                <div class="statut"><span class="label label-success">Block inventorié</span></div>
                                <?php }else if($resul[5] == 0){ ?>
                                <div class="statut"><a class="statut" href="<?=site_url('main/dossier_de_inventaire/'.$id_sub.'/'.$id_inv)?>"><span class="label label-info">Clique ici pour commencer</span></a></div>
                                <?php }elseif($resul[5] == 3){ ?>
                                 <div class="statut"><span class="label label-success">Block validé</span></div>
                                <?php } ?>
                            </td>
                            <td><?php if($resul[3] !=0 and ($resul[5] == 2 || $resul[5] == 1 )){?>
                                <div class="statut"><a class="statut" href="<?=site_url('main/product_already_inventoried/'.$id_sub.'/'.$id_inv)?>"><span class="label label-info">Clique ici pour reprendre</span></a></div>

                           <?php  }else{echo ""; } ?></td>
                        </tr> 
                        <?php  } } else{ echo "<span>Aucune donnée</span>";} ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</section>

<script type="application/javascript">
    $(function() {
        $(".table-wrap").each(function() {
            var nmtTable = $(this);
            var nmtHeadRow = nmtTable.find("thead tr");
            nmtTable.find("tbody tr").each(function() {
                var curRow = $(this);
                for (var i = 0; i < curRow.find("td").length; i++) {
                    var rowSelector = "td:eq(" + i + ")";
                    var headSelector = "th:eq(" + i + ")";
                    curRow.find(rowSelector).attr('data-title', nmtHeadRow.find(headSelector).text());
                }
            });
        });
    });

</script>
<?php $this->load->view('template/_parts/front_master_footer_view');?>
