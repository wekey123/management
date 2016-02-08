<div id="page-wrapper">
<?php echo $this->Form->create('Inventory'); ?>
	<fieldset>
		<legend><?php echo __('Edit Inventory'); ?></legend>
	<div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
            	<div class="panel-heading">Products</div>              
                <div class="panel-body">
		<?php 		
			echo $this->Form->input('id',array('div'=>false,'error'=>false,'type'=>'hidden'));
			echo $this->Form->input('user_id',array('div'=>false,'error'=>false,'type'=>'hidden','value'=>$data['user_id']));

			echo $this->Form->input('product_id',array('div'=>false,'error'=>false,'before' => '<div class="form-group">', 'after' => '</div>' , 'class'=>'validate[required] form-control',$product_selected));
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

        <div id="tab">
        <ul style="width:100%;float:left;">
        <?php 
        $i=1;foreach($loops as $Titlekey => $loopTitle){?>
            <li style="list-style:none; float:left; margin-left:20px;">    
            <a href="#tabs-<?php echo $i;?>"><?php echo strtoupper($Titlekey);?></a> 
            </li>   
        <?php $i++;} ?>
        </ul>
        <?php $i=1;foreach($loops as $key1 => $loop){ ?> 
                
                  <div class="col-lg-12" id="tabs-<?php echo $i ?>">
                    <div class="panel panel-default">
                        <div class="panel-heading"><?php echo strtoupper($key1);?></div>              
                        <div class="panel-body"> 
                        <?php foreach($loop as $key2 => $value){  ?>
                          <div class="col-lg-4">
                                <div class="panel panel-default">
                                    <div class="panel-heading"><?php echo strtoupper($key2);?></div>              
                                    <div class="panel-body"> 
                                  <?php foreach($value as $key3 => $fields){ ?>
                                        <?php 
                                        if($key3 == 'quantity')
                                            $placeholder = 'Qty';
                                        if($key3 == 'purchase_price')
                                            $placeholder = 'Purchase Price';
                                        if($key3 == 'sale_price')
                                            $placeholder = 'Sale Price';
                                        if(!empty($this->request->data[$key1][$key2]['id'])){	
                                         echo $this->Form->input($key1.'.'.$key2.'.id',array('div'=>false,'error'=>false,'type'=>'hidden'));
                                        }
                                        echo $this->Form->input($key1.'.'.$key2.'.'.$key3 ,array('div'=>false,'error'=>false, 'before' => '<div class="form-group">', 'after' => '</div>', 'class'=>'validate[required] form-control invent_'.$key3,'placeholder'=>$placeholder,'id'=>$key1.'_'.$key2.'_'.$key3,'required'=>false,'label'=>$placeholder)); 
                                        ?>
                                  <?php } ?>
                                     </div>
                                     </div>
                          </div>
                        <?php } ?>
                        </div>
                     </div>
                   </div>
        <?php $i++;} ?>
        </div>

       <br /> 
 </div>
            </div>
        </div>
	</fieldset>
<?php echo $this->Form->submit(__('Submit'),array('div'=>false, 'class'=>'btn btn-lg btn-success btn-block' ,'id' => 'getVarientValue')); echo $this->Form->end();	?>
</div>
<script>

$(function() {
	$( "#tab" ).tabs({effect: 'ajax'});
 });

		
$( "#InventoryType" ).change(function() {
	var ProductId = $('#InventoryProductId').val();
	var ProductType = $(this).val();
    $.post("/inventories/getform/"+ProductId+'/'+ProductType, function(data, status){
		console.log(data); 
		$('#result').html(data);
    });
});

$( "#InventoryProductId" ).change(function() {
	var ProductId = $(this).val();
	var ProductType = $('#InventoryType').val();
    $.post("/inventories/getform/"+ProductId+'/'+ProductType, function(data, status){
		console.log(data); 
		$('#result').html(data);
    });
});


$('#getVarientValue').click(function() {
	var myQuan=0,mysalePrice=0,mypurchasePrice=0;
	
		$('.invent_quantity').each(function() {
			myQuan += (isNaN(parseInt($( this ).val()))) ? 0 : parseInt($( this ).val());
		});
		$('#tab div.col-lg-4').each(function() {
			mypurchasePrice += (isNaN(parseFloat($( this ).find('input.invent_purchase_price').val()))) ? 0 : (parseFloat($( this ).find('input.invent_purchase_price').val()) *  parseInt($( this ).find('input.invent_quantity').val()));
			mysalePrice += (isNaN(parseFloat($( this ).find('input.invent_sale_price').val()))) ? 0 : (parseFloat($( this ).find('input.invent_sale_price').val()) *  parseInt($( this ).find('input.invent_quantity').val()));
		});
		$('#myQuan').val(myQuan);
		$('#mypurchasePrice').val(mypurchasePrice);
		$('#mysalePrice').val(mysalePrice);
}); 

</script>
