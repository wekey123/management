<div id="page-wrapper">
<?php echo $this->Form->create('Inventory'); ?>
	<fieldset>
		<legend><?php echo __('Add Inventory'); ?></legend>
	<div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
            	<div class="panel-heading">Products</div>              
                <div class="panel-body">           
		<?php 		
		echo $this->Form->input('user_id',array('div'=>false,'error'=>false,'type'=>'hidden', 'value'=>$data['user_id']));
		echo $this->Form->input('product_id',array('div'=>false,'error'=>false,'type'=>'hidden', 'value'=>$data['product_id']));
		echo $this->Form->input('quantity',array('div'=>false,'error'=>false,'type'=>'hidden', 'id'=>'myQuan'));
		echo $this->Form->input('purchase_price',array('div'=>false,'error'=>false,'type'=>'hidden', 'id'=>'mypurchasePrice'));
		echo $this->Form->input('sale_price',array('div'=>false,'error'=>false,'type'=>'hidden', 'id'=>'mysalePrice'));
		echo $this->Form->input('variant',array('div'=>false,'error'=>false,'type'=>'hidden', 'value'=>1));
		echo $this->Form->input('type',array('div'=>false,'error'=>false, 'type'=>'select', 'options'=>array('0'=>'Select Category','order'=>'Order','sales'=>'Sales','fulfillment'=>'Fulfillment'), 'before' => '<div class="form-group">', 'after' => '</div>' , 'class'=>'validate[required] form-control' ));
		?>
        <?php foreach($loops as $key1 => $loop){ ?>
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading"><?php echo $key1;?></div>              
                <div class="panel-body"> 
			<?php foreach($loop as $key2 => $value){  ?>
              <div class="col-lg-4">
            		<div class="panel panel-default">
                        <div class="panel-heading"><?php echo $key2;?></div>              
                        <div class="panel-body"> 
					  <?php foreach($value as $key3 => $fields){ ?>
							<?php echo $this->Form->input($key1.'.'.$key2.'.'.$fields ,array('div'=>false,'error'=>false, 'before' => '<div class="form-group">', 'after' => '</div>', 'class'=>'validate[required] form-control invent_'.$fields,'placeholder'=>'Order Quantity','id'=>'pTitle','required'=>false)); ?>
					  <?php } ?>
                      </div></div></div>
			<?php } ?>
            </div></div></div>
		<?php } ?>

        
        
       <br /> 
 </div>
            </div>
        </div>
	</fieldset>
<?php echo $this->Form->submit(__('Submit'),array('div'=>false, 'class'=>'btn btn-lg btn-success btn-block' ,'id' => 'getVarientValue')); echo $this->Form->end();	?>
</div>
<script>
$('#getVarientValue').click(function() {
	var myQuan=0,mysalePrice=0,mypurchasePrice=0;
	
		$('.invent_quantity').each(function() {
			myQuan += (isNaN(parseInt($( this ).val()))) ? 0 : parseInt($( this ).val());
		});
		$('#myQuan').val(myQuan);
		
		$('.invent_purchase_price').each(function() {
			mypurchasePrice += (isNaN(parseFloat($( this ).val()))) ? 0 : (parseFloat($( this ).val()) *  parseInt($('#myQuan').val()));
		});
		$('#mypurchasePrice').val(mypurchasePrice);
		
		$('.invent_sale_price').each(function() {
			mysalePrice += (isNaN(parseFloat($( this ).val()))) ? 0 : (parseFloat($( this ).val()) *  parseInt($('#myQuan').val()));
		});
		$('#mysalePrice').val(mysalePrice);
}); 

</script>
