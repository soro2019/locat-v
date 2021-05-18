<footer class="footer">
  <div class="container">
    <p class="text-muted">© Copyright 2020. Make by <a href="https://jprobeweb.com" target="_blank">JPROBEWEB</a>.</p>
  </div>
</footer>
<script src="<?=site_url('assets/')?>bower_components/jquery/dist/jquery.min.js"></script>
<!-- Select2 -->
<script src="<?=site_url('assets/')?>bower_components/select2/dist/js/select2.full.min.js"></script>

<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
    $('#brand').select2()
  })
</script>
<script src="<?=site_url('/assets/js/bootstrap.min.js')?>"></script>
<script src="<?=site_url('/assets/js/bootbox.min.js')?>"></script>
<script src="<?=site_url('/assets/js/bootbox.locales.min.js')?>"></script>

<script type="text/javascript">

 function myFunction(){
    var box = bootbox.confirm({ 
	    size: "small",
	    message: "You are about to disconnect, are you sure?",
	    callback: function(result){ 
	         /* result is a boolean; true = OK, false = Cancel*/
	         if(result==true)
	         {
	         	var url = "<?php echo site_url('main/logout') ?>";
	         	window.setTimeout(function(){
				        // Move to a new location or you can do something else
				        window.location.href =  url;

				    }, 300);
	         	//window.location.href = url;
	         }
	  }
	})
 }
</script>
<script type="text/javascript">
  var base_url2 = "<?php echo base_url('products/'); ?>";
  $(document).ready(function() {
    
    $('#brand').on('change', function(){
          var brand = $(this).val();
            $.ajax({
                url: base_url2+"selectModelByBrandNotInvente",
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


    $('#brandexiste').on('change', function(){
          var brand = $(this).val();
            $.ajax({
                url: base_url2+"selectModelByBrandInInvente",
                type: "POST",
                data: {"brand" : brand},
                dataType: 'json',
                success: function(data) {
                  $('#modeleexiste').html(data);
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

   });

</script>
</body>
</html>


