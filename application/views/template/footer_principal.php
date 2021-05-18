 </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0
    </div>
    <strong>Copyright &copy; <?=date('Y')-1?>-<?=date('Y')?> <a href="http://simple-three.com/">Simple Three</a>.</strong> All rights
    reserved.
  </footer>

  
  <div class="control-sidebar-bg"></div>
</div>
<!-- jQuery 3 -->

<script src="<?=site_url('assets/')?>bower_components/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?=site_url('assets/')?>bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="<?=site_url('assets/')?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="<?=site_url('assets/')?>bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?=site_url('assets/')?>bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->

<!-- daterangepicker -->
<script src="<?=site_url('assets/')?>bower_components/moment/min/moment.min.js"></script>
<script src="<?=site_url('assets/')?>bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="<?=site_url('assets/')?>bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="<?=site_url('assets/')?>plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="<?=site_url('assets/')?>bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?=site_url('assets/')?>bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?=site_url('assets/')?>dist/js/adminlte.min.js"></script>
<!-- Select2 -->
<script src="<?=site_url('assets/')?>bower_components/select2/dist/js/select2.full.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?=site_url('assets/')?>dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?=site_url('assets/')?>dist/js/demo.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.5/js/dataTables.responsive.min.js"></script>

<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.5/js/responsive.bootstrap4.min.js"></script>


<script>
  $(function () {
    $('#example1').DataTable({
      'responsive': true
    })
  })
</script>


<script>
  var base_url = "<?php echo base_url('inventory/'); ?>";
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
    $('#brand').select2()
  })
</script>

<!--POUR LA BOITE BOOTBOX-->
<script src="<?=site_url('assets/bootbox/bootbox.min.js')?>"></script>
<script src="<?=site_url('assets/bootbox/bootbox.locales.min.js')?>"></script>

<?php if($page_title_sous == 'list product'){ ?>
  <script type="text/javascript">
    var productTable;
    
    $(document).ready(function() {
        $("#languageNav").addClass('active');
            
        // initialize the datatable 
        var base_url = "<?php echo base_url('products/');?>"; // You can use full url here but I prefer like this
        productTable = $('#productTable').DataTable({
            
            'paging': true,
            'lengthChange': true,
            'searching': false,
            /*'ordering': true,*/
            'info': true,
            'responsive': true,
            /* Processing indicator */
            "processing": true,
            "pageLength" : 10,
            "serverSide": true,
            "order": [],
            "ajax":{
              dataType: "JSON",
              url :  base_url+'data_product',
              type : 'POST',

              
              data: function(data){
                   data.name = $('#name').val();
                   data.brand = $('#brand').val();
                   data.code = $('#code').val();
                  }
            },
            

        });

       $('#brand').change(function(){
          productTable.draw();
       });
       $('#code,#name').keyup(function(){
          productTable.draw();
       });
    });
</script>
<?php } ?>
<script type="text/javascript">
  var base_url = "<?php echo base_url('sells/'); ?>";
  var base_url2 = "<?php echo base_url('products/'); ?>";
  $(document).ready(function() {
    
    $('#brand').on('change', function(){
          var brand = $(this).val();
            $.ajax({
                url: base_url2+"selectModelByBrand",
                type: "POST",
                data: {"brand" : brand},
                dataType: 'json',
                success: function(data) {
                  $('#modele').html(data);
                },
                error: function(){
                  alert('error');
                }
            });
    });


    $('#modele').on('change', function(){
          var pro = $(this).val();
            $.ajax({
                url: base_url2+"selectQntByModel",
                type: "POST",
                data: {"pro" : pro},
                dataType: 'json',
                success: function(data) {
                  $('#qntbis').val(data.qnt);
                  $('#prix_u').val(data.prix);
                },
                error: function(){
                  alert('error');
                }
            });
    });


    $('#type_vente').on('change', function(){
        var type = $(this).val();
        if(type == "" || type == -1)
        { 
         $('input[name ="mnt_v1"]').attr('disabled', 'disabled'); //Disable
         $('input[name ="nb_v_restant"]').attr('disabled', 'disabled'); //Disable
         $('input[name ="mnt_v1"]').val(''); //Disable
         $('input[name ="nb_v_restant"]').val(''); //Disable
        }else{ 
          $('input[name ="mnt_v1"]').removeAttr('disabled'); //Enable
          $('input[name ="nb_v_restant"]').removeAttr('disabled'); //Enable
        }
    })


     $('#qnt').on('input', function(){
          var qnt = $(this).val();
          var prix_u = $('input[name ="prix_u"]').val();
          var prix_acc = $('input[name ="prix_acc"]').val();
          var total = (prix_u*qnt);

          if(prix_acc == '')
          {
            total = parseInt(total) + 0
          }else{
             total = parseInt(total) + parseInt(prix_acc)
          }

          //alert(parseInt(total))
              //total = parseInt(total) + parseInt(prix_acc)
          $('#totalPrix').val(total);
          $('#prix_tn').val(total);
      })

      $('#prix_u').on('input', function(){
          var prix_u = $(this).val();
          var qnt = $('input[name ="qnt"]').val();
          var prix_acc = $('input[name ="prix_acc"]').val();
          var total = (prix_u*qnt);
          if(prix_acc == '')
          {
            total = parseInt(total) + 0
          }else{
             total = parseInt(total) + parseInt(prix_acc)
          }
          $('#totalPrix').val(total);
          $('#prix_tn').val(total);
      })

      $('#prix_acc').on('input', function(){
          var prix_acc = $(this).val();
          var qnt = $('input[name ="qnt"]').val();
          var prix_u = $('input[name ="prix_u"]').val();
          var total = (prix_u*qnt);
          if(prix_acc == '')
          {
            total = parseInt(total) + 0
          }else{
             total = parseInt(total) + parseInt(prix_acc)
          }
          $('#totalPrix').val(total);
          $('#prix_tn').val(total);
      })



      $('#penalite').on('input', function(){
          var penalite = $(this).val();
          if(penalite=="")
          {
            penalite = 0;
          }
          var montant = $('#montant').val();
          var total = parseInt(penalite) + parseInt(montant);
          $('input[name ="total"]').val(total);
      })

      

      $('#type_vente').on('change', function(){
        var type = $(this).val();
        if(type == "" || type == -1)
        { 
         $('#btn').text('Enregister');
        }else{ 
          $('#btn').text('Suivant');
        }
      })

      $('#client').on('change', function(){
            var id_client = $(this).val();
            $.ajax({
                url: base_url+"getinfoByClient",
                type: "POST",
                data: {"id_client" : id_client},
                dataType: 'json',
                success: function(data) {
                 $('#contact').val(data.contact);
                  /*$('#nameAp').val(data.name);*/
                },
                error: function(){
                  alert('error');
                }
            })
      });

     /* $('#brand').on('change', function(){
            var brand = $(this).val();
            $.ajax({
                url: base_url+"getinfoByAppareil",
                type: "POST",
                data: {"brand" : brand},
                dataType: 'json',
                success: function(data) {
                 $('#prix_u').val(data.prix_vente);
                  /*$('#nameAp').val(data.name);*/
                /*},
                error: function(){
                  alert('error');
                }
            })
      });*/

      var i = 1;

      $('#add').click(function(){
        i++;
        $('#dynamic_field').append('<tr id="row'+i+'"><td><input type="text" class="form-control name_list" id="emeil" placeholder="EMEI de l\'appareil '+i+'" name="emeil[]" required></td><td><button name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>')
      });

      $(document).on('click', '.btn_remove', function(){
        var button_id = $(this).attr("id");
        //alert(button_id)
        $("#row"+button_id+"").remove();
      });
  });
</script>


</body>
</html>
