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
		echo $this->Form->input('user_id',array('div'=>false,'error'=>false,'type'=>'hidden','value'=>$data['user_id']));
			echo $this->Form->input('product_id',array('div'=>false,'error'=>false,'before' => '<div class="form-group">', 'after' => '</div>' , 'class'=>'validate[required] form-control'));
			if($product_selected == 'disabled'){
				echo $this->Form->input('product_id',array('div'=>false,'error'=>false,'type'=>'hidden'));
			}

			echo $this->Form->input('type',array('div'=>false,'error'=>false, 'type'=>'select', 'options'=>array('0'=>'Select Category','order'=>'Order','fulfillment'=>'Fulfillment','sale'=>'Sales'), 'before' => '<div class="form-group">', 'after' => '</div>' , 'class'=>'validate[required] form-control',$type_selected));
			if($type_selected == 'disabled'){
				echo $this->Form->input('type',array('div'=>false,'error'=>false,'type'=>'hidden'));
			}
			
		echo $this->Form->input('quantity',array('div'=>false,'error'=>false,'type'=>'hidden', 'id'=>'myQuan'));
		echo $this->Form->input('purchase_price',array('div'=>false,'error'=>false,'type'=>'hidden', 'id'=>'mypurchasePrice'));
		echo $this->Form->input('sale_price',array('div'=>false,'error'=>false,'type'=>'hidden', 'id'=>'mysalePrice'));
		echo $this->Form->input('variant',array('div'=>false,'error'=>false,'type'=>'hidden', 'value'=>1));
		
		?>
       
			<div id='result'></div>
        
       <br /> 
 </div>
            </div>
        </div>
	</fieldset>
    
<?php echo $this->Form->submit(__('Submit'),array('div'=>false, 'class'=>'btn btn-lg btn-success btn-block' ,'id' => 'getVarientValue')); echo $this->Form->end();	?>
</div>
<script>
var ServerConfig = '<?php echo Configure::read('ServerBaseURL'); ?>';
$( "#InventoryType" ).change(function() {
	var ProductId = $('#InventoryProductId').val();
	var ProductType = $(this).val();
    $.post(ServerConfig+"/inventories/getform/"+ProductId+'/'+ProductType, function(data, status){
		console.log(data); 
		$('#result').html(data);
    });
});

$( "#InventoryProductId" ).change(function() {
	var ProductId = $(this).val();
	var ProductType = $('#InventoryType').val();
    $.post(ServerConfig+"/inventories/getform/"+ProductId+'/'+ProductType, function(data, status){
		console.log(data); 
		$('#result').html(data);
    });
});


$('#getVarientValue').click(function() {
	var myQuan=0,mysalePrice=0,mypurchasePrice=0;
		var type = $('#type').val();
		$('.invent_quantity').each(function() {
			myQuan += (isNaN(parseInt($( this ).val()))) ? 0 : parseInt($( this ).val());
		});
		$('#tab div.col-lg-4').each(function() {
			
			myQuantity = (isNaN(parseInt($( this ).find('input.invent_quantity').val()))) ? 0 : parseInt($( this ).find('input.invent_quantity').val());
			console.log(myQuantity);
			
			if(type == 'order'){
				mypurchasePrice += (isNaN(parseFloat($( this ).find('input.invent_purchase_price').val()))) ? 0 : (parseFloat($( this ).find('input.invent_purchase_price').val()) *  parseInt($( this ).find('input.invent_quantity').val()));
				mysalePrice += (isNaN(parseFloat($( this ).find('input.invent_sale_price').val()))) ? 0 : (parseFloat($( this ).find('input.invent_sale_price').val()) *  parseInt($( this ).find('input.invent_quantity').val()));
			}else if(type == 'fulfillment'){
				if(myQuantity != 0){
					mypurchasePrice += (isNaN(parseFloat($( this ).find('input.invent_purchase_price').val()))) ? 0 : (parseFloat($( this ).find('input.invent_purchase_price').val()) *  parseInt($( this ).find('input.invent_quantity').val()));
					mysalePrice += (isNaN(parseFloat($( this ).find('input.invent_sale_price').val()))) ? 0 : (parseFloat($( this ).find('input.invent_sale_price').val()) *  parseInt($( this ).find('input.invent_quantity').val()));
				}
				console.log(mypurchasePrice);
				console.log(mysalePrice); 
			}else if(type == 'sale'){
				if(myQuantity != 0){
					mypurchasePrice += (isNaN(parseFloat($( this ).find('input.invent_purchase_price').val()))) ? 0 : (parseFloat($( this ).find('input.invent_purchase_price').val()) *  parseInt($( this ).find('input.invent_quantity').val()));
					mysalePrice += (isNaN(parseFloat($( this ).find('input.invent_sale_price').val()))) ? 0 : (parseFloat($( this ).find('input.invent_sale_price').val()) *  parseInt($( this ).find('input.invent_quantity').val()));	
				}
				console.log(mypurchasePrice);
				console.log(mysalePrice); 
			}
		});
		$('#myQuan').val(myQuan);
		$('#mypurchasePrice').val(mypurchasePrice);
		$('#mysalePrice').val(mysalePrice);
}); 

</script>
