<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Yalachi Admin - Login</title>
    <link rel="icon" href="<?php echo BASE_URL; ?>favicon.ico" type="image/x-icon" />
    <!--<meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
	<?php 
	echo $this->Html->css('bootstrap.min'); 
	echo $this->Html->css('plugins/metisMenu/metisMenu.min'); 
	echo $this->Html->css('plugins/timeline'); 
	echo $this->Html->css('sb-admin-2'); 
	echo $this->Html->css('plugins/morris'); 
	echo $this->Html->css('font-awesome-4.1.0/css/font-awesome.min');
	?>
  </head>
  <body>
  	<div class="container">
        <div class="row">
    	 	<div class="col-md-4 col-md-offset-4">
    		<?php 
                echo $this->Html->link($this->Html->image('logo.png',array('border'=>0,'alt'=>'logo')),array('action'=>'index'),array('escape'=>false,'class'=>'logo_link'));			
            ?>
		<?php echo $this->fetch('content'); ?>
    </div></div></div>
    <?php 
	echo $this->Html->script('jquery.min'); 
	echo $this->Html->script('bootstrap.min');
	echo $this->Html->script('plugins/metisMenu/metisMenu.min');
	echo $this->Html->script('sb-admin-2');
	?>
    <script>
	$(".logintabs").click(function () {
		$('.emailformError').remove();
		$('#email').val('');
		$('.forgotBox').slideUp('normal', function() {
			$('.loginBox').slideDown(function() {
			});
		});
	});
	
	$(".forgottabs").click(function () {
		$('.usernameformError').remove();
		$('.passwordformError').remove();
		$('#username').val('');
		$('#password').val('');
		$('.loginBox').slideUp('normal', function() { console.log('a');alert('a');
			$('.forgotBox').slideDown(function() {
			});
		});
	});
	

</script>
  </body>
</html>