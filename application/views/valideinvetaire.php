<?php 
//var_dump($listproduit);die;
defined('BASEPATH') OR exit('No direct script access allowed');

$this->load->view('template/_parts/front_master_header_view'); ?>
<div class="container">
    <br>
    <br>
    <div class="panel panel-success">
        <div class="panel-heading">
            <h4>Total : <?php if(!is_bool($listproduit)) { echo count($listproduit); }?> Produits</h4>
        </div>
        <div class="panel-body">
            <div class="table-wrap">
                <?php //$listinventairesnotvalided = false;
                            if($listproduit==false){
                                 ?>   
                                    <ul class="fa-ul col-sm-12">
                                      <li><i  style="position: initial;"class="fa-li fa fa-spinner fa-spin fa-5x"></i></li>
                                    </ul>

                                 <?php
                            }
                            else{?>

                            <?php if(!empty($this->session->flashdata('message'))) {   ?>
                                <div class="alert alert-success alert-dismissible" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <?php
                              echo $this->session->flashdata('message');
                              ?>
                                </div>
                                <?php  }if(!empty($this->session->flashdata('errors'))) { ?><div class="alert alert-warning alert-dismissible" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <?php
                              echo $this->session->flashdata('errors');
                              ?>
                                </div>
                                <?php  } ?>
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Code</th>
                            <th>Marque</th>
                            <th>Modèle produit</th>
                            <th>Quantité comptée</th>
                            <th>Compteur</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($listproduit as $listproduit) {  

                          $row = $this->Crud_model->selectProduitByID($listproduit->id_products);
                          $brand = $this->db->get_where('brands', array('id' => $row->brand))->row_array();
                          $user = $this->Crud_model->selectUser($listproduit->id_counter);
                        ?>  
                                    <tr>
                                        <td><?=$row->codeIdentification?></td>
                                        <td style='font-size: 12px;'><?=$brand['name']?></td>
                                        <td style='font-size: 12px;'><?=$row->name?></td>
                                        <td><?=preg_replace("#,#"," ",number_format($listproduit->qntcompter))?></td>
                                        <td><?=$user['username']?></td>
                                        <td><button type="button" class="btn btn-success btnmoi2" data-backdrop="static" data-toggle="modal" data-target="#myModal2<?=$row->id?>" style='margin-bottom: 10px;'>Validé</button>

                                        <div id="myModal2<?=$row->id?>" class="modal fade" role="dialog">
                                          <div class="modal-dialog">
                                            <!-- Modal content-->
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title">
                                                  êtes vous sûr de vouloir faire cette action ?
                                                </h4>
                                              </div>
                                              <div class="modal-body">
                                                <p>
                                                Quantité : <?=preg_replace("#,#"," ",number_format($listproduit->qntcompter))?><br/><br/>
                                                
                                                </p>
                                              </div>
                                              
                                              <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">NON</button>
                                                <a type="submit" class="btn btn-success btnmoi" href="<?=site_url('main/validationinventaireByproduit/'.$row->id)?>">OUI</a>
                                              </div>
                                            </div>
                                          </div>
                                        </div>


                                          <div id="myModal<?=$row->id?>" class="modal fade" role="dialog">
                                            <div class="modal-dialog">
                                              <!-- Modal content-->
                                              <div class="modal-content">
                                                <div class="modal-header">
                                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                  <h6 class="modal-title">Modèle produit : <?php if( strlen($row->name) > 28){
                                                      $ts = str_split($row->name, 28);
                                                      foreach($ts as $value){
                                                        echo $value;
                                                      }
                                                  }else{echo $row->name;} ?> <br>
                                                    Code : <?=$row->codeIdentification?> <br>
                                                    Marque : <?=$brand['name']?> <br>
                                                  </h6>
                                                </div>
                                                <form action="<?=site_url('main/corrections')?>" method="post">
                                                  <div class="modal-body">
                                                  <p>
                                                   
                                                      Quantité : <input class="form-control" value="<?=$listproduit->qntcompter?>" name="quantity">
                                                      <!-- Price : <input class="form-control" value="<?=$listproduit->unit_price?>" name="price"> -->

                                                      <input type='hidden' value="<?=$row->id?>" name="id_pro">
                                                  </p>
                                                  </div>
                                                  <div class="modal-footer">
                                                    <input type="submit" name="btncorrige" class="btn btn-success" value="Corrigé et validé">
                                                  </div>
                                                </div> 
                                            </form>
                                            </div>
                                          </div>

                                          <!--  <button type="submit" style='margin-top: 25;' class="btn btn-primary btnmoi2" onclick="correctionProduts()">Corriger</button> -->
                                        </td><td><button type="button" class="btn btn-primary btnmoi2" data-backdrop="static" data-toggle="modal" data-target="#myModal<?=$row->id?>">Correction</button></td>
                                    </tr>
                                <?php  }
                            } ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>


<!-- Modal -->


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
