<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
$setting = $this->Crud_model->selectSettings();
date_default_timezone_set($setting["time_zone"]);

$this->load->view('template/_parts/front_master_header_view'); ?>
<!--<meta http-equiv="Refresh" content="5; url=<=site_url('admin/tableaubord')>">-->
<div class="container">
    <br>   
    <?php $this->load->view('menu_versement'); ?>
    <br>    

    <div class="panel panel-success">
        <div class="panel-heading">
            <h3 class="panel-title">Versement en cours</h3>
        </div>
        
        <div class="panel-body">
            <div class="table-wrap">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                          <th>Code vente</th>
                          <th>Client</th>
                          <th>Versement</th>
                          <th>Montant</th>
                          <th>Echéance</th>
                          <th>Status</th>
                          <th>Date paiement</th>
                          <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                       <?php if(!is_bool($encours) && count($encours) > 0){ foreach($encours as $encour) { 

                            $ventes = $this->db->get_where('ventes', array('id' => $encour['idvente']))->row_array();

                            $vente = $ventes['codeVente'];

                            $clients = $this->db->get_where('clients', array('id' => $encour['idclient']))->row_array();
                            $client = $clients['full_name'].' | '.$ventes['contatClient'];

                            $status = "Non payer";
                            $action = '<a href="'.site_url('sells/payments/'.$encour['id']).'" title="Payé maintenant"><b><span style="font-size: 10px;">Payé maintenant</span></b></a>';

                            $datepenalite = strtotime($encour['echeance']. ' + 10 days');

                              if($encour['status'] != 1)
                              {
                                if(time() >= $datepenalite)
                                {
                                    //avec penalité
                                    $status = '<span class="label label-danger">En retard</span>';
                                    //$action = '<a href="'.site_url('inventory/paiementpenalite/'.$query['id']).'" title="Payé maintenant"><b>Payé M</b></a>';
                                }else
                                {
                                 $status = '<span class="label label-warning">En cours</span>'; 
                                }
                              }else
                              {
                                $action = '<span class="label label-success">Ok</span>';
                                $status = '<span class="label label-success">Payer</span>';
                              }


                              if($encour['date_paiement'] == 0)
                              {
                                $date_pp = "Pas encore payer";
                              }else
                              {
                                $date_pp = date("d/m/Y", $encour['date_paiement']);
                              }
                        ?>
                          <tr>
                              <td><?=$vente?></td>
                              <td><?=$client?></td>
                              <td><?=$encour['versement']?></td>
                              <td><?=number_format($encour['montant'], 0, ' ', ' ').' FCFA'?></td>
                              <td><?=$encour['echeance']?></td>
                              <td><?=$status?></td>
                              <td><?=$date_pp?></td>
                              <td><?=$action?></td>
                          </tr>
                       <?php } } ?>
                      </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

<?php $this->load->view('template/_parts/front_master_footer_view');?>
